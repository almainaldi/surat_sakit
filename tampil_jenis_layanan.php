<!DOCTYPE html>
<html>
<title>LPS | Jenis Layanan</title>
<?php
include_once('template/header.php');
include_once('class/jenis_layanan.php');

$jenis_layanan   = new jenis_layanan();

$data_jenis_layanan      = $jenis_layanan->tampil_data();

if (isset($_POST['tombol'])) {
     $data = array(

          "id_jenis"  => $_POST['id_jenis'],
          "nama"  => $_POST['nama']
     );
     if ($jenis_layanan->tambah($data)) {
          header("location:tampil_jenis_layanan?pesan=success");
     } else {
          header("location:tampil_jenis_layanan?pesan=gagal");
     }
}

if (isset($_POST['update'])) {
     $data = array(

          "id_jenis" => $_POST['id_jenis'],
          "nama" => $_POST['nama']
     );
     if ($jenis_layanan->edit($data)) {
          header("location:tampil_jenis_layanan?pesan=success");
     } else {
          header("location:tampil_jenis_layanan?pesan=gagal");
     }
}

if (isset($_GET['hapus_id'])) {
     if ($jenis_layanan->cek_id($_GET['hapus_id'])) {
          if ($jenis_layanan->hapus($_GET['hapus_id'])) {
               header("location:tampil_jenis_layanan?pesan=hapus");
          } else {
               header("location:tampil_jenis_layanan?pesan=gagal");
          }
     } else {
          header("location:tampil_jenis_layanan");
     }
}
?>
<script src="class/validasi_form/jenis_layanan.js" type="text/javascript"></script>
<div class="content-wrapper">
     <section class="content-header">
          <h1>
               Master Jenis Layanan
          </h1>
          <ol class="breadcrumb">
               <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
               <li class="active">Master Jenis Layanan</li>
          </ol>
     </section>
     <div>

          <div class="container-fluid col-sm-12 col-md-3">
               <div class="card card-success">
                    <div class="card-body">
                         <div class="box box-primary box-solid">
                              <div class="box-header with-border">
                                   <h3 class="box-title text-black"><i class="fa fa-cube"></i> Form Input Jenis Layanan <i class="fa fa-cube"></i></h3>
                              </div>
                              <form class="form" id="form" name="form" method="post" action="">
                                   <div class="box-body">
                                        <div class="row">
                                             <div class="col-md-12">
                                                  <div class="form-group">
                                                       <label class="col-xs-4 control-label">Jenis Layanan</label>
                                                       <div class="col-xs-8">
                                                            <input type="text" class="form-control" name="nama" onkeyup="this.value = this.value.toUpperCase()" autocomplete="off" placeholder="Input Jenis Layanan">
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>
                                        <div class=" box-footer">
                                             <button type="submit" name="tombol" class="btn btn-info pull-right"><i class="fa fa-save"> Simpan</i></button>
                                        </div>
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
                                                            <th class="text-center">Jenis Layanan</th>
                                                            <th class="text-center">ACTION</th>
                                                       </tr>
                                                  </thead>
                                                  <tbody>
                                                       <?php
                                                       if ($data_jenis_layanan->num_rows > 0) {
                                                            $no = 1;
                                                            while ($row = mysqli_fetch_array($data_jenis_layanan)) { ?>
                                                                 <tr>
                                                                      <td style="vertical-align : middle;text-align:center;"><b><?php echo $no++ ?></b></td>
                                                                      <td style="vertical-align : middle;"><b><?php echo $row['nama'] ?></b></td>
                                                                      <td style="vertical-align : middle;text-align:center;">
                                                                           <?php if ($_SESSION['edit'] == "1") { ?>
                                                                                <!-- EDIT -->
                                                                                <a href="" class="btn btn-sm btn-warning text-black" data-toggle="modal" data-target="#edit2<?php echo $row['id_jenis']; ?>"><i class="fa fa-edit"></i></a>
                                                                                <div class="modal fade" id="edit2<?php echo $row['id_jenis']; ?>">
                                                                                     <form id="form" method="post" action="" enctype="multipart/form-data">
                                                                                          <div class="modal-dialog">
                                                                                               <div class="modal-content">
                                                                                                    <div class="modal-header">
                                                                                                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                              <span aria-hidden="true">&times;</span></button>
                                                                                                         <h4 class="modal-title">Edit Data Jenis Layanan</h4>
                                                                                                    </div>
                                                                                                    <div class="modal-body">
                                                                                                         <div class="box-body">
                                                                                                              <div class="form-group">
                                                                                                                   <table>
                                                                                                                        <tr>
                                                                                                                             <th style="width: 30%;">Jenis Layanan</th>
                                                                                                                             <th style="width: 10%;">:</th>
                                                                                                                             <th style="width: 60%;"><input type="text" class="form-control" name="nama" id="nama" value="<?php echo $row['nama']; ?>" onkeyup="this.value = this.value.toUpperCase()" autocomplete="off"></th>
                                                                                                                        </tr>
                                                                                                                   </table>
                                                                                                              </div>
                                                                                                         </div>
                                                                                                    </div>
                                                                                                    <div class="modal-footer">
                                                                                                         <input type="hidden" name="id_jenis" value="<?php echo $row['id_jenis']; ?>" readonly>
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

                                                                           <!-- HAPUS -->
                                                                           <?php if ($_SESSION['hapus'] == "1") { ?>
                                                                                <a title="Hapus" title="Hapus Data" href="tampil_jenis_layanan?hapus_id=<?php echo $row['id_jenis']; ?>">
                                                                                     <button class="btn btn-danger btn-sm text-black"><i class="fa fa-trash"> </i></button>
                                                                                </a>
                                                                           <?php } ?>
                                                                           <!-- END HAPUS -->
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