<!DOCTYPE html>
<html>
<title>LPS | Karyawan</title>
<?php
include_once('template/header.php');
include_once('class/karyawan.php');
include_once('class/jabatan.php');

$karyawan   = new karyawan();
$jabatan   = new jabatan();

$data_karyawan      = $karyawan->tampil_data();
$data_jabatan      = $jabatan->tampil_data();

if (isset($_POST['tombol'])) {
    $data = array(

        "id_kar"  => $_POST['id_kar'],
        "nama_kar"  => $_POST['nama_kar'],
        "jabatan" => $_POST['jabatan']
    );
    if ($karyawan->tambah($data)) {
        header("location:tampil_karyawan?pesan=success");
    } else {
        header("location:tampil_karyawan?pesan=gagal");
    }
}

if (isset($_POST['update'])) {
    $data = array(
        "id_kar" => $_POST['id_kar'],
        "nama_kar" => $_POST['nama_kar'],
        "jabatan"  => $_POST['jabatan']
    );
    if ($karyawan->edit($data)) {
        header("location:tampil_karyawan?pesan=update");
    } else {
        header("location:tampil_karyawan?pesan=gagal");
    }
}

if (isset($_GET['hapus_id'])) {
    if ($karyawan->cek_id($_GET['hapus_id'])) {
        if ($karyawan->hapus($_GET['hapus_id'])) {
            header("location:tampil_karyawan?pesan=hapus");
        } else {
            header("location:tampil_karyawan?pesan=gagal");
        }
    } else {
        header("location:tampil_karyawan");
    }
}
?>
<script src="class/validasi_form/karyawan.js" type="text/javascript"></script>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Master Karyawan
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Master Karyawan</li>
        </ol>
    </section>
    <p>

    <div class="container-fluid col-sm-12 col-md-3">
        <div class="card card-success">
            <div class="card-body">
                <div class="box box-primary box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title text-black"><i class="fa fa-cube"></i> Form Input Karyawan <i class="fa fa-cube"></i></h3>
                    </div>
                    <form class="form" id="form" name="form" method="post" action="">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="col-xs-4 control-label">Karyawan</label>
                                        <div class="col-xs-8">
                                            <input type="text" class="form-control" name="nama_kar" onkeyup="this.value = this.value.toUpperCase()" autocomplete="off" placeholder="Input Karyawan" autofocus required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')" oninput="setCustomValidity('')">
                                        </div>
                                    </div><br><br>
                                    <div class="form-group">
                                        <label class="col-xs-4 control-label">Jabatan</label>
                                        <div class="col-xs-8">
                                            <select class="form-control select2" name="jabatan" id="jabatan">
                                                <?php
                                                if ($data_jabatan->num_rows > 0) {
                                                    while ($row = mysqli_fetch_object($data_jabatan)) {
                                                ?>
                                                        <option value="<?php echo $row->jabatan; ?>"><?php echo $row->jabatan; ?></option>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div></div>
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

    <section class="content">
        <div class="row">
            <div class="col-sm-12 col-md-9">
                <div class="box">
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
                                            <th class="text-center">Karyawan</th>
                                            <th class="text-center">Jabatan</th>
                                            <?php if ($_SESSION['edit'] == "1") { ?>
                                                <th class="text-center">Edit</th>
                                            <?php } ?>
                                            <?php if ($_SESSION['hapus'] == "1") { ?>
                                                <th class="text-center">Hapus</th>
                                            <?php } ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($data_karyawan->num_rows > 0) {
                                            $no = 1;
                                            while ($row = mysqli_fetch_array($data_karyawan)) { ?>
                                                <tr>
                                                    <td style="vertical-align : middle;text-align:center;"><b><?php echo $no++ ?></b></td>
                                                    <td style="vertical-align : middle;"><b><?php echo $row['nama_kar'] ?></b></td>
                                                    <td style="vertical-align : middle;"><b><?php echo $row['jabatan'] ?></b></td>
                                                    <?php if ($_SESSION['edit'] == "1") { ?>
                                                        <td style="vertical-align : middle;text-align:center;">
                                                            <!-- EDIT -->
                                                            <form id="form1" method="post" action="" enctype="multipart/form-data">
                                                                <a href="edit_karyawan?id=<?php echo $row['id_kar']; ?>" class="btn btn-warning btn-sm text-black margin" data-toggle="modal" data-target="#edit<?php echo $row['id_kar']; ?>"><i class="fa fa-edit"></i></a>
                                                                <div class="modal fade" id="edit<?php echo $row['id_kar']; ?>">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                            <!-- END EDIT -->
                                                        </td>
                                                    <?php } ?>
                                                    <?php if ($_SESSION['hapus'] == "1") { ?>
                                                        <td style="vertical-align : middle;text-align:center;">
                                                            <!-- HAPUS -->
                                                            <a title="Hapus" title="Hapus Data" href="tampil_karyawan?hapus_id=<?php echo $row['id_kar']; ?>">
                                                                <button class="btn btn-danger btn-sm text-black margin"><i class="fa fa-trash"> </i></button>
                                                            </a>
                                                            <!-- END HAPUS -->
                                                        </td>
                                                    <?php } ?>
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

<?php
include_once('template/footer.php');
?>