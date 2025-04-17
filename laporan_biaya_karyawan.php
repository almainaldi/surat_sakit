<!DOCTYPE html>
<html>
<title>LPS | Laporan Data Biaya Karyawan</title>
<?php
include_once('template/header.php');
include_once('class/laporan_biaya_karyawan.php');

$laporan_biaya_karyawan   = new laporan_biaya_karyawan();

if (isset($_GET['tombol_search'])) {
    //jika tombol search di klik
    $view = "search";
    $data['bulan'] = date($_GET['bulan']);
    $data['tahun'] = date($_GET['tahun']);

    $label_search = "";

    if ((!empty($_GET['bulan'])) and (!empty($_GET['tahun']))) {
        $label_search .= "" . $_GET['bulan'] . "-" . $_GET['tahun'];
    }

    if ((!empty($_GET['bulan'])) and (empty($_GET['tahun']))) {
        $label_search .= "" . $_GET['bulan'] . " ";
    }

    if ((empty($_GET['bulan'])) and (!empty($_GET['tahun']))) {
        $label_search .= "" . $_GET['tahun'];
    }
    $data_laporan_biaya_karyawan = $laporan_biaya_karyawan->tampil_data_search($data);
} else {
    $view = "all";
    $data_laporan_biaya_karyawan      = $laporan_biaya_karyawan->tampil_data();
}

?>
<script src="class/validasi_form/surat_rujukan.js" type="text/javascript"></script>
<script src="class/validasi_form/app.js" type="text/javascript"></script>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Laporan Data Biaya Karyawan
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Seluruh Laporan Data Biaya Karyawan</li>
        </ol>
    </section>
    <p>
        <!-- tabel -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                    </div>
                    <div class="box-body">
                        <?php if (isset($_GET['pesan'])) {
                            if ($_GET['pesan'] == "update") {
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
                        <div class="row">
                            <div class="col-md-8">
                                <form class="form-inline" method="get" action="">
                                    <div class="col-sm-2">
                                        <select class="form-control mr-2" name="bulan" required="">
                                            <option value="">Pilih Bulan</option>
                                            <option value="01">Januari</option>
                                            <option value="02">Februari</option>
                                            <option value="03">Maret</option>
                                            <option value="04">April</option>
                                            <option value="05">Mei</option>
                                            <option value="06">Juni</option>
                                            <option value="07">Juli</option>
                                            <option value="08">Agustus</option>
                                            <option value="09">September</option>
                                            <option value="10">Oktober</option>
                                            <option value="11">November</option>
                                            <option value="12">Desember</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-2">
                                        <select class="form-control mr-2" name="tahun" required="">
                                            <option value="">Pilih Tahun</option>
                                            <option value="2021">2021</option>
                                            <option value="2022">2022</option>
                                            <option value="2023">2023</option>
                                            <option value="2024">2024</option>
                                            <option value="2025">2025</option>
                                        </select>
                                    </div>
                                    <button type="submit" name="tombol_search" value="search" class="btn btn-warning">
                                        <span class="glyphicon glyphicon-search"></span> Search
                                    </button>
                                    <?php if (isset($_GET['tombol_search'])) { ?>
                                        <a href="laporan_biaya_karyawan" class="btn btn-info">Tampil Bulan Ini</a>
                                    <?php } ?>
                                </form>
                            </div>
                        </div><br>
                        <div>
                            <?php if (!isset($_GET['tombol_search'])) { ?>
                                <h3 style="font-style: italic; font-weight: bold; color: red;"> Laporan Data : <?php echo date('M-Y'); ?></h3>
                            <?php } else { ?>
                                <h3 style="font-style: italic; font-weight: bold; color: red;"> Laporan Data : <?php echo $label_search; ?></h3>
                            <?php } ?>
                        </div><br>
                        <!-- ############# END SEARCH ############# -->
                        <div class="table-responsive no-padding">
                            <table class="table table-hover table-bordered table-striped" id="example1" style="height: auto; ">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Nama Karyawan</th>
                                        <th class="text-center">Total Biaya</th>
                                        <!-- <th class="text-center">Total Biaya</th> -->
                                        <?php if ($_SESSION['lihat'] == "1") { ?>
                                            <th class="text-center">Action</th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($data_laporan_biaya_karyawan->num_rows > 0) {
                                        $no = 1;
                                        while ($row = mysqli_fetch_array($data_laporan_biaya_karyawan)) { ?>
                                            <tr>
                                                <td style="vertical-align : middle;text-align:center;"><b><?php echo $no++ ?></b></td>
                                                <td style="vertical-align : middle;text-align:center;"><b><?php echo $row['nama_kar'] ?></b></td>
                                                <td style="vertical-align : middle;text-align:center;"><b><?php echo number_format($row['total_biaya'], 0, "", ".") ?></b></td>
                                                <!-- <td style="vertical-align : middle;text-align:center;"><b><?php echo $row['total_biaya'] ?></b></td> -->
                                                <td style="vertical-align : middle;text-align:center;">
                                                    <!-- EDIT -->
                                                    <?php if ($_SESSION['lihat'] == "1") { ?>
                                                        <form id="form1" method="post" action="" enctype="multipart/form-data">
                                                            <a href="lihat_laporan_data_karyawan?id=<?php echo $row['id_kar']; ?>" class="btn btn-info btn-sm margin" data-toggle="modal" data-target="#edit<?php echo $row['id_kar']; ?>">Lihat</a>
                                                            <div class="modal fade" id="edit<?php echo $row['id_kar']; ?>">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    <?php } ?>
                                                </td>
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