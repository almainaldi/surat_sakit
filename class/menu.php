<?php 
include_once('koneksi.php');
class menu extends koneksi{
	function nama($id)
	{
		$query = $this->con->query("select * from menu where id='$id'");
		$hasil = $query->fetch_array();
	    return $hasil['nama'];
	}

	function cek_id($id)
	{
		$query = $this->con->query("select * from menu where id='$id'");
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
		$query = $this->con->query("select * from menu where id='$id'");
		return $query->fetch_array();
	}

	function tambah($data)
	{
		$id = $data['id'];
		$nama = $data['nama'];
        $status = $data['status'];

		$query = $this->con->query("insert into menu(id,nama,status)values('','$nama','$status')");

		return $query;
	}

	function edit($data)
	{
		$id = $data['id'];
		$nama = $data['nama'];
        $status = $data['status'];

		$query = $this->con->query("UPDATE menu SET nama='$nama',status='$status' WHERE id='$id'");

		return $query;
	}

	// function hapus($id)
	// {
	// 	$query = $this->con->query("DELETE FROM menu WHERE id='$id'");
	// 	return $query;
	// }
}
