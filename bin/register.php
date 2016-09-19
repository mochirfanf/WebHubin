<?php

include "koneksidb.php";

	if(!empty($_SESSION['username'])){

			if($_SESSION['level']=='super_admin'){
				header('location:super_admin/index.php');
			}
			if($_SESSION['level']=='admin'){
				header('location:admin/index.php');
			}
      if($_SESSION['level']=='perusahaan'){
				header('location:perusahaan/index.php');
			}
	}else{
		?>
		<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
		<html>
		<head><!--
			<style type="text/css">

				input[type="text"]:-moz-placeholder{color: red}
				input[type="text"]::-moz-placeholder{color: red}
				input[type="text"]:-ms-input-placeholder{color: red}
				input[type="text"]::-webkit-input-placeholder{color: red}

			</style> -->
		<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
		<title>Login Form</title>


		<!--SCRIPTS-->
		<script type='text/javascript' src='js/jquery-1.10.2.min.js'></script>

		</head>
		<body style=''>

			<form method="POST" action="proses.php?a=register">
					<input name='nama' type='text' placeholder='Nama Perusahaan'> <br>
					<input name='email' type='email' placeholder='Email Perusahaan'> <br>
					<textarea name="alamat"> Alamat Perusahaan </textarea> <br>
					<input name='provinsi' type='text' placeholder='Provinsi'> <br>
					<input name='kabupaten' type='text' placeholder='Kabupaten'> <br>
					<input name='kecamatan' type='text' placeholder='Kecamatan'> <br>
					<input name='kelurahan' type='text' placeholder='Kelurahan'> <br>
					<input name='kodepos' type='text' placeholder='Kode Pos'> <br><br>

				  <input type='submit' name='REGISTER' value='REGISTER' class='button' >
			</form>
		</body>
		</html>

		<?php
	}

?>
