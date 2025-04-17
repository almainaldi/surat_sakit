<?php 
include_once('template/header.php');
include_once('class/user.php');
$user = new user();
//$user->cek_admin();

if(! empty($_GET['username']))
{
  $username = $_GET['username'];
  if($user->cek_id($username))
  {
    //JIKA DATA ADA
    $data_user = $user->get_by_id($username);
  }
  else
  {
    header("location:tampil_user");
  }
}
else
{
  header("location:tampil_user?pesan=gagal");
}

if(isset($_POST['tombol']))
{   
    $data = array(
      "username" => $_POST['username']
      
      );

    if(isset($_FILES['gambar']['tmp_name']))
  {
    $old_data = $user->get_by_id($data['username']);
    $old_gambar = $old_data['gambar'];

    $lokasi_file = $_FILES['gambar']['tmp_name'];
    $nama_file = $_FILES['gambar']['name'];
    $acak = rand(1,999999);
    $nama_file_unik = $acak.$nama_file;
    $dir_uploads = "master_gambar\user/";
    $file_upload = $dir_uploads.$nama_file_unik;
    if(move_uploaded_file($lokasi_file,$file_upload))
    {
      unlink("master_gambar\user/".$old_gambar);
      $data['gambar'] = $nama_file_unik; 
    }
  }

    if($user->update_gambar($data))
    {
      header("location:tampil_user?pesan=gambar");  
    }
    else
    {
       header("location:edit_user_gambar?pesan=gagal");  
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
              if(isset($_GET['pesan'])){
                if($_GET['pesan'] == "gagal"){
                    echo "<div class='alert alert-danger'>Data Gagal Ditambahkan</div>";
                }
                }
              ?>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
             <form id="form" class="form-horizontal" method="post" action="" enctype="multipart/form-data">
              <input type="hidden" name="username" value="<?php echo $data_user['username']; ?>">
              <div class="box-body">
                <div class="form-group">
                    <label for="gambar" class="col-sm-2 control-label">Gambar</label>
                    <div class="col-sm-8">
                    <input type="file" name="gambar" id="gambar" class="form-control">
                    </div>
                  </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" name="tombol" class="btn btn-info pull-left">Upload Gambar</button>
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
  
