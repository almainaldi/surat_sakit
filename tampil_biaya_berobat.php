<!DOCTYPE html>
<title>LPS | Biaya Berobat</title>
<html>
<?php
include_once('template/header.php');
include_once('class/biaya_berobat.php');
include_once('class/karyawan.php');
include_once('class/klinik.php');
include_once('class/rekap_berobat.php');
include_once('class/config.php');

$biaya_berobat      = new biaya_berobat();
$karyawan           = new karyawan();
$klinik             = new klinik();
$rekap_berobat      = new rekap_berobat();
$config             = new config();

$data_biaya_berobat = $biaya_berobat->tampil_data();
$data_karyawan      = $karyawan->tampil_data();
$data_klinik        = $klinik->tampil_data();


if (isset($_POST['tambah'])) {
     $data = array(
          "id_berobat"   => $_POST['id_berobat'],
          "tgl"          => $_POST['tgl'],
          "tgl_in"       => $_POST['tgl_in'],
          "jam"          => $_POST['jam'],
          "nama_kar"     => $_POST['nama_kar'],
          "tempat"       => $_POST['tempat'],
          "dokter"       => $_POST['dokter'],
          "jenis"        => $_POST['jenis'],
          "kasbon"       => $_POST['kasbon'],
          "user"         => $_POST['user']
     );
     if ($biaya_berobat->tambah($data)) {
          header("location:tampil_biaya_berobat?pesan=success");
     } else {
          header("location:tampil_biaya_berobat?pesan=gagal");
     }
}

if (isset($_POST['rekap'])) {
     $data = array(
          "id_rekap"          => $_POST['id_rekap'],
          "id_kar"            => $_POST['id_kar'],
          "id_biaya_berobat"  => $_POST['id_biaya_berobat'],
          "jam"               => $_POST['jam'],
          "tgl"               => $_POST['tgl'],
          "user"              => $_POST['user'],
          "keluhan"           => $_POST['keluhan'],
          "diagnosis"         => $_POST['diagnosis'],
          "solusi"            => $_POST['solusi'],
          "id_berobat"        => $_POST['id_berobat']
     );
     if ($rekap_berobat->tambah($data)) {
          $biaya_berobat->selesai_rekap($data);
          header("location:tampil_rekap_berobat?pesan=success");
     } else {
          header("location:tampil_biaya_berobat?pesan=gagal");
     }
}

if (isset($_POST['update'])) {
     $data = array(
          "id_berobat"   => $_POST['id_berobat'],
          "tgl"          => $_POST['tgl'],
          "tgl_in"       => $_POST['tgl_in'],
          "nama_kar"     => $_POST['nama_kar'],
          "tempat"       => $_POST['tempat'],
          "dokter"       => $_POST['dokter'],
          "jenis"        => $_POST['jenis'],
          "kasbon"       => $_POST['kasbon']
     );
     if ($biaya_berobat->edit($data)) {
          header("location:tampil_biaya_berobat?pesan=update");
     } else {
          header("location:tampil_biaya_berobat?pesan=gagal");
     }
}

/* HAPUS */
if (isset($_GET['hapus_id'])) {
     if ($biaya_berobat->cek_id($_GET['hapus_id'])) {
          if ($biaya_berobat->hapus($_GET['hapus_id'])) {
               header("location:tampil_biaya_berobat?pesan=hapus");
          } else {
               header("location:tampil_biaya_berobat?pesan=gagal");
          }
     } else {
          header("location:tampil_biaya_berobat");
     }
}
/* END HAPUS */
?>
<div class="content-wrapper">
     <section class="content-header">
          <h1>
               Biaya Berobat
          </h1>
          <ol class="breadcrumb">
               <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
               <li class="active">Data Biaya Berobat</li>
          </ol>
     </section>

     <section class="content">
          <div class="row">
               <div class="col-xs-12">
                    <div class="box">
                         <div class="box-header">
                         </div>
                         <div class="box-body">
                              <!-- <?php if ($_SESSION['tambah'] == "1") { ?> -->
                              <!-- <a href="tambah_biaya_berobat"><button class="btn btn-info">Tambah Data</button></a> -->
                              <!-- <a href="" class="btn btn-info" data-toggle="modal" data-target="#tambah">Tambah Data</a> -->
                              <!-- <?php } ?> -->
                              <!-- <hr /> -->
                              <!-- <?php
                                   if (isset($_GET['pesan'])) {
                                        if ($_GET['pesan'] == "success") {
                                             echo "<div class='alert alert-success'>Data Berhasil Ditambahkan</div>";
                                        } else if ($_GET['pesan'] == "gagal") {
                                             echo "<div class='alert alert-danger'>Data Gagal Ditambahkan</div>";
                                        } else if ($_GET['pesan'] == "update") {
                                             echo "<div class='alert alert-success'>Data Berhasil Di Update</div>";
                                        } else if ($_GET['pesan'] == "hapus") {
                                             echo "<div class='alert alert-success'>Data Berhasil Di Hapus</div>";
                                        }
                                   }
                                   ?> -->

                              <div class="panel-body table-responsive no-padding">
                                   <table id="example1" class="table table-bordered table-striped" border="1">
                                        <thead>
                                             <tr>
                                                  <th>No</th>
                                                  <th>Tanggal</th>
                                                  <th>Nama Karyawan</th>
                                                  <th>Klinik</th>
                                                  <th>Dokter</th>
                                                  <th>Jenis Penyakit</th>
                                                  <th>Kasbon</th>
                                                  <th>Total Biaya</th>
                                                  <th>No Surat</th>
                                                  <th>No Kasbon</th>
                                                  <th>No Bukti Kas</th>
                                                  <?php if ($_SESSION['lihat'] == "1") { ?>
                                                       <th style="text-align: center;">Lihat</th>
                                                       <th style="text-align: center;">PDF</th>
                                                  <?php } ?>
                                                  <?php if ($_SESSION['tambah'] == "1") { ?>
                                                       <th style="text-align: center;">Tambah</th>
                                                  <?php } ?>
                                                  <?php if ($_SESSION['edit'] == "1") { ?>
                                                       <th style="text-align: center;">Edit</th>
                                                  <?php } ?>
                                                  <?php if ($_SESSION['tipe'] == "admin") { ?>
                                                       <th style="text-align: center;">Edit Status</th>
                                                  <?php } ?>
                                                  <?php if ($_SESSION['hapus'] == "1") { ?>
                                                       <th style="text-align: center;">Hapus</th>
                                                  <?php } ?>
                                             </tr>
                                        </thead>
                                        <tbody>
                                             <?php
                                             if ($data_biaya_berobat->num_rows > 0) {
                                                  $no = 1;
                                                  while ($row = mysqli_fetch_array($data_biaya_berobat)) { ?>
                                                       <?php $id = $row['id_surat_rujukan'] ?>
                                                       <?php $hasil_bulan  = $biaya_berobat->bln($id) ?>
                                                       <?php $bulan = $config->bln2($hasil_bulan) ?>
                                                       <tr>
                                                            <td style="vertical-align : middle;text-align:center;"><b><?php echo $no++ ?></b></td>
                                                            <td style="vertical-align : middle;"><b><?php echo $row['tanggal'] ?></b></td>
                                                            <td style="vertical-align : middle;"><b><?php echo $row['nama_karyawan'] ?></b></td>
                                                            <td style="vertical-align : middle;"><b><?php echo $row['tempat'] ?></b></td>
                                                            <td style="vertical-align : middle;"><b><?php echo $row['dokter'] ?></b></td>
                                                            <td style="vertical-align : middle;"><b><?php echo $row['jenis'] ?></b></td>
                                                            <td style="vertical-align : middle;"><b><?php echo number_format($row['kasbon'], 0, "", ".") ?></b></td>
                                                            <td style="vertical-align : middle;"><b><?php echo number_format($row['total_biaya'], 0, "", ".") ?></b></td>
                                                            <td style="vertical-align : middle;">
                                                                 <b><?php echo $row['id_surat_rujukan'] ?>/SR/<?php echo $bulan ?>/<?= $row['tahun'] ?></b>
                                                            </td>
                                                            <td style="vertical-align : middle;text-align:center;"><b>
                                                                      <?php if ($row['no_kasbon'] != '') { ?>
                                                                           <?php echo $row['no_kasbon'] ?>
                                                                      <?php } else { ?>
                                                                           -
                                                                      <?php } ?>
                                                                 </b></td>
                                                            <td style="vertical-align : middle;text-align:center;"><b>
                                                                      <?php if ($row['no_bukti'] != '') { ?>
                                                                           <?php echo $row['no_bukti'] ?>
                                                                      <?php } else { ?>
                                                                           -
                                                                      <?php } ?>
                                                                 </b></td>
                                                            <?php if ($_SESSION['lihat'] == "1") { ?>
                                                                 <?php if ($row['status'] == "2") { ?>
                                                                      <td style="vertical-align : middle;text-align:center;">
                                                                           <a title="Cetak Rincian Biaya Berobat" href="lihat_cetak_rincian_berobat?id=<?php echo $row['id_berobat']; ?>">
                                                                                <!-- <span class="label label-success"><?php echo $row['id_surat']; ?></span> -->
                                                                                <button class="btn btn-info btn-sm margin"><i class="fa fa-print" aria-hidden="true"> Print</i></button>
                                                                           </a>
                                                                      </td>
                                                                      <td style="vertical-align : middle;text-align:center;">
                                                                           <a title="Cetak Rincian Biaya Berobat" href="cetak_pdf?id=<?php echo $row['id_berobat']; ?>" target="_blank">
                                                                                <button class="btn btn-warning btn-sm margin"><i class="fa fa-file-pdf-o" aria-hidden="true"> PDF</i></button>
                                                                           </a>
                                                                      </td>
                                                                 <?php } else { ?>
                                                                      <td></td>
                                                                      <td></td>
                                                                 <?php } ?>
                                                            <?php } ?>
                                                            <?php if ($_SESSION['tambah'] == "1") { ?>
                                                                 <td style="vertical-align : middle;text-align:center;">
                                                                      <?php if ($row['status'] == "0") { ?>
                                                                           <a href="detail_data_berobat?id=<?php echo $row['id_berobat']; ?>" class="btn btn-sm btn-success margin">Detail Biaya Berobat</a>
                                                                      <?php } ?>
                                                                      <?php if ($row['status'] == "1") { ?>
                                                                           <form id="form1" method="post" action="" enctype="multipart/form-data">
                                                                                <a href="tambah_rekap_berobat?id=<?php echo $row['id_berobat']; ?>" class="btn btn-warning btn-sm text-black margin" data-toggle="modal" data-target="#edit<?php echo $row['id_berobat']; ?>">Rekam Medis</a>
                                                                                <div class="modal fade" id="edit<?php echo $row['id_berobat']; ?>">
                                                                                     <div class="modal-dialog">
                                                                                          <div class="modal-content">
                                                                                          </div>
                                                                                     </div>
                                                                                </div>
                                                                           </form>
                                                                      <?php } ?>
                                                                      <?php if ($row['status'] == "2") { ?>
                                                                      <?php } ?>
                                                                 </td>
                                                            <?php } ?>
                                                            <?php if ($_SESSION['edit'] == "1") { ?>
                                                                 <td>
                                                                      <form id="form1" method="post" action="" enctype="multipart/form-data">
                                                                           <a href="edit_biaya_berobat?id=<?php echo $row['id_berobat']; ?>" class="btn btn-success btn-sm margin" data-toggle="modal" data-target="#edit2<?php echo $row['id_berobat']; ?>">Edit Biaya Berobat</a>
                                                                           <div class="modal fade" id="edit2<?php echo $row['id_berobat']; ?>">
                                                                                <div class="modal-dialog">
                                                                                     <div class="modal-content">
                                                                                     </div>
                                                                                </div>
                                                                           </div>
                                                                      </form>
                                                                      <a href="edit_detail_data_berobat?id=<?php echo $row['id_berobat']; ?>" class="btn btn-sm btn-warning margin">Edit Detail Berobat</a>
                                                                 </td>
                                                            <?php } ?>
                                                            <td>
                                                                 <?php if ($_SESSION['tipe'] == "admin") { ?>
                                                                      <?php if ($row['status'] == '1') { ?>
                                                                           <a href="admin_edit_det_data_ber?id=<?php echo $row['id_berobat']; ?>" class="btn btn-sm btn-warning margin"><i class="glyphicon glyphicon-edit"></i></a>
                                                                      <?php } ?>
                                                                 <?php } ?>
                                                            </td>
                                                            <?php if ($_SESSION['hapus'] == "1") { ?>
                                                                 <td>
                                                                      <a title="Hapus Data" href="tampil_biaya_berobat?hapus_id=<?php echo $row['id_berobat']; ?>"><button class="btn btn-danger btn-sm margin delete">Hapus</button></a>
                                                                 </td>
                                                            <?php } ?>
                                                       </tr>
                                             <?php  }
                                             } ?>
                                        </tbody>
                                   </table>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </section>
</div>
<?php
include_once('template/footer.php');
?>
<div class="modal fade" id="tambah">
     <form id="form" method="post" action="" enctype="multipart/form-data">
          <div class="modal-dialog">
               <div class="modal-content">
                    <div class="modal-header">
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span></button>
                         <h4 class="modal-title">Tambah Biaya Berobat</h4>
                    </div>
                    <div class="modal-body">
                         <div class="box-body">
                              <!-- Tanggal -->
                              <div class="form-group">
                                   <table>
                                        <tbody>
                                             <tr>
                                                  <th style="width: 30%">Tanggal</th>
                                                  <th style="width: 15%">:</th>
                                                  <th style="width: 60%">
                                                       <input type="text" name="tgl" class="form-control tanggal" value="<?php echo date('Y-m-d'); ?>">
                                                  </th>
                                             </tr>
                                             <!-- ENTER -->
                                             <tr>
                                                  <th>
                                                       <div><br></div>
                                                  </th>
                                             </tr><!-- END ENTER -->
                                             <tr>
                                                  <th style="width: 30%">Nama Karyawan</th>
                                                  <th style="width: 15%">:</th>
                                                  <th style="width: 60%">
                                                       <select class="form-control select2" name="nama_kar" id="nama_kar" style="width: 100%">
                                                            <option></option>
                                                            <?php
                                                            if ($data_karyawan->num_rows > 0) {
                                                                 while ($row = mysqli_fetch_object($data_karyawan)) {
                                                            ?>
                                                                      <option value="<?php echo $row->id_kar; ?>"> <?php echo $row->nama_kar; ?></option>
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
                                                       <select class="form-control select2" name="tempat" id="tempat" style="width: 100%">
                                                            <option></option>
                                                            <?php
                                                            if ($data_klinik->num_rows > 0) {
                                                                 while ($row = mysqli_fetch_object($data_klinik)) {
                                                            ?>
                                                                      <option value="<?php echo $row->klinik; ?>"><?php echo $row->klinik; ?></option>
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
                                                       <input type="text" name="dokter" id="dokter" class="form-control" onkeyup="this.value = this.value.toUpperCase()" autocomplete="off" placeholder="Input Dokter" autofocus required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')" oninput="setCustomValidity('')">
                                                  </th>
                                             </tr>
                                             <!-- ENTER -->
                                             <tr>
                                                  <th>
                                                       <div><br></div>
                                                  </th>
                                             </tr><!-- END ENTER -->
                                             <tr>
                                                  <th style="width: 30%">Jenis Penyakit</th>
                                                  <th style="width: 15%">:</th>
                                                  <th style="width: 60%">
                                                       <input type="text" name="jenis" id="jenis" class="form-control" onkeyup="this.value = this.value.toUpperCase()" autocomplete="off" placeholder="Input Jenis Penyakit" autofocus required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')" oninput="setCustomValidity('')">
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
                                                       <input type="text" name="kasbon" id="kasbon" class="form-control" autocomplete="off" placeholder="Input Kasbon">
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
                                   <input type="hidden" name="user" id="user" class="form-control" value="<?php echo $_SESSION['nama']; ?>" readonly>
                                   <input type="hidden" name="jam" class="form-control" value="<?php echo date('H:i:s'); ?>">
                              </div>
                         </div>
                         <div class="modal-footer">
                              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                              <button type="submit" name="tambah" class="btn btn-primary"><i class="fa fa-save" aria-hidden="true"></i> Save</button>
                         </div>
                    </div>
               </div>
     </form>
</div>
<?php if ($_SESSION['tipe'] != "admin") {  ?>
     <script type="text/javascript">
          $(document).ready(function() {
               setTimeout(function() {
                    location.reload();
               }, 300000); // 60000 = 1 menit | 300000 = 5 Menit
          })
     </script>
<?php } ?>
<!-- ./wrapper -->
</body>

</html>