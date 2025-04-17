<!DOCTYPE html>
<html>
<title>LPS | Surat Rujukan</title>
<?php
include_once('template/header.php');
include_once('class/surat_rujukan.php');
include_once('class/klinik.php');
include_once('class/jabatan.php');
include_once('class/karyawan.php');
include_once('class/biaya_berobat.php');
include_once('class/config.php');

$surat_rujukan = new surat_rujukan();
$klinik        = new klinik();
$jabatan       = new jabatan();
$karyawan      = new karyawan();
$biaya_berobat = new biaya_berobat();
$config        = new config();

$data_surat_rujukan = $surat_rujukan->tampil_data();
$data_klinik        = $klinik->tampil_data();
$data_jabatan       = $jabatan->tampil_data();
$data_karyawan      = $karyawan->tampil_data();


if (isset($_POST['tombol'])) {
     $data = array(

          "id_surat"     => $_POST['id_surat'],
          "tgl"          => $_POST['tgl'],
          "tgl_in"       => $_POST['tgl_in'],
          "nama"         => $_POST['nama'],
          "jabatan"      => $_POST['jabatan'],
          "keluhan"      => $_POST['keluhan'],
          "tujuan"       => $_POST['tujuan'],
          "mengetahui"   => $_POST['mengetahui'],
          "pemberi"      => $_POST['pemberi']
     );
     if ($surat_rujukan->tambah($data)) {
          header("location:tampil_surat_rujukan?pesan=success");
     } else {
          header("location:tampil_surat_rujukan?pesan=gagal");
     }
}

if (isset($_POST['updatein'])) {
     $data = array(

          "id_surat"     => $_POST['id_surat'],
          "note"         => $_POST['note'],
          "status"       => $_POST['status']
     );
     if ($surat_rujukan->note($data)) {
          header("location:tampil_surat_rujukan?pesan=success");
     } else {
          header("location:tampil_surat_rujukan?pesan=gagal");
     }
}


if (isset($_POST['update'])) {
     $data = array(

          "id_surat"     => $_POST['id_surat'],
          "tgl"          => $_POST['tgl'],
          "tgl_in"       => $_POST['tgl_in'],
          "nama"         => $_POST['nama'],
          "jabatan"      => $_POST['jabatan'],
          "keluhan"      => $_POST['keluhan'],
          "tujuan"       => $_POST['tujuan'],
          "mengetahui"   => $_POST['mengetahui'],
          "pemberi"      => $_POST['pemberi']
     );
     if ($surat_rujukan->edit($data)) {
          header("location:tampil_surat_rujukan?pesan=success");
     } else {
          header("location:tampil_surat_rujukan?pesan=gagal");
     }
}

if (isset($_POST['biaya_berobat'])) {
     $data = array(
          "id_berobat" => $_POST['id_berobat'],
          "id_surat_rujukan" => $_POST['id_surat_rujukan'],
          "tgl" => $_POST['tgl'],
          "tgl_in" => $_POST['tgl_in'],
          "jam" => $_POST['jam'],
          "nama_kar" => $_POST['nama_kar'],
          "tempat" => $_POST['tempat'],
          "dokter" => $_POST['dokter'],
          "jenis" => $_POST['jenis'],
          "kasbon" => $_POST['kasbon'],
          "user" => $_POST['user']
     );
     if ($biaya_berobat->tambah($data)) {
          $surat_rujukan->ubah_status($data);
          header("location:tampil_biaya_berobat?pesan=success");
     } else {
          header("location:tampil_biaya_berobat?pesan=gagal");
     }
}

if (isset($_GET['hapus_id'])) {
     if ($surat_rujukan->cek_id($_GET['hapus_id'])) {
          if ($surat_rujukan->hapus($_GET['hapus_id'])) {
               header("location:tampil_surat_rujukan?pesan=hapus");
          } else {
               header("location:tampil_surat_rujukan?pesan=gagal");
          }
     } else {
          header("location:tampil_surat_rujukan");
     }
}
?>
<style>
     .testing {
          width: 100%;
          height: auto;
          outline: none;
          border-color: #bfbfbf;
          border-radius: 2px;
     }

     .noscroll {
          resize: none;
          overflow: hidden;
     }

     .hiddendiv {
          display: none;
          white-space: pre-wrap;
          word-wrap: break-word;
          width: 500px;
          min-height: 50px;
     }

     .lbr {
          line-height: 3px;
     }
</style>
<script src="class/validasi_form/surat_rujukan.js" type="text/javascript"></script>
<script src="class/validasi_form/app.js" type="text/javascript"></script>
<script src="js/jquery.min.js"></script>
<script>
     $(function() {
          var textArea = $('#content'),
               hiddenDiv = $(document.createElement('div')),
               content = null;

          textArea.addClass('noscroll');
          hiddenDiv.addClass('hiddendiv');

          $(textArea).after(hiddenDiv);

          textArea.on('keyup', function() {
               content = $(this).val();
               content = content.replace(/\n/g, '<br>');
               hiddenDiv.html(content + '<br class="lbr">');
               $(this).css('height', hiddenDiv.height());
          });
     });
</script>
<div class="content-wrapper">
     <section class="content-header">
          <h1>
               Surat Rujukan
          </h1>
          <ol class="breadcrumb">
               <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
               <li class="active">Surat Rujukan</li>
          </ol>
     </section>
     <p>
          <?php if ($_SESSION['tambah'] == "1") { ?>
     <div class="container-fluid col-sm-12 col-md-3">
          <div class="card card-success">
               <div class="card-body">
                    <div class="box box-primary box-solid">
                         <div class="box-header with-border">
                              <h3 class="box-title text-black"><i class="fa fa-cube"></i> FORM INPUT SURAT RUJUKAN <i class="fa fa-cube"></i></h3>
                         </div>
                         <form class="form" id="form" name="form" method="post" action="">
                              <div class="box-body">
                                   <div class="row">
                                        <div class="col-md-12">
                                             <div class="form-group">
                                                  <label for="" class="col-xs-4 control-label">Tanggal</label>
                                                  <div class="col-xs-8">
                                                       <input type="text" name="tgl" class="form-control tanggal" value="<?php echo date('Y-m-d') ?>">
                                                  </div>
                                             </div><br><br>
                                             <div class="form-group">
                                                  <label for="" class="col-xs-4  control-label">Nama</label>
                                                  <div class="col-xs-8">
                                                       <select class="form-control select2" name="nama" id="nama">
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
                                                  </div>
                                             </div><br><br>
                                             <div class="form-group">
                                                  <label for="" class="col-xs-4  control-label">Jabatan</label>
                                                  <div class="col-xs-8">
                                                       <select class="form-control select2" name="jabatan" id="jabatan">
                                                            <option></option>

                                                       </select>
                                                  </div>
                                             </div><br><br>
                                             <div class="form-group">
                                                  <label for="" class="col-xs-4  control-label">Klinik / R.S</label>
                                                  <div class="col-xs-8">
                                                       <select class="form-control select2" name="tujuan" id="tujuan">
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
                                                  </div>
                                             </div><br><br>
                                             <div class="form-group">
                                                  <label for="" class="col-xs-4  control-label">Keluhan</label>
                                                  <div class="col-xs-8">
                                                       <textarea class="testing" id="content" name="keluhan" placeholder=" Input Keluhan" onkeyup="this.value = this.value.toUpperCase()" autofocus required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')" oninput="setCustomValidity('')"></textarea>
                                                  </div>
                                             </div><br><br><br>
                                             <input type="hidden" class="form-control" placeholder="Input Mengetahui" name="mengetahui" value="<?php echo $_SESSION['nama'] ?>" readonly>
                                             <input type="hidden" class="form-control" name="pemberi" value="ROME WIJAYA" readonly>
                                             <input type="hidden" name="tgl_in" class="form-control" value="<?php echo date('Y-m-d') ?>" readonly>
                                        </div>
                                   </div>
                              </div>
                              <div class="box-footer">
                                   <button type="submit" name="tombol" class="btn btn-info pull-right"><i class="fa fa-save"> Simpan</i></button>
                              </div>
                         </form>
                    </div>
               </div>
          </div>
     </div>
<?php } ?>

<section class="content">
     <div class="row">
          <div class="col-sm-12 col-md-9">
               <div class="box box-primary">
                    <div class="box-header">
                         <div class="box-body">
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
                              <div class="table-responsive no-padding">
                                   <table class="table table-hover table-bordered table-striped" id="example1" style="height: auto; ">
                                        <thead>
                                             <tr>
                                                  <th class="text-center">No</th>
                                                  <th class="text-center">No Surat</th>
                                                  <th class="text-center">Tanggal</th>
                                                  <th class="text-center">Nama</th>
                                                  <th class="text-center">Jabatan</th>
                                                  <th class="text-center">Keluhan</th>
                                                  <th class="text-center">Klinik / R.S</th>
                                                  <th class="text-center">No Kasbon</th>
                                                  <th class="text-center">No Bukti Kas</th>
                                                  <?php if ($_SESSION['print'] == "1") { ?>
                                                       <th class="text-center">Konfirmasi / Print</th>
                                                       <th class="text-center">PDF</th>
                                                  <?php } ?>
                                                  <?php if ($_SESSION['tambah'] == "1") { ?>
                                                       <th class="text-center">Biaya Berobat</th>
                                                  <?php } ?>
                                                  <?php if ($_SESSION['edit'] == "1") { ?>
                                                       <th class="text-center">Edit</th>
                                                  <?php } ?>
                                                  <?php if ($_SESSION['edit'] == "1") { ?>
                                                       <th class="text-center">Memo</th>
                                                  <?php } ?>
                                                  <?php if ($_SESSION['hapus'] == "1") { ?>
                                                       <th class="text-center">Hapus</th>
                                                  <?php } ?>
                                             </tr>
                                        </thead>
                                        <tbody>
                                             <?php
                                             if ($data_surat_rujukan->num_rows > 0) {
                                                  $no = 1;
                                                  while ($row = mysqli_fetch_array($data_surat_rujukan)) { ?>
                                                       <?php $id = $row['id_surat'] ?>
                                                       <?php $hasil_bulan  = $surat_rujukan->bln($id) ?>
                                                       <?php $bulan = $config->bln2($hasil_bulan) ?>
                                                       <tr>
                                                            <td style="vertical-align : middle;text-align:center;"><b><?php echo $no++ ?></b></td>
                                                            <td style="vertical-align : middle;">
                                                                 <b><?php echo $row['id_surat'] ?>/SR/<?php echo $bulan ?>/<?= $row['tahun']?></b>
                                                            </td>
                                                            <td style="vertical-align : middle;"><b><?php echo $row['tanggal'] ?></b></td>
                                                            <td style="vertical-align : middle;"><b><?php echo $row['nama_kar'] ?></b></td>
                                                            <td style="vertical-align : middle;"><b><?php echo $row['jabatan'] ?></b></td>
                                                            <td style="vertical-align : middle;"><b><?php echo $row['keluhan'] ?></b></td>
                                                            <td style="vertical-align : middle;"><b><?php echo $row['tujuan'] ?></b></td>
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
                                                            <?php if ($_SESSION['print'] == "1") { ?>
                                                                 <td style="vertical-align : middle;text-align:center;">
                                                                      <?php if ($row['acc'] == '0') { ?>
                                                                           <!-- SHARE -->
                                                                           <?php if (($_SESSION['tipe'] == 'staff') or ($_SESSION['tipe'] == 'admin')) { ?>
                                                                                <span class="label label-success"><?php echo $row['st_print']; ?></span>
                                                                                <a href="surat_rujukan_wa?id=<?php echo $row['id_surat']; ?>" class="btn btn-sm btn-microsoft"><i class="fa fa-share"></i></a>
                                                                           <?php } ?>
                                                                           <?php if (($_SESSION['nama'] == $row['pemberi'])) { ?>
                                                                                <a title="ACC SURAT RUJUKAN" href="surat_rujukan_acc?id=<?php echo $row['id_surat']; ?>">
                                                                                     <span class="label label-success"><?php echo $row['st_print']; ?></span>
                                                                                     <button class="btn btn-sm btn-microsoft"><i class="fa fa-check" aria-hidden="true"> ACC</i></button>
                                                                                </a>
                                                                           <?php } ?>
                                                                      <?php } else { ?>
                                                                           <a title="Cetak Surat Rujukan" href="surat_rujukan_cetak?id=<?php echo $row['id_surat']; ?>">
                                                                                <span class="label label-success"><?php echo $row['jum_print']; ?></span>
                                                                                <button class="btn btn-success btn-sm margin"><i class="fa fa-print" aria-hidden="true"></i></button>
                                                                           </a>
                                                                      <?php } ?>
                                                                 </td>
                                                                 <td style="vertical-align : middle;text-align:center;">
                                                                      <?php if ($row['acc'] == '0') { ?>
                                                                           <!-- SHARE -->
                                                                           <?php if (($_SESSION['tipe'] == 'staff') or ($_SESSION['tipe'] == 'admin')) { ?>
                                                                           <?php } ?>
                                                                           <?php if (($_SESSION['nama'] == $row['pemberi'])) { ?>
                                                                           <?php } ?>
                                                                      <?php } else { ?>
                                                                           <a title="Cetak Surat Rujukan" href="cetak_sr?id=<?php echo $row['id_surat']; ?>" target="_blank">
                                                                                <button class="btn btn-warning btn-sm margin"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></button>
                                                                           </a>
                                                                      <?php } ?>
                                                                 </td>
                                                            <?php } ?>
                                                            <?php if ($_SESSION['tambah'] == "1") { ?>
                                                                 <td style="vertical-align : middle;text-align:center;">
                                                                      <?php if ($row['status'] == "1") { ?>
                                                                           <form id="form1" method="post" action="" enctype="multipart/form-data">
                                                                                <a href="tambah_biaya_berobat?id=<?php echo $row['id_surat']; ?>" class="btn btn-info btn-sm text-black margin" data-toggle="modal" data-target="#edit<?php echo $row['id_surat']; ?>"><i class="fa fa-plus"></i></a>
                                                                                <div class="modal fade" id="edit<?php echo $row['id_surat']; ?>">
                                                                                     <div class="modal-dialog">
                                                                                          <div class="modal-content">

                                                                                          </div>
                                                                                     </div>
                                                                                </div>
                                                                           </form>
                                                                      <?php } ?>
                                                                 </td>
                                                            <?php } ?>
                                                            <?php if ($_SESSION['edit'] == "1") { ?>
                                                                 <td style="vertical-align : middle;text-align:center;">
                                                                      <?php if ($_SESSION['edit'] == "1") { ?>
                                                                           <!-- EDIT -->
                                                                           <form id="form2" method="post" action="" enctype="multipart/form-data">
                                                                                <a href="edit_surat_rujukan?id=<?php echo $row['id_surat']; ?>" class="btn btn-warning btn-sm text-black margin" data-toggle="modal" data-target="#edit<?php echo $row['id_surat']; ?>"><i class="fa fa-edit"></i></a>
                                                                                <div class="modal fade" id="edit<?php echo $row['id_surat']; ?>">
                                                                                     <div class="modal-dialog">
                                                                                          <div class="modal-content">

                                                                                          </div>
                                                                                     </div>
                                                                                </div>
                                                                           </form>
                                                                           <!-- END EDIT -->
                                                                      <?php } ?>
                                                                 </td>
                                                                 <td style="vertical-align : middle;text-align:center;">
                                                                      <?php if ($_SESSION['edit'] == "1") { ?>
                                                                           <!-- EDIT -->
                                                                           <form id="form1" method="post" action="" enctype="multipart/form-data">
                                                                                <a href="memo_surat_rujukan?id=<?php echo $row['id_surat']; ?>" class="btn bg-navy btn-sm text-white margin" data-toggle="modal" data-target="#memo<?php echo $row['id_surat']; ?>"><i class="fa fa-edit"></i></a>
                                                                                <div class="modal fade" id="memo<?php echo $row['id_surat']; ?>">
                                                                                     <div class="modal-dialog">
                                                                                          <div class="modal-content">

                                                                                          </div>
                                                                                     </div>
                                                                                </div>
                                                                           </form>
                                                                           <!-- END EDIT -->
                                                                      <?php } ?>
                                                                 </td>
                                                            <?php } ?>
                                                            <?php if ($_SESSION['hapus'] == "1") { ?>
                                                                 <td style="vertical-align : middle;text-align:center;">
                                                                      <!-- HAPUS -->
                                                                      <a title="Hapus" title="Hapus Data" href="tampil_surat_rujukan?hapus_id=<?php echo $row['id_surat']; ?>">
                                                                           <button class="btn btn-danger btn-sm text-black"><i class="fa fa-trash"> </i></button>
                                                                      </a>
                                                                      <!-- END HAPUS -->
                                                                 </td>
                                                            <?php } ?>
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

<?php
include_once('template/footer.php');
?>
<script>
     window.setTimeout(function() {
          $(".alert").fadeTo(300, 0).slideUp(300, function() {
               $($this).remove();
          });
     }, 1500)
</script>