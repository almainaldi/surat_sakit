<?php
include_once('koneksi.php');
class surat_rujukan extends koneksi
{
	function tampil_data()
	{
		$query = $this->con->query("select a.* from vw_surat_rujukan a ORDER BY a.status ASC, a.tgl DESC");
		return $query;
	}

	function tampil_data_batal()
	{
		$query = $this->con->query("select a.* from vw_surat_rujukan a where note != '' ORDER BY a.status ASC, a.tgl DESC");
		return $query;
	}

	function tampil_data_acc()
	{
		$query = $this->con->query("SELECT a.* from vw_surat_rujukan a WHERE STATUS='0' ORDER BY a.tgl DESC ");
		return $query;
	}

	function tampil_data_on()
	{
		$query = $this->con->query("SELECT a.* from vw_surat_rujukan a WHERE STATUS='1' AND acc = '1' ORDER BY a.tgl DESC ");
		return $query;
	}

	function nama($id)
	{
		$query = $this->con->query("select * from vw_surat_rujukan where id_surat='$id'");
		$hasil = $query->fetch_array();
		return $hasil['nama'];
	}

	function cek_id($id)
	{
		$query = $this->con->query("select * from vw_surat_rujukan where id_surat='$id'");
		if ($query->num_rows > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	function stj_surat($data)
	{
		$id_surat   = $data['id_surat'];
		$status  = $this->con->real_escape_string($data['status']);
		$acc  = $this->con->real_escape_string($data['acc']);
		$acc_tgl  = $this->con->real_escape_string($data['acc_tgl']);
		$query    = $this->con->query("UPDATE surat_rujukan SET status='$status', acc='$acc', acc_tgl='$acc_tgl' WHERE id_surat='$id_surat'");
		return $query;
	}

	function get_by_id($id)
	{
		$query = $this->con->query("select * from vw_surat_rujukan where id_surat='$id'");
		return $query->fetch_array();
	}

	function tambah($data)
	{
		$id_surat 		= $data['id_surat'];
		$tgl 			= $data['tgl'];
		$tgl_in 		= $data['tgl_in'];
		$nama 			= $data['nama'];
		$jabatan 		= $data['jabatan'];
		$keluhan 		= $data['keluhan'];
		$tujuan 		= $data['tujuan'];
		$mengetahui 	= $data['mengetahui'];
		$pemberi 		= $data['pemberi'];

		$query = $this->con->query("INSERT into surat_rujukan(id_surat,
															tgl,
															tgl_in,
															nama,
															jabatan,
															keluhan,
															tujuan,
															mengetahui,
															pemberi)
															values('$id_surat',
															'$tgl',
															'$tgl_in',
															'$nama',
															'$jabatan',
															'$keluhan',
															'$tujuan',
															'$mengetahui',
															'$pemberi')");

		return $query;
	}

	function edit($data)
	{
		$id 		= $data['id_surat'];
		$tgl 		= $data['tgl'];
		$tgl_in 	= $data['tgl_in'];
		$nama 		= $data['nama'];
		$jabatan 	= $data['jabatan'];
		$keluhan 	= $data['keluhan'];
		$tujuan 	= $data['tujuan'];
		$mengetahui = $data['mengetahui'];
		$pemberi 	= $data['pemberi'];

		$query = $this->con->query("UPDATE surat_rujukan SET nama		='$nama',
															tgl			='$tgl', 
															tgl_in		='$tgl_in', 
															jabatan		='$jabatan', 
															keluhan		='$keluhan', 
															tujuan		='$tujuan',
															mengetahui	='$mengetahui',
															pemberi		='$pemberi'
															WHERE id_surat='$id'");

		return $query;
	}

	function note($data)
	{
		$id = $data['id_surat'];
		$note = $data['note'];
		$status = $data['status'];

		$query = $this->con->query("UPDATE surat_rujukan SET status='$status',
															note='$note'
															WHERE id_surat='$id'");

		return $query;
	}

	function ubah_status($data)
	{
		$id = $data['id_surat_rujukan'];
		$status = '2';

		$query = $this->con->query("UPDATE surat_rujukan SET status='$status'
															WHERE id_surat='$id'");

		return $query;
	}

	function no_urut()
	{
		$query = $this->con->query("SELECT max(id_surat) as kodeTerbesar FROM surat_rujukan");
		$data = mysqli_fetch_array($query);
		$id_surat = $data['kodeTerbesar'];
		$id_surat++;
		$hasil = sprintf($id_surat);
		return $hasil;
	}

	function konfir($data)
	{
		$id_surat          = $data['id_surat'];
		$st_print      = $this->con->real_escape_string($data['st_print']);
		$st_print++;
		$query           = $this->con->query("UPDATE surat_rujukan SET st_print='$st_print' WHERE id_surat='$id_surat'");
		return $query;
	}

	function hapus($id)
	{
		$query = $this->con->query("DELETE FROM surat_rujukan WHERE id_surat='$id'");
		return $query;
	}

	function get_by_id_surat($id)
	{
		$query = $this->con->query("select * from vw_surat_rujukan where nama='$id'");
		return $query->fetch_array();
	}

	function print($id)
	{
		$query = $this->con->query("SELECT * FROM vw_surat_rujukan WHERE id_surat='$id'");
		return $query->fetch_array();
	}

	function surat($id)
	{
		$hasil = $this->get_by_id_surat($id);
		return $hasil['nama_kar'];
	}

	function st_print($data)
	{
		$id_surat   = $data['id_surat'];
		$jum_print  = $this->con->real_escape_string($data['jum_print']);
		$jum_print++;
		$query    = $this->con->query("UPDATE surat_rujukan SET jum_print='$jum_print' WHERE id_surat='$id_surat'");
		return $query;
	}

	function tampil_data_search($data)
	{
		$query = "select * from vw_surat_rujukan where";
		if ($data['id_kar'] != "all") {
			$query .= " nama='" . $data['id_kar'] . "'";
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

	function tampil_data_search_batal($data)
	{
		$query = "select * from vw_surat_rujukan where note != '' and";
		if ($data['id_kar'] != "all") {
			$query .= " nama='" . $data['id_kar'] . "'";
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
		$query = $this->con->query("SELECT bulan FROM vw_surat_rujukan where id_surat='$id'");
		$hasil =  $query->fetch_array();
		return $hasil['bulan'];
	}
	function thn($id)
	{
		$query = $this->con->query("SELECT SUBSTRING(tgl, 1, 4)thn FROM surat_rujukan where id_surat='$id'");
		$hasil =  $query->fetch_array();
		return $hasil['tahun'];
	}
}
