<?php 
include_once('koneksi.php');
class jenis_layanan extends koneksi{
	function tampil_data()
	{
		$query = $this->con->query("select * from jenis_layanan");
	    return $query;
	}
	function nama($id)
	{
		$query = $this->con->query("select * from jenis_layanan where id_jenis='$id'");
		$hasil = $query->fetch_array();
	    return $hasil['nama'];
	}

	function cek_id($id)
	{
		$query = $this->con->query("select * from jenis_layanan where id_jenis='$id'");
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
		$query = $this->con->query("select * from jenis_layanan where id_jenis='$id'");
		return $query->fetch_array();
	}

	function tambah($data)
	{
		$id = $data['id_jenis'];
		$nama = $data['nama'];

		$query = $this->con->query("insert into jenis_layanan(id_jenis,nama)values('','$nama')");

		return $query;
	}

	function edit($data)
	{
		$id = $data['id_jenis'];
		$nama = $data['nama'];

		$query = $this->con->query("UPDATE jenis_layanan SET nama='$nama' WHERE id_jenis='$id'");

		return $query;
	}

	function hapus($id)
	{
	$query = $this->con->query("DELETE FROM jenis_layanan WHERE id_jenis='$id'");
	return $query;
	}
}
