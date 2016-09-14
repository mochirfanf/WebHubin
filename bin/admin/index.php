<?php
	include "../koneksidb.php";
	if ($_SESSION['tahun_ajaran']=='') {
		header("location:tahun_ajaran.php");
	}else{
		header("location:homepage.php");
	}
	
?>