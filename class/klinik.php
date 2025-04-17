<?php 
include_once('koneksi.php');
class klinik extends koneksi{
	function tampil_data()
	{
		$query = $this->con->query("select * from klinik");
	    return $query;
	}
	function nama($id)
	{
		$query = $this->con->query("select * from klinik where id_klinik='$id'");
		$hasil = $query->fetch_array();
	    return $hasil['klinik'];
	}

	function cek_id($id)
	{
		$query = $this->con->query("select * from klinik where id_klinik='$id'");
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
		$query = $this->con->query("select * from klinik where id_klinik='$id'");
		return $query->fetch_array();
	}

	function tambah($data)
	{
		$id = $data['id_klinik'];
		$klinik = $data['klinik'];

		$query = $this->con->query("insert into klinik(id_klinik,klinik)values('','$klinik')");

		return $query;
	}

	function edit($data)
	{
		$id = $data['id_klinik'];
		$klinik = $data['klinik'];

		$query = $this->con->query("UPDATE klinik SET klinik='$klinik' WHERE id_klinik='$id'");

		return $query;
	}

	function hapus($id)
	{
	$query = $this->con->query("DELETE FROM klinik WHERE id_klinik='$id'");
	return $query;
	}
}
