<?php 
include_once('koneksi.php');
class karyawan extends koneksi{
	function tampil_data()
	{
		$query = $this->con->query("select * from karyawan");
	    return $query;
	}
	function nama($id)
	{
		$query = $this->con->query("select * from karyawan where id_kar='$id'");
		$hasil = $query->fetch_array();
	    return $hasil['nama_kar'];
	}

	function cek_id($id)
	{
		$query = $this->con->query("select * from karyawan where id_kar='$id'");
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
		$query = $this->con->query("select * from karyawan where id_kar='$id'");
		return $query->fetch_array();
	}

	function tambah($data)
	{
		$id_kar = $data['id_kar'];
		$nama = $data['nama_kar'];
        $jabatan = $data['jabatan'];

		$query = $this->con->query("insert into karyawan(id_kar,nama_kar,jabatan)values('','$nama','$jabatan')");

		return $query;
	}

	function edit($data)
	{
		$id = $data['id_kar'];
		$nama = $data['nama_kar'];
        $jabatan = $data['jabatan'];

		$query = $this->con->query("UPDATE karyawan SET nama_kar='$nama' ,
														jabatan='$jabatan' 
														WHERE id_kar='$id'");

		return $query;
	}

	function hapus($id)
	{
	$query = $this->con->query("DELETE FROM karyawan WHERE id_kar='$id'");
	return $query;
	}
}
