<!DOCTYPE html>
<html>

<head>
    <title>Seluruh Data Detail Biaya Berobat</title>

    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
    <script type="text/javascript" src="assets/js/jquery.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.js"></script>

</head>

<body>
    <?php
    include_once('class/biaya_berobat.php');
    include_once('class/detail_data_berobat.php');
    $biaya_berobat = new biaya_berobat();
    $detail_data_berobat = new detail_data_berobat();

    if (!empty($_GET['id'])) {
        $id = $_GET['id'];
        if ($biaya_berobat->cek_id($id)) {
            $data = $biaya_berobat->print($id);
        } else {
            header("location:tampil_seluruh_biaya_berobat");
        }
    } else {
        header("location:tampil_seluruh_biaya_berobat");
    }

    $id_berobat = $_GET['id'];
    $data_detail_data_berobat      = $detail_data_berobat->tampil_data($id_berobat);
    $total_biaya      = $detail_data_berobat->total_biaya($id_berobat);
    ?>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 style="text-align: center;">Data Rekap Berobat</h3>
                    </div>
                    <form id="form" class="form-horizontal" method="post" action="">
                        <form class="form-horizontal">
                            <div class="box-body">
                                <div class="col-sm-12" align="center">
                                    <table class="table table-bordered table-striped">
                                        <tr>
                                            <th>Tanggal</th>
                                            <th style="text-align: center;">:</th>
                                            <td><?php echo $data['tgl']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Nama Karyawan</th>
                                            <th style="text-align: center;">:</th>
                                            <td><?php echo $data['nama_karyawan']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Dokter</th>
                                            <th style="text-align: center;">:</th>
                                            <td><?php echo $data['dokter']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Jenis Penyakit</th>
                                            <th style="text-align: center;">:</th>
                                            <td><?php echo $data['jenis']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Kasbon</th>
                                            <th style="text-align: center;">:</th>
                                            <td><?php echo $data['kasbon']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Status</th>
                                            <th style="text-align: center;">:</th>
                                            <td><?php
                                                if ($data['status'] == '1') {
                                                    echo "<div class='label label-success'>SEMBUH</div>";
                                                } else {
                                                    echo "<div class='label label-danger'>SAKIT</div>";
                                                }

                                                ?>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-xs-12">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th style="vertical-align : middle;text-align:center;">No</th>
                                                <th style="vertical-align : middle;text-align:center;">Jenis Layanan</th>
                                                <th colspan="4" style="text-align: center;">Biaya</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if ($data_detail_data_berobat->num_rows > 0) {
                                                $no = 1;
                                                while ($row = mysqli_fetch_object($data_detail_data_berobat)) {
                                            ?>
                                                    <tr>
                                                        <td style="text-align: center;"><?php echo $no++ ?></td>
                                                        <td><?php echo $row->jenis_layanan ?></td>
                                                        <td style="text-align: center;"><?php echo number_format($row->biaya, 0, "", ".") ?></td>
                                                    </tr>
                                            <?php  }
                                            } ?>
                                            <tr>
                                                <th colspan="2" style="text-align: center; ">Total Biaya</th>
                                                <th colspan="2" style="text-align: center; "><?php echo number_format($total_biaya, 0, "", ".") ?></th>
                                            </tr>
                                            <tr>

                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="box-footer">
                                    <a href="tampil_seluruh_biaya_berobat" button onclick="window.close()" class="btn btn-primary pull-left">Kembali</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                </div>
            </div>
    </section>
</body>

</html>