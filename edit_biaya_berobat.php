<!DOCTYPE html>
<html>
<?php
ob_start();
session_start();
include_once('class/biaya_berobat.php');
include_once('class/karyawan.php');
include_once('class/klinik.php');


$biaya_berobat = new biaya_berobat();
$karyawan   = new karyawan();
$klinik   = new klinik();

$data_biaya_berobat      = $biaya_berobat->tampil_data();
$data_karyawan      = $karyawan->tampil_data();
$data_klinik      = $klinik->tampil_data();

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
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 style="text-align: center;">Edit Biaya Berobat</h3>
        </div>
        <form id="form" class="form-horizontal" method="post" action="">
          <form class="form-horizontal">
            <div class="box-body">
              <table>
                <tbody>
                  <tr>
                    <th style="width: 30%">Tanggal</th>
                    <th style="width: 15%">:</th>
                    <th style="width: 60%">
                      <input type="text" name="tgl" class="form-control tanggal" value="<?php echo $data['tgl']; ?>">
                      <input type="hidden" name="tgl_in" class="form-control tanggal" value="<?php echo date('Y-m-d') ?>">
                    </th>
                  </tr>
                  <!-- ENTER -->
                  <tr>
                    <th>
                      <div><br></div>
                    </th>
                  </tr><!-- END ENTER -->
                  <tr>
                    <th style="width: 30%">Nama</th>
                    <th style="width: 10%">:</th>
                    <th style="width: 60%">
                      <select class="form-control select2" name="nama_kar" id="nama_kar">
                        <?php
                        if ($data_karyawan->num_rows > 0) {
                          while ($row = mysqli_fetch_array($data_karyawan)) {
                        ?>
                            <option value="<?php echo $row['id_kar']; ?>" <?php
                                                                          if ($data['nama_kar'] == $row['id_kar']) //DB tujuan = DB asal
                                                                          {
                                                                            echo " Selected";
                                                                          }
                                                                          ?>><?php echo $row['nama_kar']; ?></option>
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
                    <th style="width: 30%">Klinik</th>
                    <th style="width: 10%">:</th>
                    <th style="width: 60%">
                      <select class="form-control select2" name="tempat" id="tempat">
                        <option></option>
                        <?php
                        if ($data_klinik->num_rows > 0) {
                          while ($row = mysqli_fetch_array($data_klinik)) {
                        ?>
                            <option value="<?php echo $row['klinik']; ?>" <?php
                                                                          if ($data['tempat'] == $row['klinik'])   // Sesuai DB tujuan input == DB asal data
                                                                          {
                                                                            echo " Selected";
                                                                          }
                                                                          ?>><?php echo $row['klinik']; ?></option>
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
                    <th style="width: 30%">Dokter</th>
                    <th style="width: 15%">:</th>
                    <th style="width: 60%">
                      <input type="text" name="dokter" id="dokter" class="form-control" value="<?php echo $data['dokter']; ?>" onkeyup="this.value = this.value.toUpperCase()" autocomplete="off" autofocus required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')" oninput="setCustomValidity('')">
                    </th>
                  </tr>
                  <!-- ENTER -->
                  <tr>
                    <th>
                      <div><br></div>
                    </th>
                  </tr><!-- END ENTER -->
                  <!-- ENTER -->
                  <th style="width: 30%">Jenis Penyakit</th>
                  <th style="width: 15%">:</th>
                  <th style="width: 60%">
                    <input type="text" name="jenis" id="jenis" class="form-control" onkeyup="this.value = this.value.toUpperCase()" autocomplete="off" value="<?php echo $data['jenis']; ?>" autofocus required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')" oninput="setCustomValidity('')">
                  </th>
                  </tr>
                  <!-- ENTER -->
                  <tr>
                    <th>
                      <div><br></div>
                    </th>
                  </tr><!-- END ENTER -->
                  <tr>
                    <th style="width: 30%">Kasbon</th>
                    <th style="width: 15%">:</th>
                    <th style="width: 60%">
                      <input type="text" name="kasbon" id="kasbon" class="form-control" autocomplete="off" value="<?php echo $data['kasbon']; ?>">
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
              <input type="hidden" name="id_berobat" class="form-control" value="<?php echo $data['id_berobat']; ?>" readonly>
              <input type="hidden" name="user" class="form-control" value="<?php echo $_SESSION['nama']; ?>" readonly>
              <input type="hidden" name="jam" class="form-control" value="<?php echo date('H:i:s'); ?>">
              <!-- <input type="hidden" name="tgl" class="form-control tanggal"> -->
            </div>
            <div class="box-footer">
              <a href="tampil_biaya_berobat" button onclick="window.close()" class="btn btn-primary pull-left">Kembali</a>
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
<!-- <script>
  $().ready(function(){
    $('#tempat').select2({
        placeholder: 'Pilih Klinik',
    });
  })
</script> -->

</html>