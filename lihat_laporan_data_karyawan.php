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
    include_once('class/laporan_biaya_karyawan.php');
    $laporan_biaya_karyawan = new laporan_biaya_karyawan();

    $id_kar = $_GET['id'];
    $data_laporan_biaya_karyawan      = $laporan_biaya_karyawan->tampil_detail_data($id_kar);
        $total_biaya      = $laporan_biaya_karyawan->total_biaya($id_kar);

    ?>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 style="text-align: center;">Detail Laporan Biaya Karyawan</h3>
                    </div>
                    <form id="form" class="form-horizontal" method="post" action="">
                        <form class="form-horizontal">
                            <div class="box-body">
                                <div class="col-xs-12">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th style="vertical-align : middle;text-align:center;">No</th>
                                                <th style="vertical-align : middle;text-align:center;">Tanggal</th>
                                                <th style="vertical-align : middle;text-align:center;">Klinik</th>
                                                <th style="vertical-align : middle;text-align:center;">Dokter</th>
                                                <th style="vertical-align : middle;text-align:center;">Jenis Penyakit</th>
                                                <th style="vertical-align : middle;text-align: center;">Total Biaya</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if ($data_laporan_biaya_karyawan->num_rows > 0) {
                                                $no = 1;
                                                while ($row = mysqli_fetch_object($data_laporan_biaya_karyawan)) {
                                            ?>
                                                    <tr>
                                                        <td style="text-align: center;"><?php echo $no++ ?></td>
                                                        <td><?php echo $row->tgl ?></td>
                                                        <td><?php echo $row->tempat ?></td>
                                                        <td><?php echo $row->dokter ?></td>
                                                        <td><?php echo $row->jenis ?></td>
                                                        <td style="text-align: center;"><?php echo number_format($row->total_biaya, 0, "", ".") ?></td>
                                                    </tr>
                                            <?php  }
                                            } ?>
                                            <tr>
                                                <th colspan="4" style="text-align: center; "></th>
                                                <th style="text-align: center; ">Total Biaya</th>
                                                <th style="text-align: center; "><?php echo number_format($total_biaya, 0, "", ".") ?></th>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="box-footer">
                                    <a href="laporan_biaya_karyawan" button onclick="window.close()" class="btn btn-primary pull-left">Kembali</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                </div>
            </div>
    </section>
</body>

</html>