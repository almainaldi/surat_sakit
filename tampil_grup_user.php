<?php
include_once('template/header.php');
include_once('class/user.php');
$user = new user();
$data_grup = $user->tampil_grup();

// HAPUS DATA
if (isset($_POST['hapus'])) {
    $data = array(
        "id_user"        => $_POST['id_user']
    );

    if ($user->hapus_grup($data)) {
        header("location:tampil_grup_user?pesan=hapus");
    } else {
        header("location:tampil_grup_user?pesan=gagal");
    }
}
// END HAPUS DATA
?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Data Group User
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Data Group User</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                    </div>
                    <div class="box-body">
                        <!-- <a href="tambah_user"><button class="btn btn-info">Tambah Data</button></a> -->
                        <a href="tambah_grup_user" class="btn btn-info" data-target="#tambah">Tambah Data</a>
                        <hr />
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
                        <div class="panel-body table-responsive no-padding">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tipe Grup</th>
                                        <!-- BASIC -->
                                        <th>Lihat</th>
                                        <th>Print</th>
                                        <th>Tambah</th>
                                        <th>Edit</th>
                                        <th>Hapus</th>
                                        <th>Acc</th>
                                        <!-- END BASIC -->
                                        <!-- MENU -->
                                        <th>Menu 1</th>
                                        <th>Menu 2</th>
                                        <th>Menu 3</th>
                                        <th>Menu 4</th>
                                        <th>Menu 5</th>
                                        <th>Menu 6</th>
                                        <th>Menu 7</th>
                                        <th>Menu 8</th>
                                        <th>Menu 9</th>
                                        <th>Menu 10</th>
                                        <!-- END MENU -->
                                        <th>Edit</th>
                                        <th>Hapus</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($data_grup->num_rows > 0) {
                                        $no = 1;
                                        while ($row = mysqli_fetch_object($data_grup)) {
                                    ?>
                                            <tr>
                                                <td><?php echo $no++; ?></td>
                                                <td><?php echo $row->tipe ?></td>
                                                <!-- BASIC -->
                                                <td style="vertical-align : middle;text-align:center;">
                                                    <?php
                                                    if ($row->lihat == "1") {
                                                        echo "<div class='label label-success'>YES</div>";
                                                    } else if ($row->lihat == "0") {
                                                        echo "<div class='label label-danger'>NO</div>";
                                                    }
                                                    ?>
                                                </td>
                                                <td style="vertical-align : middle;text-align:center;">
                                                    <?php
                                                    if ($row->print == "1") {
                                                        echo "<div class='label label-success'>YES</div>";
                                                    } else if ($row->print == "0") {
                                                        echo "<div class='label label-danger'>NO</div>";
                                                    }
                                                    ?>
                                                </td>
                                                <td style="vertical-align : middle;text-align:center;">
                                                    <?php
                                                    if ($row->tambah == "1") {
                                                        echo "<div class='label label-success'>YES</div>";
                                                    } else if ($row->tambah == "0") {
                                                        echo "<div class='label label-danger'>NO</div>";
                                                    }
                                                    ?>
                                                </td>
                                                <td style="vertical-align : middle;text-align:center;">
                                                    <?php
                                                    if ($row->edit == "1") {
                                                        echo "<div class='label label-success'>YES</div>";
                                                    } else if ($row->edit == "0") {
                                                        echo "<div class='label label-danger'>NO</div>";
                                                    }
                                                    ?>
                                                </td>
                                                <td style="vertical-align : middle;text-align:center;">
                                                    <?php
                                                    if ($row->hapus == "1") {
                                                        echo "<div class='label label-success'>YES</div>";
                                                    } else if ($row->hapus == "0") {
                                                        echo "<div class='label label-danger'>NO</div>";
                                                    }
                                                    ?>
                                                </td>
                                                <td style="vertical-align : middle;text-align:center;">
                                                    <?php
                                                    if ($row->acc == "1") {
                                                        echo "<div class='label label-success'>YES</div>";
                                                    } else if ($row->acc == "0") {
                                                        echo "<div class='label label-danger'>NO</div>";
                                                    }
                                                    ?>
                                                </td>
                                                <!-- END BASIC -->
                                                <!-- MENU -->
                                                <td style="vertical-align : middle;text-align:center;">
                                                    <?php
                                                    if ($row->menu1 == "1") {
                                                        echo "<div class='label label-success'>YES</div>";
                                                    } else if ($row->menu1 == "0") {
                                                        echo "<div class='label label-danger'>NO</div>";
                                                    }
                                                    ?>
                                                </td>
                                                <td style="vertical-align : middle;text-align:center;">
                                                    <?php
                                                    if ($row->menu2 == "1") {
                                                        echo "<div class='label label-success'>YES</div>";
                                                    } else if ($row->menu2 == "0") {
                                                        echo "<div class='label label-danger'>NO</div>";
                                                    }
                                                    ?>
                                                </td>
                                                <td style="vertical-align : middle;text-align:center;">
                                                    <?php
                                                    if ($row->menu3 == "1") {
                                                        echo "<div class='label label-success'>YES</div>";
                                                    } else if ($row->menu3 == "0") {
                                                        echo "<div class='label label-danger'>NO</div>";
                                                    }
                                                    ?>
                                                </td>
                                                <td style="vertical-align : middle;text-align:center;">
                                                    <?php
                                                    if ($row->menu4 == "1") {
                                                        echo "<div class='label label-success'>YES</div>";
                                                    } else if ($row->menu4 == "0") {
                                                        echo "<div class='label label-danger'>NO</div>";
                                                    }
                                                    ?>
                                                </td>
                                                <td style="vertical-align : middle;text-align:center;">
                                                    <?php
                                                    if ($row->menu5 == "1") {
                                                        echo "<div class='label label-success'>YES</div>";
                                                    } else if ($row->menu5 == "0") {
                                                        echo "<div class='label label-danger'>NO</div>";
                                                    }
                                                    ?>
                                                </td>
                                                <td style="vertical-align : middle;text-align:center;">
                                                    <?php
                                                    if ($row->menu6 == "1") {
                                                        echo "<div class='label label-success'>YES</div>";
                                                    } else if ($row->menu6 == "0") {
                                                        echo "<div class='label label-danger'>NO</div>";
                                                    }
                                                    ?>
                                                </td>
                                                <td style="vertical-align : middle;text-align:center;">
                                                    <?php
                                                    if ($row->menu7 == "1") {
                                                        echo "<div class='label label-success'>YES</div>";
                                                    } else if ($row->menu7 == "0") {
                                                        echo "<div class='label label-danger'>NO</div>";
                                                    }
                                                    ?>
                                                </td>
                                                <td style="vertical-align : middle;text-align:center;">
                                                    <?php
                                                    if ($row->menu8 == "1") {
                                                        echo "<div class='label label-success'>YES</div>";
                                                    } else if ($row->menu8 == "0") {
                                                        echo "<div class='label label-danger'>NO</div>";
                                                    }
                                                    ?>
                                                </td>
                                                <td style="vertical-align : middle;text-align:center;">
                                                    <?php
                                                    if ($row->menu9 == "1") {
                                                        echo "<div class='label label-success'>YES</div>";
                                                    } else if ($row->menu9 == "0") {
                                                        echo "<div class='label label-danger'>NO</div>";
                                                    }
                                                    ?>
                                                </td>
                                                <td style="vertical-align : middle;text-align:center;">
                                                    <?php
                                                    if ($row->menu10 == "1") {
                                                        echo "<div class='label label-success'>YES</div>";
                                                    } else if ($row->menu10 == "0") {
                                                        echo "<div class='label label-danger'>NO</div>";
                                                    }
                                                    ?>
                                                </td>
                                                <!-- END MENU -->
                                                <div class="btn-group-vertical">
                                                    <td>
                                                        <a href="edit_grup_user?id=<?php echo $row->id_user; ?>" class="btn btn-sm btn-warning text-black"><i class="fa fa-edit"></i></a>
                                                    </td>
                                                    <td>
                                                        <a href="" class="btn btn-sm btn-danger text-black" data-toggle="modal" data-target="#hapus<?php echo $row->id_user; ?>"><i class="fa fa-trash"></i></a>
                                                        <div class="modal fade" id="hapus<?php echo $row->id_user; ?>">
                                                            <form id="form" method="post" action="" enctype="multipart/form-data">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span></button>
                                                                            <h4 class="modal-title">Hapus Grup</h4>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="box-body">
                                                                                <div class="form-group">
                                                                                    <div class="row">
                                                                                        <label class="col-sm-3 control-label text-right">Nama Grup <span class="text-red">*</span></label>
                                                                                        <div class="col-sm-8">
                                                                                            <input type="text" class="form-control text-capitalize" name="" value="<?php echo $row->tipe; ?>" readonly>
                                                                                        </div>
                                                                                    </div>
                                                                                </div><br>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <input type="hidden" name="id_user" value="<?php echo $row->id_user; ?>" readonly>
                                                                            <button type="submit" name="hapus" class="btn btn-primary"><i class="fa fa-save" aria-hidden="true"></i> Save</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </div>
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
    </section>
</div>
<?php include_once('template/footer.php') ?>
<script>
    window.setTimeout(function() {
        $(".alert").fadeTo(150, 0).slideUp(150, function() {
            $($this).remove();
        });
    }, 1500)
</script>