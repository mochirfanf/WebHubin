<?php
	session_start();
	session_name("hubin");

	mysql_connect("localhost","root","") or die ("Koneksi ke Server Gagal". mysql_error());
	mysql_select_db("db_hubin") or die ("Database Tidak Ditemukan". mysql_error());;

	
?>