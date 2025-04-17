<?php
include_once('template/header.php');
include_once('class/user.php');
$user = new user();
//$user->cek_admin();

if (!empty($_GET['username'])) {
  $username = $_GET['username'];
  if ($user->cek_id($username)) {
    //JIKA DATA ADA
    $data_user = $user->get_by_id($username);
  } else {
    header("location:tampil_user");
  }
} else {
  header("location:tampil_user?pesan=gagal");
}


if (isset($_POST['tombol'])) {
  $data = array(
    "username" => $_POST['username'],
    "nama" => $_POST['nama'],
    "password" => $_POST['password']
  );


  if ($user->edit($data)) {
    header("location:tampil_user?pesan=update");
  } else {
    $error = "Gagal Update Data";
  }
}

?>
<script src="assets/validasi_form/edit_user.js" type="text/javascript"></script>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Update User
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Update User</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">

        <!-- /.box -->

        <div class="box box-info">
          <div class="box-header with-border">
            <?php
            if (isset($_GET['pesan'])) {
              if ($_GET['pesan'] == "gagal") {
                echo "<div class='alert alert-danger'>Data Gagal Ditambahkan</div>";
              }
            }
            ?>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form id="form" class="form-horizontal" method="post" action="">
            <input type="hidden" name="username" value="<?php echo $data_user['username']; ?>">
            <div class="box-body">

              <div class="form-group">
                <label for="username" class="col-sm-2 control-label">Username</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="username" value="<?php echo $data_user['username']; ?>" readonly>
                </div>
              </div>

              <div class="form-group">
                <label for="nama" class="col-sm-2 control-label">Nama</label>
                <div class="col-sm-10">
                  <input type="text" name="nama" class="form-control" id="nama" value="<?php echo $data_user['nama']; ?>" placeholder="Isikan Nama User">
                </div>
              </div>

              <div class="form-group">
                <label for="password" class="col-sm-2 control-label">Password</label>
                <div class="col-sm-10">
                  <input type="password" name="password" class="form-control" id="password" placeholder="Isikan Password User">
                </div>
              </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <button type="submit" name="tombol" class="btn btn-info pull-left">Update User</button>
            </div>
            <!-- /.box-footer -->
          </form>
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php
include_once('template/footer.php');
?>