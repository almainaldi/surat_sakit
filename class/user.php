<?php
include_once('koneksi.php');
class user extends koneksi
{
	function tampil_data()
	{
		$result = $this->con->query("select * from user order by nama asc");
		return $result;
	}

	function tampil_group_user()
	{
		$result = $this->con->query("select * from grup_user");
		return $result;
	}

	function tampil_grup()
	{
		$result = $this->con->query("select * from grup_user order by id_user asc");
		return $result;
	}

	function hapus_grup($data)
	{
		$id_user = $data['id_user'];
		$query = $this->con->query("delete from grup_user where id_user='$id_user'");
		return $query;
	}

	
	// GROUP
		function tambah_grup($data)
		{

			$id_user 	= $data['id_user'];
			$tipe 		= $data['tipe'];

			$lihat 		= $data['lihat'];
			$print 		= $data['print'];
			$tambah 	= $data['tambah'];
			$edit 		= $data['edit'];
			$hapus 		= $data['hapus'];
			$acc 		= $data['acc'];

			$menu1 		= $data['menu1'];
			$menu2 		= $data['menu2'];
			$menu3 		= $data['menu3'];
			$menu4 		= $data['menu4'];
			$menu5 		= $data['menu5'];
			$menu6 		= $data['menu6'];
			$menu7 		= $data['menu7'];
			$menu8 		= $data['menu8'];
			$menu9 		= $data['menu9'];
			$menu10 		= $data['menu10'];

			$query = $this->con->query("insert into grup_user (id_user,tipe,lihat,print,tambah,edit,hapus,acc,
																	menu1,menu2,menu3,menu4,menu5,menu6,menu7,menu8,menu9,menu10) 
											values('','$tipe','$lihat','$print','$tambah','$edit','$hapus','$acc',
													'$menu1','$menu2','$menu3','$menu4','$menu5','$menu6','$menu7','$menu8','$menu9','$menu10')");

			return $query;
		}
		function cek_id_grup($id)
		{
			$query = $this->con->query("select * from grup_user where id_user='$id'");
			if ($query->num_rows > 0) {
				return TRUE;
			} else {
				return FALSE;
			}
		}

		function get_by_id_grup($id)
		{
			$query = $this->con->query("select * from grup_user where id_user='$id'");
			return $query->fetch_array();
		}
	// END GROUP
	function tambah($data)
	{
		$username = $this->con->real_escape_string($data['username']);
		$nama = $this->con->real_escape_string($data['nama']);
		$password = $this->con->real_escape_string($data['password']);
		$tipe = $this->con->real_escape_string($data['tipe']);
		$app = $this->con->real_escape_string($data['app']);
		$gambar = $data['gambar'];
		if ($this->cek_username($username)) {
			//jika bernilai true
			$password_baru = password_hash($password, PASSWORD_DEFAULT);
			$query = $this->con->query("insert into user (username,password,nama,tipe,app,gambar) values ('$username','$password_baru','$nama','$tipe','$app','$gambar')");
			if ($query) {
				//jika query berhasil
				$hasil['status'] = TRUE;
			} else {
				//jika query gagal 
				$hasil['status'] = FALSE;
				$hasil['pesan'] = "Data Gagal di Tambahkan";
			}
		} else {
			//jika bernilai false
			$hasil['status'] = FALSE;
			$hasil['pesan'] = "Username sudah digunakan, gunakan username lain";
		}

		return $hasil;
	}

	function update_gambar($data)
	{

		$username = $data['username'];
		$gambar = $data['gambar'];

		$query = $this->con->query("UPDATE user SET gambar='$gambar' WHERE username='$username'");
		return $query;
	}

	function  cek_username($username)
	{
		$query = $this->con->query("select * from user where username='$username'");
		if ($query->num_rows > 0) {
			return FALSE;
		} else {
			return TRUE;
		}
	}

	function cek_id($username)
	{
		$query = $this->con->query("select * from user where username='$username'");
		if ($query->num_rows > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	function get_by_id($username)
	{
		$query = $this->con->query("select * from user where username='$username'");
		return $query->fetch_array();
	}

	function edit($data)
	{
		$username = $this->con->real_escape_string($data['username']);
		$nama = $this->con->real_escape_string($data['nama']);
		$password = $this->con->real_escape_string($data['password']);
		$tipe = $this->con->real_escape_string($data['tipe']);

		$q = "update user set nama='$nama',tipe='$tipe'";

		if (!empty($data['password'])) // cek apakah password juga diganti
		{
			//jika tidak kosong
			$password = password_hash($this->con->real_escape_string($data['password']), PASSWORD_DEFAULT);
			$q .= " , password = '$password'";
		}

		if (isset($data['gambar'])) {
			$gambar = $data['gambar'];

			$q .= ", gambar='$gambar'";
		}
		$q .= " where username='$username'";

		$query = $this->con->query($q);
		return $query;
	}

	function hapus($username)
	{
		$query = $this->con->query("delete from user where username='$username'");
		return $query;
	}
	// SET COOKIE 
		function login_user($data)
		{
			$username = $this->con->real_escape_string($data['username']);
			$password = $this->con->real_escape_string($data['password']);
			$remember = $data['remember'];

			$query = $this->con->query("SELECT a.username,a.password,a.nama,a.app,a.gambar,a.online,b.* FROM user a LEFT JOIN grup_user b ON a.tipe=b.tipe WHERE a.username='$username'");
			if ($query->num_rows > 0) {
				//jika user ada
				$hasil = $query->fetch_array();
				if (password_verify($password, $hasil['password'])) {
					//jika password benar
					session_start();
					if ($remember == "y") {
						//jika remember dicek
						setcookie('username', $hasil['username'], time() + (60 * 120)); // (60 * 60 * 24 * 30)
					}
					$_SESSION['username'] = $hasil['username'];
					$_SESSION['nama'] = $hasil['nama'];
					$_SESSION['tipe'] = $hasil['tipe'];
					$_SESSION['app'] = $hasil['app'];
					//
					$_SESSION['lihat'] = $hasil['lihat'];
					$_SESSION['print'] = $hasil['print'];
					$_SESSION['tambah'] = $hasil['tambah'];
					$_SESSION['edit'] = $hasil['edit'];
					$_SESSION['hapus'] = $hasil['hapus'];
					$_SESSION['acc'] = $hasil['acc'];

					$_SESSION['menu1'] = $hasil['menu1'];
					$_SESSION['menu2'] = $hasil['menu2'];
					$_SESSION['menu3'] = $hasil['menu3'];
					$_SESSION['menu4'] = $hasil['menu4'];
					$_SESSION['menu5'] = $hasil['menu5'];
					$_SESSION['menu6'] = $hasil['menu6'];
					$_SESSION['menu7'] = $hasil['menu7'];
					$_SESSION['menu8'] = $hasil['menu8'];
					$_SESSION['menu9'] = $hasil['menu9'];
					$_SESSION['menu10'] = $hasil['menu10'];
					//
					$_SESSION['gambar'] = $hasil['gambar'];
					$_SESSION['ttd'] = $hasil['ttd'];
					$_SESSION['online'] = $hasil['online'];
					return TRUE;
				} else {
					//jika password salah
					return FALSE;
				}
			} else {
				//jika user tidak ada
				return FALSE;
			}
		}

		function set_by_cookie($username)
		{
			$query = $this->con->query("SELECT a.username,a.password,a.nama,a.app,a.gambar,a.online,b.* FROM user a LEFT JOIN grup_user b ON a.tipe=b.tipe WHERE a.username='$username'");
			$hasil = $query->fetch_array();
			$_SESSION['username'] = $hasil['username'];
			$_SESSION['nama'] = $hasil['nama'];
			$_SESSION['tipe'] = $hasil['tipe'];
			$_SESSION['app'] = $hasil['app'];
			//
			$_SESSION['lihat'] = $hasil['lihat'];
			$_SESSION['print'] = $hasil['print'];
			$_SESSION['tambah'] = $hasil['tambah'];
			$_SESSION['edit'] = $hasil['edit'];
			$_SESSION['hapus'] = $hasil['hapus'];
			$_SESSION['acc'] = $hasil['acc'];
			//
			$_SESSION['menu1'] = $hasil['menu1'];
			$_SESSION['menu2'] = $hasil['menu2'];
			$_SESSION['menu3'] = $hasil['menu3'];
			$_SESSION['menu4'] = $hasil['menu4'];
			$_SESSION['menu5'] = $hasil['menu5'];
			$_SESSION['menu6'] = $hasil['menu6'];
			$_SESSION['menu7'] = $hasil['menu7'];
			$_SESSION['menu8'] = $hasil['menu8'];
			$_SESSION['menu9'] = $hasil['menu9'];
			$_SESSION['menu10'] = $hasil['menu10'];
			//
			$_SESSION['gambar'] = $hasil['gambar'];
			$_SESSION['ttd'] = $hasil['ttd'];
			$_SESSION['online'] = $hasil['online'];
		}
	// END SET COOKIE	

	function cek_login()
	{
		if (!isset($_SESSION['username'])) {
			//session_start();
			header("location:index.php");
		}
	}

	function cek_app()
	{
		if ($_SESSION['app'] != "surat sakit") {
			header("location:logout.php");
		}
	}

	function edit_profile($data)
	{
		$username = $data['username'];
		$nama = $this->con->real_escape_string($data['nama']);
		$success = "Success Update Data";

		$q = "update user set nama='$nama'";

		if (!empty($data['password'])) {
			$password = password_hash($this->con->real_escape_string($data['password']), PASSWORD_DEFAULT);
			$q .= " , password='$password'";
		}

		$q .= " where username='$username'";

		$query = $this->con->query($q);
		return $query;
	}

	function update_akses($data)
	{

		$id_user = $data['id_user'];
		$tipe = $data['tipe'];
		$lihat = $data['lihat'];
		$print = $data['print'];
		$tambah = $data['tambah'];
		$edit = $data['edit'];
		$hapus = $data['hapus'];
		$acc = $data['acc'];

		$menu1 = $data['menu1'];
		$menu2 = $data['menu2'];
		$menu3 = $data['menu3'];
		$menu4 = $data['menu4'];
		$menu5 = $data['menu5'];
		$menu6 = $data['menu6'];
		$menu7 = $data['menu7'];
		$menu8 = $data['menu8'];
		$menu9 = $data['menu9'];
		$menu10 = $data['menu10'];

		$query = $this->con->query("UPDATE grup_user SET tipe='$tipe',lihat='$lihat',print='$print',tambah='$tambah',edit='$edit',hapus='$hapus',acc='$acc', menu1='$menu1',menu2='$menu2',menu3='$menu3',menu4='$menu4',menu5='$menu5',menu6='$menu6',menu7='$menu7',menu8='$menu8',menu9='$menu9',menu10='$menu10' WHERE id_user='$id_user'");
		return $query;
	}

	function update_profil($data)
	{

		$username = $_SESSION['username'];
		$nama = $data['nama'];

		$query = $this->con->query("UPDATE user SET nama='$nama' WHERE username='$username'");
		return $query;
	}

	function ubah_password($data)
	{
		$username = $this->con->real_escape_string($data['username']);
		$nama = $this->con->real_escape_string($data['nama']);

		$q = "update user set nama='$nama'";

		if (!empty($data['password'])) // cek apakah password juga diganti
		{
			//jika tidak kosong
			$password = password_hash($this->con->real_escape_string($data['password']), PASSWORD_DEFAULT);
			$q .= " , password = '$password'";
		}

		$q .= " where username='$username'";

		$query = $this->con->query($q);
		return $query;
	}

	function status_online($data)
	{
		$username = $data['username'];

		$query = $this->con->query("UPDATE user SET online='1' WHERE username='$username'");
		return $query;
	}


	function online($data)
	{
		$id = $data['id'];
		$username = $data['username'];
		$jam = $data['jam'];
		$tgl = $data['tgl'];
		$status = $data['status'];

		$query = $this->con->query("INSERT into online (id,username,jam,tgl,status) values ('','$username','$jam','$tgl','$status')");
		return $query;
	}

	function status_offline($data)
	{
		$username = $data['username'];

		$query = $this->con->query("UPDATE user SET online='0' WHERE username='$username'");
		return $query;
	}

	function tampil_data_aktifitas()
	{
		$username = $_SESSION['username'];
		$result = $this->con->query("SELECT * from online where username = '$username' order by tgl DESC, jam DESC limit 15");
		return $result;
	}
	// BASIC 
		function cek_lihat()
		{
			$cek = $_GET['id'];
			$query = $this->con->query("SELECT * FROM grup_user WHERE id_user='$cek'");
			$data = mysqli_fetch_assoc($query);
			$cek = explode(',', $data['lihat']);
			return $cek;
		}

		function cek_print()
		{
			$cek = $_GET['id'];
			$query = $this->con->query("SELECT * FROM grup_user WHERE id_user='$cek'");
			$data = mysqli_fetch_assoc($query);
			$cek = explode(',', $data['print']);
			return $cek;
		}

		function cek_tambah()
		{
			$cek = $_GET['id'];
			$query = $this->con->query("SELECT * FROM grup_user WHERE id_user='$cek'");
			$data = mysqli_fetch_assoc($query);
			$cek = explode(',', $data['tambah']);
			return $cek;
		}

		function cek_edit()
		{
			$cek = $_GET['id'];
			$query = $this->con->query("SELECT * FROM grup_user WHERE id_user='$cek'");
			$data = mysqli_fetch_assoc($query);
			$cek = explode(',', $data['edit']);
			return $cek;
		}

		function cek_hapus()
		{
			$cek = $_GET['id'];
			$query = $this->con->query("SELECT * FROM grup_user WHERE id_user='$cek'");
			$data = mysqli_fetch_assoc($query);
			$cek = explode(',', $data['hapus']);
			return $cek;
		}

		function cek_acc()
		{
			$cek = $_GET['id'];
			$query = $this->con->query("SELECT * FROM grup_user WHERE id_user='$cek'");
			$data = mysqli_fetch_assoc($query);
			$cek = explode(',', $data['acc']);
			return $cek;
		}
	// END BASIC

	// MENU
		function cek_menu_1()
		{
			$cek = $_GET['id'];
			$query = $this->con->query("SELECT * FROM grup_user WHERE id_user='$cek'");
			$data = mysqli_fetch_assoc($query);
			$cek = explode(',', $data['menu1']);
			return $cek;
		}

		function cek_menu_2()
		{
			$cek = $_GET['id'];
			$query = $this->con->query("SELECT * FROM grup_user WHERE id_user='$cek'");
			$data = mysqli_fetch_assoc($query);
			$cek = explode(',', $data['menu2']);
			return $cek;
		}

		function cek_menu_3()
		{
			$cek = $_GET['id'];
			$query = $this->con->query("SELECT * FROM grup_user WHERE id_user='$cek'");
			$data = mysqli_fetch_assoc($query);
			$cek = explode(',', $data['menu3']);
			return $cek;
		}

		function cek_menu_4()
		{
			$cek = $_GET['id'];
			$query = $this->con->query("SELECT * FROM grup_user WHERE id_user='$cek'");
			$data = mysqli_fetch_assoc($query);
			$cek = explode(',', $data['menu4']);
			return $cek;
		}

		function cek_menu_5()
		{
			$cek = $_GET['id'];
			$query = $this->con->query("SELECT * FROM grup_user WHERE id_user='$cek'");
			$data = mysqli_fetch_assoc($query);
			$cek = explode(',', $data['menu5']);
			return $cek;
		}

		function cek_menu_6()
		{
			$cek = $_GET['id'];
			$query = $this->con->query("SELECT * FROM grup_user WHERE id_user='$cek'");
			$data = mysqli_fetch_assoc($query);
			$cek = explode(',', $data['menu6']);
			return $cek;
		}

		function cek_menu_7()
		{
			$cek = $_GET['id'];
			$query = $this->con->query("SELECT * FROM grup_user WHERE id_user='$cek'");
			$data = mysqli_fetch_assoc($query);
			$cek = explode(',', $data['menu7']);
			return $cek;
		}

		function cek_menu_8()
		{
			$cek = $_GET['id'];
			$query = $this->con->query("SELECT * FROM grup_user WHERE id_user='$cek'");
			$data = mysqli_fetch_assoc($query);
			$cek = explode(',', $data['menu8']);
			return $cek;
		}

		function cek_menu_9()
		{
			$cek = $_GET['id'];
			$query = $this->con->query("SELECT * FROM grup_user WHERE id_user='$cek'");
			$data = mysqli_fetch_assoc($query);
			$cek = explode(',', $data['menu9']);
			return $cek;
		}

		function cek_menu_10()
		{
			$cek = $_GET['id'];
			$query = $this->con->query("SELECT * FROM grup_user WHERE id_user='$cek'");
			$data = mysqli_fetch_assoc($query);
			$cek = explode(',', $data['menu10']);
			return $cek;
		}
	// END MENU
}
