<?php
	include("class/koneksi_js.php");     
	switch ($_GET['jenis']) {

		case 'jabatan': // sesuai nama ID
		$id = $_POST['id']; // nama_kar
		if($id == ''){
		     exit;
		}else{
		     $query = mysqli_query($con,"SELECT  * FROM karyawan WHERE id_kar ='$id'") or die ('Query Gagal');
		     while($data = mysqli_fetch_array($query)){
		          //echo '<option value="'.$data['id'].'">'.$data['jenis'].'</option>';
		     	echo '<option value="'.$data['jabatan'].'">'.$data['jabatan'].'</option>'; // masuk DB
		     }
		     exit;    
		}
		break;
	}
?>