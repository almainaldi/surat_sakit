<?php
include_once('template/header.php');
include_once('class/user.php');
$user = new user();
$data_user = $user->tampil_data();
$data_grup = $user->tampil_group_user();
$data_grup2 = $user->tampil_group_user();

// TAMBAH DATA
if (isset($_POST['tombol'])) {
  $data = array(
    "username"        => $_POST['username'],
    "nama"            => $_POST['nama'],
    "password"        => $_POST['password'],
    "tipe"            => $_POST['tipe'],
    "app"             => $_POST['app']
  );

  if (isset($_FILES['gambar']['tmp_name'])) {
    $old_data = $user->get_by_id($data['username']);
    $old_gambar = $old_data['gambar'];

    $lokasi_file = $_FILES['gambar']['tmp_name'];
    $nama_file = $_FILES['gambar']['name'];
    $acak = rand(1, 999999);
    $nama = $_POST['username'];
    $format = '.jpg';
    // $nama_file_unik = $acak . $nama_file;
    $nama_file_unik = $nama . $format;
    $dir_uploads = "master_gambar\user/";
    $file_upload = $dir_uploads . $nama_file_unik;
    if (move_uploaded_file($lokasi_file, $file_upload)) {
      unlink("master_gambar\user/" . $old_gambar);
      $data['gambar'] = $nama_file_unik;
    }
  }

  $hasil = $user->tambah($data);
  if ($hasil['status']) {
    header("location:tampil_user");
  } else {
    $error = $hasil['pesan'];
  }
}
// END TAMBAH DATA

// EDIT DATA
if (isset($_POST['edit'])) {
  $data = array(
    "username"        => $_POST['username'],
    "nama"            => $_POST['nama'],
    "password"        => $_POST['password'],
    "tipe"            => $_POST['tipe'],
    "gambar"          => $nama_file_unik
  );

  if (isset($_FILES['gambar']['tmp_name'])) {
    $old_data = $user->get_by_id($data['username']);
    $old_gambar = $old_data['gambar'];

    $lokasi_file = $_FILES['gambar']['tmp_name'];
    $nama_file = $_FILES['gambar']['name'];
    $acak = rand(1, 999999);
    $nama = $_POST['username'];
    $format = '.jpg';
    $nama_file_unik = $nama . $acak . $format;
    $dir_uploads = "master_gambar\user/";
    $file_upload = $dir_uploads . $nama_file_unik;
    if (move_uploaded_file($lokasi_file, $file_upload)) {
      unlink("master_gambar\user/" . $old_gambar);
      $data['gambar'] = $nama_file_unik;
    }
  }
  if ($user->edit($data)) {
    header("location:tampil_user");
  } else {
    header("location:tampil_user?pesan=gagal");
  }
}
// END EDIT DATA


// HAPUS DATA
if (isset($_GET['hapus_username'])) {
  if ($user->cek_id($_GET['hapus_username'])) {
    if ($user->hapus($_GET['hapus_username'])) {
      header("location:tampil_user?pesan=hapus");
    } else {
      header("location:tampil_user?pesan=gagal");
    }
  } else {
    header("location:tampil_user");
  }
}
// END HAPUS DATA
?>
<script src="class/validasi_form/tambah_user.js" type="text/javascript"></script>
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Data User
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Data User</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
          </div>
          <div class="box-body">
            <!-- <a href="tambah_user"><button class="btn btn-info">Tambah Data</button></a> -->
            <a href="" class="btn btn-info" data-toggle="modal" data-target="#tambah">Tambah Data</a>
            <hr />
            <?php if (isset($_GET['pesan'])) {
              if ($_GET['pesan'] == "success") {
                echo "<div class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;
                                                            </button><h4> Data Berhasil Ditambahkan</h4> </div>";
              } else if ($_GET['pesan'] == "gagal") {
                echo "<div class='alert alert-warning alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;
                                                            </button><h4> Data Gagal Ditambahkan</h4> </div>";
              } else if ($_GET['pesan'] == "update") {
                echo "<div class='alert alert-info alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;
                                                            </button><h4> Data Berhasil Di Update</h4> </div>";
              } else if ($_GET['pesan'] == "hapus") {
                echo "<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;
                                                            </button><h4> Data Berhasil Di Hapus</h4> </div>";
              }
            } ?>
            <?php if (isset($error)) { ?>
              <div class="alert alert-danger" role="alert"><?php echo $error; ?></div>
            <?php } ?>
            <div class="panel-body table-responsive no-padding">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th style="vertical-align : middle;text-align:center;">No</th>
                    <th style="vertical-align : middle;text-align:center;">Username</th>
                    <th style="vertical-align : middle;text-align:center;">Nama</th>
                    <th style="vertical-align : middle;text-align:center;">Tipe User</th>
                    <th style="vertical-align : middle;text-align:center;">Gambar</th>
                    <th style="vertical-align : middle;text-align:center;">Edit</th>
                    <th style="vertical-align : middle;text-align:center;">Hapus</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  if ($data_user->num_rows > 0) {
                    $no = 1;
                    while ($row = mysqli_fetch_object($data_user)) {
                  ?>
                      <tr>
                        <td style="vertical-align : middle;text-align:center;"><?php echo $no++; ?></td>
                        <td style="vertical-align : middle;text-align:center;"><?php echo $row->username ?></td>
                        <td style="vertical-align : middle;text-align:center;"><?php echo $row->nama ?></td>
                        <td style="vertical-align : middle;text-align:center;"><?php echo $row->tipe ?></td>
                        <td style="vertical-align : middle;text-align:center;">
                          <?php if ($row->gambar == '') { ?>
                            <img src="master_gambar/user/polos.png" class="img" alt="User Image" width="150" height="150">
                          <?php } else { ?>
                            <img src="master_gambar/user/<?php echo $row->gambar; ?>" class="img" alt="User Image" width="150" height="150">
                          <?php } ?>
                        </td>
                        <div class="btn-group-vertical">
                          <?php if ($row->username != "admin") { ?>
                            <td style="vertical-align : middle;text-align:center;">
                              <form id="form1" method="post" action="" enctype="multipart/form-data">
                                <a href="edit_user?username=<?php echo $row->username ?>" class="btn btn-info" data-toggle="modal" data-target="#edit<?php echo $row->username ?>">Edit</a>
                                <div class="modal fade" id="edit<?php echo $row->username ?>">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      
                                    </div>
                                  </div>
                                </div>
                              </form>
                            </td>
                            <td style="vertical-align : middle;text-align:center;">
                              <a title="Hapus Data" href="tampil_user?hapus_username=<?php echo $row->username; ?>"><button type="button" class="btn btn-danger">Hapus</button></a>
                            </td>
                          <?php } else { ?>
                            <td></td>
                            <td></td>
                          <?php } ?>
                        </div>
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
  </section>
</div>
<?php include_once('template/footer.php') ?>
<!-- TAMBAH -->
<div class="modal fade" id="tambah">
  <form id="form" method="post" action="" enctype="multipart/form-data">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Tambah Data User</h4>
        </div>
        <div class="modal-body">
          <div class="box-body">
            <!-- Username -->
            <div class="form-group">
              <label for="" class="col-xs-4 control-label">Username</label>
              <div class="col-xs-8">
                <input type="text" name="username" class="form-control" id="username" placeholder="Isikan Username">
              </div>
            </div><br>
            <!-- END Username -->
            <!-- Nama -->
            <div class="form-group">
              <label for="" class="col-xs-4 control-label">Nama</label>
              <div class="col-xs-8">
                <input type="text" name="nama" class="form-control" id="nama" placeholder="Isikan Nama User">
              </div>
            </div><br>
            <!-- END Nama -->
            <!-- Jabatan -->
            <div class="form-group">
              <label for="" class="col-xs-4 control-label">Jabatan</label>
              <div class="col-xs-8">
                <select name="tipe" id="tipe" class="form-control select2" style="width: 100%;">
                  <?php if ($data_grup->num_rows > 0) {
                    while ($row = mysqli_fetch_object($data_grup)) { ?>
                      <option value="<?php echo $row->tipe; ?>"><?php echo $row->tipe; ?></option>
                    <?php } ?>
                  <?php } ?>
                </select>
              </div>
            </div><br>
            <!-- END Jabatan -->
            <!-- Password -->
            <div class="form-group">
              <label for="" class="col-xs-4 control-label">Password</label>
              <div class="col-xs-8">
                <input type="password" name="password" class="form-control" id="password" placeholder="Isikan Password User">
              </div>
            </div><br>
            <!-- END Password -->
            <!-- Gambar -->
            <div class="form-group">
              <label for="" class="col-xs-4 control-label">Gambar</label>
              <div class="col-xs-8">
                <input type="file" name="gambar" id="gambar" class="form-control">
              </div>
            </div><br>
            <!-- END Gambar -->
          </div>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="app" class="form-control" id="" value="surat sakit">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <button type="submit" name="tombol" class="btn btn-primary"><i class="fa fa-save" aria-hidden="true"></i> Save</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
  </form>
</div>
<!-- END TAMBAH -->
<script>
  window.setTimeout(function() {
    $(".alert").fadeTo(150, 0).slideUp(150, function() {
      $($this).remove();
    });
  }, 1500)
</script>

