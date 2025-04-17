<!DOCTYPE html>
<html>

<body>
    <?php
    include_once('template/header.php');
    include_once('class/jenis_layanan.php');
    include_once('class/biaya_berobat.php');
    include_once('class/detail_data_berobat.php');

    $jenis_layanan = new jenis_layanan();
    $biaya_berobat = new biaya_berobat();
    $detail_data_berobat = new detail_data_berobat();

    $data_jenis_layanan      = $jenis_layanan->tampil_data();


    if (!empty($_GET['id'])) // Ngecek ID apakah sesuai dan ada di database
    {
        $id = $_GET['id'];
        if ($biaya_berobat->cek_id($id)) {
            $data = $biaya_berobat->get_by_id($id);
            $id_berobat = $biaya_berobat->id_berobat($id); //11
        } else {
            header("location:tampil_seluruh_biaya_berobat?pesan=gagal");
        }
    } else {
        header("location:tampil_seluruh_biaya_berobat?pesan=gagal");
    }

    $data_detail_data_berobat      = $detail_data_berobat->tampil_data($id_berobat);
    $jumlah_data = $detail_data_berobat->detail_berobat($id);

    if (isset($_POST['tombol'])) {
        $data = array(
            "id_detail_berobat" => $_POST['id_detail_berobat'],
            "id_berobat" => $_POST['id_berobat'],
            "jenis_layanan" => $_POST['jenis_layanan'],
            "biaya" => $_POST['biaya']
        );
        if ($detail_data_berobat->tambah($data)) {
            header("location:detail_seluruh_data_berobat?id=$id_berobat");
        } else {
            header("location:detail_seluruh_data_berobat?pesan=gagal");
        }
    }

    if (isset($_POST['selesai'])) {
        $data = array(
            "id_berobat" => $_POST['id_berobat']
        );
        if ($biaya_berobat->selesai($data)) {
            header("location:tampil_seluruh_biaya_berobat?pesan=success");
        } else {
            header("location:tampil_seluruh_biaya_berobat?pesan=gagal");
        }
    }

    ?>
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Tambah Biaya Berobat
            </h1>
            <ol class="breadcrumb">
                <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Tambah Biaya Berobat</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <?php
                            if (isset($error)) {
                            ?>
                                <div class="alert alert-danger" role="alert"><?php echo $error; ?></div>
                            <?php
                            }
                            ?>
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
                                } else if ($_GET['pesan'] == "lihat") {
                                    echo "<div class='alert alert-danger'>Data Gagal Di Lihat Atau Data Di Hapus Admin</div>";
                                }
                            }
                            ?>
                        </div>
                        <form id="form" class="form-horizontal" method="post" action="">
                            <form class="form-horizontal">
                                <div class="box-body">
                                    <!-- KIRI -->
                                    <div class="col-xs-6">
                                        <div class="form-group"></div>
                                        <div class="form-group">
                                            <label for="nama" class="col-sm-3 control-label">Nama Karyawan</label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control" value="<?php echo $data['nama_karyawan']; ?>" readonly>
                                                <input type="hidden" name="id_berobat" class="form-control" value="<?php echo $data['id_berobat']; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="tempat" class="col-sm-3 control-label">Klinik / RS</label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control" value="<?php echo $data['tempat']; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class=" form-group">
                                            <label for="dokter" class="col-sm-3 control-label">Dokter</label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control" value="<?php echo $data['dokter']; ?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END KIRI -->
                                    <!-- KANAN -->
                                    <div class="col-xs-6">
                                        <div class="form-group"></div>
                                        <div class="form-group">
                                            <label for="type" class="col-sm-3 control-label">Jenis Penyakit</label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control" value="<?php echo $data['jenis']; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="tgl" class="col-sm-3 control-label">Tanggal Berobat</label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control" name="tgl" value="<?php echo $data['tgl']; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="type" class="col-sm-3 control-label">User</label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control" placeholder="Input Mengetahui" name="mengetahui" value="<?php echo $_SESSION['nama'] ?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END KANAN -->
                                <div class="panel-body table-responsive no-padding">
                                    <div class="col-xs-12 control">
                                        <table id="example1" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th style="text-align: center;border: 1px solid gray;vertical-align : middle;">No</th>
                                                    <th style="text-align: center;border: 1px solid gray;vertical-align : middle;">Jenis Layanan</th>
                                                    <th style="text-align: center;border: 1px solid gray;vertical-align : middle;">Biaya</th>
                                                    <th style="text-align: center;border: 1px solid gray;vertical-align : middle;">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if ($data_detail_data_berobat->num_rows > 0) {
                                                    $no = 1;
                                                    while ($row = mysqli_fetch_object($data_detail_data_berobat)) {
                                                ?>
                                                        <tr>
                                                            <td style="text-align: center;border: 1px solid gray;vertical-align : middle;"><?php echo $no++ ?></td>
                                                            <td style="text-align: center;border: 1px solid gray;vertical-align : middle;"><?php echo $row->jenis_layanan ?></td>
                                                            <td style="text-align: center;border: 1px solid gray;vertical-align : middle;"><?php echo number_format($row->biaya, 0, "", ".") ?></td>
                                                            <td style="text-align: center;border: 1px solid gray;vertical-align : middle;">
                                                                    <a href="hapus_seluruh_detail_berobat?id=<?php echo $row->id_detail_berobat; ?>" class="btn btn-danger btn-sm margin">Hapus</a>
                                                            </td>
                                                        </tr>
                                                <?php  }
                                                } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- ########################## END TABEL ########################## -->
                                <!-- END Jumlah Do -->
                                <!-- JENIS KENDARAAN -->
                                <div class="form-group">
                                    <label for="jenis_layanan" class="col-sm-3 control-label">Jenis Layanan</label>
                                    <div class="col-sm-6">
                                        <select class="form-control select2" name="jenis_layanan" id="jenis_layanan">
                                            <option></option>
                                            <?php
                                            if ($data_jenis_layanan->num_rows > 0) {
                                                while ($row = mysqli_fetch_object($data_jenis_layanan)) {
                                            ?>
                                                    <option value="<?php echo $row->nama; ?>"><?php echo $row->nama; ?></option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <!-- END JENIS KENDARAAN -->
                                <!-- NO KENDARAAN -->
                                <div class="form-group">
                                    <label for="" class="col-sm-3 control-label">Biaya Berobat</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="biaya" id="biaya" class="form-control" placeholder="Masukan Jumlah Biaya berobat" onkeyup="sum_1();" autocomplete="off" required="true" title="Jumlah tidak boleh kosong">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-8"></div>
                                    <div class="col-sm-1">
                                        <button type="submit" name="tombol" class="btn btn-success pull-right">Simpan</button>
                                    </div>
                                </div>
                            </form>
                            <form id="form1" class="form-horizontal" method="post" action="">
                                <!-- END NO KENDARAAN -->
                                <div class="form-group"></div>
                                <div class="box-footer">
                                    <input type="hidden" name="id_berobat" class="form-control" value="<?php echo $data['id_berobat']; ?>" readonly>
                                    <a href="tampil_seluruh_biaya_berobat" class="btn btn-warning pull-left">Kembali</a>
                                    <!-- <a href="" name="selesai" class="btn btn-warning pull-left">Kembali</a> -->
                                    <?php if ($jumlah_data != '0') { ?>
                                    <button type="submit" name="selesai" class="btn btn-info pull-right">Selesai</button>
                                    <?php }?>
                                </div>
                            </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <?php
    include_once('template/footer.php');
    ?>

    <script>
        $().ready(function() {
            $('#jenis_layanan').select2({
                placeholder: 'Pilih Jenis Layanan',
            });
        })
    </script>
</body>

</html>