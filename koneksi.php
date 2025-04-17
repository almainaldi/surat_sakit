<?php 
class koneksi{
	protected $host = "localhost";
	protected $user = "root";
	protected $pass = "";
	protected $db   = "surat_sakit";
	protected $con;

	function __construct()
	{
		$this->con = new mysqli($this->host,$this->user,$this->pass,$this->db);
		return $this->con;
	}
}
?>