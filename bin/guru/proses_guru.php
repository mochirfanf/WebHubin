<?php

	include "../koneksidb.php";

	function anti_injection($param){
		$filter = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($param,ENT_QUOTES))));
		return $filter;
	}

if($_SESSION['level']=='guru'){
	if (!empty($_GET ["a"])) {
		switch ($_GET ["a"]){
			case "verifikasibimbingan":

			mysql_query("UPDATE hb_bimbingan_tatap SET status='Sudah Terverifikasi' WHERE id_bimbingan_tatap='$_POST[id]'") or die ("Ups! Gagal Ditambahkan, Silahkan Coba Lagi! ".mysql_error());
					
					header("location:verifikasibimbingan.php?id=".$_POST['nis']);

			break;
			case "tanggalmonitoring" :
				if(isset($_POST['pilih'])){

					$ada= mysql_query("SELECT tgl_monitoring FROM hb_monitoring WHERE id_du='$_POST[iddu]'");
					$c = mysql_fetch_array($ada);

						mysql_query("UPDATE hb_monitoring SET tgl_monitoring='$_POST[tgl_monitoring]' WHERE id_du='$_POST[iddu]'") or die ("Ups! Gagal Ditambahkan, Silahkan Coba Lagi! ".mysql_error());
					
					
					header("location:jadwalmonitoring.php");
				}

			break;
			case "monitoring" :
				if(isset($_POST['pilih'])){
						$nilai = anti_injection($_POST['nilai']);
						$yg_menerima = anti_injection($_POST['yg_menerima']);
						$kegiatan = anti_injection($_POST['kegiatansiswa']);
						$masalah = anti_injection($_POST['masalah']);
						$saran = anti_injection($_POST['saran']);
						mysql_query("UPDATE hb_monitoring SET nilai='$nilai', yang_menerima='$yg_menerima', kegiatan_siswa='$kegiatan', masalah_yg_ditemukan='$masalah', saran='$saran', tahun_ajaran='$_SESSION[tahun_ajaran]', nip_guru='$_SESSION[username]' WHERE id_du='$_POST[iddu]'") or die ("Ups! Gagal Ditambahkan, Silahkan Coba Lagi! ".mysql_error());
					
					
					header("location:yangbelummonitoring.php");
				}

			break;
			case "settahun_ajaran":
				if(isset($_POST['Oke'])){
					$tahun_ajaran	= $_POST['tahun_ajaran'];
					$_SESSION['tahun_ajaran'] = $tahun_ajaran;
					header("location:homepage.php");
				}
			break;
		}

	}
}else{
	header('location:../login.php');
}

?>


