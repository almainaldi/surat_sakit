<!DOCTYPE html>
<title>LPS | Cetak Rincian Biaya Berobat</title>
<html>
<?php
include_once('template/header.php');
include_once('class/biaya_berobat.php');
include_once('class/detail_data_berobat.php');
$biaya_berobat = new biaya_berobat();
$detail_data_berobat = new detail_data_berobat();

if (!empty($_GET['id'])) {
    $id = $_GET['id'];
    if ($biaya_berobat->cek_id($id)) {
        $data = $biaya_berobat->get_by_id($id);
    } else {
        header("location:tampil_seluruh_biaya_berobat?pesan=gagal");
    }
} else {
    header("location:tampil_seluruh_biaya_berobat");
}

$id_berobat = $_GET['id'];
$data_detail_data_berobat      = $detail_data_berobat->tampil_data($id_berobat);
$total_biaya      = $detail_data_berobat->total_biaya($id_berobat);
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
                <h3 class="text-center" style="font-size:30px;"><b>Rincian Biaya Berobat</b></h3>
            </div>
        </div>

        <div class="row">
            <!-- KIRI -->
            <div class="col-xs-6">
                <div class="col-xs-12 table-responsive">
                    <table class="table table-borderless table-striped table-hover">
                        <tr>
                            <td style="width: 200px; padding: 0px;vertical-align: middle;"><b> Tanggal</b></td>
                            <td style="width: 5px; padding: 0px;vertical-align: middle;"><b>:</td>
                            <td><b> <?php echo $data['tanggal'] ?></td>
                        </tr>
                        <tr>
                            <td style="width: 200px; padding: 0px;vertical-align: middle;"><b> Nama Karyawan</b></td>
                            <td style="width: 5px; padding: 0px;vertical-align: middle;"><b>:</td>
                            <td><b> <?php echo $data['nama_karyawan'] ?></td>
                        </tr>
                        <tr>
                            <td style="width: 200px; padding: 0px;vertical-align: middle;"><b> Jenis Penyakit</b></td>
                            <td style="width: 5px; padding: 0px;vertical-align: middle;"><b>:</td>
                            <td><b> <?php echo $data['jenis'] ?></td>
                        </tr>
                    </table>
                </div>
            </div>
            <!-- KANAN -->
            <div class="col-xs-6">
                <div class="col-xs-12 table-responsive">
                    <table class="table table-borderless table-striped table-hover">
                        <tr>
                            <td style="width: 110px; padding: 0px; vertical-align: middle;"><b> Nama Klinik</b></td>
                            <td style="width: 5px; padding: 0px;vertical-align: middle;"><b>:</td>
                            <td><b> <?php echo $data['tempat'] ?></td>
                        </tr>
                        <tr>
                            <td style="width: 110px; padding: 0px;vertical-align: middle;"><b> Dokter</b></td>
                            <td style="width: 5px; padding: 0px;vertical-align: middle;"><b>:</td>
                            <td><b> <?php echo $data['dokter'] ?></td>
                        </tr>
                        <tr>
                            <td style="width: 110px; padding: 0px;vertical-align: middle;"><b> Kasbon</b></td>
                            <td style="width: 5px; padding: 0px;vertical-align: middle;"><b>:</td>
                            <td><b> Rp. &emsp; <?php echo number_format($data['kasbon'], 0, "", ".") ?></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="col-xs-12">
                <tr>
                    <th>
                        <div><br></div>
                    </th>
                </tr><!-- END ENTER -->
            </div>



            <div class="col-xs-12">
                <table class="table table-head-fixed table-striped" >
                    <thead>
                        <tr>
                            <th style="vertical-align : middle;text-align:center;border:1px solid #000;">No</th>
                            <th style="vertical-align : middle;text-align:center;border:1px solid #000;">Jenis Layanan</th>
                            <th colspan="1" style="vertical-align : middle;text-align:center;border:1px solid #000;">Biaya</th>
                        </tr>
                    </thead>
                    <?php
                    if ($data_detail_data_berobat->num_rows > 0) {
                        $no = 1;
                        while ($row = mysqli_fetch_object($data_detail_data_berobat)) {
                    ?>
                            <tbody>
                                <tr>
                                    <td style="vertical-align : middle;text-align:center;border:1px solid #000;"><?php echo $no++ ?></td>
                                    <td style="vertical-align : middle;text-align:left;border:1px solid #000;"><?php echo $row->jenis_layanan ?></td>
                                    <td style="vertical-align : middle;text-align:right;border:1px solid #000;"><?php echo number_format($row->biaya, 0, "", ".") ?></td>
                                </tr>
                        <?php  }
                    } ?>
                        <tr>
                            <td colspan="2" style="vertical-align : middle;text-align:center;border:1px solid #000;">Total Biaya</td>
                            <td colspan="1" style="vertical-align : middle;text-align:right;border:1px solid #000;"><?php echo number_format($total_biaya, 0, "", ".") ?></td>
                        </tr>
                            </tbody>
                </table>
                <div class="clearfix"></div>

                <div class="row no-print">
                    <div class="col-xs-12">
                        <a href="tampil_seluruh_biaya_berobat" class="btn btn-warning pull-left"><i class="fa fa-backward"></i> Kembali</a>
                        <form id="form" method="post" action="" enctype="multipart/form-data">
                            <button type="submit" name="tombol" class="btn btn-success pull-right" onclick="window.print()"><i class="fa fa-print"></i> Print</button>
                        </form>
                    </div>
                </div>
    </section>
    <div class="clearfix"></div><br><br><br><br>
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