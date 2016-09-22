<?php

	include "../koneksidb.php";

	function anti_injection($param){
		$filter = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($param,ENT_QUOTES))));
		return $filter;
	}

	if (!empty($_GET ["a"])) {
		switch ($_GET ["a"]){
			case "input":
				if (isset($_POST['MASUK'])){

					$username			= anti_injection($_POST['username']);
					$password			= anti_injection($_POST['password']);
					$password 		= md5($password);

					mysql_query(" UPDATE hb_du_umum SET username='$username', password='$password', status='aktif', level='perusahaan' WHERE kode='$_POST[kode]'") or die ("Ups! Gagal Ditambahkan, Silahkan Coba Lagi! ".mysql_error());


						$_SESSION['username'] = $username;
            $_SESSION['level'] = 'perusahaan';
            $_SESSION['password'] = $password;


					?>
					<script>
						alert(" Berhasil Menentukan Username dan Password ");
            top.location = "../perusahaan/index.php";

					</script><?php
				}
			break;
		}
	}


?>


