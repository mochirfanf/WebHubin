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

					mysql_query(" INSERT INTO hb_prakerin(nis, id_du, status_verifikasi,saran_pembimbing,nip_guru) VALUES ('$nis', '$id_du', 'Menunggu Verifikasi', '$saran_pembimbing', '$saran_pembimbing')") or die ("Ups! Gagal Ditambahkan, Silahkan Coba Lagi! ".mysql_error());

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
								$nama = anti_injection($_POST['nama_du']);
                $email = anti_injection($_POST['email_du']);
                $alamat = anti_injection($_POST['alamat']);
                $provinsi = anti_injection($_POST['prop']);
                $kabupaten = anti_injection($_POST['kota']);
                $kecamatan = anti_injection($_POST['kec']);
                $kelurahan = anti_injection($_POST['kel']);
                $kodepos = anti_injection($_POST['kodepos']);
								$keterangan	= anti_injection($_POST['keterangan']);

										$a = mysql_query("SELECT email_du FROM hb_du_umum");
               		  $f = 0;

                    while($d=mysql_fetch_array($a)){
                      if($d['email_du']==$email){
                          $f=1;
                      }
                    }

                    if($f==0){

                        mysql_query("INSERT INTO hb_du_umum ( nama_du, email_du, alamat, id_prov, id_kab, id_kec, id_kel, no_kodepos)
                                VALUES('$nama','$email','$alamat','$provinsi', '$kabupaten', '$kecamatan', '$kelurahan' , '$kodepos')") or die ("Ups! Gagal Ditambahkan, Silahkan Coba Lagi! ".mysql_error());

                        $x = mysql_fetch_array(mysql_query("SELECT id_du FROM hb_du_umum ORDER BY id_du DESC LIMIT 1")) ;

               		  		mysql_query("INSERT INTO hb_du_permintaan (id_du, permintaan_siswa, du_siswa, tahun_ajaran, keterangan_permintaan, status_permintaan, status_du)
                                VALUES('$x[id_du]' ,'Ya','$nis','$_SESSION[tahun_ajaran]', '$keterangan', 'Belum Terverifikasi', 'DU/DI dari Siswa')")  or die ("Ups! Gagal Ditambahkan, Silahkan Coba Lagi! ".mysql_error());


                        ?>
                            <script>
                                alert(" Berhasil Meminta Izin. Tunggu Tindakan Selanjutnya dari Hubin ");
                                top.location = 'inputperizinan.php';
                            </script>
                            <?php

                    }else{
                      ?>
                            <script>
                                alert('Gagal Dikirim ! Perusahaan Telah Ada');
                                top.location = 'inputperizinan.php';
                            </script>
                            <?php
                    }
						}

			break;

			case "editperizinan":
				if (isset($_POST['Perbaharui'])){

								$nama = anti_injection($_POST['nama_du']);
                $email = anti_injection($_POST['email_du']);
                $alamat = anti_injection($_POST['alamat']);
                $provinsi = anti_injection($_POST['prop']);
                $kabupaten = anti_injection($_POST['kota']);
                $kecamatan = anti_injection($_POST['kec']);
                $kelurahan = anti_injection($_POST['kel']);
                $kodepos = anti_injection($_POST['kodepos']);
								$keterangan	= anti_injection($_POST['keterangan']);


                        mysql_query("UPDATE hb_du_umum SET nama_du = '$nama', email_du = '$email', alamat = '$alamat', id_prov = '$provinsi', id_kab = '$kabupaten', id_kec = '$kecamatan', id_kel = '$kelurahan', no_kodepos='$kodepos' WHERE id_du='$_GET[id]'") or die ("Ups! Gagal Diupdate, Silahkan Coba Lagi! ".mysql_error());


               		  		mysql_query("UPDATE hb_du_permintaan SET  keterangan_permintaan = '$keterangan' WHERE id_du='$_GET[id]' ")  or die ("Ups! Gagal Diupdate, Silahkan Coba Lagi! ".mysql_error());


                        ?>
                            <script>
                                alert(" Berhasil Diupdate ");
                                top.location = 'inputperizinan.php';
                            </script>
                     <?php
				}
			break;

			case "hapusdu":
				$id = $_GET["id"];
				mysql_query("DELETE FROM hb_du_umum WHERE id_du = $id")or die ("Ups! Gagal Dihapus, Silahkan Coba Lagi! ".mysql_error());

				mysql_query("DELETE FROM hb_du_permintaan WHERE id_du = $id")or die ("Ups! Gagal Dihapus, Silahkan Coba Lagi! ".mysql_error());
				?>
					<script>
						alert(" Permintaan Perizinan Telah Dihapus ");
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


