<!DOCTYPE html>
<html>
<?php
ob_start();
session_start();
include_once('class/surat_rujukan.php');
include_once('class/karyawan.php');
include_once('class/jabatan.php');
include_once('class/klinik.php');
include_once('class/biaya_berobat.php');

$surat_rujukan   = new surat_rujukan();
$biaya_berobat = new biaya_berobat();
$karyawan   = new karyawan();
$jabatan   = new jabatan();
$klinik   = new klinik();

$data_karyawan      = $karyawan->tampil_data();
$data_jabatan      = $jabatan->tampil_data();
$data_klinik      = $klinik->tampil_data();


if (!empty($_GET['id'])) // Ngecek ID apakah sesuai dan ada di database
{
    $id = $_GET['id'];
    if ($surat_rujukan->cek_id($id)) {
        $data_surat = $surat_rujukan->get_by_id($id); // hasil dari DB
    } else {
        header("location:tampil_surat_rujukan?pesan=gagal");
    }
} else {
    header("location:tampil_surat_rujukan?pesan=gagal");
}

if (isset($_POST['biaya_berobat'])) {
    $data = array(
        "id_berobat" => $_POST['id_berobat'],
        "id_surat_rujukan" => $_POST['id_surat_rujukan'],
        "tgl" => $_POST['tgl'],
        "jam" => $_POST['jam'],
        "nama_kar" => $_POST['nama_kar'],
        "tempat" => $_POST['tempat'],
        "dokter" => $_POST['dokter'],
        "jenis" => $_POST['jenis'],
        "kasbon" => $_POST['kasbon'],
        "user" => $_POST['user']
    );
    if ($biaya_berobat->tambah($data)) {
        header("location:tampil_seluruh_biaya_berobat?pesan=success");
    } else {
        header("location:tampil_seluruh_biaya_berobat?pesan=gagal");
    }
}

?>
<script src="class/validasi_form/tambah_biaya_berobat.js" type="text/javascript"></script>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 style="text-align: center;">Tambah Biaya Berobat</h3>
                </div>
                <form id="form" class="form-horizontal" method="post" action="">
                    <form class="form-horizontal">
                        <div class="box-body">
                            <table>
                                <tbody>
                                    <tr>
                                        <th style="width: 30%">Tanggal</th>
                                        <th style="width: 15%">:</th>
                                        <th style="width: 60%">
                                            <input type="text" name="tgl" class="form-control tanggal" value="<?php echo $data_surat['tgl']; ?>" readonly>
                                        </th>
                                    </tr>
                                    <!-- ENTER -->
                                    <tr>
                                        <th>
                                            <div><br></div>
                                        </th>
                                    </tr><!-- END ENTER -->
                                    <tr>
                                        <th style="width: 30%">Nama</th>
                                        <th style="width: 10%">:</th>
                                        <th style="width: 60%">
                                            <input type="hidden" name="nama_kar" class="form-control" value="<?php echo $data_surat['nama']; ?>" readonly>
                                            <input type="text" name="" class="form-control" value="<?php echo $data_surat['nama_kar']; ?>" readonly>
                                        </th>
                                    </tr>
                                    <!-- ENTER -->
                                    <tr>
                                        <th>
                                            <div><br></div>
                                        </th>
                                    </tr><!-- END ENTER -->
                                    <tr>
                                        <th style="width: 30%">Klinik</th>
                                        <th style="width: 10%">:</th>
                                        <th style="width: 60%">
                                            <input type="text" name="tempat" class="form-control tanggal" value="<?php echo $data_surat['tujuan']; ?>" readonly>
                                        </th>
                                    </tr>
                                    <!-- ENTER -->
                                    <tr>
                                        <th>
                                            <div><br></div>
                                        </th>
                                    </tr><!-- END ENTER -->
                                    <tr>
                                        <th style="width: 30%">Dokter</th>
                                        <th style="width: 10%">:</th>
                                        <th style="width: 60%">
                                            <input type="text" name="dokter" id="dokter" class="form-control" onkeyup="this.value = this.value.toUpperCase()" autocomplete="off" placeholder="Input Dokter" autofocus required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')" oninput="setCustomValidity('')">
                                        </th>
                                    </tr>
                                    <!-- ENTER -->
                                    <tr>
                                        <th>
                                            <div><br></div>
                                        </th>
                                    </tr><!-- END ENTER -->
                                    <tr>
                                        <th style="width: 30%">Jenis Penyakit</th>
                                        <th style="width: 10%">:</th>
                                        <th style="width: 60%">
                                            <input type="text" name="jenis" id="jenis" class="form-control" onkeyup="this.value = this.value.toUpperCase()" autocomplete="off" placeholder="Input Jenis Penyakit" autofocus required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')" oninput="setCustomValidity('')">
                                        </th>
                                    </tr>
                                    <!-- ENTER -->
                                    <tr>
                                        <th>
                                            <div><br></div>
                                        </th>
                                    </tr><!-- END ENTER -->
                                    <tr>
                                        <th style="width: 30%">Kasbon</th>
                                        <th style="width: 15%">:</th>
                                        <th style="width: 60%">
                                            <input type="text" name="kasbon" id="kasbon" class="form-control" autocomplete="off" placeholder="Input Kasbon">
                                        </th>
                                    </tr>
                                    <!-- ENTER -->
                                </tbody>
                            </table>
                            <input type="hidden" name="user" id="user" class="form-control" value="<?php echo $_SESSION['nama']; ?>" readonly>
                            <input type="hidden" name="jam" class="form-control" value="<?php echo date('H:i:s'); ?>">
                            <input type="hidden" name="id_berobat" class="form-control">
                            <input type="hidden" name="id_surat_rujukan" class="form-control" value="<?php echo $data_surat['id_surat'] ?>">
                        </div>
                        <div class="box-footer">
                            <!-- <button type="submit" name="tombol" class="btn btn-info pull-left">Simpan Data</button> -->
                            <a href="tampil_seluruh_surat_rujukan" button onclick="window.close()" class="btn btn-primary pull-left">Close</a>
                            <button type="submit" name="biaya_berobat" class="btn btn-primary pull-right"><i class="fa fa-save" aria-hidden="true"></i> Save</button>
                        </div>
            </div>
        </div>
</section>
<script type="text/javascript">
    $(document).ready(function() {
        $('.tanggal').datepicker({
            autoclose: true,
            format: 'yyyy-mm-dd' //2020-01-20
            //format:'DD, dd-MM-yy' //Monday, 20 January 2020
            //format: 'dd-mm-yyyy' //20-01-2020
            //format:'DD, dd-mm-yyyy'
        });
    });
</script>
</body>

</html>