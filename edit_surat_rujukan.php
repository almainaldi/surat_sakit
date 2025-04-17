<!DOCTYPE html>
<html>
<?php
ob_start();
session_start();
include_once('class/surat_rujukan.php');
include_once('class/karyawan.php');
include_once('class/jabatan.php');
include_once('class/klinik.php');

$surat_rujukan   = new surat_rujukan();
$karyawan   = new karyawan();
$jabatan   = new jabatan();
$klinik   = new klinik();

$data_karyawan      = $karyawan->tampil_data();
//$data_karyawan2     = $karyawan->tampil_data();
$data_jabatan      = $jabatan->tampil_data();
$data_jabatan2      = $jabatan->tampil_data();
$data_klinik      = $klinik->tampil_data();


if (!empty($_GET['id'])) // Ngecek ID apakah sesuai dan ada di database
{
  $id = $_GET['id'];
  if ($surat_rujukan->cek_id($id)) {
    $data = $surat_rujukan->get_by_id($id); // hasil dari DB
  } else {
    header("location:tampil_surat_rujukan?pesan=gagal");
  }
} else {
  header("location:tampil_surat_rujukan?pesan=gagal");
}

?>
<!-- <script src="class/validasi_form/surat_rujukan.js" type="text/javascript"></script>
<script src="class/validasi_form/app.js" type="text/javascript"></script> -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 style="text-align: center;">Edit Data Surat Rujukan</h3>
        </div>
        <form id="form" class="form-horizontal" method="post" action="">
          <form class="form-horizontal">
            <div class="box-body">
              <table>
                <tbody>
                  <tr>
                    <th style="width: 30%">Tanggal</th>
                    <th style="width: 10%">:</th>
                    <th style="width: 60%">
                      <input type="text" class="form-control tanggal" name="tgl" id="tgl" value="<?php echo $data['tgl']; ?>">
                    </th>
                  </tr>
                  <tr>
                    <th>
                      <div><br></div>
                    </th>
                  </tr><!-- END ENTER -->
                  <tr>
                    <th style="width: 30%">Nama</th>
                    <th style="width: 10%">:</th>
                    <th style="width: 60%">
                      <select class="form-control select2" name="nama" id="nama" style="width: 100%;">
                        <?php
                        if ($data_karyawan->num_rows > 0) {
                          while ($row = mysqli_fetch_object($data_karyawan)) {
                        ?>
                            <option value="<?php echo $row->id_kar; ?>" <?php
                                                                        if ($data['nama'] == $row->id_kar)   // Sesuai DB Surat Rujukan == DB Karyawan
                                                                        {
                                                                          echo " Selected";
                                                                        }
                                                                        ?>><?php echo $row->nama_kar; ?></option>
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
                  <tr>
                    <th style="width: 30%">Jabatan</th>
                    <th style="width: 10%">:</th>
                    <th style="width: 60%">
                      <select class="form-control select2" name="jabatan" id="jabatan" style="width: 100%;">
                      <option value=""></option>
                        <?php
                        if ($data_jabatan->num_rows > 0) {
                          while ($row = mysqli_fetch_object($data_jabatan)) {
                        ?>
                            <option value="<?php echo $row->jabatan; ?>" <?php
                                                                          if ($data['jabatan'] == $row->jabatan)   // Sesuai DB Surat Rujukan == DB Jabatan
                                                                          {
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
                  <tr>
                    <th style="width: 30%">Keluhan</th>
                    <th style="width: 10%">:</th>
                    <th style="width: 60%">
                      <textarea class="form-control" name="keluhan" id="keluhan" placeholder="Input Keluhan" rows="5"> <?php echo $data['keluhan'] ?> </textarea>
                    </th>
                  </tr>
                  <!-- ENTER -->
                  <tr>
                    <th>
                      <div><br></div>
                    </th>
                  </tr><!-- END ENTER -->
                  <tr>
                    <th style="width: 30%">Tujuan</th>
                    <th style="width: 10%">:</th>
                    <th style="width: 60%">
                      <select class="form-control select2" name="tujuan" id="tujuan" style="width: 100%;">
                        <option></option>
                        <?php
                        if ($data_klinik->num_rows > 0) {
                          while ($row = mysqli_fetch_object($data_klinik)) {
                        ?>
                            <option value="<?php echo $row->klinik; ?>" <?php
                                                                        if ($data['tujuan'] == $row->klinik)   // Sesuai DB Surat Rujukan == DB Klinik
                                                                        {
                                                                          echo " Selected";
                                                                        }
                                                                        ?>><?php echo $row->klinik; ?></option>
                        <?php
                          }
                        }
                        ?>
                      </select>
                    </th>
                    <!-- ENTER -->
                  <tr>
                    <th>
                      <div><br></div>
                    </th>
                  </tr><!-- END ENTER -->
                </tbody>
              </table>
              <input type="hidden" class="form-control" name="mengetahui" value="<?php echo $data['mengetahui'] ?>" readonly>
              <input type="hidden" name="pemberi" class="form-control" value="<?php echo $data['pemberi'] ?>">
              <input type="hidden" name="id_surat" class="form-control" value="<?php echo $data['id_surat'] ?>">
              <input type="hidden" name="tgl_in" class="form-control" value="<?php echo date('Y-m-d') ?>" readonly>
            </div>
            <div class="box-footer">
              <!-- <button type="submit" name="tombol" class="btn btn-info pull-left">Simpan Data</button> -->
              <a href="tampil_surat_rujukan" button onclick="window.close()" class="btn btn-primary pull-left">Close</a>
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
<script>
  $(function() {
    $('.select2').select2()
  });
  $(document).ready(function() {
    $('.js-example-basic-single').select2();
  });
</script>
<script>
  $(document).ready(function() {
    $('#nama').select2({
      placeholder: 'Pilih Karyawan'
    });

    $('#jabatan').select2({
      placeholder: 'Pilih Jabatan'
    });

    $("#nama").change(function() {
      //$("img#load1").show();
      var id = $(this).val();
      $.ajax({
        type: "POST",
        dataType: "html",
        url: "data-karyawan.php?jenis=jabatan",
        data: "id=" + id, // nama_kar
        success: function(msg) {
          $("select#jabatan").html(msg);
          //$("img#load1").hide();
        }
      });
    });
  });
</script>
</body>

</html>