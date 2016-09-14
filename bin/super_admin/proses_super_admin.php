<?php
	
	include "../koneksidb.php";

	function anti_injection($param){
		$filter = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($param,ENT_QUOTES))));
		return $filter;
	}

if($_SESSION['level']=='super_admin'){ 
	if (!empty($_GET ["a"])) {
		switch ($_GET ["a"]){
			case "input":
				if (isset($_POST['MASUK'])){
					
					$nip			= anti_injection($_POST['nip']);
					$nama			= anti_injection($_POST['nama']);
					$jabatan		= anti_injection($_POST['jabatan']);
					$password 		= md5($nip);

					mysql_query(" INSERT INTO hb_pengelola_hubin(username, nama, jabatan, nip) VALUES ('$nip', '$nama', '$jabatan', '$nip')") or die ("Ups! Gagal Ditambahkan, Silahkan Coba Lagi! ".mysql_error());

					mysql_query(" INSERT INTO hb_user_admin(username,password,level,status) VALUES ('$nip', '$password', 'admin','aktif')");

					?>
					<script>
						alert(" Berhasil Dimasukkan ");
						top.location="inputadmin.php";
					</script><?php
				}
			break;
			case "gantipassword":
				if (isset($_POST['GANTI'])){

					$d = mysql_fetch_array(mysql_query("SELECT * FROM hb_user_admin WHERE username = '$_SESSION[username]'"));
							
					$passlama		= md5(anti_injection($_POST['pl']));
					$passbaru		= md5(anti_injection($_POST['pb']));
					$passbaru2		= md5(anti_injection($_POST['pb2']));

					if ($passbaru == $passbaru2) {
						
						if ($_SESSION['password'] == $passlama) {
							mysql_query(" UPDATE hb_user_admin SET password = '$passbaru' WHERE username = '$_SESSION[username]'") or die ("Ups! Gagal Ditambahkan, Silahkan Coba Lagi! ".mysql_error());
							
							$_SESSION["password"] = $passbaru;
							?>
							<script>
								alert(" Password Berhasil Diganti ");
								top.location="gantipassword.php";
							</script><?php
						}else{
							echo"
								<script>
									alert('Password Lama Anda Salah');
									top.location='gantipassword.php';
								</script>";
						}
					}
					else{
						echo"
						<script>
							alert('Password Baru Anda Tidak Sama');
							top.location='gantipassword.php';
						</script>";
					}

				}
			break;

			case "hapusadmin":

				$nip = $_GET['nip'];

				$deletefoto= mysql_fetch_array(mysql_query("SELECT * FROM hb_pengelola_hubin WHERE nip='$nip' LIMIT 1"));
				if ($deletefoto["foto"] != "") {
					$deletefoto["foto"] = "../images/admin/".$deletefoto["foto"];
					if(file_exists($deletefoto["foto"])){unlink($deletefoto["foto"]);}
				}

				mysql_query("DELETE FROM hb_user_admin WHERE username = '$nip'");
				mysql_query("DELETE FROM hb_pengelola_hubin WHERE nip = '$nip'");
				echo"
					<script>
						alert('Admin dengan NIP $nip Telah Dihapus');
						top.location='lihatadmin.php';
					</script>";
			break;
		}
	}
		
}else{
	header('location:../login.php');
}

?>


