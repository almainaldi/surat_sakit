<?php
include_once('template/header.php');
include_once('class/user.php');
include_once('class/menu.php');
$user = new user();
$menu = new menu();

if (isset($_POST['tombol'])) {
    $data = array(
        "id_user" => $_POST['id_user'],
        "tipe" => $_POST['tipe'],

        "lihat" => $_POST['lihat'],
        "print" => $_POST['print'],
        "tambah" => $_POST['tambah'],
        "edit" => $_POST['edit'],
        "hapus" => $_POST['hapus'],
        "acc" => $_POST['acc'],

        "menu1" => $_POST['menu1'],
        "menu2" => $_POST['menu2'],
        "menu3" => $_POST['menu3'],
        "menu4" => $_POST['menu4'],
        "menu5" => $_POST['menu5'],
        "menu6" => $_POST['menu6'],
        "menu7" => $_POST['menu7'],
        "menu8" => $_POST['menu8'],
        "menu9" => $_POST['menu9'],
        "menu10" => $_POST['menu10']
    );

    if ($user->tambah_grup($data)) {
        header("location:tampil_grup_user");
    } else {
        header("location:tambah_grup_user?pesan=gagal");
    }
}

?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            TAMBAH GRUP USER
        </h1>
        <ol class="breadcrumb">
            <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Tambah Grup User</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <?php
                        if (isset($_GET['pesan'])) {
                            if ($_GET['pesan'] == "gagal") {
                                echo "<div class='alert alert-danger'>Data Gagal Ditambahkan</div>";
                            }
                        }
                        ?>
                    </div>
                    <div class="box-body">
                        <div class="col-sm-8">
                            <!-- SEBELAH KIRI-->
                            <section class="content">
                                <div class="row">
                                    <div class="box box-info">
                                        <div class="box-body">
                                            <form id="form" class="form-horizontal" method="post" action="">
                                                <div class="box-body">
                                                    <div class="form-group">
                                                        <label for="username" class="col-sm-2 control-label">Nama Group : </label>

                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control" name="tipe" id="tipe">
                                                            <input type="hidden" class="form-control" name="id_user" id="id_user">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-sm-4"></div>
                                                        <div class="col-sm-4" style="text-align: center;"><b>
                                                                <h2>AKSES LEVEL :</h2>
                                                            </b></div>
                                                        <div class="col-sm-4"></div><br>
                                                    </div>
                                                    <!-- BASIC -->
                                                    <div class="col-sm-4">
                                                        <!-- LIHAT -->
                                                        <div class="form-group">
                                                            <label for="klasifikasi" class="col-sm-4 control-label">LIHAT : </label>
                                                            <div class="col-sm-2"><label><input type="radio" name="lihat" id="lihat_no" value="0"> NO</label>
                                                            </div>
                                                            <div class="col-sm-2"><label><input type="radio" name="lihat" id="lihat_yes" value="1"> YES</label></div>
                                                        </div>
                                                        <!-- END LIHAT -->

                                                        <!-- PRINT -->
                                                        <div class="form-group">
                                                            <label for="klasifikasi" class="col-sm-4 control-label">PRINT : </label>
                                                            <div class="col-sm-2"><label><input type="radio" name="print" id="print_no" value="0"> NO</label></div>
                                                            <div class="col-sm-2"><label><input type="radio" name="print" id="print_yes" value="1"> YES</label></div>
                                                        </div>
                                                        <!-- END PRINT -->

                                                        <!-- TAMBAH -->
                                                        <div class="form-group">
                                                            <label for="klasifikasi" class="col-sm-4 control-label">TAMBAH : </label>
                                                            <div class="col-sm-2"><label><input type="radio" name="tambah" id="tambah_no" value="0"> NO</label></div>
                                                            <div class="col-sm-2"><label><input type="radio" name="tambah" id="tambah_yes" value="1"> YES</label></div>
                                                        </div>
                                                        <!-- END TAMBAH -->

                                                        <!-- EDIT -->
                                                        <div class="form-group">
                                                            <label for="klasifikasi" class="col-sm-4 control-label">EDIT : </label>
                                                            <div class="col-sm-2"><label><input type="radio" name="edit" id="edit_no" value="0"> NO</label></div>
                                                            <div class="col-sm-2"><label><input type="radio" name="edit" id="edit_yes" value="1"> YES</label></div>
                                                        </div>
                                                        <!-- END EDIT -->

                                                        <!-- HAPUS -->
                                                        <div class="form-group">
                                                            <label for="klasifikasi" class="col-sm-4 control-label">HAPUS : </label>
                                                            <div class="col-sm-2"><label><input type="radio" name="hapus" id="hapus_no" value="0"> NO</label></div>
                                                            <div class="col-sm-2"><label><input type="radio" name="hapus" id="hapus_yes" value="1"> YES</label></div>
                                                        </div>
                                                        <!-- END HAPUS -->

                                                        <div class="form-group">
                                                            <label for="klasifikasi" class="col-sm-4 control-label">ACC : </label>
                                                            <div class="col-sm-2"><label><input type="radio" name="acc" id="acc_no" value="0"> NO</label></div>
                                                            <div class="col-sm-2"><label><input type="radio" name="acc" id="acc_yes" value="1"> YES</label></div>
                                                        </div>
                                                    </div>
                                                    <!-- END BASIC -->

                                                    <!-- MENU -->
                                                    <div class="col-sm-4">
                                                        <!-- MENU 1 -->
                                                        <div class="form-group">
                                                            <label for="klasifikasi" class="col-sm-4 control-label">MENU 1 : </label>
                                                            <div class="col-sm-2"><label><input type="radio" name="menu1" id="menu1_no" value="0"> NO</label></div>
                                                            <div class="col-sm-2"><label><input type="radio" name="menu1" id="menu1_yes" value="1"> YES</label></div>
                                                        </div>
                                                        <!-- END MENU 1 -->

                                                        <!-- MENU 2 -->
                                                        <div class="form-group">
                                                            <label for="klasifikasi" class="col-sm-4 control-label">MENU 2 : </label>
                                                            <div class="col-sm-2"><label><input type="radio" name="menu2" id="menu2_no" value="0"> NO</label></div>
                                                            <div class="col-sm-2"><label><input type="radio" name="menu2" id="menu2_yes" value="1"> YES</label></div>
                                                        </div>
                                                        <!-- END MENU 2 -->

                                                        <!-- MENU 3 -->
                                                        <div class="form-group">
                                                            <label for="klasifikasi" class="col-sm-4 control-label">MENU 3 : </label>
                                                            <div class="col-sm-2"><label><input type="radio" name="menu3" id="menu3_no" value="0"> NO</label></div>
                                                            <div class="col-sm-2"><label><input type="radio" name="menu3" id="menu3_yes" value="1"> YES</label></div>
                                                        </div>
                                                        <!-- END MENU 3 -->

                                                        <!-- MENU 4 -->
                                                        <div class="form-group">
                                                            <label for="klasifikasi" class="col-sm-4 control-label">MENU 4 : </label>
                                                            <div class="col-sm-2"><label><input type="radio" name="menu4" id="menu4_no" value="0"> NO</label></div>
                                                            <div class="col-sm-2"><label><input type="radio" name="menu4" id="menu4_yes" value="1"> YES</label></div>
                                                        </div>
                                                        <!-- END MENU 4 -->

                                                        <!-- MENU 5 -->
                                                        <div class="form-group">
                                                            <label for="klasifikasi" class="col-sm-4 control-label">MENU 5 : </label>
                                                            <div class="col-sm-2"><label><input type="radio" name="menu5" id="menu5_no" value="0"> NO</label></div>
                                                            <div class="col-sm-2"><label><input type="radio" name="menu5" id="menu5_yes" value="1"> YES</label></div>
                                                        </div>
                                                        <!-- END MENU 5 -->

                                                        <!-- MENU 6 -->
                                                        <div class="form-group">
                                                            <label for="klasifikasi" class="col-sm-4 control-label">MENU 6 : </label>
                                                            <div class="col-sm-2"><label><input type="radio" name="menu6" id="menu6_no" value="0"> NO</label></div>
                                                            <div class="col-sm-2"><label><input type="radio" name="menu6" id="menu6_yes" value="1"> YES</label></div>
                                                        </div>
                                                        <!-- END MENU 6 -->

                                                        <!-- MENU 7 -->
                                                        <div class="form-group">
                                                            <label for="klasifikasi" class="col-sm-4 control-label">MENU 7 : </label>
                                                            <div class="col-sm-2"><label><input type="radio" name="menu7" id="menu7_no" value="0"> NO</label></div>
                                                            <div class="col-sm-2"><label><input type="radio" name="menu7" id="menu7_yes" value="1"> YES</label></div>
                                                        </div>
                                                        <!-- END MENU 7 -->

                                                        <!-- MENU 8 -->
                                                        <div class="form-group">
                                                            <label for="klasifikasi" class="col-sm-4 control-label">MENU 8 : </label>
                                                            <div class="col-sm-2"><label><input type="radio" name="menu8" id="menu8_no" value="0"> NO</label></div>
                                                            <div class="col-sm-2"><label><input type="radio" name="menu8" id="menu8_yes" value="1"> YES</label></div>
                                                        </div>
                                                        <!-- END MENU 8 -->

                                                        <!-- MENU 9 -->
                                                        <div class="form-group">
                                                            <label for="klasifikasi" class="col-sm-4 control-label">MENU 9 : </label>
                                                            <div class="col-sm-2"><label><input type="radio" name="menu9" id="menu9_no" value="0"> NO</label></div>
                                                            <div class="col-sm-2"><label><input type="radio" name="menu9" id="menu9_yes" value="1"> YES</label></div>
                                                        </div>
                                                        <!-- END MENU 9 -->

                                                        <!-- MENU 10 -->
                                                        <div class="form-group">
                                                            <label for="klasifikasi" class="col-sm-4 control-label">MENU 10 : </label>
                                                            <div class="col-sm-2"><label><input type="radio" name="menu10" id="menu10_no" value="0"> NO</label></div>
                                                            <div class="col-sm-2"><label><input type="radio" name="menu10" id="menu10_yes" value="1"> YES</label></div>
                                                        </div>
                                                        <!-- END MENU 10 -->
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-sm-10" align="center">
                                                            <a href="#" id="no-button" class="btn btn-danger">SEMUA NO</a>
                                                            <a href="#" id="yes-button" class="btn btn-success">SEMUA YES</a><br><br>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="box-footer">
                                                    <a href="tampil_grup_user" class="btn btn-warning">Kembali</a>
                                                    <button type="submit" name="tombol" class="btn btn-info pull-right">Simpan Data</button>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div><!-- END SEBELAH KIRI-->
                        <div class="col-sm-4">
                            <!-- SEBELAH KANAN-->
                            <section class="content">
                                <div class="row">
                                    <div class="box box-info">
                                        <div class="box-header with-border">
                                            INFO :
                                        </div>

                                        <div class="box-body">
                                            Menu 1 untuk hak akses <b><?php $id = '1';
                                                                        $hasil = $menu->nama($id);
                                                                        echo $hasil; ?></b> <br>
                                            <p></p>
                                            Menu 2 untuk hak akses <b><?php $id = '2';
                                                                        $hasil = $menu->nama($id);
                                                                        echo $hasil; ?></b> <br>
                                            <p></p>
                                            Menu 3 untuk hak akses <b><?php $id = '3';
                                                                        $hasil = $menu->nama($id);
                                                                        echo $hasil; ?></b> <br>
                                            <p></p>
                                            Menu 4 untuk hak akses <b><?php $id = '4';
                                                                        $hasil = $menu->nama($id);
                                                                        echo $hasil; ?></b> <br>
                                            <p></p>
                                            Menu 5 untuk hak akses <b><?php $id = '5';
                                                                        $hasil = $menu->nama($id);
                                                                        echo $hasil; ?></b> <br>
                                            <p></p>

                                            Menu 6 untuk hak akses <b><?php $id = '6';
                                                                        $hasil = $menu->nama($id);
                                                                        echo $hasil; ?></b> <br>
                                            <p></p>
                                            Menu 7 untuk hak akses <b><?php $id = '7';
                                                                        $hasil = $menu->nama($id);
                                                                        echo $hasil; ?></b> <br>
                                            <p></p>
                                            Menu 8 untuk hak akses <b><?php $id = '8';
                                                                        $hasil = $menu->nama($id);
                                                                        echo $hasil; ?></b> <br>
                                            <p></p>
                                            Menu 9 untuk hak akses <b><?php $id = '9';
                                                                        $hasil = $menu->nama($id);
                                                                        echo $hasil; ?></b> <br>
                                            <p></p>
                                            Menu 10 untuk hak akses <b><?php $id = '10';
                                                                        $hasil = $menu->nama($id);
                                                                        echo $hasil; ?></b> <br>
                                            <p></p>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div><!-- END SEBELAH KANAN-->
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php
include_once('template/footer.php');
?>
<script type="text/javascript">
    document.getElementById('no-button').addEventListener('click', function() {
        ["lihat_no", "print_no", "tambah_no", "edit_no", "hapus_no", "acc_no",
            "menu1_no", "menu2_no", "menu3_no", "menu4_no", "menu5_no", "menu6_no", "menu7_no", "menu8_no", "menu9_no", "menu10_no"
        ].forEach(function(id) {
            document.getElementById(id).checked = true;
        });
        return true;
    })
</script>

<script type="text/javascript">
    document.getElementById('yes-button').addEventListener('click', function() {
        ["lihat_yes", "print_yes", "tambah_yes", "edit_yes", "hapus_yes", "acc_yes",
            "menu1_yes", "menu2_yes", "menu3_yes", "menu4_yes", "menu5_yes", "menu6_yes", "menu7_yes", "menu8_yes", "menu9_yes", "menu10_yes"
        ].forEach(function(id) {
            document.getElementById(id).checked = true;
        });
        return true;
    })
</script>