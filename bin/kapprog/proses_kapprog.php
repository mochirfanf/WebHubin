<?php
	
	include "../koneksidb.php";

	function anti_injection($param){
		$filter = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($param,ENT_QUOTES))));
		return $filter;
	}

if($_SESSION['level']=='kapprog'){ 
	if (!empty($_GET ["a"])) {
		switch ($_GET ["a"]){
			
			case "settahun_ajaran":
				if(isset($_POST['Oke'])){
					$tahun_ajaran	= $_POST['tahun_ajaran'];
					$_SESSION['tahun_ajaran'] = $tahun_ajaran;
					header("location:homepage.php");
				}
			break;

			case "inputkelolaprakerin":
				if(isset($_POST['Tambahkan'])){
					$nis = anti_injection($_POST["nis"]);
					$id_du = anti_injection($_POST["id_du"]);
					$saran_pembimbing = anti_injection($_POST["saran_pembimbing"]);

					mysql_query(" INSERT INTO hb_prakerin(nis, id_du, status_verifikasi,saran_pembimbing,nip_guru) VALUES ('$nis', '$id_du', 'Menunggu Verifikasi', '$saran_pembimbing', '$saran_pembimbing')")or die ("Ups! Gagal Ditambahkan, Silahkan Coba Lagi! ".mysql_error());

					$d = mysql_fetch_array( mysql_query("SELECT sisa_kuota_penerimaan FROM hb_du_penerima WHERE id_du=$id_du AND id_jurusan = $_SESSION[jurusan]"));
					$sisa = $d["sisa_kuota_penerimaan"] - 1 ;
					mysql_query("UPDATE hb_du_penerima SET sisa_kuota_penerimaan= $sisa WHERE id_du=$id_du AND id_jurusan = $_SESSION[jurusan]") or die ("Ups! Gagal Diperbaharui, Silahkan Coba Lagi! ".mysql_error());
					?>
					<script>
						alert(" Berhasil Dimasukkan ");
						top.location='kelola_prakerin.php';
					</script><?php
				}
			break;

			case "updatekelolaprakerin":
				if(isset($_POST['Perbaharui'])){
					$nis = anti_injection($_POST["nis"]);
					$id_du = anti_injection($_POST["id_du"]);
					$saran_pembimbing = anti_injection($_POST["saran_pembimbing"]);
					$iddulama = $_POST["iddulama"];

					$d = mysql_fetch_array( mysql_query("SELECT sisa_kuota_penerimaan FROM hb_du_penerima WHERE id_du=$iddulama AND id_jurusan = $_SESSION[jurusan]"));
					$sisa = $d["sisa_kuota_penerimaan"] + 1 ;
					mysql_query("UPDATE hb_du_penerima SET sisa_kuota_penerimaan= $sisa WHERE id_du=$iddulama AND id_jurusan = $_SESSION[jurusan]") or die ("Ups! Gagal Diperbaharui, Silahkan Coba Lagi! ".mysql_error());

					$d = mysql_fetch_array( mysql_query("SELECT sisa_kuota_penerimaan FROM hb_du_penerima WHERE id_du=$id_du AND id_jurusan = $_SESSION[jurusan]"));
					$sisa = $d["sisa_kuota_penerimaan"] - 1 ;
					mysql_query("UPDATE hb_du_penerima SET sisa_kuota_penerimaan= $sisa WHERE id_du=$id_du AND id_jurusan = $_SESSION[jurusan]") or die ("Ups! Gagal Diperbaharui, Silahkan Coba Lagi! ".mysql_error());

					mysql_query(" UPDATE hb_prakerin SET nis = '$nis', id_du = '$id_du', saran_pembimbing = '$saran_pembimbing', nip_guru = '$saran_pembimbing' WHERE id_prakerin = $_GET[id]")or die ("Ups! Gagal Diperbaharui, Silahkan Coba Lagi! ".mysql_error());


					?>
					<script>
						alert(" Berhasil Diperbaharui ");
						top.location='kelola_prakerin.php';
					</script><?php
				}
			break;

			case "inputperizinan":
				if (isset($_POST['Tambahkan'])){
					
					$nis 		= anti_injection($_POST['nis']);
					$nama_du	= anti_injection($_POST['nama_du']);
					$alamat		= anti_injection($_POST['alamat']);
					$kota		= anti_injection($_POST['kota']);
					$email		= anti_injection($_POST['email']);
					$keterangan	= anti_injection($_POST['keterangan']);

					mysql_query(" INSERT INTO hb_du(tahun_ajaran, nama_du, alamat, kota, status_du, email, permintaan_siswa, du_siswa, keterangan_du ) VALUES ('$_SESSION[tahun_ajaran]', '$nama_du', '$alamat', '$kota', 'DU_Siswa', '$email', $nis, 'Yes', '$keterangan')")or die ("Ups! Gagal Ditambahkan, Silahkan Coba Lagi! ".mysql_error());

					?>
					<script>
						alert(" Berhasil Dimasukkan ");
						top.location='inputperizinan.php';
					</script><?php
				}
			break;

			case "editperizinan":
				if (isset($_POST['Perbaharui'])){
					
					$nama_du	= anti_injection($_POST['nama_du']);
					$alamat		= anti_injection($_POST['alamat']);
					$kota		= anti_injection($_POST['kota']);
					$email		= anti_injection($_POST['email']);
					$keterangan	= anti_injection($_POST['keterangan']);
					
					mysql_query(" UPDATE hb_du SET nama_du = '$nama_du', alamat = '$alamat', kota = '$kota', email ='$email', keterangan_du ='$keterangan' WHERE id_du = '$_GET[id]'")or die ("Ups! Gagal Diperbaharui, Silahkan Coba Lagi! ".mysql_error());

					?>
					<script>
						alert(" Berhasil Diperbaharui ");
						top.location='inputperizinan.php';
					</script><?php
				}
			break;
			
			case "hapusdu":
				$id = $_GET["id"];
				mysql_query("DELETE FROM hb_du WHERE id_du = $id")or die ("Ups! Gagal Dihapus, Silahkan Coba Lagi! ".mysql_error());
				?>
					<script>
						alert(" DU Telah Dihapus ");
						top.location='inputperizinan.php';
					</script><?php
			break;

			case "hapusprakerin":
				$id = $_GET["id"];
				
				$data = mysql_query("SELECT id_du FROM hb_prakerin WHERE id_prakerin=$id");
				while ($d = mysql_fetch_array($data)) {
					$e = mysql_fetch_array(mysql_query("SELECT sisa_kuota_penerimaan FROM hb_du_penerima WHERE id_du=$d[id_du] AND id_jurusan = $_SESSION[jurusan]"));
					$sisa = $e["sisa_kuota_penerimaan"] + 1 ;
					mysql_query("UPDATE hb_du_penerima SET sisa_kuota_penerimaan= $sisa WHERE id_du=$d[id_du] AND id_jurusan = $_SESSION[jurusan]") or die ("Ups! Gagal Diperbaharui, Silahkan Coba Lagi! ".mysql_error());
				}

				mysql_query("DELETE FROM hb_prakerin WHERE id_prakerin = $id")or die ("Ups! Gagal Dihapus, Silahkan Coba Lagi! ".mysql_error()); 
				?>
					<script>
						alert(" Siswa Telah Dihapus ");
						top.location='kelola_prakerin.php';
					</script><?php 
			break;

			case "inputmonitoring":
				if (isset($_POST['Tambahkan'])){
					
					$nis 				= anti_injection($_POST['nis']);
					$id_du				= anti_injection($_POST['id_du']);
					$tgl_monitoring		= anti_injection($_POST['tgl_monitoring']);
					$kegiatan			= anti_injection($_POST['kegiatan']);
					$masalah			= anti_injection($_POST['masalah']);
					$saran				= anti_injection($_POST['saran']);
					$nilai				= anti_injection($_POST['nilai']);

					mysql_query(" INSERT INTO hb_monitoring( id_du, nis, nip_guru, tgl_monitoring, tgl_masuk, kegiatan_siswa, nilai, masalah_yg_ditemukan, saran ) 
						VALUES ('$id_du', '$nis', '$_SESSION[username]', '$tgl_monitoring', NOW(), '$kegiatan', '$nilai', '$masalah', '$saran')")or die ("Ups! Gagal Ditambahkan, Silahkan Coba Lagi! ".mysql_error());

					?>
					<script>
						alert(" Berhasil Dimasukkan ");
						top.location='hasil_monitoring.php';
					</script><?php
				}
			break;

			case "updatemonitoring":
				if(isset($_POST['Perbaharui'])){
					$tgl_monitoring		= anti_injection($_POST['tgl_monitoring']);
					$kegiatan			= anti_injection($_POST['kegiatan']);
					$masalah			= anti_injection($_POST['masalah']);
					$saran				= anti_injection($_POST['saran']);
					$nilai				= anti_injection($_POST['nilai']);

					mysql_query(" UPDATE hb_monitoring SET tgl_monitoring = '$tgl_monitoring', kegiatan_siswa = '$kegiatan', masalah_yg_ditemukan = '$masalah', nilai = '$nilai', saran = '$saran' WHERE id_monitoring = $_GET[id]")or die ("Ups! Gagal Diperbaharui, Silahkan Coba Lagi! ".mysql_error());


					?>
					<script>
						alert(" Berhasil Diperbaharui ");
						top.location='hasil_monitoring.php';
					</script><?php
				}
			break;

			case "hapusmonitoring":
				$id = $_GET["id"];

				mysql_query("DELETE FROM hb_monitoring WHERE id_monitoring = $id")or die ("Ups! Gagal Dihapus, Silahkan Coba Lagi! ".mysql_error()); 
				?>
					<script>
						alert(" Siswa Telah Dihapus ");
						top.location='hasil_monitoring.php';
					</script><?php 
			break;

		}
	
	}	
}else{
	header('location:../login.php');
}

?>


