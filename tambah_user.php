<?php 
include_once('template/header.php');
include_once('class/user.php');
$user = new user();
//$user->cek_admin();




if(isset($_POST['tombol']))
{
    $data = array(
      "username"=>$_POST['username'],
      "nama"=>$_POST['nama'],
      "password"=>$_POST['password'],
      "jabatan"=>$_POST['jabatan'],
      "app"=>$_POST['app'],
      "ttd"=>$_POST['ttd'],
      "gambar"=>$_POST['gambar'],
      "status_pengurus"=>$_POST['status_pengurus']
      );

    $hasil = $user->tambah($data);
    if($hasil['status'])
    {
      header("location:tampil_user");  
    }
    else
    {
      $error = $hasil['pesan'];
    }
}

?>
  <script src="assets/validasi_form/tambah_user.js" type="text/javascript"></script>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Tambah User
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Tambah User</li>
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
              if(isset($error))
              {
                ?>
                <div class="alert alert-danger" role="alert"><?php echo $error; ?></div>
                <?php
              }
              ?>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form id="form" class="form-horizontal" method="post" action="">
              <div class="box-body">
              <!-- Username -->
                <div class="form-group">
                  <label for="username" class="col-sm-2 control-label">Username</label>
                  <div class="col-sm-10">
                    <input type="text" name="username" class="form-control" id="username" placeholder="Isikan Username">
                  </div>
                </div>
              <!-- END Username -->
              
              <!-- Nama -->
                <div class="form-group">
                  <label for="nama" class="col-sm-2 control-label">Nama</label>
                  <div class="col-sm-10">
                    <input type="text" name="nama" class="form-control" id="nama" placeholder="Isikan Nama User">
                  </div>
                </div>
              <!-- END Nama -->

              <!-- Password -->
                <div class="form-group">
                  <label for="password" class="col-sm-2 control-label">Password</label>
                  <div class="col-sm-10">
                    <input type="password" name="password" class="form-control" id="password" placeholder="Isikan Password User">
                  </div>
                </div>
              <!-- END Password -->

                <input type="hidden" name="tipe" class="form-control" id="" value="0">
                <input type="hidden" name="app" class="form-control" id="" value="do">
                <input type="hidden" name="gambar" class="form-control" id="gambar" value="0">
                <span id="myAnalisa"></span>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" name="tombol" class="btn btn-info pull-left">Tambah User</button>
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
  <script>
   /*
      "status_pengurus"  mentukan K.pool Box,Mobil Motor = 1 / Mobil Trailer = 2
  */
  function user(value) {
  if(value == "k.pool") {
    document.getElementById("myAnalisa").innerHTML = "<div class='form-group'> <label for='' class='col-sm-2 control-label'>Tipe K.POOL</label> <div class='col-sm-10'> <select name='status_pengurus' class='form-control'> <option value='1'>Mobil Box, Motor, Meja, Storing</option> <option value='2'>Mobil Trailer</option> </select> </div> </div>";
  }else {
    document.getElementById("myAnalisa").innerHTML = ""; 
  }
}
</script>
  <!-- /.content-wrapper -->
<?php
include_once('template/footer.php');
?>
  
