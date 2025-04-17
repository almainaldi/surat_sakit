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
    } else {
        header("location:tampil_surat_rujukan?pesan=gagal");
    }
} else {
    header("location:tampil_surat_rujukan?pesan=gagal");
}

if (isset($_POST['konfir'])) {
    $no = 1;

    $data = array(
        "id_surat"       => $_POST['id_surat'],
        "st_print"   => $_POST['st_print']
    );
    if ($surat_rujukan->konfir($data)) {
        header("location:tampil_surat_rujukan");
    } else {
        header("location:tampil_surat_rujukan?pesan=gagal");
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
                <div class="col-xs-1">
                    <a href="tampil_surat_rujukan" class="btn btn-warning pull-left"><i class="fa fa-backward"></i> Kembali</a>
                </div>
                <div class="col-xs-3"></div>
                <div class="col-xs-4"></div>
                <div class="col-xs-4">
                    <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;" data-toggle="modal" data-target="#Konfirmasi"> Kirim Notifikasi</button>
                </div>
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
                        <p>No. Surat Rujukan : <?php echo $data['id_surat'] ?></p>
                    </strong><br>
                    <style type="text/css">
                        input[type="text"],
                        button[type="submit"] {
                            padding: 10px 15px;
                            font-size: 15;
                            border-radius: 5px;
                        }

                        input[type="text"] {
                            width: 290px;
                            border: 1px solid #bbb;
                        }

                        button[type="submit"] {
                            background: #6cb2eb;
                            border: 1px solid #71ff1f;
                            color: #fff;
                            cursor: pointer;
                        }
                    </style>
                    <div class="card">
                        <h5>Online :</h5>
                        <input type="text" value="http://langgeng.dyndns.biz/surat_sakit/surat_rujukan_acc?id=<?php echo $data['id_surat']; ?>" id="pilih" readonly />
                        <button type="submit" name="konfir" onclick="copy_text()"><i class="fa fa-copy" aria-hidden="true"></i></button>
                        <a title="Whatsapps" href="https://web.whatsapp.com/%F0%9F%8C%90/id" target="_blank" rel="noopener noreferrer" class="btn btn-lg bg-lime-active"><i class="fa fa-whatsapp"></i></a>
                    </div>
                    <div class="card">
                        <h5>Lokal :</h5>
                        <input type="text" value="http://10.3.80.55/surat_sakit/surat_rujukan_acc?id=<?php echo $data['id_surat']; ?>" id="pilih1" readonly />
                        <button type="submit" name="konfir" onclick="copy_text1()"><i class="fa fa-copy" aria-hidden="true"></i></button>
                        <a title="Whatsapps" href="https://web.whatsapp.com/%F0%9F%8C%90/id" target="_blank" rel="noopener noreferrer" class="btn btn-lg bg-lime-active"><i class="fa fa-whatsapp"></i></a>
                    </div>

                    <small style="font-style: italic;">(Surat Rujukan tidak bisa diberikan apabila belum di ACC)</small>
                    <script type="text/javascript">
                        function copy_text() {
                            document.getElementById("pilih").select();
                            document.execCommand("copy");
                            alert("Text berhasil dicopy");
                        }
                    </script>
                    <script type="text/javascript">
                        function copy_text1() {
                            document.getElementById("pilih1").select();
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
                    <!-- <button type="submit" name="tombol" class="btn btn-primary"><i class="fa fa-save" aria-hidden="true"></i> Save</button> -->
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