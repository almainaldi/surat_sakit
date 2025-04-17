<?php 
include_once('koneksi.php');
class biaya_berobat extends koneksi{
	function tampil_data()
	{
		$query = $this->con->query("SELECT a.* 
		from vw_biaya_berobat a 
		WHERE a.tgl BETWEEN DATE_FORMAT(DATE_SUB(NOW(), INTERVAL 2 MONTH),'%Y-%m-%d') AND DATE_FORMAT(NOW(),'%Y-%m-%d') 
		ORDER BY a.tgl DESC ");
	    return $query;
	}
	
	function nama($id)
	{
		$query = $this->con->query("select * from vw_biaya_berobat where id_berobat='$id'");
		$hasil = $query->fetch_array();
	    return $hasil['nama_kar'];
	}

	function id_berobat($id)
	{
		$query = $this->con->query("select * from vw_biaya_berobat where id_berobat='$id'");
		$hasil = $query->fetch_array();
	    return $hasil['id_berobat'];
	}

	function cek_id($id)
	{
		$query = $this->con->query("select * from vw_biaya_berobat where id_berobat='$id'");
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
		$query = $this->con->query("select * from vw_biaya_berobat where id_berobat='$id'");
		return $query->fetch_array();
	}

	function print($id)
	{
		$query = $this->con->query("select * from vw_biaya_berobat where id_berobat='$id'");
		return $query->fetch_array();

	}

	function selesai($data)
	{
		$id = $data['id_berobat'];
		$status = "1";

		$query = $this->con->query("UPDATE biaya_berobat SET status='$status' WHERE id_berobat='$id'");

		return $query;
	}
	function edit_admin1($data)
	{
		$id = $data['id_berobat'];
		$status = "0";

		$query = $this->con->query("UPDATE biaya_berobat SET status='$status' WHERE id_berobat='$id'");

		return $query;
	}

	function selesai_rekap($data)
	{
		$id = $data['id_berobat'];
		$status = "2";

		$query = $this->con->query("UPDATE biaya_berobat SET status='$status' WHERE id_berobat='$id'");

		return $query;
	}

	function tambah($data)
	{	
		$id_berobat 		= $data['id_berobat'];
		$id_surat_rujukan 	= $data['id_surat_rujukan'];
		$nama_kar 			= $data['nama_kar'];
		$jenis 				= $data['jenis'];
		$dokter 			= $data['dokter'];
		$tempat 			= $data['tempat'];
		$tgl 				= $data['tgl'];
		$tgl_in 			= $data['tgl_in'];
        $jam 				= $data['jam'];
		$kasbon 			= $data['kasbon'];
        $user 				= $data['user'];

		$query = $this->con->query("INSERT into biaya_berobat (id_berobat,
																id_surat_rujukan,nama_kar,
																jenis,
																dokter,
																tempat,
																tgl,
																tgl_in,
																jam,
																kasbon,
																user)
																values('',
																'$id_surat_rujukan',
																'$nama_kar',
																'$jenis',
																'$dokter',
																'$tempat',
																'$tgl',
																'$tgl_in',
																'$jam',
																'$kasbon',
																'$user')");

		return $query;
	}

	function edit($data)
	{
		$id 		= $data['id_berobat'];
		$nama_kar 	= $data['nama_kar'];
		$jenis 		= $data['jenis'];
		$tempat 	= $data['tempat'];
		$tgl 		= $data['tgl'];
		$tgl_in 	= $data['tgl_in'];
		$dokter 	= $data['dokter'];
		$kasbon 	= $data['kasbon'];

		$query = $this->con->query("UPDATE biaya_berobat SET nama_kar	='$nama_kar',
															jenis		='$jenis', 
															tempat		='$tempat',
															tgl			='$tgl',
															tgl_in		='$tgl_in',
															dokter		='$dokter',
															kasbon		='$kasbon'
															WHERE id_berobat='$id'");

		return $query;
	}

	function hapus($id)
	{
	$query = $this->con->query("DELETE FROM biaya_berobat WHERE id_berobat='$id'");
	return $query;
	}

function get_by_id_karyawan($id)
	{
		$query = $this->con->query("select * from vw_biaya_berobat where nama_kar='$id'");
		return $query->fetch_array();
	}

	function karyawan($id)
	{
		$hasil = $this->get_by_id_karyawan($id);
		return $hasil['nama_karyawan'];
	}

	function tampil_data_search($data)
	{
		$query = "select * from vw_biaya_berobat where ";
		if ($data['id_kar'] != "all") {
			$query .= " nama_kar='" . $data['id_kar'] . "'";
		}

		if ((!empty($data['tgl_1'])) and (!empty($data['tgl_2']))) {
			if ($data['id_kar'] != "all") {
				$query .= " and tgl between '" . $data['tgl_1'] . "' and '" . $data['tgl_2'] . "' ";
			} else {
				$query .= " tgl between '" . $data['tgl_1'] . "' and '" . $data['tgl_2'] . "' ";
			}
		}
		$query .= " order by tgl desc";
		$result = $this->con->query($query);
		return $result;
	}

	function bln($id)
	{
		$query = $this->con->query("SELECT bulan FROM vw_biaya_berobat where id_surat_rujukan='$id'");
		$hasil =  $query->fetch_array();
		return $hasil['bulan'];
	}
}
