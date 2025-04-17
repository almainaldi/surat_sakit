<?php
include_once('class/user.php');
$user = new user();
$data_grup = $user->tampil_group_user();

if (!empty($_GET['username'])) {
  $username = $_GET['username'];
  if ($user->cek_id($username)) {
    //JIKA DATA ADA
    $data = $user->get_by_id($username);
  } else {
    header("location:tampil_user");
  }
} else {
  header("location:tampil_user?pesan=gagal");
}

?>
<script src="class/validasi_form/edit_user.js" type="text/javascript"></script>
<form id="" method="post" action="" enctype="multipart/form-data">
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-info">
          <div class="box-header with-border">
            <h4 style="text-align: center;"><b>Edit Data User</b></h4>
          </div>
          <div class="box-body">
            <table>
              <tbody>
                <tr>
                  <th style="width: 20%">Username</th>
                  <th style="width: 10%">:</th>
                  <th style="width: 80%">
                    <input type="text" name="username" id="username" class="form-control" value="<?php echo $data['username']; ?>" readonly>
                  </th>
                </tr>
                <!-- ENTER --><tr><th><div><br></div></th></tr><!-- END ENTER -->
                <tr>
                  <th style="width: 30%">Nama</th>
                  <th style="width: 10%">:</th>
                  <th style="width: 60%">
                    <input type="text" name="nama" class="form-control" id="nama" value="<?php echo $data['nama']; ?>">
                  </th>
                </tr>
                <!-- ENTER --><tr><th><div><br></div></th></tr><!-- END ENTER -->
                <tr>
                  <th style="width: 30%">Nama</th>
                  <th style="width: 10%">:</th>
                  <th style="width: 60%">
                  <select name="tipe" id="tipe" class="form-control select2" style="width: 100%;">
                    <?php if ($data_grup->num_rows > 0) {
                      while ($row = mysqli_fetch_object($data_grup)) { ?>
                        <option value="<?php echo $row->tipe; ?>"
                        <?php
                          if ($data['tipe'] == $row->tipe) //plat di dapat dari data base mt
                          {
                            echo " Selected";
                          }
                          ?>
                        ><?php echo $row->tipe; ?></option>
                      <?php } ?>
                    <?php } ?>
                  </select>
                  </th>
                </tr>
                <!-- ENTER --><tr><th><div><br></div></th></tr><!-- END ENTER -->
                <tr>
                  <th style="width: 30%">Password</th>
                  <th style="width: 10%">:</th>
                  <th style="width: 60%">
                    <input type="password" name="password" class="form-control" id="password" placeholder="Isikan Password baru">
                  </th>
                </tr>
                <!-- ENTER --><tr><th><div><br></div></th></tr><!-- END ENTER -->
                <tr>
                  <th style="width: 30%">Gambar</th>
                  <th style="width: 10%">:</th>
                  <th style="width: 60%">
                    <input type="file" name="gambar" id="gambar" class="form-control">
                  </th>
                </tr>
              </tbody>
            </table>
            <div class="form-group">
              <div class="col-sm-2"></div>
              <div class="col-sm-8" style="text-align: center;">
                <?php if ($data['gambar'] == '') { ?>
                  <img src="master_gambar/user/polos.png" class="img" alt="User Image" width="150" height="150">
                <?php } else { ?>
                  <img src="master_gambar/user/<?php echo $data['gambar']; ?>" class="img" alt="User Image" width="150" height="150">
                <?php } ?>
              </div>
              <div class="col-sm-2"></div>
            </div>

          </div>
          <div class="box-footer">
            <a href="tampil_user" class="btn btn-warning pull-left">Kembali</a>
            <button type="submit" name="edit" class="btn btn-info pull-right">Save</button>
          </div>
        </div>
      </div>
    </div>
  </section>
</form>

<script>
  $(function() {
    $('.select2').select2()
  });
  $(document).ready(function() {
    $('.js-example-basic-single').select2();
  });
</script>