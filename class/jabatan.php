<?php 
include_once('koneksi.php');
class jabatan extends koneksi{
	function tampil_data()
	{
		$query = $this->con->query("select * from jabatan");
	    return $query;
	}
	function nama($id)
	{
		$query = $this->con->query("select * from jabatan where id_jabatan='$id'");
		$hasil = $query->fetch_array();
	    return $hasil['jabatan'];
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

	function tambah($data)
	{
		$id = $data['id_jabatan'];
		$jabatan = $data['jabatan'];

		$query = $this->con->query("insert into jabatan(id_jabatan,jabatan)values('','$jabatan')");

		return $query;
	}

	function edit($data)
	{
		$id = $data['id_jabatan'];
		$jabatan = $data['jabatan'];

		$query = $this->con->query("UPDATE jabatan SET jabatan='$jabatan' WHERE id_jabatan='$id'");

		return $query;
	}

	function hapus($id)
	{
	$query = $this->con->query("DELETE FROM jabatan WHERE id_jabatan='$id'");
	return $query;
	}
}
