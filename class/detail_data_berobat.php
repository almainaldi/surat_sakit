<?php
include_once('koneksi.php');
class detail_data_berobat extends koneksi
{
	function tampil_data($id_berobat)
	{
		$query = $this->con->query("SELECT a.* ,b.status
		FROM  detail_data_berobat a 
		LEFT JOIN biaya_berobat b ON a.id_berobat = b.id_berobat where a.id_berobat=$id_berobat");
		return $query;
	}

	function total_biaya($id_berobat)
	{
		$query = $this->con->query("select a.*, SUM(a.biaya) AS total_biaya from detail_data_berobat a where id_berobat=$id_berobat");
		$hasil = $query->fetch_array();
		return $hasil['total_biaya'];
	}


	function nama($id)
	{
		$query = $this->con->query("select * from detail_data_berobat where id_detail_berobat='$id'");
		$hasil = $query->fetch_array();
		return $hasil['id_berobat'];
	}

	function cek_id($id)
	{
		$query = $this->con->query("select * from detail_data_berobat where id_detail_berobat='$id'");
		if ($query->num_rows > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	function id_berobat($id)
	{
		$query = $this->con->query("select * from detail_data_berobat where id_detail_berobat='$id'");
		$hasil = $query->fetch_array();
		return $hasil['id_berobat'];
	}

	function get_by_id($id)
	{
		$query = $this->con->query("select * from detail_data_berobat where id_detail_berobat='$id'");
		return $query->fetch_array();
	}

	function print($id)
	{
		$query = $this->con->query("select * from detail_data_berobat where id_detail_berobat='$id'");
		return $query->fetch_array();
	}

	function tambah($data)
	{
		$id = $data['id_detail_berobat'];
		$id_berobat = $data['id_berobat'];
		$jenis_layanan = $data['jenis_layanan'];
		$biaya = $data['biaya'];

		$query = $this->con->query("INSERT into detail_data_berobat(id_detail_berobat,
																	id_berobat,
																	jenis_layanan,
																	biaya)
																	values('',
																	'$id_berobat',
																	'$jenis_layanan',
																	'$biaya')");

		return $query;
	}

	function hapus($data)
	{
		$id_detail_berobat = $data['id_detail_berobat'];
		$query = $this->con->query("DELETE FROM detail_data_berobat WHERE id_detail_berobat='$id_detail_berobat'");
		return $query;
	}

	function detail_berobat($id)
	{
		$query = $this->con->query("SELECT COUNT(*) as jumlah  from detail_data_berobat  where id_berobat='$id'");
		$hasil = $query->fetch_array();
		return $hasil['jumlah'];
	}
}
