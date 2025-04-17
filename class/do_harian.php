<?php 
include_once('koneksi_do.php');
class do_harian extends koneksi_do{
	function tampil_data()
	{
		$result = $this->con->query("select * from vw_do_harian order by tgl desc,id_plant asc");
		return $result;
	}

	function tampil_data_now()
	{
		$result = $this->con->query("SELECT * FROM vw_do_harian WHERE tgl=DATE(now())");
		return $result;
	}

	function tambah($data)
	{
		$id = $this->con->real_escape_string($data['id']);
		$id_plant = $this->con->real_escape_string($data['id_plant']);
		$tujuan = $this->con->real_escape_string($data['tujuan']);
		$tgl = $this->con->real_escape_string($data['tgl']);
		$jam = $this->con->real_escape_string($data['jam']);

		$jumlah_1 = $this->con->real_escape_string($data['jumlah_1']);
		$jumlah_2 = $this->con->real_escape_string($data['jumlah_2']);
		$jumlah_3 = $this->con->real_escape_string($data['jumlah_3']);
		$jumlah_4 = $this->con->real_escape_string($data['jumlah_4']);
		$jumlah_5 = '0';
		$jumlah_6 = '0';
		$user = $this->con->real_escape_string($data['user']);
 
		$query = $this->con->query("insert into do_harian (id,id_plant,tujuan,tgl,jam,jumlah_1,jumlah_2,jumlah_3,jumlah_4,jumlah_5,jumlah_6,user) values ('','$id_plant','$tujuan','$tgl','$jam','$jumlah_1','$jumlah_2','$jumlah_3','$jumlah_4','$jumlah_5','$jumlah_6','$user')");
		return $query;
	}

	function tambah2($data)
	{
		$id = $this->con->real_escape_string($data['id']);
		$id_plant = $this->con->real_escape_string($data['id_plant']);
		$tujuan = $this->con->real_escape_string($data['tujuan']);
		$tgl = $this->con->real_escape_string($data['tgl']);
		$jam = $this->con->real_escape_string($data['jam']);

		$jumlah_1 = $this->con->real_escape_string($data['jumlah_1']);
		$jumlah_2 = $this->con->real_escape_string($data['jumlah_2']);
		$jumlah_3 = $this->con->real_escape_string($data['jumlah_3']);
		$jumlah_4 = $this->con->real_escape_string($data['jumlah_4']);
		$jumlah_5 = '0';
		$jumlah_6 = '0';
		$user = $this->con->real_escape_string($data['user']);


		if($this->cek_data($id_plant,$tgl))
		{
			//jika bernilai true
			$query = $this->con->query("insert into do_harian (id,id_plant,tujuan,tgl,jam,jumlah_1,jumlah_2,jumlah_3,jumlah_4,jumlah_5,jumlah_6,user) values ('','$id_plant','$tujuan','$tgl','$jam','$jumlah_1','$jumlah_2','$jumlah_3','$jumlah_4','$jumlah_5','$jumlah_6','$user')");
			if($query)
			{
				//jika query berhasil
				$hasil['status'] = TRUE;
				header("location:tampil_do_harian.php?pesan=success"); 
			}
			else
			{
				//jika query gagal 
				$hasil['status'] = FALSE;
				$hasil['pesan'] = "Data Gagal di Tambahkan";
			}
		}
		else
		{
			//jika bernilai false
			$hasil['status'] = FALSE;
			// $hasil['pesan'] = "Plant dan TGL sudah ada, mohon di cek kembali !!!";
			header("location:tampil_do_harian.php?pesan=sama"); 
		}

		return $hasil;
	}

	function update($data)
		{
			$id = $this->con->real_escape_string($data['id']);
			$id_plant = $this->con->real_escape_string($data['id_plant']);
			$tujuan = $this->con->real_escape_string($data['tujuan']);
			$tgl = $this->con->real_escape_string($data['tgl']);
			$jam = $this->con->real_escape_string($data['jam']);

			$jumlah_1 = $this->con->real_escape_string($data['jumlah_1']);
			$jumlah_2 = $this->con->real_escape_string($data['jumlah_2']);
			$jumlah_3 = $this->con->real_escape_string($data['jumlah_3']);
			$jumlah_4 = $this->con->real_escape_string($data['jumlah_4']);
			$jumlah_5 = '0';
			$jumlah_6 = '0';
			$user = $this->con->real_escape_string($data['user']);

			$query = $this->con->query("update do_harian set id_plant='$id_plant', tujuan='$tujuan' ,tgl='$tgl', jam='$jam', jumlah_1='$jumlah_1', jumlah_2='$jumlah_2',  jumlah_3='$jumlah_3',  jumlah_4='$jumlah_4',  jumlah_5='$jumlah_5',  jumlah_6='$jumlah_6', user='$user' where id='$id'");

			if($query)
			{
				return TRUE;
			}
			else
			{
				return FALSE;
			}
		}

	function tampil_data_search($data)
	{
		$query = "select * from vw_do_harian where ";
		if($data['plant'] != "all")
		{
			$query .= " id_plant='".$data['plant']."'";
		}

		if( (! empty($data['tgl_1'])) and (! empty($data['tgl_2']))  )
		{
			if($data['plant'] != "all")
			{
				$query .= " and tgl between '".$data['tgl_1']."' and '".$data['tgl_2']."' ";
			}
			else
			{
				$query .= " tgl between '".$data['tgl_1']."' and '".$data['tgl_2']."' ";
			}
			
		}
		$query .= " order by tgl desc";
		$result = $this->con->query($query);
		return $result;
	}

	function cek_data($id_plant,$tgl)
	{
		$query = $this->con->query("SELECT * from vw_do_harian where id_plant='$id_plant' AND tgl='$tgl'");
		if($query->num_rows > 0)
		{
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	function cek_id($id)
	{
		$query = $this->con->query("select * from vw_do_harian where id='$id'");
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
		$query = $this->con->query("select * from vw_do_harian where id='$id'");
		return $query->fetch_array();

	}

	function print($id)
	{
		$query = $this->con->query("select * from vw_do_harian where id='$id'");
		return $query->fetch_array();

	}

	function hapus($id)
		{
			$query = $this->con->query("delete from do_harian where id='$id'");
			return $query;
		}

	function tampil_data_dealer()
	{
		$result = $this->con->query("SELECT * FROM vw_do_harian WHERE tgl=DATE(now()) GROUP BY vw_do_harian.nama");
		return $result;
	}
	
	function tampil_plant()
	{
		$result = $this->con->query("select * from plant");
		return $result;
	}

	function nama_plant($id)
	{
		$hasil = $this->get_by_id($id);
		return $hasil['id_plant'];
	}

	function tampil_daerah()
	{
		$result = $this->con->query("select * from daerah");
		return $result;
	}

	function tampil_do_harian()
	{
		$result = $this->con->query("SELECT * from vw_do_harian WHERE tgl=DATE(now()) ");
		return $result;
	}
}
 ?>