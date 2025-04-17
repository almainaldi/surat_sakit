<?php 
date_default_timezone_set('Asia/Jakarta');
class koneksi{
	protected $host = "localhost";
	protected $user = "sslpsmy_aldi";
	protected $pass = "12345";
	protected $db   = "sslpsmy_surat_sakit";
	protected $con;

	function __construct()
	{
		$this->con = new mysqli($this->host,$this->user,$this->pass,$this->db);
		return $this->con;
	}
}
?>