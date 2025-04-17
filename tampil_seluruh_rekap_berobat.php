<!DOCTYPE html>
<title>LPS | Seluruh Data Rekap Medis</title>
<html>
<?php
include_once('template/header.php');
include_once('class/rekap_berobat.php');
include_once('class/karyawan.php');
include_once('class/biaya_berobat.php');

$rekap_berobat   = new rekap_berobat();
$karyawan   = new karyawan();
$biaya_berobat = new biaya_berobat();

$data_karyawan      = $karyawan->tampil_data();

if (isset($_GET['tombol_search'])) {
    //jika tombol search di klik
    $view = "search";
    $data['id_kar'] = $_GET['id_kar'];
    $data['tgl_1'] = $_GET['tgl_1'];
    $data['tgl_2'] = $_GET['tgl_2'];

    $label_search = "Hasil Pencarian ";

    if (isset($_GET['id_kar'])) {
        if ($_GET['id_kar'] == "all") {
            $label_search .= " Seluruh Karyawan "; // Tulisan Hasil Dari Pencarian
        } else {
            $karyawan = $rekap_berobat->rekap($_GET['id_kar']);
            $label_search .= " Nama " . $karyawan; // Tulisan Hasil Dari Pencarian
        }
    }

    if ((!empty($_GET['tgl_1'])) and (!empty($_GET['tgl_2']))) {
        $label_search .= " Antara tanggal " . $config->tanggal_indo($_GET['tgl_1']) . " Hingga " . $config->tanggal_indo($_GET['tgl_2']);
    }

    // tombol searching di klik
    $data_rekap_berobat = $rekap_berobat->tampil_data_search($data);
} else {
    $view = "all";
    $data_rekap_berobat      = $rekap_berobat->tampil_data();
}
/* END SEARCH */

if (isset($_POST['update'])) {
    $data = array(
        "id_rekap"  => $_POST['id_rekap'],
        "id_biaya_berobat" => $_POST['id_biaya_berobat'],
        "id_kar" => $_POST['id_kar'],
        "jam"  => $_POST['jam'],
        "tgl" => $_POST['tgl'],
        "user"  => $_POST['user'],
        "keluhan"  => $_POST['keluhan'],
        "diagnosis"  => $_POST['diagnosis'],
        "solusi"  => $_POST['solusi']
    );
    if ($rekap_berobat->edit($data)) {
        header("location:tampil_seluruh_rekap_berobat?pesan=update");
    } else {
        header("location:tampil_seluruh_rekap_berobat?pesan=gagal");
    }
}

if (isset($_POST['selesai'])) {
    $data = array(
        "id_rekap" => $_POST['id_rekap'],
        "id_berobat" => $_POST['id_berobat']
    );
    if ($rekap_berobat->hapus1($data)) {
        $biaya_berobat->edit_admin1($data);
        header("location:tampil_seluruh_biaya_berobat?pesan=update");
    } else {
        header("location:tampil_seluruh_biaya_berobat?pesan=gagal");
    }
}

/* HAPUS */
if (isset($_GET['hapus_id'])) {
    if ($rekap_berobat->cek_id($_GET['hapus_id'])) {
        if ($rekap_berobat->hapus($_GET['hapus_id'])) {
            header("location:tampil_seluruh_rekap_berobat?pesan=hapus");
        } else {
            header("location:tampil_seluruh_rekap_berobat?pesan=gagal");
        }
    } else {
        header("location:tampil_seluruh_rekap_berobat");
    }
}
/* END HAPUS */
?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Seluruh Data Rekap Medis
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Seluruh Data Rekap Medis</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <h4>Pencarian Data Rekap Medis</h4>
                        <form class="form-horizontal" method="get" action="">
                            <div class="form-group">
                                <div class="col-sm-2">
                                    <select name="id_kar" id="id_kar" class="form-control select2" style="width: 100%;">
                                        <option value="all">Seluruh Karyawan</option>
                                        <?php
                                        if ($data_karyawan->num_rows > 0) {
                                            while ($row = mysqli_fetch_object($data_karyawan)) {
                                        ?>
                                                <option value="<?php echo $row->id_kar; ?>">
                                                    <?php echo $row->nama_kar; ?>
                                                </option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" autocomplete="off" name="tgl_1" class="form-control tanggal" placeholder="Dari Tanggal">
                                </div>

                                <div class="col-sm-2">
                                    <input type="text" autocomplete="off" name="tgl_2" class="form-control tanggal" placeholder="Sampai Tanggal">
                                </div>

                                <div class="col-sm-2">
                                    <button type="submit" name="tombol_search" value="search" class="btn btn-warning">
                                        <span class="glyphicon glyphicon-search"></span> Search
                                    </button>
                                </div>
                            </div>
                        </form>
                        <?php
                        if ($view == "all") {
                        ?>
                        <?php
                        } else {
                        ?>
                            <a href="tampil_seluruh_rekap_berobat"><button class="btn btn-info"><span class="glyphicon glyphicon-list-alt"> Tampil Semua</span></button></a>
                            <hr />
                            <div class="alert alert-success" role="alert"><?php echo $label_search; ?></div>
                        <?php } ?>
                        <hr />
                        <?php
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
                        ?>

                        <div class="panel-body table-responsive no-padding">
                            <table id="example1" class="table table-bordered table-striped" border="1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Nama Karyawan</th>
                                        <th>Jabatan</th>
                                        <th>Keluhan</th>
                                        <th>Diagnosis</th>
                                        <th>Solusi</th>
                                        <th style="width: 3%;">No Surat</th>
                                        <th>No Kasbon</th>
                                        <th>No Bukti Kas</th>
                                        <th style="text-align: center;">PDF</th>
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
                                    if ($data_rekap_berobat->num_rows > 0) {
                                        $no = 1;
                                        while ($row = mysqli_fetch_array($data_rekap_berobat)) { ?>
                                            <?php $id = $row['id_surat_rujukan'] ?>
                                            <?php $hasil_bulan  = $biaya_berobat->bln($id) ?>
                                            <?php $bulan = $config->bln2($hasil_bulan) ?>
                                            <tr>
                                                <td style="vertical-align : middle;text-align:center;"><b><?php echo $no++ ?></b></td>
                                                <td style="vertical-align : middle;"><b><?php echo $row['tanggal'] ?></b></td>
                                                <td style="vertical-align : middle;"><b><?php echo $row['nama_kar'] ?></b></td>
                                                <td style="vertical-align : middle;"><b><?php echo $row['jabatan'] ?></b></td>
                                                <td style="vertical-align : middle;"><b><?php echo $row['keluhan'] ?></b></td>
                                                <td style="vertical-align : middle;"><b><?php echo $row['diagnosis'] ?></b></td>
                                                <td style="vertical-align : middle;"><b><?php echo $row['solusi'] ?></b></td>
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
                                                <td style="vertical-align : middle;text-align:center;">
                                                    <a title="Cetak Rincian Biaya Berobat" href="cetak_rm?id=<?php echo $row['id_rekap']; ?>" target="_blank">
                                                        <button class="btn btn-warning btn-sm margin"><i class="fa fa-file-pdf-o" aria-hidden="true"> PDF</i></button>
                                                    </a>
                                                </td>
                                                <?php if ($_SESSION['edit'] == "1") { ?>
                                                    <td style="vertical-align : middle;text-align:center;">
                                                        <form id="form1" method="post" action="" enctype="multipart/form-data">
                                                            <a href="edit_seluruh_rekap_berobat?id=<?php echo $row['id_rekap']; ?>" class="btn btn-warning btn-sm margin" data-toggle="modal" data-target="#edit<?php echo $row['id_rekap']; ?>">Edit</a>
                                                            <div class="modal fade" id="edit<?php echo $row['id_rekap']; ?>">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </td>
                                                <?php } ?>
                                                <?php if ($_SESSION['tipe'] == "admin") { ?>
                                                    <td style="vertical-align : middle;text-align:center;">
                                                        <form id="form1" method="post" action="" enctype="multipart/form-data">
                                                            <a href="admin_edit_rek_s_ber?id=<?php echo $row['id_rekap']; ?>" class="bg bg-purple-gradient btn-sm margin" data-toggle="modal" data-target="#edit1<?php echo $row['id_rekap']; ?>"><i class="glyphicon glyphicon-edit"></i></a>
                                                            <div class="modal fade" id="edit1<?php echo $row['id_rekap']; ?>">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </td>
                                                <?php } ?>
                                                <?php if ($_SESSION['hapus'] == "1") { ?>
                                                    <td style="vertical-align : middle;text-align:center;">
                                                        <a title="Hapus Data" href="tampil_seluruh_rekap_berobat?hapus_id=<?php echo $row['id_rekap']; ?>"><button class="btn btn-danger btn-sm margin delete">Hapus</button></a>
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