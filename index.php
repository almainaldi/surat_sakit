<?php
include_once('class/user.php');
$user = new user();

session_start();
date_default_timezone_set('Asia/Jakarta');

if (isset($_COOKIE['username'])) {
  $user->set_by_cookie($_COOKIE['username']);
  header("location:home");
}


if (isset($_SESSION['username'])) {
  header("location:home");
}

if (isset($_POST['tombol'])) {
  $data['username'] = $_POST['username'];
  $data['password'] = $_POST['password'];

  $data['id'] = $_POST['id'];
  $data['jam'] = $_POST['jam'];
  $data['tgl'] = $_POST['tgl'];
  $data['status'] = $_POST['status'];

  if (isset($_POST['remember'])) {
    $data['remember'] = "y";
  } else {
    $data['remember'] = "t";
  }

  if ($user->login_user($data)) {
    $user->status_online($data);
    $user->online($data);
    header("location:home");
  } else {
    header("location:index?pesan=gagal");
  }

}

?>
<!DOCTYPE html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>LPS | Log in</title>
  <link rel="shorcut icon" href="master_gambar/logo.jpg">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="assets/master/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/master/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="assets/master/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/master/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="assets/master/plugins/iCheck/square/blue.css">
  <!-- Google Font -->
  <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"> -->
</head>


<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
    <a href="index.php"><b>Login</b>
      <br><b style="color: red;">SURAT SAKIT</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
      <p class="login-box-msg">Sign in to start your session</p>
      <?php
      // Notif Pesan             
      if (isset($_GET['pesan'])) {
        if ($_GET['pesan'] == "gagal") {
          echo "<div class='alert alert-danger'>Login gagal! username dan password salah!</div>";
        } else if ($_GET['pesan'] == "logout") {
          echo "<div class='alert alert-info'>Anda telah berhasil logout</div>";
        }
      }
      ?>

      <form action="" method="post">
        <div class="form-group has-feedback">
          <input type="text" name="username" class="form-control" placeholder="Username">
          <input type="hidden" name="id" class="form-control">
          <input type="hidden" name="jam" class="form-control" value="<?php echo date('H:i:s'); ?>">
          <input type="hidden" name="tgl" class="form-control" value="<?php echo date('Y-m-d'); ?>">
          <input type="hidden" name="status" class="form-control" value="MASUK">
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="password" name="password" class="form-control" placeholder="Password">
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
          <div class="col-xs-8">
            <div class="checkbox icheck">
              <label>
                <input type="checkbox" name="remember"> Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-xs-4">
            <button type="submit" name="tombol" class="btn btn-primary btn-block btn-flat">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.login-box-body -->
  </div>
  <!-- /.login-box -->

  <!-- jQuery 3 -->
  <script src="assets/master/bower_components/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="assets/master/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- iCheck -->
  <script src="assets/master/plugins/iCheck/icheck.min.js"></script>
  <script>
    $(function() {
      $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' /* optional */
      });
    });
  </script>
</body>