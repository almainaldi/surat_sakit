<!DOCTYPE html>
<html>
<title>LPS | Klinik / RS</title>
<?php
include_once('template/header.php');
include_once('class/klinik.php');

$klinik   = new klinik();

$data_klinik      = $klinik->tampil_data();

if (isset($_POST['tombol'])) {
    $data = array(

        "id_klinik"  => $_POST['id_klinik'],
        "klinik"  => $_POST['klinik']
    );
    if ($klinik->tambah($data)) {
        header("location:tampil_klinik?pesan=success");
    } else {
        header("location:tampil_klinik?pesan=gagal");
    }
}

if (isset($_POST['update'])) {
    $data = array(

        "id_klinik" => $_POST['id_klinik'],
        "klinik" => $_POST['klinik']
    );
    if ($klinik->edit($data)) {
        header("location:tampil_klinik?pesan=success");
    } else {
        header("location:tampil_klinik?pesan=gagal");
    }
}

if (isset($_GET['hapus_id'])) {
    if ($klinik->cek_id($_GET['hapus_id'])) {
        if ($klinik->hapus($_GET['hapus_id'])) {
            header("location:tampil_klinik?pesan=hapus");
        } else {
            header("location:tampil_klinik?pesan=gagal");
        }
    } else {
        header("location:tampil_klinik");
    }
}
?>
<script src="class/validasi_form/klinik.js" type="text/javascript"></script>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Master Klinik/RS
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Master Klinik/RS</li>
        </ol>
    </section>
    <p>
    <div>

        <div class="container-fluid col-sm-12 col-md-3">
            <div class="card card-success">
                <div class="card-body">
                    <div class="box box-primary box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title text-black"><i class="fa fa-cube"></i> Form Input Klinik/RS <i class="fa fa-cube"></i></h3>
                        </div>
                        <form class="form" id="form" name="form" method="post" action="">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-xs-4 control-label">Klinik/RS</label>
                                            <div class="col-xs-8">
                                            <input type="text" class="form-control" name="klinik" onkeyup="this.value = this.value.toUpperCase()" autocomplete="off" placeholder="Input Klinik/RS" autofocus required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')" oninput="setCustomValidity('')">
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="submit" name="tombol" class="btn btn-info pull-right"><i class="fa fa-save"> Simpan</i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script>
            window.setTimeout(function() {
                $(".alert").fadeTo(300, 0).slideUp(300, function() {
                    $($this).remove();
                });
            }, 1500)
        </script>

        <!-- tabel -->
        <section class="content">
            <div class="row">
                <div class="col-sm-12 col-md-9">
                    <div class="box box-primary">
                        <div class="box-header">
                            <div class="box-body">
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
                                <?php if (isset($error)) { ?>
                                    <div class="alert alert-danger" role="alert"><?php echo $error; ?></div>
                                <?php } ?>
                                <div class="table-responsive no-padding">
                                    <table class="table table-hover table-bordered table-striped" id="example1" style="height: auto; ">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No</th>
                                                <th class="text-center">Klinik/RS</th>
                                                <?php if (($_SESSION['edit'] == "1") or ($_SESSION['hapus'] == "1")) { ?>
                                                    <th class="text-center">ACTION</th>
                                                <?php } ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if ($data_klinik->num_rows > 0) {
                                                $no = 1;
                                                while ($row = mysqli_fetch_array($data_klinik)) { ?>
                                                    <tr>
                                                        <td style="vertical-align : middle;text-align:center;"><b><?php echo $no++ ?></b></td>
                                                        <td style="vertical-align : middle;"><b><?php echo $row['klinik'] ?></b></td>
                                                        <td style="vertical-align : middle;text-align:center;">
                                                            <?php if ($_SESSION['edit'] == "1") { ?>
                                                                <!-- EDIT -->
                                                                <a href="" class="btn btn-sm btn-warning text-black" data-toggle="modal" data-target="#edit2<?php echo $row['id_klinik']; ?>"><i class="fa fa-edit"></i></a>
                                                                <div class="modal fade" id="edit2<?php echo $row['id_klinik']; ?>">
                                                                    <form id="form" method="post" action="" enctype="multipart/form-data">
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                        <span aria-hidden="true">&times;</span></button>
                                                                                    <h4 class="modal-title">Edit Data Klinik/RS</h4>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <div class="box-body">
                                                                                        <div class="form-group">
                                                                                            <label for="" class="col-xs-4 control-label">Klinik/RS : </label>
                                                                                            <div class="col-xs-8">
                                                                                                <input type="text" class="form-control" name="klinik" id="klinik" value="<?php echo $row['klinik']; ?>" onkeyup="this.value = this.value.toUpperCase()" autocomplete="off">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <input type="hidden" name="id_klinik" value="<?php echo $row['id_klinik']; ?>" readonly>
                                                                                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                                                                    <button type="submit" name="update" class="btn btn-primary"><i class="fa fa-save" aria-hidden="true"></i> Save</button>
                                                                                </div>
                                                                            </div>
                                                                            <!-- /.modal-content -->
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                                <!-- END EDIT -->
                                                            <?php } ?>

                                                            <?php if ($_SESSION['hapus'] == "1") { ?>
                                                                <!-- HAPUS -->
                                                                <a title="Hapus" title="Hapus Data" href="tampil_klinik?hapus_id=<?php echo $row['id_klinik']; ?>">
                                                                    <button class="btn btn-danger btn-sm text-black"><i class="fa fa-trash"> </i></button>
                                                                </a>
                                                                <!-- END HAPUS -->
                                                            <?php } ?>
                                                        </td>
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
            </div>
        </section>
    </div>
</div>


<?php
include_once('template/footer.php');
?>