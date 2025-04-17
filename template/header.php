<?php
ob_start();
session_start();
date_default_timezone_set('Asia/Jakarta');
include_once('class/user.php');
include_once('class/config.php');
$config = new config();
$user = new user();
$user->cek_login();
$user->cek_app();

$timeout = 1; // setting timeout dalam menit
$logout = "logout"; // redirect halaman logout
$timeout = $timeout * 600000; // menit ke detik ('600000' sepuluh menit tidak ada aktivitas logout otomatis) 600000000

$datas = array(
  "username" => $_SESSION['username'],
);

if (isset($_SESSION['start_session'])) {
  $elapsed_time = time() - $_SESSION['start_session'];
  if ($elapsed_time >= $timeout) {
    echo "<script type='text/javascript'>alert('Waktu anda telah berakhir');window.location='$logout'</script>";
  }
}

$_SESSION['start_session'] = time();
?>



<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>LPS | Aplikasi Surat Sakit</title>
  <!-- summernote -->
  <link rel="shorcut icon" href="master_gambar/logo.jpg">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="assets/master/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/master/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="assets/master/bower_components/Ionicons/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="assets/master/bower_components/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="assets/master/bower_components/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="assets/master/bower_components/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/master/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
      folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="assets/master/dist/css/skins/_all-skins.min.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">

  <!-- Tambah Banyak Data -->
  <script src="assets/jd/jquery-v1.9.1.js"></script>
  <!-- jQuery 3 -->
  <script src="assets/master/bower_components/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="assets/master/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- DataTables -->
  <script src="assets/master/bower_components/datatables/jquery.dataTables.min.js"></script>
  <script src="assets/master/bower_components/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="assets/master/bower_components/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="assets/master/bower_components/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="assets/master/bower_components/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="assets/master/bower_components/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="assets/master/bower_components/jszip/jszip.min.js"></script>
  <script src="assets/master/bower_components/pdfmake/pdfmake.min.js"></script>
  <script src="assets/master/bower_components/pdfmake/vfs_fonts.js"></script>
  <script src="assets/master/bower_components/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="assets/master/bower_components/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="assets/master/bower_components/datatables-buttons/js/buttons.colVis.min.js"></script>
  <!-- SlimScroll -->
  <script src="assets/master/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
  <!-- FastClick -->
  <script src="assets/master/bower_components/fastclick/lib/fastclick.js"></script>
  <!-- AdminLTE App -->
  <script src="assets/master/dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="assets/master/dist/js/demo.js"></script>
  <!-- Select2 -->
  <link rel="stylesheet" href="assets/master/bower_components/select2/dist/css/select2.min.css">
  <script src="assets/master/bower_components/select2/dist/js/select2.min.js"></script>
  <!-- Select2 -->
  <script src="assets/master/bower_components/select2/dist/js/select2.full.min.js"></script>

  <script src="assets/js/validasi/dist/jquery.validate.js"></script>
  <!-- Sparkline -->
  <script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
  <!-- jvectormap  -->
  <script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
  <script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="dist/js/pages/dashboard2.js"></script>

  <!-- GRAFIK LINE CHAT -->
  <!-- Morris charts -->
  <link rel="stylesheet" href="assets/master/bower_components/morris.js/morris.css">
  <!-- Morris.js charts -->
  <script src="assets/master/bower_components/raphael/raphael.min.js"></script>
  <script src="assets/master/bower_components/morris.js/morris.min.js"></script>

  <!-- InputMask -->
  <script src="assets/master/bower_components/moment/moment.min.js"></script>
  <script src="assets/master/bower_components/inputmask/jquery.inputmask.min.js"></script>

  <!-- InputMask -->
  <script src="assets/master/bower_components_2/plugins/moment/moment.min.js"></script>
  <script src="assets/master/bower_components_2/plugins/inputmask/jquery.inputmask.min.js"></script>

  <!-- ini untuk date picker -->
  <link rel="stylesheet" href="assets/master/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <script src="assets/master/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
  <!-- ini untuk date picker -->
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
  <script>
    window.setTimeout(function() {
      $(".alert").fadeTo(300, 0).slideUp(300, function() {
        $($this).remove();
      });
    }, 3000)
  </script>

  <!-- Select2 -->
  <script>
    $(function() {
      $('.select2').select2()
    });
    $(document).ready(function() {
      $('.js-example-basic-single').select2();
    });
  </script>

  <style type="text/css">
    .error {
      display: block;
      font-size: small;
      margin-top: 5px;
    }

    .error {
      font-size: small;
      color: red;
    }
  </style>

  <!-- DATA TABEL -->
  <script>
    $(function() {
      $("#example1").DataTable({
        //"responsive": true,
        "lengthChange": true,
        "ordering": true,
        "autoWidth": false,
        "buttons": ["csv", "excel", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>
  <!-- END DATA TABEL -->
</head>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    <header class="main-header">
      <a href="home" class="logo">
        <span class="logo-mini"><b>LPS</b></span>
        <span class="logo-lg"><b>SURAT SAKIT</b></span>
      </a>
      <nav class="navbar navbar-static-top">
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </a>

        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <?php
            if (isset($_POST['keluar'])) {
              $data['username'] = $_POST['username'];

              $data['id'] = $_POST['id'];
              $data['jam'] = $_POST['jam'];
              $data['tgl'] = $_POST['tgl'];
              $data['status'] = $_POST['status'];

              if ($user->status_offline($data)) {
                $user->online($data);
                header("location:logout");
              }
            }
            ?>
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <?php if ($_SESSION['gambar'] == '') { ?>
                  <img src="master_gambar/user/polos.png" class="user-image" alt="User Image">
                <?php } else { ?>
                  <img src="master_gambar/user/<?php echo $_SESSION['gambar']; ?>" class="user-image" alt="User Image">
                <?php } ?>
                <span class="hidden-xs"><?php echo $_SESSION['nama']; ?></span>
              </a>
              <ul class="dropdown-menu">
                <li class="user-header">
                  <?php if ($_SESSION['gambar'] == '') { ?>
                    <img src="master_gambar/user/polos.png" class="img-circle" alt="User Image">
                  <?php } else { ?>
                    <img src="master_gambar/user/<?php echo $_SESSION['gambar']; ?>" class="img-circle" alt="User Image">
                  <?php } ?>
                  <p>
                    <?php echo $_SESSION['nama']; ?>
                </li>
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="user_profil" class="btn btn-default btn-flat">Profil</a>
                  </div>
                  <div class="pull-right">
                    <form action="" method="post">
                      <input type="hidden" name="id" class="form-control">
                      <input type="hidden" name="username" class="form-control" value="<?php echo $_SESSION['username']; ?>">
                      <input type="hidden" name="jam" class="form-control" value="<?php echo date('H:i:s'); ?>">
                      <input type="hidden" name="tgl" class="form-control" value="<?php echo date('Y-m-d'); ?>">
                      <input type="hidden" name="status" class="form-control" value="KELUAR">
                      <button type="submit" name="keluar" class="btn btn-default btn-flat">Sign out</button>
                    </form>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </nav>
    </header>
    <aside class="main-sidebar">
      <section class="sidebar">
        <div class="user-panel">
          <div class="pull-left image">
            <img src="master_gambar/user/<?php echo $_SESSION['gambar']; ?>" class="img-circle" alt="User Image">
          </div>
          <div class="pull-left info">
            <p><?php echo $_SESSION['nama']; ?></p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
          </div>
        </div>
        <ul class="sidebar-menu" data-widget="tree">
          <li class="header">MAIN NAVIGATION</li>
          <li><a href="home"><i class="fa fa-home"></i> <span>Home</span></a></li>
          <!-- MASTER DATA -->
          <?php if ($_SESSION['menu1'] == "1") { ?>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-database"></i> <span>Master Data</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="tampil_jenis_layanan"><i class="fa fa-circle-o"></i>Jenis Layanan</a></li>
                <li><a href="tampil_klinik"><i class="fa fa-circle-o"></i>Klinik</a></li>
                <li><a href="tampil_jabatan"><i class="fa fa-circle-o"></i>Jabatan</a></li>
                <li><a href="tampil_karyawan"><i class="fa fa-circle-o"></i>Karyawan</a></li>
              </ul>
            </li>
          <?php } ?>
          <!-- END MASTER DATA -->

          <!-- SELURUH DATA DO -->
          <?php if ($_SESSION['menu2'] == "1") { ?>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-folder-open-o"></i> <span>Seluruh Data</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="tampil_seluruh_surat_rujukan"><i class="fa fa-circle-o"></i>Data Surat Rujukan</a></li>
                <li><a href="tampil_seluruh_biaya_berobat"><i class="fa fa-circle-o"></i>Data Biaya Berobat</a></li>
                <li><a href="tampil_seluruh_rekap_berobat"><i class="fa fa-circle-o"></i>Data Rekam Medis</a></li>
              </ul>
            </li>
          <?php } ?>

          <!-- END SELURUH DATA DO -->

          <!-- DATA DO -->
          <?php if ($_SESSION['menu3'] == "1") { ?>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-desktop"></i> <span>Input Data</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="tampil_surat_rujukan"><i class="fa fa-circle-o"></i>Surat Rujukan</a></li>
                <li><a href="tampil_biaya_berobat"><i class="fa fa-circle-o"></i>Biaya Berobat</a></li>
                <li><a href="tampil_rekap_berobat"><i class="fa fa-circle-o"></i>Rekam Medis</a></li>
              </ul>
            </li>
          <?php } ?>
          <!-- END DATA DO -->

          <!-- DATA realisasi -->
          <?php if ($_SESSION['menu4'] == "1") { ?>

          <?php } ?>
          <!-- END DATA realisasi -->

          <!-- Container -->
          <?php if ($_SESSION['menu5'] == "1") { ?>

          <?php } ?>
          <!-- END Container -->

          <!-- IN / OUT Kendaraan -->
          <?php if ($_SESSION['menu6'] == "1") { ?>

          <?php } ?>
          <!-- END IN / OUT Kendaraan -->

          <?php if ($_SESSION['menu7'] == "1") { ?>

          <?php } ?>

          <!-- Gambar -->
          <?php if ($_SESSION['menu8'] == "1") {
          ?>

          <?php }
          ?>
          <!-- END Gambar -->

          <!-- END LAPORAN -->
          <?php if ($_SESSION['menu9'] == "1") { ?>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-folder-open"></i> <span>Laporan</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="laporan_biaya_karyawan"><i class="fa fa-circle-o"></i>Laporan Data Karyawan</a></li>
                <li><a href="laporan_rinci_karyawan"><i class="fa fa-circle-o"></i>Laporan Rincian Data Karyawan</a></li>
              </ul>
            </li>
          <?php } ?>
          <!-- LAPORAN -->

          <!-- Manajemen User -->
          <?php if ($_SESSION['menu10'] == "1") { ?>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-gear"></i> <span>Manajemen User</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="tampil_user"><i class="fa fa-circle-o"></i>DATA USER</a></li>
                <li><a href="tampil_grup_user"><i class="fa fa-circle-o"></i>GROUP USER</a></li>
              </ul>
            </li>
          <?php } ?>
          <!-- Manajemen User -->
        </ul>
      </section>
    </aside>