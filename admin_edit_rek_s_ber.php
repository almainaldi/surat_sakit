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
        header("location:tampil_rekap_berobat?pesan=gagal");
    }
} else {
    header("location:tampil_rekap_berobat?pesan=gagal");
}

?>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 style="text-align: center;">Admin Edit Alur Surat Sakit</h3>
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
                                        <input type="text" name="" class="form-control" value="<?php echo $data['jabatan']; ?>" readonly>
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
                                            <textarea class="form-control" name="" id="keluhan" placeholder="Input Keluhan" rows="5" onkeyup="this.value = this.value.toUpperCase()" autocomplete="off" autofocus required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')" oninput="setCustomValidity('')" disabled><?php echo $data['keluhan']; ?></textarea>
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
                                            <textarea class="form-control" name="" id="diagnosis" placeholder="Input Diagnosis" rows="5" onkeyup="this.value = this.value.toUpperCase()" autocomplete="off" autofocus required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')" oninput="setCustomValidity('')" disabled><?php echo $data['diagnosis']; ?></textarea>
                                        </th>
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
                                            <textarea class="form-control" name="" id="solusi" placeholder="Input Solusi" rows="5" onkeyup="this.value = this.value.toUpperCase()" autocomplete="off" autofocus required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')" oninput="setCustomValidity('')" disabled><?php echo $data['solusi']; ?></textarea>
                                        </th>
                                    </tr>
                                    <!-- ENTER -->
                                    <tr>
                                        <th>
                                            <div><br></div>
                                        </th>
                                    </tr><!-- END ENTER -->
                                    <tr>
                                        <th style="width: 30%">Memo</th>
                                        <th style="width: 15%">:</th>
                                        <th style="width: 60%">
                                            <textarea class="form-control" name="" id="solusi" placeholder="Memo Belum Di isi" rows="5" autocomplete="off"  disabled><?php echo $data['memo']; ?></textarea>
                                        </th>
                                    </tr>
                                    <!-- ENTER -->
                                    <tr>
                                        <th>
                                            <div><br></div>
                                        </th>
                                    </tr><!-- END ENTER -->
                                    <tr style="color: red;">
                                        <th style="width: 30%;">Note</th>
                                        <th style="width: 15%">:</th>
                                        <th style="width: 60%;">
                                            <i> Tombol Simpan digunakan untuk mengembalikan ke alur input detail biaya berobat dan data rekap ini akan terhapus</i>
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
                            <input type="hidden" name="id_berobat" class="form-control" value="<?php echo $data['id_biaya_berobat']; ?>" readonly>
                        </div>
                        <div class="box-footer">
                            <!-- <button type="submit" name="tombol" class="btn btn-info pull-left">Simpan Data</button> -->
                            <a href="tampil_seluruh_rekap_berobat" button onclick="window.close()" class="btn btn-warning pull-left">Kembali</a>
                            <button type="submit" name="selesai" class="btn btn-info pull-right"> Simpan</button>
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