<?php

	include "../koneksidb.php";

	function anti_injection($param){
		$filter = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($param,ENT_QUOTES))));
		return $filter;
	}

	if (!empty($_GET ["a"])) {
		switch ($_GET ["a"]){
			case "search":
			$s = str_replace(' ', '-', $_POST['src']);
			$s = anti_injection($s);
			

			header("location:lowongankerja.php?q=$s");
			break;
			case "input":
				if (isset($_POST['MASUK'])){

					$username			= anti_injection($_POST['username']);
					$password			= anti_injection($_POST['password']);
					$password 		= md5($password);

          $ada  = mysql_fetch_row(mysql_query("SELECT * FROM hb_du_umum WHERE username='$username'"));

					if ($ada > 0) {
						?>
							<script>
								alert(" Username Sudah Ada ");
								window.history.go(-1);

							</script><?php
					}
					else{
							mysql_query(" UPDATE hb_du_umum SET username='$username', password='$password', status='aktif', level='perusahaan' WHERE kode='$_POST[kode]'") or die ("Ups! Gagal Ditambahkan, Silahkan Coba Lagi! ".mysql_error());


						 						$userperusahaan  = mysql_query("SELECT * FROM hb_du_umum WHERE username='$username' AND password='$password' AND level='perusahaan' AND status='aktif' ");
          							$c  = mysql_fetch_array($userperusahaan);

                        $_SESSION['username'] = $username;
                        $_SESSION['level'] = 'perusahaan';
                        $_SESSION['password'] = $password;
                        $_SESSION['id_du'] = $c["id_du"];
                        $_SESSION['tahun_ajaran'] = "2013-2014";

                        header("location:../perusahaan/index.php");


							?>
							<script>
								alert(" Berhasil Menentukan Username dan Password ");
		            top.location = "../perusahaan/index.php";

							</script><?php
					}


				}
			break;
		}
	}

?>


