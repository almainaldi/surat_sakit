<?php 
  include "config.php";
  if (isset($_POST["tombol"])) {
    $jumlah = count($_FILES['gambar']['name']);
    if ($jumlah > 0) {
      for ($i=0; $i < $jumlah; $i++) { 
        $file_name = $_FILES['gambar']['name'][$i];
        $tmp_name = $_FILES['gambar']['tmp_name'][$i];        
        move_uploaded_file($tmp_name, "img/".$file_name);
        mysqli_query($conn,"INSERT INTO gambar VALUES('','$file_name')");       
      }
      echo "Berhasil Upload";
    }
    else{
      echo "Gambar tidak ada";
    }
  }
?>