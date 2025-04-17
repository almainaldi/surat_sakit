<?php
date_default_timezone_set('Asia/Jakarta');
define('HOST','localhost');
define('USER','root');
define('PASS','');
define('DB1', 'testing');

// Buat Koneksinya
$db1 = new mysqli(HOST, USER, PASS, DB1);
?>
