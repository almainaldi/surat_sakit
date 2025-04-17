<!DOCTYPE html>
<html>
<?php
ob_start();
session_start();
include_once('class/surat_rujukan.php');

$surat_rujukan   = new surat_rujukan();

if (!empty($_GET['id'])) // Ngecek ID apakah sesuai dan ada di database
{
  $id = $_GET['id'];
  if ($surat_rujukan->cek_id($id)) {
    $data = $surat_rujukan->get_by_id($id); // hasil dari DB
  } else {
    header("location:tampil_surat_rujukan?pesan=gagal");
  }
} else {
  header("location:tampil_surat_rujukan?pesan=gagal");
}

?>
<!-- <script src="class/validasi_form/surat_rujukan.js" type="text/javascript"></script>
<script src="class/validasi_form/app.js" type="text/javascript"></script> -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 style="text-align: center;">Edit Data Surat Rujukan</h3>
        </div>
        <form id="form" class="form-horizontal" method="post" action="">
          <form class="form-horizontal">
            <div class="box-body">
              <table>
                <tbody>
                  <tr>
                    <th style="width: 30%">Nama</th>
                    <th style="width: 10%">:</th>
                    <th style="width: 60%">
                    <input type="text" class="form-control" name="nama" id="nama" value="<?php echo $data['nama_kar']; ?>" readonly>
                    </th>
                  </tr>
                    <th>
                      <div><br></div>
                    </th>
                  </tr><!-- END ENTER -->
                  <tr>
                    <th style="width: 30%">Memo</th>
                    <th style="width: 10%">:</th>
                    <th style="width: 60%">
                    <textarea class="form-control" name="note" id="note" placeholder="Input Memo" rows="5"></textarea>
                    </th>
                  </tr>
                </tbody>
              </table>
              <input type="hidden" name="status" class="form-control" value="2">
              <input type="hidden" name="id_surat" class="form-control" value="<?php echo $data['id_surat'] ?>">
            </div>
            <div class="box-footer">
              <!-- <button type="submit" name="tombol" class="btn btn-info pull-left">Simpan Data</button> -->
              <a href="tampil_surat_rujukan" button onclick="window.close()" class="btn btn-primary pull-left">Close</a>
              <button type="submit" name="updatein" class="btn btn-primary pull-right"><i class="fa fa-save" aria-hidden="true"></i> Save</button>
            </div>
      </div>
    </div>
</section>
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
</body>

</html>