<?php
	session_start();
	session_name("hubin");

	mysql_connect("localhost","c2hubindea987","hubindea987") or die ("Koneksi ke Server Gagal". mysql_error());
	mysql_select_db("c2hubin") or die ("Database Tidak Ditemukan". mysql_error());;
	
$item_per_page = 4;
	
?>