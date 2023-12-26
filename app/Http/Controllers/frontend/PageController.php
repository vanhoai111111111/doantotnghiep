<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Helpers\SeoHelper;
use Illuminate\Http\Request;
use App\Models\ProductModel;
use App\Models\CategoryModel;
use App\Models\BrandModel;
use App\Models\ImageModel;
use App\Models\CommentModel;
use App\Models\OrderModel;
use App\Models\OrderdetailModel;
use App\Models\PostModel;
use App\Models\SlideModel;
use Illuminate\Support\Facades\Auth;
use Session;
use Illuminate\Support\Str;

class PageController extends Controller
{
    //
    public function __construct(){
        $priceMax = ProductModel::max('product_price_sell');
        $priceMin = ProductModel::min('product_price_sell');
        $dataCategory = CategoryModel::all();
        $dataBrand = BrandModel::all();
        
        view()->share([
            'dataCategory' => $dataCategory, 
            'dataBrand' => $dataBrand, 
            'priceMax' => $priceMax, 
            'priceMin' => $priceMin,
            'priceMinFilter' => $priceMin+2000000,
            'priceMaxFilter' => $priceMax-2000000,
            
        ]);
    }

    public function index(){
        $dataProductNews = ProductModel::orderBy('product_id', 'DESC')->paginate(8);
        $dataProductSales = ProductModel::orderBy('product_sale', 'DESC')->limit(8)->get();
        $dataProductSell = OrderdetailModel::groupBy('product_id')->select('product_id')->orderBy('order_detail_id', 'DESC')->limit(4)->get();
        $dataComment = CommentModel::where('comment_status', 3)->limit(4)->get();
        $dataSilde = SlideModel::where('active', 1)->where('type', 1)->orderBy('id', 'DESC')->limit(4)->get();
        $dataBanner = SlideModel::where('active', 1)->where('type', 2)->orderBy('id', 'DESC')->first();
        $dataPost = PostModel::orderBy('id', 'DESC')->limit(4)->get();
        $searchKeyword = session('search_keyword');
        $search_keyword1 = ProductModel::where('product_name', 'LIKE', '%'.$searchKeyword.'%')->inRandomOrder()->limit(4)->get();
        $dataProductMostPurchased = OrderdetailModel::select('product_id', \DB::raw('SUM(order_detail_quantity) as total_quantity'))
        ->groupBy('product_id')
        ->orderByDesc('total_quantity')
        ->limit(1)
        ->get();
        return view('frontend.pages.home',[
            'dataProductNews' => $dataProductNews,
            'dataProductSales' => $dataProductSales,
            'dataProductSell' => $dataProductSell,
            'dataComment' => $dataComment,
            'dataSilde' => $dataSilde,
            'dataBanner' => $dataBanner,
            'dataPost' => $dataPost,
            'search_keyword1' => $search_keyword1,
            'dataProductMostPurchased' => $dataProductMostPurchased,

        ]);
    }

    public function shop(){
        
        $dataProductSales = ProductModel::orderBy('product_sale', 'DESC')->limit(4)->get();

        if($this->checkFilter()){
            $price_start = $_GET['price_start'];
            $price_end = $_GET['price_end'];
            $data = ProductModel::whereBetween('product_price_sell', [$price_start, $price_end])->orderBy('product_id', 'DESC')->paginate(9);
        }
        else if($this->checkSort()){
            $sortBy = $_GET['sort_by'];
            $data = $this->sortByShop($sortBy);
        }
        else if($this->checkSearch()){
            $keyword = $_GET['search_keyword'];
            $data = ProductModel::where('product_name', 'LIKE', '%'.$keyword.'%')->paginate(9);
            
            Session::put('search_keyword', $keyword);
        }
        else{
            $data = ProductModel::orderBy('product_id', 'DESC')->paginate(9);
        }
        return view('frontend.pages.shop',[
            'data' => $data,
            'dataProductSales' => $dataProductSales,
            
        ]);
    }

    public function category($id){
        $dataProductSales = ProductModel::orderBy('product_sale', 'DESC')->limit(4)->get();
        $data_category = CategoryModel::find($id);
    
        if($this->checkFilter()){
            // echo $id;
            $price_start = $_GET['price_start'];
            $price_end = $_GET['price_end'];
            $data = ProductModel::where('category_id', $id)->whereBetween('product_price_sell', [$price_start, $price_end])->orderBy('product_id', 'DESC')->paginate(9);
        }
        else if($this->checkSort()){
            $sortBy = $_GET['sort_by'];
            $data = $this->sortByCategory($sortBy, $id);
        }
        else{
            $data = ProductModel::where('category_id', $id)->orderBy('product_id', 'DESC')->paginate(9);
        }
        return view('frontend.pages.shop',[
            'data' => $data,
            'dataProductSales' => $dataProductSales,
         
        ]);
    }

    public function brand($id){
        $dataProductSales = ProductModel::orderBy('product_sale', 'DESC')->limit(4)->get();
        $data_brand = BrandModel::find($id);
    
        if($this->checkFilter()){
            $price_start = $_GET['price_start'];
            $price_end = $_GET['price_end'];
            $data = ProductModel::where('brand_id', $id)->whereBetween('product_price_sell', [$price_start, $price_end])->orderBy('product_id', 'DESC')->paginate(9);
        }
        else if($this->checkSort()){
            $sortBy = $_GET['sort_by'];
            $data = $this->sortByBrand($sortBy, $id);
        }
        else{
            $data = ProductModel::where('brand_id', $id)->orderBy('product_id', 'DESC')->paginate(9);
        }
        return view('frontend.pages.shop',[
            'data' => $data,
            'dataProductSales' => $dataProductSales,
           
        ]);
    }

    public function product($id){
        $pos = strpos($id, "-");
        $id = substr($id, 0, $pos);//Cắt lấy id theo cái - đầu

        $data = ProductModel::find($id);    
        $dataProductCategory = ProductModel::where('product_id', '!=', $id)->where('category_id', $data->category_id)->orderBy('product_sale', 'DESC')->limit(4)->get();
        $dataProductImages = ImageModel::where('product_id', $id)->get();
        $dataComment = CommentModel::where('product_id', $id)->orderBy('comment_id', 'DESC')->limit(3)->get();
        $rating = CommentModel::where('product_id', $id)->avg('comment_rating');
        $rating = round($rating);
        $checkCmt = false;
        $dataOrder = OrderModel::where('user_id', Auth::id())->get();
        foreach($dataOrder as $order){
            $dataOrderDetail = OrderdetailModel::where('order_id', $order->order_id)->get();
            foreach($dataOrderDetail as $detail){
                if($detail->product_id == $id){
                    $checkCmt = true;
                }
            }
        }

       

        return view('frontend.pages.product',[
            'data' => $data,
            'dataProductCategory' => $dataProductCategory,
            'dataProductImages' => $dataProductImages,
            'dataComment' => $dataComment,
            'rating' => $rating,
            'checkCmt' => $checkCmt,
        ]);
    }

    public function contact(){
        return view('frontend.pages.contact');
    }

    public function blog()
    {
        $data = PostModel::orderBy('id', 'DESC')->paginate(12);

        return view('frontend.pages.blog', [
            'data' => $data,
        ]);
    }

    public function viewBlog($id)
    {
        $pos = strpos($id, "-");
        $id = substr($id, 0, $pos);//Cắt lấy id theo cái - đầu

        $data = PostModel::find($id);
        $dataBlog = PostModel::where('id', '!=', $id)->orderBy('id', 'DESC')->limit(4)->get();

        return view('frontend.pages.post', [
            'data' => $data,
            'dataBlog' => $dataBlog,
        ]);
    }

    public function checkFilter(){
        if(isset($_GET['price_start']) && isset($_GET['price_end'])){
            return true;
        }
    }

    public function checkSort(){
        if(isset($_GET['sort_by'])){
            return true;
        }
    }

    public function checkSearch(){
        if(isset($_GET['search_keyword'])){
            return true;
        }
    }

    public function sortByShop($sortBy){
        if($sortBy == 'tang_dan'){
            return $data = ProductModel::orderBy('product_price_sell', 'ASC')->paginate(9);
        }
        else if($sortBy == 'giam_dan'){
            return $data = ProductModel::orderBy('product_price_sell', 'DESC')->paginate(9);
        }
        else if($sortBy == 'kitu_az'){
            return $data = ProductModel::orderBy('product_name', 'ASC')->paginate(9);
        }
        else {
            return $data = ProductModel::orderBy('product_name', 'DESC')->paginate(9);
        }
    }

    public function sortByCategory($sortBy, $id){
        if($sortBy == 'tang_dan'){
            return $data = ProductModel::where('category_id', $id)->orderBy('product_price_sell', 'ASC')->paginate(9);
        }
        else if($sortBy == 'giam_dan'){
            return $data = ProductModel::where('category_id', $id)->orderBy('product_price_sell', 'DESC')->paginate(9);
        }
        else if($sortBy == 'kitu_az'){
            return $data = ProductModel::where('category_id', $id)->orderBy('product_name', 'ASC')->paginate(9);
        }
        else {
            return $data = ProductModel::where('category_id', $id)->orderBy('product_name', 'DESC')->paginate(9);
        }
    }

    public function sortByBrand($sortBy, $id){
        if($sortBy == 'tang_dan'){
            return $data = ProductModel::where('brand_id', $id)->orderBy('product_price_sell', 'ASC')->paginate(9);
        }
        else if($sortBy == 'giam_dan'){
            return $data = ProductModel::where('brand_id', $id)->orderBy('product_price_sell', 'DESC')->paginate(9);
        }
        else if($sortBy == 'kitu_az'){
            return $data = ProductModel::where('brand_id', $id)->orderBy('product_name', 'ASC')->paginate(9);
        }
        else {
            return $data = ProductModel::where('brand_id', $id)->orderBy('product_name', 'DESC')->paginate(9);
        }
    }
}
