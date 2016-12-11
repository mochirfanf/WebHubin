<?php
	
	include "../koneksidb.php";

	function anti_injection($param){
		$filter = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($param,ENT_QUOTES))));
		return $filter;
	}

if($_SESSION['level']=='siswa'){ 
	if (!empty($_GET ["a"])) {
		switch ($_GET ["a"]){
			case "tambahbimbingan":
				$materi = anti_injection($_POST['materi']);
				$tanggal = $_POST['tanggal'];
				mysql_query(" INSERT INTO hb_bimbingan_tatap(nis,materi,tanggal_bimbingan,status) VALUES ('$_SESSION[username]','$materi','$tanggal','Belum Terverifikasi')") or die ("Ups! Gagal Ditambahkan, Silahkan Coba Lagi! ".mysql_error());
		        header("location:bimbingan2.php");

			break;
			case "update_profil":
		        $tempat = anti_injection($_POST['tempat']);
		        $tanggal = anti_injection($_POST['tanggal']);
		        $jk = anti_injection($_POST['jk']);
		        $alamat = anti_injection($_POST['alamat']);
		        $agama = anti_injection($_POST['agama']);
		        $goldar = anti_injection($_POST['goldar']);
		        $email = anti_injection($_POST['email']);
		        $no_telp = anti_injection($_POST['no_telp']);


		        mysql_query("UPDATE siswa SET tempat_lahir='$tempat', tanggal_lahir='$tanggal', jenis_kelamin='$jk', alamat_siswa='$alamat', agama='$agama', gol_darah = '$goldar', email_siswa='$email', no_telepon='$no_telp' WHERE nis='$_SESSION[username]'") or die ("Ups! Gagal Ditambahkan, Silahkan Coba Lagi! ".mysql_error());
		        ?>
					<script>
						alert("Profil telah diperbarui!");
						window.history.go(-1);
					</script><?php

		     
			break;
			case "hapuskegiatan":
				mysql_query("DELETE FROM hb_kegiatan_prakerin WHERE id_kegiatan ='$_POST[id]'")or die ("Ups! Gagal Dihapus, Silahkan Coba Lagi! ".mysql_error());

				?>
					<script>
						alert("Kegiatan tersebut telah dihapus!");
						window.history.go(-1);
					</script><?php

			break;
			case "ubahkegiatanprakerin":
		        $kegiatan = anti_injection($_POST['kegiatan']);
		        $mingguke = anti_injection($_POST['mingguke']);

		        mysql_query("UPDATE hb_kegiatan_prakerin SET jenis_kegiatan='$kegiatan', mingguke='$mingguke' WHERE id_kegiatan='$_POST[id]'") or die ("Ups! Gagal Ditambahkan, Silahkan Coba Lagi! ".mysql_error());
		        ?>
					<script>
						alert("Kegiatan tersebut telah diperbarui!");
						window.history.go(-1);
					</script><?php

		     break;
			case "tambahkegiatanprakerin":
		        $kegiatan = anti_injection($_POST['kegiatan']);
		        $mingguke = anti_injection($_POST['mingguke']);

		        mysql_query(" INSERT INTO hb_kegiatan_prakerin(nis,jenis_kegiatan,mingguke) VALUES ('$_SESSION[username]','$kegiatan','$mingguke')") or die ("Ups! Gagal Ditambahkan, Silahkan Coba Lagi! ".mysql_error());
		        header("location:kegiatanprakerin.php");

		     break;

			case "lamarkerja":
		        $iddukerja = anti_injection($_POST['id']);
		        $portofolio = anti_injection($_POST['portofolio']);
		        $tgl = date('Y-m-d');
		        if(!empty($_FILES['lampiran'])){
		        $namafolder="lampiran/";
				$file_ext = substr($_FILES["lampiran"]["name"], strripos($_FILES["lampiran"]["name"], '.')); // strip name
				    
					$lam1 = $namafolder . basename($_FILES["lampiran"]["name"]);
					$lam2 = $namafolder . basename($iddukerja."-".$tgl). $file_ext;				
					if (!move_uploaded_file($_FILES['lampiran']['tmp_name'], $lam2))
					{
					   die("Failed Upload the File");
					}
			
				}

		        mysql_query(" INSERT INTO hb_lamar_kerja(id_du_kerja, nis, tgl, portofolio, status,lampiran) VALUES ('$iddukerja','$_SESSION[username]', '$tgl', '$portofolio','Belum Diterima','$lam2')") or die ("Ups! Gagal Ditambahkan, Silahkan Coba Lagi! ".mysql_error());
		        if($_GET['lan']=='ya'){
		        	$hl = "location:../landing/detail.php?id=".$iddukerja;
		    	header($hl);
		    	}else{
		    	header("location:lowongankerja.php");
		    	}
		     break;

			case "pilihtempat":
				if(isset($_POST['Tambahkan'])){
					$id_du = anti_injection($_POST["id_du"]);
					$alasan = anti_injection($_POST["alasan"]);

					mysql_query(" INSERT INTO hb_prakerin(nis, id_du, status_verifikasi,alasan_memilih, tahun_ajaran) VALUES ('$_SESSION[username]', '$id_du', 'Menunggu Verifikasi Kapprog', '$alasan', '$_SESSION[tahun_ajaran]')") or die ("Ups! Gagal Ditambahkan, Silahkan Coba Lagi! ".mysql_error());

					$d = mysql_fetch_array( mysql_query("SELECT sisa_kuota_penerimaan FROM hb_du_penerima WHERE id_du=$id_du AND id_jurusan = $_SESSION[jurusan]"));
					$sisa = $d["sisa_kuota_penerimaan"] - 1 ;
					mysql_query("UPDATE hb_du_penerima SET sisa_kuota_penerimaan= $sisa WHERE id_du=$id_du AND id_jurusan = $_SESSION[jurusan]") or die ("Ups! Gagal Diperbaharui, Silahkan Coba Lagi! ".mysql_error());

					?>
					<script>
						alert(" Berhasil Mendaftar! \n Tunggu Verifikasi Kapprog Selanjutnya ");
						top.location='pilih_tempat_prakerin.php';
					</script><?php
				}
			break;

			case "hapus_permintaan":

				mysql_query("DELETE FROM hb_prakerin WHERE nis = '$_SESSION[username]' ")or die ("Ups! Gagal Dihapus, Silahkan Coba Lagi! ".mysql_error());

				$d = mysql_fetch_array( mysql_query("SELECT sisa_kuota_penerimaan FROM hb_du_penerima WHERE id_du='$_POST[id_du]' AND id_jurusan = $_SESSION[jurusan]"));
				$sisa = $d["sisa_kuota_penerimaan"] + 1 ;
				mysql_query("UPDATE hb_du_penerima SET sisa_kuota_penerimaan= $sisa WHERE id_du='$_POST[id_du]' AND id_jurusan = $_SESSION[jurusan]") or die ("Ups! Gagal Diperbaharui, Silahkan Coba Lagi! ".mysql_error());

				header("location:pilih_tempat_prakerin.php");
			break;

			case "tambah_kegiatan":
				if(isset($_POST['Tambahkan'])){

					$nama_kegiatan = anti_injection($_POST["nama_kegiatan"]);
					$nama_tempat = anti_injection($_POST["nama_tempat"]);
					$status_kegiatan = anti_injection($_POST["status_kegiatan"]);
					$tglawal = anti_injection($_POST["tglawal"]);
					$tglakhir = anti_injection($_POST["tglakhir"]);
					$alamat = anti_injection($_POST["alamat"]);

					mysql_query(" INSERT INTO hb_riwayat_siswa(nis, nama_kegiatan, nama_tempat, tanggal_awal_riwayat, tanggal_selesai_riwayat, alamat_tempat, status) VALUES ('$_SESSION[username]', '$nama_kegiatan', '$nama_tempat', '$tglawal', '$tglakhir', '$alamat', '$status_kegiatan')") or die ("Ups! Gagal Ditambahkan, Silahkan Coba Lagi! ".mysql_error());


					?>
					<script>
						alert(" Berhasil Ditambahkan");
						top.location='riwayat_kegiatan.php';
					</script><?php
				}
			break;

			case "hapuskegiatan":
				
				mysql_query("DELETE FROM hb_riwayat_siswa WHERE id_riwayat ='$_GET[id]'")or die ("Ups! Gagal Dihapus, Silahkan Coba Lagi! ".mysql_error());

				?>
					<script>
						alert("Kegiatan tersebut telah dihapus!");
						window.history.go(-1);
					</script><?php
			break;

			case "editkegiatan":
				
				if (isset($_POST['Perbaharui'])){

					$nama_kegiatan = anti_injection($_POST["nama_kegiatan"]);
					$nama_tempat = anti_injection($_POST["nama_tempat"]);
					$status_kegiatan = anti_injection($_POST["status_kegiatan"]);
					$tglawal = anti_injection($_POST["tglawal"]);
					$tglakhir = anti_injection($_POST["tglakhir"]);
					$alamat = anti_injection($_POST["alamat"]);


                    mysql_query("UPDATE hb_riwayat_siswa SET nis = '$_SESSION[username]', nama_kegiatan = '$nama_kegiatan', nama_tempat = '$nama_tempat', status = '$status_kegiatan', tanggal_awal_riwayat = '$tglawal', tanggal_selesai_riwayat = '$tglakhir', alamat_tempat = '$alamat' WHERE id_riwayat='$_GET[id]'") or die ("Ups! Gagal Diupdate, Silahkan Coba Lagi! ".mysql_error());

                    ?>
                        <script>
                            alert(" Berhasil Diperbaharui ");
							window.history.go(-1);
                        </script>
                 <?php
				}
			break;
		}
	
	}	
}else{
	header('location:../login.php');
}

?>


