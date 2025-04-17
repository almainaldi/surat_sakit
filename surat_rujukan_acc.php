<!DOCTYPE html>
<html>
<title>LPS | Konfirmasi Surat Rujukan </title>
<?php
include_once('template/header.php');
include_once('class/surat_rujukan.php');

$surat_rujukan = new surat_rujukan();
$cekid = $surat_rujukan->no_urut();
$data_surat_rujukan      = $surat_rujukan->tampil_data();
if (!empty($_GET['id'])) {
    $id = $_GET['id'];
    if ($surat_rujukan->cek_id($id)) {
        $data = $surat_rujukan->print($id);
        if (($data['pemberi'] == $_SESSION['nama'])) {
            $data = $surat_rujukan->print($id);
        } elseif ($_SESSION['tipe'] == 'admin') {
            $data = $surat_rujukan->print($id);
        } else {
            header("location:home");
        }
    } else {
        header("location:tampil_surat_rujukan?pesan=gagal");
    }
} else {
    header("location:tampil_surat_rujukan?pesan=gagal");
}

if (isset($_POST['acc'])) {
    $no = 1;

    $data = array(
        "id_surat"    => $_POST['id_surat'],
        "acc"   => '1',
        "status"   => '1',
        "acc_tgl"   => $_POST['acc_tgl'],
    );
    if ($surat_rujukan->stj_surat($data)) {
        header("location:tampil_surat_rujukan?pesan=success");
    } else {
        header("location:surat_rujukan_detail?pesan=gagal");
    }
}


?>

<div class="content-wrapper">
    <section class="content-header"></section>
    <form id="form" class="form-horizontal" method="post" action="" enctype="multipart/form-data">
        <section class="invoice">
            <!-- title row -->
            <div class="row">
                <div class="col-xs-12">
                    <h2 class="page-header text-center"><b>Surat Rujukan</b></h2>
                </div>
                <!-- /.col -->
            </div>


            <div class="row">
                <div class="col-xs-12 table-responsive">
                    <table class="table table-borderless table-striped">
                        <tbody>
                            <tr>
                                <td style="width: 200px"><b> Nama Karyawan</b></td>
                                <td style="width: 20px"><b>:</td>
                                <td><b> <?php echo $data['nama_kar'] ?></td>
                                <!--  -->
                                <td width="175px"> </td>
                                <td width="175px"> </td>
                                <!--  -->
                                <td style="width: 200px"><b> Jabatan</b></td>
                                <td style="width: 20px"><b>:</td>
                                <td><b> <?php echo $data['jabatan'] ?></td>
                            </tr>
                            <tr>
                                <td style="width: 200px"><b> Tujuan</b></td>
                                <td style="width: 20px"><b>:</td>
                                <td><b> <?php echo $data['tujuan'] ?></td>

                                <!--  -->
                                <td width="175px"> </td>
                                <td width="175px"> </td>
                                <!--  -->
                                <td style="width: 200px"><b> Tanggal</b></td>
                                <td style="width: 20px"><b>:</td>
                                <td><b> <?php echo $data['tanggal'] ?></td>
                            </tr>
                            <tr>
                                <td style="width: 200px"><b> Yang Mengetahui</b></td>
                                <td style="width: 20px"><b>:</td>
                                <td><b> <?php echo $data['mengetahui'] ?></td>
                                <!--  -->
                                <td width="175px"> </td>
                                <td width="175px"> </td>
                                <!--  -->
                                <td style="width: 200px"><b> Pemberi Kuasa</b></td>
                                <td style="width: 20px"><b>:</td>
                                <td><b> <?php echo $data['pemberi'] ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <style>
                .bordered {
                    border: solid 1px;
                    padding: 4px 4px 4px 4px;
                }

                ;
            </style>
            <div class="bordered">
                <div class="row">
                    <div class="col-xs-12">
                        <table class="table table-borderless table-striped">
                            <tbody>
                                <tr>
                                    <th width="115px">Keluhan</th>
                                    <th>:</th>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <p style="text-align: justify;"><?php echo $data['keluhan']; ?></p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div><br>

            <div class="row no-print">
                <div class="col-xs-12">
                    <a href="tampil_surat_rujukan" class="btn btn-warning pull-left"><i class="fa fa-backward"></i> Kembali</a>
                    <?php if($data['acc'] == '0'){ ?>
                        <?php if (($_SESSION['nama'] == $data['pemberi']) OR ($_SESSION['tipe'] == 'admin')) { ?>
                            <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;" data-toggle="modal" data-target="#Konfirmasi"> ACC Surat Rujukan</button>
                        <?php } ?>
                    <?php }else{ ?>
                        <a href="#" class="btn btn-success pull-right" style="margin-right: 5px;"> SUDAH DI ACC</a>
                    <?php } ?>
                </div>
                <!-- <div class="col-xs-3"></div>
                <div class="col-xs-4"></div>
                <div class="col-xs-4">
                </div> -->
            </div>
        </section>
        <!-- /.content -->
        <div class="clearfix"></div>
</div>

<form id="form" method="post" action="" enctype="multipart/form-data">
    <div class="modal fade" id="Konfirmasi">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">KONFIRMASI SURAT RUJUKAN</h4>
                </div>
                <div class="modal-body">
                    <strong>
                        <p>No. Surat Rujukan : 00<?php echo $data['id_surat'] ?></p>
                        <p>Nama : <?php echo $data['nama_kar'] ?></p>
                    </strong><br>

                    <small style="font-style: italic;">(Surat Rujukan tidak bisa diberikan apabila belum di ACC)</small>
                    <script type="text/javascript">
                        function copy_text() {
                            document.getElementById("pilih").select();
                            document.execCommand("copy");
                            alert("Text berhasil dicopy");
                        }
                    </script>

                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id_surat" value="<?php echo $data['id_surat'] ?>" readonly>
                    <input type="hidden" name="st_print" value="<?php echo $data['st_print'] ?>" readonly>
                    <input type="hidden" name="acc_tgl" value="<?php echo date('d-M-Y'); ?>" readonly>
                    <!-- <input type="button" value="Close Tab" onclick="self.close()"> -->
                    <button type="submit" name="acc" class="btn btn-primary"><i class="fa fa-save" aria-hidden="true"></i> Save</button>
                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</form>
<?php
include_once('template/footer.php');
?>