<!DOCTYPE html>
<html lang="en">
<style>
.login-box {
  margin-top: 75px;
  height: auto;
  background: #1A2226;
  text-align: center;
  box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
}

.login-key {
  height: 100px;
  font-size: 80px;
  line-height: 100px;
  background: -webkit-linear-gradient(#27EF9F, #0DB8DE);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}

.login-title {
  margin-top: 15px;
  text-align: center;
  font-size: 30px;
  letter-spacing: 2px;
  margin-top: 15px;
  font-weight: bold;
  color: #ECF0F5;
}

.login-form {
  margin-top: 25px;
  text-align: left;
}

input[type=text] {
  background-color: #1A2226;
  border: none;
  border-bottom: 2px solid #0DB8DE;
  border-top: 0px;
  border-radius: 0px;
  font-weight: bold;
  outline: 0;
  margin-bottom: 20px;
  padding-left: 0px;
  color: #ECF0F5;
}

input[type=password] {
  background-color: #1A2226;
  border: none;
  border-bottom: 2px solid #0DB8DE;
  border-top: 0px;
  border-radius: 0px;
  font-weight: bold;
  outline: 0;
  padding-left: 0px;
  margin-bottom: 20px;
  color: #ECF0F5;
}

.form-group1 {
  margin-bottom: 40px;
  outline: 0px;
}

.form-control1:focus {
  border-color: inherit;
  -webkit-box-shadow: none;
  box-shadow: none;
  border-bottom: 2px solid #0DB8DE;
  outline: 0;
  background-color: #1A2226;
  color: #ECF0F5;
}

input:focus {
  outline: none;
  box-shadow: 0 0 0;
}

label {
  margin-bottom: 0px;
}

.form-control-label {
  font-size: 10px;
  color: #6C6C6C;
  font-weight: bold;
  letter-spacing: 1px;
}

.btn-outline-primary {
  border-color: #0DB8DE;
  color: #0DB8DE;
  border-radius: 0px;
  font-weight: bold;
  letter-spacing: 1px;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
}

.btn-outline-primary:hover {
  background-color: #0DB8DE;
  right: 0px;
}

.login-btm {
  float: left;
}

.login-button {
  padding-right: 0px;
  text-align: right;
  margin-bottom: 25px;
}

.login-text {
  text-align: left;
  padding-left: 0px;
  color: #A2A4A4;
}

.loginbttm {
  padding: 0px;
}
.body{
background: #222D32;
}
</style>
<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    VH STORE
  </title>
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <base href="/">
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="../backend_assets/assets/css/material-dashboard.css?v=2.1.2" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="../backend_assets/assets/demo/demo.css" rel="stylesheet" />
</head>

<body class="body">
 
    <div class="content">

      @include('backend.note')

        <form action="admin" method="POST" autocomplete="on">
            @csrf
        <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-2"></div>
            
              
              <div class="col-lg-6 col-md-8 login-box">
                <div class="col-lg-12 login-key">
                    <i class="fa fa-key" aria-hidden="true"></i>
                </div>
                <div class="col-lg-12 login-title">
                    ADMIN PANEL
                </div>
                
                <div class="form-group">
                                <label class="form-control-label">USERNAME</label>
                                <input type="email" class="form-control" name="user_email">
                            </div>
                    <div class="form-group">
                                <label class="form-control-label">PASSWORD</label>
                                <input type="password" class="form-control" name="user_password" i>
                            </div>
                <button type="submit" class="btn btn-primary pull-right">Đăng Nhập</button>
                <div class="clearfix"></div>
            </div>
          </form>
          

</div>
        </div>
    </div>
  
  <!--   Core JS Files   -->
  <script src="../backend_assets/assets/js/core/jquery.min.js"></script>
  <script src="../backend_assets/assets/js/core/popper.min.js"></script>
  <script src="../backend_assets/assets/js/core/bootstrap-material-design.min.js"></script>
  <script src="../backend_assets/assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!-- Plugin for the momentJs  -->
  <script src="../backend_assets/assets/js/plugins/moment.min.js"></script>
  <!--  Plugin for Sweet Alert -->
  <script src="../backend_assets/assets/js/plugins/sweetalert2.js"></script>
  <!-- Forms Validations Plugin -->
  <script src="../backend_assets/assets/js/plugins/jquery.validate.min.js"></script>
  <!-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
  <script src="../backend_assets/assets/js/plugins/jquery.bootstrap-wizard.js"></script>
  <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
  <script src="../backend_assets/assets/js/plugins/bootstrap-selectpicker.js"></script>
  <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
  <script src="../backend_assets/assets/js/plugins/bootstrap-datetimepicker.min.js"></script>
  <!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
  <script src="../backend_assets/assets/js/plugins/jquery.dataTables.min.js"></script>
  <!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
  <script src="../backend_assets/assets/js/plugins/bootstrap-tagsinput.js"></script>
  <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
  <script src="../backend_assets/assets/js/plugins/jasny-bootstrap.min.js"></script>
  <!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
  <script src="../backend_assets/assets/js/plugins/fullcalendar.min.js"></script>
  <!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
  <script src="../backend_assets/assets/js/plugins/jquery-jvectormap.js"></script>
  <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
  <script src="../backend_assets/assets/js/plugins/nouislider.min.js"></script>
  <!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
  <!-- Library for adding dinamically elements -->
  <script src="../backend_assets/assets/js/plugins/arrive.min.js"></script>
  <!-- Chartist JS -->
  <script src="../backend_assets/assets/js/plugins/chartist.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="../backend_assets/assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../backend_assets/assets/js/material-dashboard.js?v=2.1.2" type="text/javascript"></script>
  <!-- Material Dashboard DEMO methods, don't include it in your project! -->
  <script src="../backend_assets/assets/demo/demo.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  @include('sweetalert::alert')
</body>

</html>