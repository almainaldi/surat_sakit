<!DOCTYPE html>
<html>
<?php
include_once('template/header.php');
include_once('class/jenis_layanan.php');
include_once('class/biaya_berobat.php');
include_once('class/detail_data_berobat.php');

$jenis_layanan = new jenis_layanan();
$biaya_berobat = new biaya_berobat();
$detail_data_berobat = new detail_data_berobat();


if (!empty($_GET['id'])) // Ngecek ID apakah sesuai dan ada di database
{
    $id = $_GET['id'];
    if ($detail_data_berobat->cek_id($id)) {
        $data = $detail_data_berobat->get_by_id($id);
        $id_berobat = $detail_data_berobat->id_berobat($id); //11
    } else {
        header("location:tampil_biaya_berobat?pesan=gagal");
    }
} else {
    header("location:tampil_biaya_berobat?pesan=gagal");
}


// $data_detail_data_berobat      = $detail_data_berobat->tampil_data($id_berobat);

if (isset($_POST['tombol'])) {
    $data = array(
        "id_detail_berobat" => $_POST['id_detail_berobat']
    );
    if ($detail_data_berobat->hapus($data)) {
        header("location:detail_data_berobat?id=$id_berobat");
    } else {
        header("location:tampil_biaya_berobat?pesan=gagal");
    }
}
?>
<script src="class/validasi_form/request_kendaraan.js" type="text/javascript"></script>
<!--<script src="class/validasi_form/request_kendaraan_form.js" type="text/javascript"></script>-->
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Hapus Jenis Layanan
        </h1>
        <ol class="breadcrumb">
            <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Hapus Jenis Layanan</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-3"></div>
            <div class="col-xs-6">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <?php
                        if (isset($_GET['pesan'])) {
                            if ($_GET['pesan'] == "gagal") {
                                echo "<div class='alert alert-danger'>Data Gagal Dihilangkan</div>";
                            }
                        }
                        ?>
                    </div>
                    <form id="form" class="form-horizontal" method="post" action="">
                        <form class="form-horizontal">
                            <div class="box-body">
                                <?php //if ($_SESSION['tipe'] == "admin") { ?>
                                    <div class="form-group">
                                        <label for="tujuan" class="col-sm-2 control-label">Jenis Layanan</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" value="<?php echo $data['jenis_layanan']; ?>" readonly>
                                            <input type="hidden" class="form-control" name="id_detail_berobat" value="<?php echo $data['id_detail_berobat']; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="tujuan" class="col-sm-2 control-label">Biaya</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" value="<?php echo $data['biaya']; ?>" readonly>
                                        </div>
                                    </div>

                                <?php //} ?>
                            </div>
                            <div class="box-footer">
                                <button type="submit" name="tombol" class="btn btn-danger delete pull-left">Hapus Data</button>
                            </div>
                        </form>
                </div>
            </div>
            <div class="col-xs-3"></div>
    </section>
</div>
<?php
include_once('template/footer.php');
?>
</body>

</html>