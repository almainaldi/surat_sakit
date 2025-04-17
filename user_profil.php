<!DOCTYPE html>
<html>
<?php
include_once('template/header.php');
include_once('class/user.php');
$user = new user();

$data = $user->get_by_id($_SESSION['username']);
$data_aktifitas = $user->tampil_data_aktifitas();

if (isset($_POST['profil'])) {
  $data = array(
    "nama" => $_POST['nama']
  );

  if ($user->update_profil($data)) {
    header("location:user_profil?pesan=success");
  } else {
    header("location:user_profil?pesan=gagal");
  }
}

if (isset($_POST['ubah'])) {
  $data = array(
    "username" => $_POST['username'],
    "nama" => $_POST['nama'],
    "password" => $_POST['password']
  );

  if ($user->ubah_password($data)) {
    header("location:user_profil?pesan=success");
  } else {
    header("location:user_profil?pesan=gagal");
  }
}

// GAMBAR
if (isset($_POST['gambar'])) {
  $data = array(
    "username" => $_POST['username']

  );

  if (isset($_FILES['gambar']['tmp_name'])) {
    $old_data = $user->get_by_id($data['username']);
    $old_gambar = $old_data['gambar'];

    $lokasi_file = $_FILES['gambar']['tmp_name'];
    $nama_file = $_FILES['gambar']['name'];
    $acak = rand(1, 999999);
    $nama_file_unik = $acak . $nama_file;
    $dir_uploads = "master_gambar\user/";
    $file_upload = $dir_uploads . $nama_file_unik;
    if (move_uploaded_file($lokasi_file, $file_upload)) {
      unlink("master_gambar\user/" . $old_gambar);
      $data['gambar'] = $nama_file_unik;
    }
  }

  if ($user->update_gambar($data)) {
    header("location:user_profil?pesan=gambar");
  } else {
    header("location:user_profil?pesan=gagal");
  }
}
// END GAMBAR
?>
<div class="wrapper">
  <div class="content-wrapper">
    <section class="content-header">
    </section>
    <section class="content">
      <div class="row">
        <div class="col-lg-12">
          <ol class="breadcrumb ">
            <li><a href="<?php //echo $_SESSION['baseurl']; 
                          ?>">Dashboard </a></li>
            <li><a href="#">Daftar User</a></li>
            <li class="active">Data <?php //echo $dataapa 
                                    ?></li>
          </ol>
          <?php if (isset($_GET['pesan'])) {
            if ($_GET['pesan'] == "success") {
              echo "<div class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><h4> Data Berhasil Di Tambahkan</h4> </div>";
            } else if ($_GET['pesan'] == "gagal") {
              echo "<div class='alert alert-warning alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><h4> Data Gagal Di Tambahkan</h4> </div>";
            } else if ($_GET['pesan'] == "update") {
              echo "<div class='alert alert-info alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><h4> Data Berhasil Di Update</h4> </div>";
            } else if ($_GET['pesan'] == "hapus") {
              echo "<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><h4> Data Berhasil Di Hapus</h4> </div>";
            } else if ($_GET['pesan'] == "gambar") {
              echo "<div class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><h4> Gambar Berhasil Di Update</h4> </div>";
            }
          } ?>
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title"><?php //echo $dataapa; 
                                    ?></h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fa fa-minus"></i></button>
                <!-- <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                  <i class="fa fa-times"></i></button> -->
              </div>
            </div>
            <div class="box-body">
              <section class="content">
                <div class="row">
                  <div class="col-md-3">
                    <div class="box box-primary">
                      <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle" src="master_gambar/user/<?php echo $_SESSION['gambar']; ?>" alt="User profile picture">
                        <h3 class="profile-username text-center"><?php echo $_SESSION['username']; ?> </h3>
                        <p class="text-muted text-center"><?php  ?></p>
                        <ul class="list-group list-group-unbordered">
                          <li class="list-group-item">
                            <b>Nama Lengkap</b> <a class="pull-right"><?php echo $_SESSION['nama']; ?></a>
                          </li>
                          <li class="list-group-item">
                            <b>Jabatan</b> <a class="pull-right"><?php echo $_SESSION['tipe']; ?></a>
                          </li>
                        </ul>
                        <a href="" class="btn btn-primary btn-block" data-toggle="modal" data-target="#edit<?php echo $_SESSION['username']; ?>"><b>Edit Profil</b></a>
                        <a href="" class="btn btn-warning btn-block" data-toggle="modal" data-target="#password<?php echo $_SESSION['username']; ?>"><b>Ubah Password</b></a>
                        <a href="" class="btn bg-maroon btn-block" data-toggle="modal" data-target="#gambar<?php echo $_SESSION['username']; ?>"><b>Ubah Gambar</b></a>
                      </div>
                    </div>
                    <div class="box box-primary">
                      <div class="box-header with-border">
                        <h3 class="box-title">Data User</h3>
                      </div>
                      <div class="box-body">
                        <strong><i class="fa fa-book margin-r-5"></i> Alamat</strong>
                        <p class="text-muted"></p>
                        <hr>
                        <strong><i class="fa fa-file-text-o margin-r-5"></i> Catatan</strong>
                        <p>Fitur ini Masih dikembangkan, harap tunggu update selanjutny</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-9">
                    <div class="nav-tabs-custom">
                      <ul class="nav nav-tabs">
                        <li class="active"><a href="#settings" data-toggle="tab">Data Diri</a></li>
                        <li><a href="#activity" data-toggle="tab">Aktivitas terakhir</a></li>
                      </ul>
                      <div class="tab-content">
                        <div class="active tab-pane" id="settings">
                          <form class="form-horizontal">
                            <div class="form-group">
                              <label for="inputName" class="col-sm-2 control-label">Nama Lengkap</label>
                              <div class="col-sm-10">
                                <input type="email" class="form-control" value="<?php echo $_SESSION['nama']; ?>" disabled>
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputEmail" class="col-sm-2 control-label">Jabatan</label>
                              <div class="col-sm-10">
                                <input type="email" class="form-control" value="<?php echo $_SESSION['tipe']; ?>" disabled>
                              </div>
                            </div>
                            <div class="form-group">
                              <div class="col-sm-offset-2 col-sm-10">
                              </div>
                            </div>
                          </form>
                        </div>
                        <div class="tab-pane" id="activity">
                          <div class="box-body no-padding">
                            <!-- <table id="example1" class="table table-condensed" > -->
                            <table id="example1" class="table table-bordered table-striped">
                              <thead>
                                <tr>
                                  <th style="width: 10px">No</th>
                                  <th style="width: 100px">Tanggal</th>
                                  <th style="width: 50px">Jam</th>
                                  <th style="width: 50px">Status</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php if ($data_aktifitas->num_rows > 0) {
                                  $no = 1;
                                  while ($row = mysqli_fetch_object($data_aktifitas)) {
                                ?>
                                    <tr>
                                      <td><?php echo $no++; ?></td>
                                      <td><?php echo $row->tgl ?></td>
                                      <td><?php echo $row->jam ?></td>
                                      <td><?php echo $row->status ?></td>
                                    </tr>
                                  <?php } ?>
                                <?php } ?>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </section>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
      </div>
    </section>
  </div>
  <div class="control-sidebar-bg"></div>
</div>
<!-- MODAL EDIT  -->
<div class="modal fade" id="edit<?php echo $_SESSION['username']; ?>">
  <form id="form" method="post" action="" enctype="multipart/form-data">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Edit Profil</h4>
        </div>
        <div class="modal-body">
          <div class="box-body">
            <div class="form-group">
              <label for="" class="col-xs-4 control-label">Nama Lengkap</label>
              <div class="col-xs-8">
                <input type="text" class="form-control" name="nama" id="nama" value="<?php echo $_SESSION['nama']; ?>" autocomplete="off">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <button type="submit" name="profil" class="btn btn-primary"><i class="fa fa-save" aria-hidden="true"></i> Save</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
  </form>
</div>
<!-- END MODAL EDIT  -->
<!-- MODAL UBAH PASSWORD -->
<div class="modal fade" id="password<?php echo $_SESSION['username']; ?>">
  <form id="form" method="post" action="" enctype="multipart/form-data">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Ubah Password</h4>
        </div>
        <div class="modal-body">
          <div class="box-body">
            <div class="form-group">
              <label for="" class="col-xs-4 control-label">Username</label>
              <div class="col-xs-8">
                <input type="text" class="form-control" name="username" id="username" value="<?php echo $_SESSION['username']; ?>" readonly>
              </div>
            </div><br><br>
            <div class="form-group">
              <label for="" class="col-xs-4 control-label">Nama</label>
              <div class="col-xs-8">
                <input type="text" class="form-control" name="nama" id="nama" value="<?php echo $_SESSION['nama']; ?>" readonly>
              </div>
            </div><br><br>
            <div class="form-group">
              <label for="" class="col-xs-4 control-label">Password</label>
              <div class="col-xs-8">
                <input type="password" name="password" class="form-control" id="password" placeholder="Isikan Password baru">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <button type="submit" name="ubah" class="btn btn-primary"><i class="fa fa-save" aria-hidden="true"></i> Save</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
  </form>
</div>
<!-- END MODAL UBAH PASSWORD -->
<!-- MODAL GAMBAR  -->
<div class="modal fade" id="gambar<?php echo $_SESSION['username']; ?>">
  <form id="form" class="form-horizontal" method="post" action="" enctype="multipart/form-data">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Edit Gambar</h4>
        </div>
        <div class="modal-body">
          <div class="box-body">
            <div class="form-group">
              <label for="" class="col-xs-4 control-label">Input Gambar</label>
              <div class="col-xs-8">
                <input type="hidden" class="form-control" name="username" id="username" value="<?php echo $_SESSION['username']; ?>" readonly>
                <input type="file" name="gambar" id="gambar" class="form-control">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <button type="submit" name="gambar" class="btn btn-primary"><i class="fa fa-save" aria-hidden="true"></i> Save</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
  </form>
</div>
<!-- END MODAL GAMBAR  -->
</body>

</html>