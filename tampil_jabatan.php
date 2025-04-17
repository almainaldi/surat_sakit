<!DOCTYPE html>
<html>
<title>LPS | Jabatan</title>
<?php
include_once('template/header.php');
include_once('class/jabatan.php');

$jabatan   = new jabatan();

$data_jabatan      = $jabatan->tampil_data();

if (isset($_POST['tombol'])) {
    $data = array(

        "id_jabatan"  => $_POST['id_jabatan'],
        "jabatan"  => $_POST['jabatan']
    );
    if ($jabatan->tambah($data)) {
        header("location:tampil_jabatan?pesan=success");
    } else {
        header("location:tampil_jabatan?pesan=gagal");
    }
}

if (isset($_POST['update'])) {
    $data = array(

        "id_jabatan" => $_POST['id_jabatan'],
        "jabatan" => $_POST['jabatan']
    );
    if ($jabatan->edit($data)) {
        header("location:tampil_jabatan?pesan=success");
    } else {
        header("location:tampil_jabatan?pesan=gagal");
    }
}

if (isset($_GET['hapus_id'])) {
    if ($jabatan->cek_id($_GET['hapus_id'])) {
        if ($jabatan->hapus($_GET['hapus_id'])) {
            header("location:tampil_jabatan?pesan=hapus");
        } else {
            header("location:tampil_jabatan?pesan=gagal");
        }
    } else {
        header("location:tampil_jabatan");
    }
}
?>
<script src="class/validasi_form/jabatan.js" type="text/javascript"></script>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Master Jabatan
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Master Jabatan</li>
        </ol>
    </section>
    <p>

    <div>
        <div class="container-fluid col-sm-12 col-md-3">
            <div class="card card-success">
                <div class="card-body">
                    <div class="box box-primary box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title text-black"><i class="fa fa-cube"></i> Form Input Jabatan <i class="fa fa-cube"></i></h3>
                        </div>
                        <form class="form" id="form" name="form" method="post" action="">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-xs-4 control-label"> Jabatan</label>
                                            <div class="col-xs-8">
                                                <input type="text" class="form-control" name="jabatan" onkeyup="this.value = this.value.toUpperCase()" autocomplete="off" placeholder="Input Jabatan" autofocus required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')" oninput="setCustomValidity('')">
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
                                                <th class="text-center">Jabatan</th>
                                                <?php if (($_SESSION['edit'] == "1") or ($_SESSION['hapus'] == "1")) { ?>
                                                    <th class="text-center">ACTION</th>
                                                <?php } ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if ($data_jabatan->num_rows > 0) {
                                                $no = 1;
                                                while ($row = mysqli_fetch_array($data_jabatan)) { ?>
                                                    <tr>
                                                        <td style="vertical-align : middle;text-align:center;"><b><?php echo $no++ ?></b></td>
                                                        <td style="vertical-align : middle;"><b><?php echo $row['jabatan'] ?></b></td>
                                                        <td style="vertical-align : middle;text-align:center;">
                                                            <?php if ($_SESSION['edit'] == "1") { ?>
                                                                <!-- EDIT -->
                                                                <a href="" class="btn btn-sm btn-warning text-black" data-toggle="modal" data-target="#edit2<?php echo $row['id_jabatan']; ?>"><i class="fa fa-edit"></i></a>
                                                                <div class="modal fade" id="edit2<?php echo $row['id_jabatan']; ?>">
                                                                    <form id="form" method="post" action="" enctype="multipart/form-data">
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                        <span aria-hidden="true">&times;</span></button>
                                                                                    <h4 class="modal-title">Edit Data Jabatan</h4>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <div class="box-body">
                                                                                        <div class="form-group">
                                                                                            <table>
                                                                                                <tr>
                                                                                                    <th style="width: 30%;">Jabatan</th>
                                                                                                    <th style="width: 10%;">:</th>
                                                                                                    <th style="width: 60%;"><input type="text" class="form-control" name="jabatan" id="jabatan" value="<?php echo $row['jabatan']; ?>" onkeyup="this.value = this.value.toUpperCase()" autocomplete="off"></th>
                                                                                                </tr>
                                                                                            </table>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <input type="hidden" name="id_jabatan" value="<?php echo $row['id_jabatan']; ?>" readonly>
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
                                                                <a title="Hapus" title="Hapus Data" href="tampil_jabatan?hapus_id=<?php echo $row['id_jabatan']; ?>">
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