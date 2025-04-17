<?php 
include_once('koneksi.php');
class home extends koneksi{
	function jumlah_surat_rujukan()
     {
          $query = $this->con->query("SELECT COUNT(id_surat) as jumlah FROM surat_rujukan");
          $hasil = $query->fetch_array();
          return $hasil['jumlah'];
     }

     function jumlah_sr_on_proses()
     {
          $query = $this->con->query("SELECT COUNT(id_surat) as jumlah FROM surat_rujukan where status ='1' and acc = '1'");
          $hasil = $query->fetch_array();
          return $hasil['jumlah'];
     }

	 function jumlah_sr_belum_acc()
     {
          $query = $this->con->query("SELECT COUNT(id_surat) as jumlah FROM surat_rujukan where status ='0'");
          $hasil = $query->fetch_array();
          return $hasil['jumlah'];
     }

	 function jumlah_biaya_berobat()
     {
          $query = $this->con->query("SELECT COUNT(id_berobat) as jumlah FROM biaya_berobat");
          $hasil = $query->fetch_array();
          return $hasil['jumlah'];
     }

	 function jumlah_rekam_medis()
     {
          $query = $this->con->query("SELECT COUNT(id_rekap) as jumlah FROM rekap_berobat");
          $hasil = $query->fetch_array();
          return $hasil['jumlah'];
     }

     function jumlah_batal_berobat()
     {
          $query = $this->con->query("SELECT COUNT(id_surat) as jumlah FROM surat_rujukan WHERE note != ''");
          $hasil = $query->fetch_array();
          return $hasil['jumlah'];
     }
}
