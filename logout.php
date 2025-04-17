<?php 
session_start();
session_unset();
session_destroy();

if(isset($_COOKIE['username']))
{
	setcookie("username","","0");
}

header("location:index?pesan=logout");
?>