<!DOCTYPE html>
<html>
<title>LPS | Seluruh Data Surat Rujukan</title>
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

$data_klinik      = $klinik->tampil_data();
$data_jabatan      = $jabatan->tampil_data();
$data_karyawan      = $karyawan->tampil_data();
$data_surat_rujukan      = $surat_rujukan->tampil_data();

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
            $karyawan = $surat_rujukan->surat($_GET['id_kar']);
            $label_search .= " Nama " . $karyawan; // Tulisan Hasil Dari Pencarian
        }
    }

    if ((!empty($_GET['tgl_1'])) and (!empty($_GET['tgl_2']))) {
        $label_search .= " Antara tanggal " . $config->tanggal_indo($_GET['tgl_1']) . " Hingga " . $config->tanggal_indo($_GET['tgl_2']);
    }

    // tombol searching di klik
    $data_surat_rujukan = $surat_rujukan->tampil_data_search($data);
} else {
    $view = "all";
    $data_surat_rujukan      = $surat_rujukan->tampil_data();
}
/* END SEARCH */

if (isset($_POST['tombol'])) {
    $data = array(

        "id_surat"  => $_POST['id_surat'],
        "nama"  => $_POST['nama'],
        "jabatan" => $_POST['jabatan'],
        "keluhan" => $_POST['keluhan'],
        "tujuan" => $_POST['tujuan'],
        "mengetahui" => $_POST['mengetahui'],
        "pemberi" => $_POST['pemberi']
    );
    if ($surat_rujukan->tambah($data)) {
        header("location:tampil_seluruh_surat_rujukan?pesan=success");
    } else {
        header("location:tampil_seluruh_surat_rujukan?pesan=gagal");
    }
}

if (isset($_POST['biaya_berobat'])) {
    $data = array(
        "id_berobat"        => $_POST['id_berobat'],
        "id_surat_rujukan"  => $_POST['id_surat_rujukan'],
        "tgl"               => $_POST['tgl'],
        "tgl_in"            => $_POST['tgl_in'],
        "jam"               => $_POST['jam'],
        "nama_kar"          => $_POST['nama_kar'],
        "tempat"            => $_POST['tempat'],
        "dokter"            => $_POST['dokter'],
        "jenis"             => $_POST['jenis'],
        "kasbon"            => $_POST['kasbon'],
        "user"              => $_POST['user']
    );
    if ($biaya_berobat->tambah($data)) {
        $surat_rujukan->ubah_status($data);
        header("location:tampil_biaya_berobat?pesan=success");
    } else {
        header("location:tampil_biaya_berobat?pesan=gagal");
    }
}


if (isset($_POST['update'])) {
    $data = array(

        "id_surat"     => $_POST['id_surat'],
        "tgl"          => $_POST['tgl'],
        "tgl_in"       => $_POST['tgl_in'],
        "nama"         => $_POST['nama'],
        "jabatan"      => $_POST['jabatan'],
        "keluhan"      => $_POST['keluhan'],
        "tujuan"       => $_POST['tujuan'],
        "mengetahui"   => $_POST['mengetahui'],
        "pemberi"      => $_POST['pemberi']
    );
    if ($surat_rujukan->edit($data)) {
        header("location:tampil_seluruh_surat_rujukan?pesan=success");
    } else {
        header("location:tampil_seluruh_surat_rujukan?pesan=gagal");
    }
}

if (isset($_GET['hapus_id'])) {
    if ($surat_rujukan->cek_id($_GET['hapus_id'])) {
        if ($surat_rujukan->hapus($_GET['hapus_id'])) {
            header("location:tampil_seluruh_surat_rujukan?pesan=hapus");
        } else {
            header("location:tampil_seluruh_surat_rujukan?pesan=gagal");
        }
    } else {
        header("location:tampil_seluruh_surat_rujukan");
    }
}
?>
<script src="class/validasi_form/surat_rujukan.js" type="text/javascript"></script>
<script src="class/validasi_form/app.js" type="text/javascript"></script>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Seluruh Data Surat Rujukan
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Seluruh Data Surat Rujukan</li>
        </ol>
    </section>
    <p>

        <script>
            window.setTimeout(function() {
                $(".alert").fadeTo(300, 0).slideUp(300, function() {
                    $($this).remove();
                });
            }, 1500)
        </script>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <div class="box-body">
                            <h4>Pencarian Data Surat Rekap</h4>
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
                                <a href="tampil_seluruh_surat_rujukan"><button class="btn btn-info"><span class="glyphicon glyphicon-list-alt"> Tampil Semua</span></button></a>
                                <hr />
                                <div class="alert alert-success" role="alert"><?php echo $label_search; ?></div>
                            <?php } ?>
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
                            <div class="table-responsive no-padding">
                                <table class="table table-hover table-bordered table-striped" id="example1" style="height: auto; ">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">No Surat</th>
                                            <th class="text-center">Tanggal</th>
                                            <th class="text-center">Nama</th>
                                            <th class="text-center">Jabatan</th>
                                            <th class="text-center">Keluhan</th>
                                            <th class="text-center">Klinik / R.S</th>
                                            <th class="text-center">No Kasbon</th>
                                            <th class="text-center">No Bukti Kas</th>
                                            <?php if ($_SESSION['print'] == "1") { ?>
                                                <th class="text-center">Print</th>
                                                <th class="text-center">PDF</th>
                                            <?php } ?>
                                            <?php if ($_SESSION['tambah'] == "1") { ?>
                                                <th class="text-center">Biaya Berobat</th>
                                            <?php } ?>
                                            <?php if ($_SESSION['edit'] == "1") { ?>
                                                <th class="text-center">Edit</th>
                                            <?php } ?>
                                            <?php if ($_SESSION['hapus'] == "1") { ?>
                                                <th class="text-center">Hapus</th>
                                            <?php } ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($data_surat_rujukan->num_rows > 0) {
                                            $no = 1;
                                            while ($row = mysqli_fetch_array($data_surat_rujukan)) { ?>
                                                <?php $id = $row['id_surat'] ?>
                                                <?php $hasil_bulan  = $surat_rujukan->bln($id) ?>
                                                <?php $bulan = $config->bln2($hasil_bulan) ?>
                                                <tr>
                                                    <td style="vertical-align : middle;text-align:center;"><b><?php echo $no++ ?></b></td>
                                                    <td style="vertical-align : middle;">
                                                        <b><?php echo $row['id_surat'] ?>/SR/<?php echo $bulan ?>/<?= $row['tahun'] ?></b>
                                                    </td>
                                                    <td style="vertical-align : middle;text-align:center;"><b><?php echo $row['tanggal'] ?></b></td>
                                                    <td style="vertical-align : middle;text-align:center;"><b><?php echo $row['nama_kar'] ?></b></td>
                                                    <td style="vertical-align : middle;text-align:center;"><b><?php echo $row['jabatan'] ?></b></td>
                                                    <td style="vertical-align : middle;text-align:center;"><b><?php echo $row['keluhan'] ?></b></td>
                                                    <td style="vertical-align : middle;text-align:center;"><b><?php echo $row['tujuan'] ?></b></td>
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
                                                        <td style="vertical-align : middle;text-align:center;">
                                                            <?php if ($row['acc'] == '0') { ?>
                                                                <!-- SHARE -->
                                                                <?php if (($_SESSION['tipe'] == 'staff') or ($_SESSION['tipe'] == 'admin')) { ?>
                                                                <?php } ?>
                                                                <?php if (($_SESSION['nama'] == $row['pemberi'])) { ?>
                                                                <?php } ?>
                                                            <?php } else { ?>
                                                                <a title="Cetak Surat Rujukan" href="cetak_sr?id=<?php echo $row['id_surat']; ?>" target="_blank">
                                                                    <button class="btn btn-warning btn-sm margin"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></button>
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
                                                            <!-- EDIT -->
                                                            <form id="form1" method="post" action="" enctype="multipart/form-data">
                                                                <a href="edit_seluruh_surat_rujukan?id=<?php echo $row['id_surat']; ?>" class="btn btn-warning btn-sm text-black margin" data-toggle="modal" data-target="#edit<?php echo $row['id_surat']; ?>"><i class="fa fa-edit"></i></a>
                                                                <div class="modal fade" id="edit<?php echo $row['id_surat']; ?>">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                            <!-- END EDIT -->
                                                        </td>
                                                    <?php } ?>
                                                    <?php if ($_SESSION['hapus'] == "1") { ?>
                                                        <td style="vertical-align : middle;text-align:center;">
                                                            <!-- HAPUS -->
                                                            <a title="Hapus" title="Hapus Data" href="tampil_seluruh_surat_rujukan?hapus_id=<?php echo $row['id_surat']; ?>">
                                                                <button class="btn btn-danger btn-sm text-black"><i class="fa fa-trash"> </i></button>
                                                            </a>
                                                            <!-- END HAPUS -->
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
    </section>
</div>

<?php
include_once('template/footer.php');
?>