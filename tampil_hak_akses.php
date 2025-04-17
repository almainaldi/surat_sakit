<?php 
include_once('template/header.php');
include_once('class/user.php');
$user = new user();
$data_user = $user->tampil_data();
//$user->cek_admin();

if(isset($_GET['hapus_username']))
{
  if($user->cek_id($_GET['hapus_username']))
  {
    if($user->hapus($_GET['hapus_username']))
    {
      header("location:tampil_user?pesan=hapus");
    }
    else 
    {
      header("location:tampil_user?pesan=gagal");
    }
  }
  else
  {
    header("location:tampil_user");    
  }
}
?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data User
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Data User</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          
          <!-- /.box -->

          <div class="box">
            <div class="box-header">
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <a href="tambah_user"><button class="btn btn-info">Tambah Data</button></a>
            <hr/>
            <?php 
              if(isset($_GET['pesan'])){
                if($_GET['pesan'] == "success"){
                    echo "<div class='alert alert-success'>Data Berhasil Ditambahkan</div>";
                }else if($_GET['pesan'] == "gagal"){
                     echo "<div class='alert alert-danger'>Data Gagal Ditambahkan</div>";
                   }else if($_GET['pesan'] == "update"){
                     echo "<div class='alert alert-success'>Data Berhasil Di Update</div>";
                   }else if($_GET['pesan'] == "hapus"){
                     echo "<div class='alert alert-success'>Data Berhasil Di Hapus</div>";
                   }else if($_GET['pesan'] == "gambarambar"){
                     echo "<div class='alert alert-success'>Gambar Berhasil Di Tambah</div>";
                   }
                }
              ?>
              <div class="panel-body table-responsive no-padding">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Username</th>
                  <th>Nama</th>
                  <th>Tipe</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if($data_user->num_rows > 0)
                {
                  $no = 1;
                  while($row = mysqli_fetch_object($data_user))
                  {
                    ?>
                    <tr>
                      <td><?php echo $no; ?></td>
                      <td><?php echo $row->username ?></td>
                      <td><?php echo $row->nama ?></td>
                      <td><?php echo $row->tipe ?></td>
                      <div class="btn-group-vertical">
                      <td>
                        <a href="edit_akses?username=<?php echo $row->username; ?>"><button type="button" class="btn btn-success btn-sm">Edit</button></a>
                      </td>
                      </div>
                    </tr>
                    <?php
                    $no++;
                  }
                }
                ?>
                
                </tbody>
              </table></div>
            </div>
            <!-- /.box-body -->
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
  
