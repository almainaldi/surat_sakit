<!DOCTYPE html>
<html>
<?php
ob_start();
session_start();
include_once('class/karyawan.php');
include_once('class/jabatan.php');

$karyawan   = new karyawan();
$jabatan   = new jabatan();

// $data_karyawan      = $karyawan->tampil_data();
$data_jabatan      = $jabatan->tampil_data();

if (($_GET['id'])) // Ngecek ID apakah sesuai dan ada di database
{
  $id = $_GET['id'];
  if ($karyawan->cek_id($id)) {
    $data = $karyawan->get_by_id($id);
  } else {
    header("location:tampil_karyawan?pesan=gagal");
  }
} else {
  header("location:tampil_karyawan?pesan=gagal");
}

?>
<!-- <script src="class/validasi_form/tambah_do.js" type="text/javascript"></script>
<script src="class/validasi_form/app.js" type="text/javascript"></script> -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 style="text-align: center;">Edit Data Karyawan</h3>
        </div>
        <form id="form" class="form-horizontal" method="post" action="">
          <form class="form-horizontal">
            <div class="box-body">
              <table>
                <tbody>
                  <tr>
                    <th style="width: 30%">Nama</th>
                    <th style="width: 10%">:</th>
                    <th style="width: 60%">
                      <input type="text" name="nama_kar" class="form-control" value="<?php echo $data['nama_kar'] ?>">
                    </th>
                  </tr>
                  <!-- ENTER -->
                  <tr>
                    <th>
                      <div><br></div>
                    </th>
                  </tr><!-- END ENTER -->
                  <tr>
                    <th style="width: 30%">Jabatan</th>
                    <th style="width: 10%">:</th>
                    <th style="width: 60%">
                      <select name="jabatan" id="jabatan" class="form-control select2" style="width: 100%;">
                        <option></option>
                        <?php
                        if ($data_jabatan->num_rows > 0) {
                          while ($row = mysqli_fetch_object($data_jabatan)) {
                        ?>
                            <option value="<?php echo $row->jabatan; ?>" <?php
                                                                          if ($data['jabatan'] == $row->jabatan) {
                                                                            echo " Selected";
                                                                          }
                                                                          ?>><?php echo $row->jabatan; ?></option>
                        <?php
                          }
                        }
                        ?>
                      </select>
                    </th>
                  </tr>
                  <!-- ENTER -->
                  <tr>
                    <th>
                      <div><br></div>
                    </th>
                  </tr><!-- END ENTER -->
                  <!-- ENTER -->
                  <tr>
                    <th>
                      <div><br></div>
                    </th>
                  </tr><!-- END ENTER -->
                </tbody>
              </table>
              <input type="hidden" name="id_kar" class="form-control" value="<?php echo $data['id_kar']; ?>" readonly>
            </div>
            <div class="box-footer">
              <!-- <button type="submit" name="tombol" class="btn btn-info pull-left">Simpan Data</button> -->
              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
              <button type="submit" name="update" class="btn btn-primary pull-right"><i class="fa fa-save" aria-hidden="true"></i> Save</button>
            </div>
      </div>
    </div>
</section>
<script type="text/javascript">
  $(document).ready(function() {
    $('.tanggal').datepicker({
      autoclose: true,
      format: 'yyyy-mm-dd' //2020-01-20
      //format:'DD, dd-MM-yy' //Monday, 20 January 2020
      //format: 'dd-mm-yyyy' //20-01-2020
      //format:'DD, dd-mm-yyyy'
    });
  });
</script>
</body>

</html>