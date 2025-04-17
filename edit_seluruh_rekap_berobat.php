<!DOCTYPE html>
<html>
<?php
ob_start();
session_start();
include_once('class/rekap_berobat.php');
include_once('class/karyawan.php');
include_once('class/jabatan.php');

$rekap_berobat = new rekap_berobat();
$karyawan = new karyawan();
$jabatan   = new jabatan();

$data_karyawan      = $karyawan->tampil_data();
$data_jabatan      = $jabatan->tampil_data();


if (!empty($_GET['id'])) // Ngecek ID apakah sesuai dan ada di database
{
    $id = $_GET['id'];
    if ($rekap_berobat->cek_id($id)) {
        $data = $rekap_berobat->get_by_id($id);
    } else {
        header("location:tampil_seluruh_rekap_berobat?pesan=gagal");
    }
} else {
    header("location:tampil_seluruh_rekap_berobat?pesan=gagal");
}

?>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 style="text-align: center;">Edit Data Rekap Berobat</h3>
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
                                            <input type="text" name="tgl" class="form-control tanggal" value="<?php echo $data['tgl']; ?>" readonly>
                                        </th>
                                    </tr>
                                    <!-- ENTER -->
                                    <tr>
                                        <th>
                                            <div><br></div>
                                        </th>
                                    </tr><!-- END ENTER -->
                                    <tr>
                                        <th style="width: 30%">Nama Karyawan</th>
                                        <th style="width: 10%">:</th>
                                        <th style="width: 60%">
                                        <input type="text" name="nama_kar" class="form-control" value="<?php echo $data['nama_kar']; ?>" readonly>
                                        </th>
                                    </tr>
                                    <!-- ENTER -->
                                    <tr>
                                        <th>
                                            <div><br></div>
                                        </th>
                                    </tr><!-- END ENTER -->
                                    <tr>
                                        <th style="width: 30%">Jabatan</th>
                                        <th style="width: 10%">:</th>
                                        <th style="width: 60%">
                                        <input type="text" name="jabatan" class="form-control" value="<?php echo $data['jabatan']; ?>" readonly>
                                        </th>
                                    </tr>
                                    <!-- ENTER -->
                                    <tr>
                                        <th>
                                            <div><br></div>
                                        </th>
                                    </tr><!-- END ENTER -->
                                    <tr>
                                        <th style="width: 30%">Keluhan</th>
                                        <th style="width: 15%">:</th>
                                        <th style="width: 60%">
                                            <textarea class="form-control" name="keluhan" id="keluhan" placeholder="Input Keluhan" rows="5" onkeyup="this.value = this.value.toUpperCase()" autocomplete="off" autofocus required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')" oninput="setCustomValidity('')"><?php echo $data['keluhan']; ?></textarea>
                                        </th>
                                    </tr>
                                    <!-- ENTER -->
                                    <tr>
                                        <th>
                                            <div><br></div>
                                        </th>
                                    </tr><!-- END ENTER -->
                                    <!-- ENTER -->
                                    <tr>
                                    <th style="width: 30%">Diagnosis</th>
                                    <th style="width: 15%">:</th>
                                    <th style="width: 60%">
                                        <textarea class="form-control" name="diagnosis" id="diagnosis" placeholder="Input Diagnosis" rows="5" onkeyup="this.value = this.value.toUpperCase()" autocomplete="off" autofocus required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')" oninput="setCustomValidity('')"><?php echo $data['diagnosis']; ?></textarea>
                                    </th>
                                    </tr>
                                    <!-- ENTER -->
                                    <tr>
                                        <th>
                                            <div><br></div>
                                        </th>
                                    </tr><!-- END ENTER -->
                                    <tr>
                                        <th style="width: 30%">Solusi</th>
                                        <th style="width: 15%">:</th>
                                        <th style="width: 60%">
                                            <textarea class="form-control" name="solusi" id="solusi" placeholder="Input Solusi" rows="5" onkeyup="this.value = this.value.toUpperCase()" autocomplete="off" autofocus required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')" oninput="setCustomValidity('')"><?php echo $data['solusi']; ?></textarea>
                                        </th>
                                    </tr>
                                    <!-- ENTER -->
                                    <tr>
                                        <th>
                                            <div><br></div>
                                        </th>
                                    </tr><!-- END ENTER -->
                                </tbody>
                            </table>
                            <input type="hidden" name="id_rekap" class="form-control" value="<?php echo $data['id_rekap']; ?>" readonly>
                            <input type="hidden" name="id_biaya_berobat" class="form-control" value="<?php echo $data['id_biaya_berobat']; ?>" readonly>
                            <input type="hidden" name="id_kar" class="form-control" value="<?php echo $data['id_kar']; ?>" readonly>
                            <input type="hidden" name="user" class="form-control" value="<?php echo $_SESSION['nama']; ?>" readonly>
                            <input type="hidden" name="jam" class="form-control" value="<?php echo date('H:i:s'); ?>">
                            <input type="hidden" name="tgl" class="form-control" value="<?php echo $data['tgl'] ?>" readonly>
                        </div>
                        <div class="box-footer">
                            <!-- <button type="submit" name="tombol" class="btn btn-info pull-left">Simpan Data</button> -->
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                            <button type="submit" name="update" class="btn btn-primary pull-right"><i class="fa fa-save" aria-hidden="true"></i> Save</button>
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

</html>