<title>LPS | Aplikasi Surat Sakit | Home</title>
<?php
include_once('template/header.php');
include_once('class/home.php');
$home = new home();

$jumlah_surat_rujukan     = $home->jumlah_surat_rujukan();
$jumlah_sr_belum_acc     = $home->jumlah_sr_belum_acc();
$jumlah_biaya_berobat     = $home->jumlah_biaya_berobat();
$jumlah_rekam_medis     = $home->jumlah_rekam_medis();
?>
<div class="content-wrapper">
  <section class="content">
  <div class="row">
               <!-- Total SPK -->
               <div class="col-lg-3 col-xs-6">
                    <div class="small-box" style="background-color: #8BD1D4; border-radius: 10px;">
                         <div class="inner">
                              <h3><?php echo $jumlah_surat_rujukan ?></h3>
                              <p>Total Surat Rujukan</p>
                         </div>
                         <a href="tampil_seluruh_surat_rujukan" class="small-box-footer text-black" style="border-radius: 10px;">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
               </div>
               <!-- SPK BUAT/BELI -->
               <div class="col-lg-3 col-xs-6">
                    <div class="small-box" style="background-color: #E7BB8D;border-radius: 10px;">
                         <div class="inner">
                              <h3><?php echo $jumlah_sr_belum_acc ?></h3>
                              <p><i class="fa fa-money"></i> Surat Rujukan Acc</p>
                         </div>
                         <a href="tampil_surat_rujukan_acc" class="small-box-footer text-black" style="border-radius: 10px;">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
               </div>
               <!-- SPK SERVIS -->
               <div class="col-lg-3 col-xs-6">
                    <div class="small-box" style="background-color: #E79C9B;border-radius: 10px;">
                         <div class="inner">
                              <h3><?php echo $jumlah_biaya_berobat ?></h3>
                              <p><i class="fa fa-file"></i> Total Biaya Berobat</p>
                         </div>
                         <a href="tampil_seluruh_biaya_berobat" class="small-box-footer text-black" style="border-radius: 10px;">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
               </div>
               <!-- SPK SOLAR -->
               <div class="col-lg-3 col-xs-6">
                    <div class="small-box" style="background-color: #8BD1C1;border-radius: 10px;">
                         <div class="inner">
                              <h3><?php echo $jumlah_rekam_medis ?></h3>
                              <p><i class="fa  fa-file-text"></i> Total Rekam Medis</p>
                         </div>
                         <a href="tampil_seluruh_rekap_berobat" class="small-box-footer text-black" style="border-radius: 10px;">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
               </div>
          </div>
  </section>
</div>
<?php
include_once('template/footer.php');
?>