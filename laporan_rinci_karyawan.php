<!DOCTYPE html>
<title>LPS | Seluruh Data Biaya Berobat</title>
<html>
<?php
include_once('template/header.php');
include_once('class/biaya_berobat.php');
include_once('class/karyawan.php');
include_once('class/klinik.php');
include_once('class/rekap_berobat.php');

$biaya_berobat = new biaya_berobat();
$karyawan = new karyawan();
$klinik = new klinik();
$rekap_berobat   = new rekap_berobat();

$data_karyawan      = $karyawan->tampil_data();
$data_klinik      = $klinik->tampil_data();

/* SEARCH */
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
            $karyawan = $biaya_berobat->karyawan($_GET['id_kar']);
            $label_search .= " Nama " . $karyawan; // Tulisan Hasil Dari Pencarian
        }
    }

    if ((!empty($_GET['tgl_1'])) and (!empty($_GET['tgl_2']))) {
        $label_search .= " Antara tanggal " . $config->tanggal_indo($_GET['tgl_1']) . " Hingga " . $config->tanggal_indo($_GET['tgl_2']);
    }

    // tombol searching di klik
    $data_biaya_berobat = $biaya_berobat->tampil_data_search($data);
} else {
    $view = "all";
    $data_biaya_berobat = $biaya_berobat->tampil_data();
}
/* END SEARCH */

if (isset($_POST['rekap'])) {
    $data = array(
        "id_kar" => $_POST['id_kar'],
        "id_biaya_berobat" => $_POST['id_biaya_berobat'],
        "jam" => $_POST['jam'],
        "tgl" => $_POST['tgl'],
        "user" => $_POST['user'],
        "keluhan" => $_POST['keluhan'],
        "diagnosis" => $_POST['diagnosis']
    );
    if ($rekap_berobat->tambah($data)) {
        $biaya_berobat->selesai_rekap($data);
        header("location:tampil_seluruh_rekap_berobat?pesan=success");
    } else {
        header("location:tampil_seluruh_biaya_berobat?pesan=gagal");
    }
}

if (isset($_POST['update'])) {
    $data = array(
        "id_berobat"  => $_POST['id_berobat'],
        "tgl" => $_POST['tgl'],
        "nama_kar" => $_POST['nama_kar'],
        "tempat"  => $_POST['tempat'],
        "dokter"  => $_POST['dokter'],
        "jenis"  => $_POST['jenis'],
        "kasbon"  => $_POST['kasbon']
    );
    if ($biaya_berobat->edit($data)) {
        header("location:tampil_seluruh_biaya_berobat?pesan=update");
    } else {
        header("location:tampil_seluruh_biaya_berobat?pesan=gagal");
    }
}

/* HAPUS */
if (isset($_GET['hapus_id'])) {
    if ($biaya_berobat->cek_id($_GET['hapus_id'])) {
        if ($biaya_berobat->hapus($_GET['hapus_id'])) {
            header("location:tampil_seluruh_biaya_berobat?pesan=hapus");
        } else {
            header("location:tampil_seluruh_biaya_berobat?pesan=gagal");
        }
    } else {
        header("location:tampil_seluruh_biaya_berobat");
    }
}
/* END HAPUS */
?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Seluruh Data Biaya Berobat
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Seluruh Data Biaya Berobat</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                    </div>
                    <div class="box-body">
                        <!-- Search -->
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
                            <a href="tampil_seluruh_biaya_berobat"><button class="btn btn-info"><span class="glyphicon glyphicon-list-alt"> Tampil Semua</span></button></a>
                            <hr />
                            <div class="alert alert-success" role="alert"><?php echo $label_search; ?></div>
                        <?php } ?>
                        <?php if (isset($_GET['pesan'])) {
                            if ($_GET['pesan'] == "success") {
                                echo "<div class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;
                                                            </button><h4> Data Berhasil Ditambahkan</h4> </div>";
                            } else if ($_GET['pesan'] == "gagal") {
                                echo "<div class='alert alert-warning alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;
                                                            </button><h4> Data Gagal Ditambahkan</h4> </div>";
                            } else if ($_GET['pesan'] == "update") {
                                echo "<div class='alert alert-info alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;
                                                            </button><h4> Data Berhasil Di Update</h4> </div>";
                            } else if ($_GET['pesan'] == "hapus") {
                                echo "<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;
                                                            </button><h4> Data Berhasil Di Hapus</h4> </div>";
                            }
                        } ?>
                        <!-- End Search-->
                        <div class="panel-body table-responsive no-padding">
                            <table id="example1" class="table table-bordered table-striped" border="1">
                                <thead>
                                    <tr>
                                        <th style="vertical-align : middle;text-align:center;">No</th>
                                        <th style="vertical-align : middle;text-align:center;">Nama Karyawan</th>
                                        <th style="vertical-align : middle;text-align:center;">Klinik</th>
                                        <th style="vertical-align : middle;text-align:center;">Jenis Penyakit</th>
                                        <th style="vertical-align : middle;text-align:center;">Tanggal</th>
                                        <th style="vertical-align : middle;text-align:center;">Total Biaya</th>
                                        <th style="vertical-align : middle;text-align:center;">No Kasbon</th>
                                        <th style="vertical-align : middle;text-align:center;">No Bukti Kas</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($data_biaya_berobat->num_rows > 0) {
                                        $no = 1;
                                        while ($row = mysqli_fetch_array($data_biaya_berobat)) { ?>
                                            <tr>
                                                <td style="vertical-align : middle;text-align:center;"><b><?php echo $no++ ?></b></td>
                                                <td style="vertical-align : middle;text-align:center;"><b><?php echo $row['nama_karyawan'] ?></b></td>
                                                <td style="vertical-align : middle;text-align:center;"><b><?php echo $row['tempat'] ?></b></td>
                                                <td style="vertical-align : middle;text-align:center;"><b><?php echo $row['jenis'] ?></b></td>
                                                <td style="vertical-align : middle;text-align:center;"><b><?php echo $row['tanggal'] ?></b></td>
                                                <td style="vertical-align : middle;text-align:center;"><b><?php echo $row['total_biaya'] ?></b></td>
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
                                            </tr>
                                    <?php }} ?>
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