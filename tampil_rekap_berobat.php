<!DOCTYPE html>
<title>LPS | Rekap Medis</title>
<html>
<?php
include_once('template/header.php');
include_once('class/rekap_berobat.php');
include_once('class/biaya_berobat.php');

$rekap_berobat   = new rekap_berobat();
$biaya_berobat = new biaya_berobat();

$data_rekap_berobat = $rekap_berobat->tampil_data();


if (isset($_POST['update'])) {
    $data = array(
        "id_rekap"  => $_POST['id_rekap'],
        "id_biaya_berobat" => $_POST['id_biaya_berobat'],
        "id_kar" => $_POST['id_kar'],
        "jam"  => $_POST['jam'],
        "tgl" => $_POST['tgl'],
        "tgl_in" => $_POST['tgl_in'],
        "user"  => $_POST['user'],
        "keluhan"  => $_POST['keluhan'],
        "diagnosis"  => $_POST['diagnosis'],
        "solusi"  => $_POST['solusi']
    );
    if ($rekap_berobat->edit($data)) {
        header("location:tampil_rekap_berobat?pesan=update");
    } else {
        header("location:tampil_rekap_berobat?pesan=gagal");
    }
}

if (isset($_POST['updatein'])) {
    $data = array(
        "id_rekap"  => $_POST['id_rekap'],
        "id_biaya_berobat" => $_POST['id_biaya_berobat'],
        "id_kar" => $_POST['id_kar'],
        "jam"  => $_POST['jam'],
        "tgl" => $_POST['tgl'],
        "tgl_in" => $_POST['tgl_in'],
        "user"  => $_POST['user'],
        "memo"  => $_POST['memo']
    );
    if ($rekap_berobat->edit_memo($data)) {
        header("location:tampil_rekap_berobat?pesan=update");
    } else {
        header("location:tampil_rekap_berobat?pesan=gagal");
    }
}

if (isset($_POST['selesai'])) {
    $data = array(
        "id_rekap" => $_POST['id_rekap'],
        "id_berobat" => $_POST['id_berobat']
    );
    if ($rekap_berobat->hapus1($data)) {
        $biaya_berobat->edit_admin1($data);
        header("location:tampil_biaya_berobat?pesan=update");
    } else {
        header("location:tampil_biaya_berobat?pesan=gagal");
    }
}

/* HAPUS */
if (isset($_GET['hapus_id'])) {
    if ($rekap_berobat->cek_id($_GET['hapus_id'])) {
        if ($rekap_berobat->hapus($_GET['hapus_id'])) {
            header("location:tampil_rekap_berobat?pesan=hapus");
        } else {
            header("location:tampil_rekap_berobat?pesan=gagal");
        }
    } else {
        header("location:tampil_rekap_berobat");
    }
}
/* END HAPUS */
?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Rekap Medis
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Data Rekap Medis</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                    </div>
                    <div class="box-body">
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
                                        <th style="width: 3%;">No</th>
                                        <th style="width: 3%;">Tanggal</th>
                                        <th>Nama Karyawan</th>
                                        <th>Jabatan</th>
                                        <th>Keluhan</th>
                                        <th>Diagnosis</th>
                                        <th>Solusi</th>
                                        <th style="width: 3%;">No Surat</th>
                                        <th style="width: 3%;">No Kasbon</th>
                                        <th style="width: 3%;">No Bukti Kas</th>
                                        <?php if ($_SESSION['lihat'] == "1") { ?>
                                            <th style="text-align: center;width: 3%;">Print</th>
                                            <th style="text-align: center;width: 3%;">PDF</th>
                                        <?php } ?>
                                        <?php if ($_SESSION['edit'] == "1") { ?>
                                            <th style="text-align: center;width: 3%;">Edit</th>
                                        <?php } ?>
                                        <?php if ($_SESSION['tipe'] == "admin") { ?>
                                            <th style="text-align: center;width: 3%;">Edit Status</th>
                                        <?php } ?>
                                        <?php if ($_SESSION['edit'] == "1") { ?>
                                            <th style="text-align: center;width: 3%;">Memo</th>
                                        <?php } ?>
                                        <?php if ($_SESSION['hapus'] == "1") { ?>
                                            <th style="text-align: center;width: 3%;">Hapus</th>
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
                                                <td style="vertical-align : middle;text-align: justify;"><b><?php echo $row['solusi'] ?></b></td>
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
                                                <?php if (($_SESSION['lihat'] == "1")) { ?>
                                                    <td style="vertical-align : middle;text-align:center;">
                                                        <a title="" href="lihat_rekam_medis?id=<?php echo $row['id_rekap']; ?>">
                                                            <button class="btn btn-info btn-sm margin"><i class="fa fa-print" aria-hidden="true"> Print</i></button>
                                                        </a>
                                                    </td>
                                                    <td style="vertical-align : middle;text-align:center;">
                                                        <a title="Cetak Rincian Biaya Berobat" href="cetak_rm?id=<?php echo $row['id_rekap']; ?>" target="_blank">
                                                            <button class="btn btn-warning btn-sm margin"><i class="fa fa-file-pdf-o" aria-hidden="true"> PDF</i></button>
                                                        </a>
                                                    </td>
                                                <?php } ?>
                                                <?php if ($_SESSION['edit'] == "1") { ?>
                                                    <td style="vertical-align : middle;text-align:center;">
                                                        <form id="form1" method="post" action="" enctype="multipart/form-data">
                                                            <a href="edit_rekap_berobat?id=<?php echo $row['id_rekap']; ?>" class="btn btn-warning btn-sm margin" data-toggle="modal" data-target="#edit<?php echo $row['id_rekap']; ?>">Edit</a>
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
                                                            <a href="admin_edit_rek_ber?id=<?php echo $row['id_rekap']; ?>" class="bg bg-purple-gradient btn-sm margin" data-toggle="modal" data-target="#edit1<?php echo $row['id_rekap']; ?>"><i class="glyphicon glyphicon-edit"></i></a>
                                                            <div class="modal fade" id="edit1<?php echo $row['id_rekap']; ?>">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </td>
                                                <?php } ?>
                                                <?php if ($_SESSION['edit'] == "1") { ?>
                                                    <td style="vertical-align : middle;text-align:center;">
                                                        <form id="form1" method="post" action="" enctype="multipart/form-data">
                                                            <a href="tambah_memo_rekap_berobat?id=<?php echo $row['id_rekap']; ?>" class="btn btn-primary btn-sm margin" data-toggle="modal" data-target="#edit<?php echo $row['id_rekap']; ?>"><i class="fa fa-book" aria-hidden="true"></i> Memo</a>
                                                            <div class="modal fade" id="edit<?php echo $row['id_rekap']; ?>">
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
                                                        <a title="Hapus Data" href="tampil_rekap_berobat?hapus_id=<?php echo $row['id_rekap']; ?>"><button class="btn btn-danger btn-sm margin delete">Hapus</button></a>
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