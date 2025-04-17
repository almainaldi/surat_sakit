<!DOCTYPE html>
<html>
<?php
ob_start();
session_start();
include_once('class/biaya_berobat.php');

$biaya_berobat   = new biaya_berobat();


if (!empty($_GET['id'])) // Ngecek ID apakah sesuai dan ada di database
{
  $id = $_GET['id'];
  if ($biaya_berobat->cek_id($id)) {
    $data = $biaya_berobat->get_by_id($id);
  } else {
    header("location:tampil_biaya_berobat?pesan=gagal");
  }
} else {
  header("location:tampil_biaya_berobat?pesan=gagal");
}




?>
<!-- <script src="class/validasi_form/surat_rujukan.js" type="text/javascript"></script>
<script src="class/validasi_form/app.js" type="text/javascript"></script> -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 style="text-align: center;">Tambah Rekap Medis</h3>
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
                      <input type="hidden" class="form-control" name="id_kar" id="id_kar" value="<?php echo $data['nama_kar'] ?>">
                      <input type="text" class="form-control" name="" id="" value="<?php echo $data['nama_karyawan'] ?>" readonly>
                      <input type="hidden" class="form-control" name="id_berobat" id="" value="<?php echo $data['id_berobat'] ?>" readonly>
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
                      <input type="text" class="form-control" name="" id="" value="<?php echo $data['jabatan'] ?>" readonly>
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
                      <textarea class="form-control" name="keluhan" id="keluhan" rows="5"> <?php echo $data['keluhan'] ?> </textarea>
                    </th>
                  </tr>
                  <!-- ENTER -->
                  <tr>
                    <th>
                      <div><br></div>
                    </th>
                  </tr><!-- END ENTER -->
                  <tr>
                    <th style="width: 30%">Diagnosis</th>
                    <th style="width: 10%">:</th>
                    <th style="width: 60%">
                      <textarea class="form-control" name="diagnosis" id="diagnosis" placeholder="Input Diagnosis" rows="5" onkeyup="this.value = this.value.toUpperCase()" autocomplete="off" placeholder="Input Diagnosis" autofocus oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')" oninput="setCustomValidity('')"> </textarea>
                    </th>
                  </tr>
                  <!-- ENTER -->
                  <tr>
                    <th>
                      <div><br></div>
                    </th>
                  </tr><!-- END ENTER -->
                  <tr>
                    <th style="width: 30%">Solusi</th>
                    <th style="width: 10%">:</th>
                    <th style="width: 60%">
                      <textarea class="form-control" name="solusi" id="solusi" placeholder="Input Diagnosis" rows="5" onkeyup="this.value = this.value.toUpperCase()" autocomplete="off" placeholder="Input Solusi" autofocus oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')" oninput="setCustomValidity('')"> </textarea>
                    </th>
                  </tr>
                  <!-- ENTER -->
                  <tr>
                    <th>
                      <div><br></div>
                    </th>
                  </tr><!-- END ENTER -->
                </tbody>
              </table>
              <input type="hidden" name="user" class="form-control" value="<?php echo $_SESSION['nama']; ?>" readonly>
              <input type="hidden" name="id_biaya_berobat" class="form-control" value="<?php echo $data['id_berobat'] ?>" readonly>
              <input type="hidden" name="jam" class="form-control" value="<?php echo date('H:i:s'); ?>" readonly>
              <input type="hidden" name="tgl" class="form-control" value="<?php echo $data['tgl'] ?>" readonly>
              <input type="hidden" name="tgl_in" class="form-control" value="<?= date('Y-m-d') ?>" readonly>
            </div>
            <div class="box-footer">
              <div class="box-footer">
              <a href="tampil_biaya_berobat" button onclick="window.close()" class="btn btn-warning pull-left">Kembali</a>
              <button type="submit" name="rekap" class="btn btn-info pull-right">Selesai</button>
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

</html>