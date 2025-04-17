<?php
include_once('koneksi.php');
class rekap_berobat extends koneksi
{
	function tampil_data()
	{
		$query = $this->con->query("SELECT a.* from vw_rekap_berobat a 
		WHERE a.tgl BETWEEN DATE_FORMAT(DATE_SUB(NOW(), INTERVAL 2 MONTH),'%Y-%m-%d') AND DATE_FORMAT(NOW(),'%Y-%m-%d') 
		ORDER BY a.tgl DESC");
		return $query;
	}
	function nama($id)
	{
		$query = $this->con->query("select * from vw_rekap_berobat where id_krekap='$id'");
		$hasil = $query->fetch_array();
		return $hasil['id_kar'];
	}

	function cek_id($id)
	{
		$query = $this->con->query("select * from vw_rekap_berobat where id_rekap='$id'");
		if ($query->num_rows > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	function get_by_id($id)
	{
		$query = $this->con->query("select * from vw_rekap_berobat where id_rekap='$id'");
		return $query->fetch_array();
	}

	function tambah($data)
	{
		$id_rekap 			= $data['id_rekap'];
		$id_kar 			= $data['id_kar'];
		$id_biaya_berobat 	= $data['id_biaya_berobat'];
		$tgl 				= $data['tgl'];
		$tgl_in 			= $data['tgl_in'];
		$jam 				= $data['jam'];
		$user 				= $data['user'];
		$keluhan 			= $data['keluhan'];
		$diagnosis 			= $data['diagnosis'];
		$solusi 			= $data['solusi'];

		$query = $this->con->query("INSERT into rekap_berobat(id_rekap,
														id_biaya_berobat,
														id_kar,
														jam,
														tgl,
														tgl_in,
														user,
														keluhan,
														diagnosis,
														solusi)
                                                        values('',
                                                        '$id_biaya_berobat',
                                                        '$id_kar',
                                                        '$jam',
                                                        '$tgl',
                                                        '$tgl_in',
                                                        '$user',
                                                        '$keluhan',
                                                        '$diagnosis',
														'$solusi')");

		return $query;
	}

	function edit($data)
	{
		$id 				= $data['id_rekap'];
		$id_biaya_berobat 	= $data['id_biaya_berobat'];
		$id_kar 			= $data['id_kar'];
		$tgl 				= $data['tgl'];
		$tgl_in 			= $data['tgl_in'];
		$jam 				= $data['jam'];
		$user 				= $data['user'];
		$keluhan 			= $data['keluhan'];
		$diagnosis 			= $data['diagnosis'];
		$solusi 			= $data['solusi'];

		$query = $this->con->query("UPDATE rekap_berobat SET 		id_biaya_berobat	='$id_biaya_berobat',
																	id_kar				='$id_kar',
																	tgl					='$tgl',
																	tgl_in				='$tgl_in',
																	jam					='$jam',
																	user				='$user',
																	keluhan				='$keluhan',
																	diagnosis			='$diagnosis',
																	solusi				='$solusi' 
																	WHERE id_rekap	='$id'");

		return $query;
	}
	function edit_memo($data)
	{
		$id 				= $data['id_rekap'];
		$id_biaya_berobat 	= $data['id_biaya_berobat'];
		$id_kar 			= $data['id_kar'];
		$tgl 				= $data['tgl'];
		$tgl_in 			= $data['tgl_in'];
		$jam 				= $data['jam'];
		$user 				= $data['user'];
		$memo 				= $data['memo'];
		$query = $this->con->query("UPDATE rekap_berobat SET 		id_biaya_berobat	='$id_biaya_berobat',
																	id_kar				='$id_kar',
																	tgl					='$tgl',
																	tgl_in				='$tgl_in',
																	jam					='$jam',
																	user				='$user',
																	memo				='$memo'
																	WHERE id_rekap	='$id'");

		return $query;
	}

	function hapus($id)
	{
		$query = $this->con->query("DELETE FROM rekap_berobat WHERE id_rekap='$id'");
		return $query;
	}

	function hapus1($data)
	{
		$id_rekap         = $data['id_rekap'];
		$query = $this->con->query("DELETE FROM rekap_berobat WHERE id_rekap='$id_rekap'");
		return $query;
	}

	function get_by_id_rekap($id)
	{
		$query = $this->con->query("select * from vw_rekap_berobat where id_kar='$id'");
		return $query->fetch_array();
	}

	function rekap($id)
	{
		$hasil = $this->get_by_id_rekap($id);
		return $hasil['nama_kar'];
	}

	function tampil_data_search($data)
	{
		$query = "select * from vw_rekap_berobat where ";
		if ($data['id_kar'] != "all") {
			$query .= " id_kar='" . $data['id_kar'] . "'";
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
}
