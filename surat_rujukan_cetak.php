<!DOCTYPE html>
<title>LPS | Cetak Surat Rujukan</title>
<html>
<?php
include_once('template/header.php');
include_once('class/surat_rujukan.php');

$surat_rujukan   = new surat_rujukan();

if (!empty($_GET['id'])) {
     $id = $_GET['id'];
     if ($surat_rujukan->cek_id($id)) {
          $data = $surat_rujukan->get_by_id($id);
     } else {
          header("location:tampil_surat_rujukan?pesan=gagal");
     }
} else {
     header("location:tampil_surat_rujukan");
}

$id = $_GET['id'];
if (isset($_POST['tombol'])) {
     $data = array(
          "id_surat"     => $_POST['id_surat'],
          "jum_print"    => $_POST['jum_print']
     );
     if ($surat_rujukan->st_print($data)) {
          header("location:tampil_surat_rujukan?id=$id");
     } else {
          header("location:tampil_surat_rujukan?pesan=gagal");
     }
}

?>

<div class="content-wrapper" id="content">
     <section class="content-header">
          <h1>
               Surat Rujukan Berobat
          </h1>
          <ol class="breadcrumb">
               <li><a href="home"><i class="fa fa-home"></i> HOME</a></li>
               <li><a href="tampil_surat_rujukan">Surat Rujukan</a></li>
               <li class="active">Surat Rujukan</li>
          </ol>
     </section>

     <section class="invoice" style="font-size: 18px; font-family: Verdana, Geneva, Tahoma, sans-serif;">
          <div class="col-xs-11">
               <img src="gambar/logo.png" class="img" alt="User Image" width="100" height="100">
               <br><br>
          </div>
          <div class="col-xs-1">
                    <small class="pull-right" style="font-size: xx-small;">P<?php echo $data['jum_print'] ?></small>
               </div>
          <div class="row">
               <div class="col-xs-12">
                    <h3 class="text-center" style="font-size:30px;"><b>Surat Rujukan Berobat</b></h3>
               </div>
          </div><br><br>

          <div class="row">
               <!-- KIRI -->
               <div class="col-xs-12">
                    <table>
                         <tr>
                              <td><b> Yang bernama di bawah ini :</b></td>
                         </tr>
                         <tr>
                              <th>
                                   <div><br></div>
                              </th>
                         </tr><!-- END ENTER -->
                         <tr>
                              <th>
                                   <div><br></div>
                              </th>
                         </tr><!-- END ENTER -->
                    </table>
                    <table>
                         <tr>
                              <td style="width: 200px"><b> Nama Karyawan</b></td>
                              <td style="width: 20px"><b>:</td>
                              <td><b> <?php echo $data['nama_kar'] ?></td>
                         </tr>
                         <tr>
                              <td style="width: 200px"><b> Jabatan</b></td>
                              <td style="width: 20px"><b>:</td>
                              <td><b> <?php echo $data['jabatan'] ?></td>
                         </tr>
                         <tr>
                              <td style="width: 200px"><b> Keluhan</b></td>
                              <td style="width: 20px"><b>:</td>
                              <td><b> <?php echo $data['keluhan'] ?></td>
                         </tr>
                         <tr>
                              <th>
                                   <div><br></div>
                              </th>
                         </tr><!-- END ENTER -->
                         <tr>
                              <th>
                                   <div><br></div>
                              </th>
                         </tr><!-- END ENTER -->
                    </table>
                    <table>

                         <tr>
                              <td><b>Diberikan izin berobat ke <?php echo $data['tujuan'] ?> untuk dapat diperiksa oleh dokter.</b></td>
                         </tr>
                    </table>
                    <tr>
                         <th>
                              <div><br></div>
                         </th>
                    </tr><!-- END ENTER -->
                    <tr>
                         <th>
                              <div><br></div>
                         </th>
                    </tr><!-- END ENTER -->
                    <tr>
                         <th>
                              <div><br></div>
                         </th>
                    </tr><!-- END ENTER -->
               </div>
          </div>



          <table class="table" style="font-size:18px;">
               <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th><b>Jakarta, <?php echo $data['tanggal'] ?></b>
                    </th>
               </tr>
          </table>
          <table class="table" style="font-size:18px;">
               <tr>
                    <th class="text" style="vertical-align : middle;text-align:center;">Yang Mengetahui, </th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th class="text" style="vertical-align : middle;text-align:center;">Pemberi Kuasa, </th>
               </tr>
               <tr>
                    <td class="text" style="vertical-align : middle;text-align:center;" scope="col"> <img src="master_gambar/ttd/<?php echo $data['mengetahui']; ?>.png" width="175" height="125" title="" /></td>
                    <td class="text" style="vertical-align : middle;text-align:center;" scope="col"></td>
                    <td class="text" style="vertical-align : middle;text-align:center;" scope="col"></td>
                    <td class="text" style="vertical-align : middle;text-align:center;" scope="col"></td>
                    <td class="text" style="vertical-align : middle;text-align:center;" scope="col"></td>
                    <td class="text" style="vertical-align : middle;text-align:center;" scope="col"></td>
                    <td class="text" style="vertical-align : middle;text-align:center;" scope="col"></td>
                    <td class="text" style="vertical-align : middle;text-align:center;" scope="col"></td>
                    <td class="text" style="vertical-align : middle;text-align:center;" scope="col"></td>
                    <td class="text" style="vertical-align : middle;text-align:center;" scope="col"></td>
                    <td class="text" style="vertical-align : middle;text-align:center;" scope="col"> <img src="master_gambar/ttd/<?php echo $data['pemberi']; ?>.png" width="175" height="125" title="" /> </td>
               </tr>
               <tr>
                    <td class="text" style="vertical-align : middle;text-align:center;" scope="col"></td>
                    <td class="text" style="vertical-align : middle;text-align:center;" scope="col"></td>
                    <td class="text" style="vertical-align : middle;text-align:center;" scope="col"></td>
                    <td class="text" style="vertical-align : middle;text-align:center;" scope="col"></td>
                    <td class="text" style="vertical-align : middle;text-align:center;" scope="col"></td>
                    <td class="text" style="vertical-align : middle;text-align:center;" scope="col"></td>
                    <td class="text" style="vertical-align : middle;text-align:center;" scope="col"></td>
                    <td class="text" style="vertical-align : middle;text-align:center;" scope="col"></td>
                    <td class="text" style="vertical-align : middle;text-align:center;" scope="col"></td>
                    <td class="text" style="vertical-align : middle;text-align:center;" scope="col"></td>
                    <?php if ($data['acc'] == '1') { ?>
                         <td class="text" style="vertical-align : middle;text-align:center;" scope="col"><h5><?php echo $data['acc_tgl'] ?></h5> </td>
                    <?php } else { ?>
                         <td class="text" style="vertical-align : middle;text-align:center;" scope="col"></td>
                         <?php } ?>
               </tr>
               <tr>
                    <th class="text" style="vertical-align : middle;text-align:center;"><?php echo $data['mengetahui'] ?></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th class="text" style="vertical-align : middle;text-align:center;"><?php echo $data['pemberi'] ?></th>
               </tr>
          </table>
          <div class="clearfix"></div>

          <div class="row no-print">
               <div class="col-xs-12">
                    <a href="tampil_surat_rujukan" class="btn btn-warning pull-left"><i class="fa fa-backward"></i> Kembali</a>
                    <form id="form" method="post" action="" enctype="multipart/form-data">
                         <input type="hidden" name="id_surat" id="" value="<?php echo $data['id_surat'] ?>">
                         <input type="hidden" name="jum_print" id="" value="<?php echo $data['jum_print'] ?>">
                         <button type="submit" name="tombol" class="btn btn-success pull-right" onclick="window.print()"><i class="fa fa-print"></i> Print</button>
                    </form>
               </div>
          </div>
     </section>
     <div class="clearfix"></div><br><br><br><br>
</div>


<!-- <?php include_once('template/footer_cetak.php'); ?> -->

<script>
     var css = '@page { size: potrait; }',
          head = document.head || document.getElementsByTagName('head')[0],
          style = document.createElement('style');
     style.type = 'text/css';
     style.media = 'print';
     if (style.styleSheet) {
          style.styleSheet.cssText = css;
     } else {
          style.appendChild(document.createTextNode(css));
     }
     head.appendChild(style);
</script>

<style>
     .bordered {
          border: solid 1px;
          padding: 4px 4px 4px 4px;
     }

     ;
</style>

<style>
     h2 {
          font-family: 'Share', cursive;
          font-size: 50px;
          font-weight: bold;
          text-shadow: 5px 5px 0px #f0e8db, 8px 8px 0px #6c5257;
          color: #b33939;
          /* background: #f9f9d7; */
          color: #9a9d0b;
          text-shadow:
               1px 1px #404206,
               2px 2px #727415,
               3px 3px #727415,
               4px 4px #727415,
               5px 5px #727415,
               6px 6px #727415,
               7px 7px #404206,
               8px 8px 7px #000;
     }
</style>