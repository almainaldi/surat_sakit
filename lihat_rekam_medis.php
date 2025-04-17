<!DOCTYPE html>
<title>LPS | Cetak Rincian Biaya Berobat</title>
<html>
<?php
include_once('template/header.php');
include_once('class/rekap_berobat.php');
include_once('class/detail_data_berobat.php');
$rekap_berobat = new rekap_berobat();
$detail_data_berobat = new detail_data_berobat();

if (!empty($_GET['id'])) {
    $id = $_GET['id'];
    if ($rekap_berobat->cek_id($id)) {
        $data = $rekap_berobat->get_by_id($id);
    } else {
        header("location:tampil_rekap_berobat?pesan=gagal");
    }
} else {
    header("location:tampil_rekap_berobat?pesan=gagal");
}


// $id_berobat = $_GET['id'];
// $data_detail_data_berobat      = $detail_data_berobat->tampil_data($id_berobat);
// $total_biaya      = $detail_data_berobat->total_biaya($id_berobat);
?>

<div class="content-wrapper" id="content">
    <section class="content-header">
        <h1>
            Rincian Biaya Berobat
        </h1>
        <ol class="breadcrumb">
            <li><a href="home"><i class="fa fa-home"></i> HOME</a></li>
            <li><a href="tampil_biaya_berobat">Biaya Berobat</a></li>
            <li class="active">Rincian Biaya Berobat</li>
        </ol>
    </section>

    <section class="invoice" style="font-size: 15px; font-family: Verdana, Geneva, Tahoma, sans-serif;">
        <div class="row">
            <div class="col-xs-12">
                <br><br>
                <h4 class="text-center" style="font-size:25px;"><b>PT LANGGENG PRANAMAS SENTOSA</b></h4>
                <h4 class="text-center" style="font-size:20px;"><b>REKAM MEDIS KARYAWAN</b></h4>
            </div>
        </div><br><br>

        <div class="row">
            <!-- KIRI -->
            <div class="col-xs-12">
                <div class="col-xs-12 table-responsive">
                    <table class="table table-borderless table-striped table-hover">
                        <tr>
                            <td style="width: 200px"><b>Tanggal</b></td>
                            <td style="width: 20px"><b>:</td>
                            <td><b> <?php echo $data['tanggal'] ?></td>
                        </tr>
                        <tr>
                            <td style="width: 200px"><b>Nama Karyawan</b></td>
                            <td style="width: 20px"><b>:</td>
                            <td><b> <?php echo $data['nama_kar'] ?></td>
                        </tr>
                        <tr>
                            <td style="width: 200px"><b> Jabatan</b></td>
                            <td style="width: 20px"><b>:</td>
                            <td><b> <?php echo $data['jabatan'] ?></td>
                        </tr>
                        <tr>
                            <td style="width: 200px"><b> Klinik</b></td>
                            <td style="width: 20px"><b>:</td>
                            <td><b> <?php echo $data['tempat'] ?></td>
                        </tr>
                        <tr>
                            <td style="width: 200px"><b> Dokter</b></td>
                            <td style="width: 20px"><b>:</td>
                            <td><b> <?php echo $data['dokter'] ?></td>
                        </tr>
                        <tr>
                            <td style="width: 200px"><b>Keluhan Sakit</b></td>
                            <td style="width: 20px"><b>:</td>
                            <td><b> <?php echo $data['keluhan'] ?></td>
                        </tr>
                        <tr>
                            <td style="width: 200px"><b>Diagnosa Dokter</b></td>
                            <td style="width: 20px"><b>:</td>
                            <td><b> <?php echo $data['diagnosis'] ?></td>
                        </tr>
                        <tr>
                            <td style="width: 200px"><b>Solusi Bagi Pasien</b></td>
                            <td style="width: 20px"><b>:</td>
                            <td><b> <?php echo $data['solusi'] ?></td>
                            <!-- <td><textarea name="" id="" cols="auto" rows="10"><?php echo $data['solusi'] ?></textarea></td> -->
                        </tr>
                        <tr>
                            <td style="width: 200px"><b> Kasbon</b></td>
                            <td style="width: 20px"><b>:</td>
                            <td><b> <?php echo number_format($data['kasbon'], 0, "", ".") ?></td>
                        </tr>
                        <tr>
                            <td style="width: 200px"><b> Kembali</b></td>
                            <td style="width: 20px"><b>:</td>
                            <td><b> <?php echo number_format($data['kasbon'] - $data['total_biaya'], 0, "", ".") ?></td>
                        </tr>
                        <tr>
                            <td style="width: 200px"><b> Memo</b></td>
                            <td style="width: 20px"><b>:</td>
                            <td><b><?php echo $data['memo'] ?></td>
                        </tr>
                        <div><br></div>
                    </table>
                </div>
            </div>
            <div><br></div>
            <div class="col-xs-12">

                <table class="table table-bordered table-striped" border="1">
                    <thead>
                    <tr>
                            <th style="vertical-align : middle;text-align:center;">No</th>
                            <th style="vertical-align : middle;text-align:center;">Jenis Layanan</th>
                            <th colspan="1" style="vertical-align : middle;text-align:center;">Biaya</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $id_berobat = $data['id_biaya_berobat'];
                        $data_detail_data_berobat      = $detail_data_berobat->tampil_data($id_berobat);
                        $total_biaya      = $detail_data_berobat->total_biaya($id_berobat);
                        if ($data_detail_data_berobat->num_rows > 0) {
                            $no = 1;
                            while ($row = mysqli_fetch_object($data_detail_data_berobat)) {
                        ?>
                                <tr>
                                    <td style="vertical-align : middle;text-align:center;"><?php echo $no++ ?></td>
                                    <td style="vertical-align : middle;text-align:center;"><?php echo $row->jenis_layanan ?></td>
                                    <td style="vertical-align : middle;text-align:right;"><?php echo number_format($row->biaya, 0, "", ".") ?></td>
                                </tr>
                        <?php  }
                        } ?>
                        <tr>
                            <th colspan="2" style="vertical-align : middle;text-align:center;">Total Biaya</th>
                            <th colspan="1" style="vertical-align : middle;text-align:right;"><?php echo number_format($total_biaya, 0, "", ".") ?></th>
                        </tr>
                    </tbody>
                </table>
                <div class="clearfix"></div>
            </div>
            <div class="row no-print">
                <div class="col-xs-12">
                    <a href="tampil_rekap_berobat" class="btn btn-warning pull-left"><i class="fa fa-backward"></i> Kembali</a>
                    <form id="form" method="post" action="" enctype="multipart/form-data">
                        <button type="submit" name="tombol" class="btn btn-success pull-right" onclick="window.print()"><i class="fa fa-print"></i> Print</button>
                    </form>
                </div>
            </div>
    </section>
</div>

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
        border: solid 1px solid #000;
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