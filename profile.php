<?php 
include_once('template/header.php');
include_once('class/user.php');
$user = new user();

$data_user = $user->get_by_id($_SESSION['username']);  // Berdasarkan user yg sedang online


if(isset($_POST['tombol']))
{
    $data = array(
      "username"=>$_POST['username'],
      "nama"=>$_POST['nama'],
      "password"=>$_POST['password']
      );

    
    if($user->edit_profile($data))
    {
      
      header("location:profile?pesan=success");
    }
    else
    {
      header("location:profile?pesan=gagal");
    }

}

?>
  <script src="assets/validasi_form/edit_user.js" type="text/javascript"></script>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Update Password User
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Update Password User</li>
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
              if(isset($_GET['pesan'])){
                if($_GET['pesan'] == "success"){  
                    echo "<div class='alert alert-success'>Password Berhasil Diubah</div>";
                   }else if($_GET['pesan'] == "gagal"){
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
                  <label for="nama" class="col-sm-2 control-label">Nama</label>

                  <div class="col-sm-10">
                    <input type="text" name="nama" class="form-control" id="nama" value="<?php echo $data_user['nama']; ?>" placeholder="Isikan Nama User">
                  </div>
                </div>


                <div class="form-group">
                  <label for="password" class="col-sm-2 control-label">Password</label>

                  <div class="col-sm-10">
                    <input type="password" name="password" class="form-control" id="password" placeholder="Isikan Password baru">
                  </div>
                </div>

                
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" name="tombol" class="btn btn-info pull-left">Save Data </button>
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
  
