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

$surat_rujukan   = new surat_rujukan();
$klinik   = new klinik();
$jabatan   = new jabatan();
$karyawan   = new karyawan();
$biaya_berobat = new biaya_berobat();

$data_surat_rujukan      = $surat_rujukan->tampil_data_acc();
$data_klinik      = $klinik->tampil_data();
$data_jabatan      = $jabatan->tampil_data();
$data_karyawan      = $karyawan->tampil_data();

if (isset($_POST['tombol'])) {
     $data = array(

          "id_surat"  => $_POST['id_surat'],
          "tgl"  => $_POST['tgl'],
          "nama"  => $_POST['nama'],
          "jabatan" => $_POST['jabatan'],
          "keluhan" => $_POST['keluhan'],
          "tujuan" => $_POST['tujuan'],
          "mengetahui" => $_POST['mengetahui'],
          "pemberi" => $_POST['pemberi']
     );
     if ($surat_rujukan->tambah($data)) {
          header("location:tampil_surat_rujukan_acc?pesan=success");
     } else {
          header("location:tampil_surat_rujukan_acc?pesan=gagal");
     }
}

if (isset($_POST['update'])) {
     $data = array(

          "id_surat" => $_POST['id_surat'],
          "tgl"  => $_POST['tgl'],
          "nama" => $_POST['nama'],
          "jabatan" => $_POST['jabatan'],
          "keluhan" => $_POST['keluhan'],
          "tujuan" => $_POST['tujuan'],
          "mengetahui" => $_POST['mengetahui'],
          "pemberi" => $_POST['pemberi']
     );
     if ($surat_rujukan->edit($data)) {
          header("location:tampil_surat_rujukan_acc?pesan=success");
     } else {
          header("location:tampil_surat_rujukan_acc?pesan=gagal");
     }
}

if (isset($_POST['biaya_berobat'])) {
     $data = array(
          "id_berobat" => $_POST['id_berobat'],
          "id_surat_rujukan" => $_POST['id_surat_rujukan'],
          "tgl" => $_POST['tgl'],
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
?>
<script src="class/validasi_form/surat_rujukan.js" type="text/javascript"></script>
<script src="class/validasi_form/app.js" type="text/javascript"></script>
<div class="content-wrapper">
     <section class="content-header">
          <h1>
               Surat Rujukan Acc
          </h1>
          <ol class="breadcrumb">
               <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
               <li class="active">Surat Rujukan Acc</li>
          </ol>
     </section>
     <p>


<section class="content">
     <div class="row">
          <div class="col-sm-12 col-md-12">
               <div class="box">
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
                                                  <th class="text-center">Tanggal</th>
                                                  <th class="text-center">Nama</th>
                                                  <th class="text-center">Jabatan</th>
                                                  <th class="text-center">Keluhan</th>
                                                  <th class="text-center">Klinik / R.S</th>
                                                  <?php if ($_SESSION['print'] == "1") { ?>
                                                       <th class="text-center">Konfirmasi / Print</th>
                                                  <?php } ?>
                                                  <?php if ($_SESSION['tambah'] == "1") { ?>
                                                       <th class="text-center">Biaya Berobat</th>
                                                  <?php } ?>
                                                  <?php if ($_SESSION['edit'] == "1") { ?>
                                                       <th class="text-center">Edit</th>
                                                  <?php } ?>
                                             </tr>
                                        </thead>
                                        <tbody>
                                             <?php
                                             if ($data_surat_rujukan->num_rows > 0) {
                                                  $no = 1;
                                                  while ($row = mysqli_fetch_array($data_surat_rujukan)) { ?>
                                                       <tr>
                                                            <td style="vertical-align : middle;text-align:center;"><b><?php echo $no++ ?></b></td>
                                                            <td style="vertical-align : middle;"><b><?php echo $row['tanggal'] ?></b></td>
                                                            <td style="vertical-align : middle;"><b><?php echo $row['nama_kar'] ?></b></td>
                                                            <td style="vertical-align : middle;"><b><?php echo $row['jabatan'] ?></b></td>
                                                            <td style="vertical-align : middle;"><b><?php echo $row['keluhan'] ?></b></td>
                                                            <td style="vertical-align : middle;"><b><?php echo $row['tujuan'] ?></b></td>
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
                                                                           <form id="form1" method="post" action="" enctype="multipart/form-data">
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
<script>
     window.setTimeout(function() {
          $(".alert").fadeTo(300, 0).slideUp(300, function() {
               $($this).remove();
          });
     }, 1500)
</script>

<?php
include_once('template/footer.php');
?>