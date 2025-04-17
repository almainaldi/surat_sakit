<?php 
include_once('koneksi.php');
class laporan_biaya_karyawan extends koneksi{
	function tampil_data()
	{
		$query = $this->con->query("SELECT a.* FROM detail_laporan_biaya_karyawan a WHERE CONCAT(YEAR(tgl),'/',MONTH(tgl))=CONCAT(YEAR(NOW()),'/',MONTH(NOW())) ORDER BY a.total_biaya DESC");
	    return $query;
	}

	function tampil_data_search($data)
	{
		$query = "SELECT a.* from detail_laporan_biaya_karyawan a where ";
		if( (! empty($data['bulan'])) and (! empty($data['tahun']))  )
		{
			$query .= " MONTH(tgl)= '".$data['bulan']."' and YEAR(tgl)= '".$data['tahun']."' ";		
		}
		$query .= " ORDER BY a.total_biaya DESC";
		$result = $this->con->query($query);
		return $result;
	}

	function tampil_detail_data($id_kar)
	{
		$query = $this->con->query("SELECT * FROM vw_biaya_berobat WHERE nama_kar='$id_kar' ");
	    return $query;
	}

	function cek_id($id)
	{
		$query = $this->con->query("select * from jabatan where id_jabatan='$id'");
		if($query->num_rows > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function get_by_id($id)
	{
		$query = $this->con->query("select * from jabatan where id_jabatan='$id'");
		return $query->fetch_array();
	}

	function total_biaya($id_kar)
	{
		$query = $this->con->query("select a.*, SUM(a.total_biaya) AS grand_total from vw_biaya_berobat a where nama_kar='$id_kar'");
	    $hasil = $query->fetch_array();
	    return $hasil['grand_total'];
	}

	function id_berobat($id)
	{
		$query = $this->con->query("select * from laporan_biaya_karyawan where id_detail_berobat='$id'");
		$hasil = $query->fetch_array();
	    return $hasil['id_berobat'];
	}
}
