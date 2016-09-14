<?php
	
	include "../koneksidb.php";

	function anti_injection($param){
		$filter = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($param,ENT_QUOTES))));
		return $filter;
	}

if($_SESSION['level']=='admin'){ 
	if (!empty($_GET ["a"])) {
		switch ($_GET ["a"]){
			case "update":
				if (isset($_POST['MASUK'])){
					

					if(empty($_POST['jk'])) {
						$jk = "";
					}else{
						$jk	= anti_injection($_POST['jk']);
					}

					if(empty($_POST['gol'])) {
						$gol = "";
					}else{
						$gol = anti_injection($_POST['gol']);
					}

					if(empty($_POST['status'])) {
						$status = "";
					}else{
						$status	= anti_injection($_POST['status']);
					}

					$username		= anti_injection($_POST['username']);
					$nama			= anti_injection($_POST['nama']);
					$jabatan		= anti_injection($_POST['jabatan']);
					$tempat_lahir	= anti_injection($_POST['tempat_lahir']);
					$tanggal_lahir	= anti_injection($_POST['tanggal_lahir']);
					$alamat			= anti_injection($_POST['alamat']);
					$agama			= anti_injection($_POST['agama']);
					$email			= anti_injection($_POST['email']);
					$nomor			= anti_injection($_POST['nomor']);
					$motto			= anti_injection($_POST['motto']);
					$foto 		    = $_FILES['foto']['name'];
					$error 			= $_FILES['foto']['error'];
					$temporary_sementara = $_FILES['foto']['tmp_name'];
					
					mysql_query(" UPDATE hb_user_admin SET username = '$username' WHERE username = '$_SESSION[username]'") or die ("Ups! Gagal Ditambahkan, Silahkan Coba Lagi! ".mysql_error());
					mysql_query(" UPDATE hb_pengelola_hubin SET username = '$username', nama = '$nama', jabatan = '$jabatan', jenis_kelamin = '$jk', tempat_lahir = '$tempat_lahir', tanggal_lahir = '$tanggal_lahir' , alamat = '$alamat' , agama = '$agama', email = '$email', no_telepon= '$nomor', gol_darah = '$gol', status ='$status', motto_hidup = '$motto' WHERE nip = '$_SESSION[nip]'") or die ("Ups! Gagal Ditambahkan, Silahkan Coba Lagi! ".mysql_error());
					
					$_SESSION["username"] = $username;
					?>
					<script>
						alert(" Profil Anda Telah Diperbaharui");
						top.location="updateprofile.php";
					</script><?php

					
					if ($foto !=="" && $error == 0){

						$replace_foto = mysql_fetch_array(mysql_query("SELECT * FROM hb_pengelola_hubin WHERE nip = '$_SESSION[nip]' LIMIT 1"));
						$nama_foto 	= $replace_foto["foto"];

						if ($nama_foto == "") {
							$move=move_uploaded_file($temporary_sementara, '../images/admin/'.$foto);
							if($move){
								mysql_query(" UPDATE hb_pengelola_hubin SET foto = '$foto' WHERE nip = '$_SESSION[nip]'") or die ("Ups! Gagal Ditambahkan, Silahkan Coba Lagi! ".mysql_error());
	
								?>
								<script>
									alert(" Foto Berhasil Diganti ");
									top.location="updateprofile.php";
								</script><?php
							}else{
								echo"
									<script>
										alert('Maaf Gagal Mengunggah Foto');
									</script>";
							}
						}else{
							$move=move_uploaded_file($temporary_sementara, '../images/admin/'.$nama_foto);
							if($move){
								mysql_query(" UPDATE hb_pengelola_hubin SET foto = '$nama_foto' WHERE nip = '$_SESSION[nip]'") or die ("Ups! Gagal Ditambahkan, Silahkan Coba Lagi! ".mysql_error());
	
								?>
								<script>
									alert(" Foto Berhasil Diganti ");
									top.location="updateprofile.php";
								</script><?php
							}else{
								echo"
									<script>
										alert('Maaf Gagal Mengunggah Foto');
									</script>";
							}
						}							
					}
				}
				
				
			break;

			case "gantipassword":
				if (isset($_POST['GANTI'])){

					$d = mysql_fetch_array(mysql_query("SELECT * FROM hb_user_admin WHERE username = '$_SESSION[username]'"));
							
					$passlama		= md5(anti_injection($_POST['pl']));
					$passbaru		= anti_injection($_POST['pb']);
					$passbaru2		= anti_injection($_POST['pb2']);

					if ($passbaru == $passbaru2) {
						
						if ($_SESSION['password'] == $passlama) {
							mysql_query(" UPDATE hb_user_admin SET password = MD5('$passbaru') WHERE username = '$_SESSION[username]'") or die ("Ups! Gagal Ditambahkan, Silahkan Coba Lagi! ".mysql_error());
							
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

			case "inputperizinan":
				if (isset($_POST['Tambahkan'])){
		
					$nama_du	= anti_injection($_POST['nama_du']);
					$alamat		= anti_injection($_POST['alamat']);
					$kota		= anti_injection($_POST['kota']);
					$email		= anti_injection($_POST['email']);
					$keterangan	= anti_injection($_POST['keterangan']);


					mysql_query(" INSERT INTO hb_du(tahun_ajaran, nama_du, alamat, kota, status_du, email, keterangan_du ) VALUES ('$_SESSION[tahun_ajaran]', '$nama_du', '$alamat', '$kota', 'Proses', '$email', '$keterangan')")or die ("Ups! Gagal Ditambahkan, Silahkan Coba Lagi! ".mysql_error());

					?>
					<script>
						alert(" Berhasil Dimasukkan ");
						top.location='inputperizinan.php';
					</script><?php
				}
			break;

			case "settahun_ajaran":
				if(isset($_POST['Oke'])){
					$tahun_ajaran	= $_POST['tahun_ajaran'];
					$_SESSION['tahun_ajaran'] = $tahun_ajaran;
					header("location:homepage.php");
				}

			break;

			case "menolak":
				$id = $_GET["id"];
				mysql_query(" UPDATE hb_du SET status_du='Menolak' WHERE id_du=$id") or die ("Ups! Gagal Diperbaharui, Silahkan Coba Lagi! ".mysql_error());
				?>
					<script>
						alert(" Status Telah Diperbaharui ");
						top.location='inputperizinan.php';
					</script><?php
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

			case "menerima":
				if (isset($_POST['Tambahkan'])){
					
					/*$jurusan = "jurusan$id";
					$jumlah = "jumlah$id";
					$jurusan1	= anti_injection($_POST[$jurusan]);
					$jumlah1	= anti_injection($_POST[$jumlah]);*/

					$id = $_GET["id"];
					
					$nama_pj	= anti_injection($_POST['nama_pj']);
					$mulai		= anti_injection($_POST['mulai']);
					$berakhir	= anti_injection($_POST['berakhir']);


					if(isset($_POST["seleksi"])){ 
						$seleksi	= anti_injection($_POST['seleksi']);
					}else{
						$seleksi="No";
					}

					if(isset($_POST["jurusan"])){  
						$no=0;
					    foreach($_POST["jurusan"] as $jurusan){
					    	$no= $no+1;
					    	$ajur["$no"] = "$jurusan";
					    }
					}

					if(isset($_POST["jumlah"])){ 
						$no=0;   
					    foreach($_POST["jumlah"] as $jumlah){
					    	$no= $no+1;
					    	$ajum["$no"] = "$jumlah";
					    }
					}

					for ($i=1; $i<=$no; $i++) { 
						
						mysql_query(" INSERT INTO hb_du_penerima(id_du, id_jurusan, jumlah_penerimaan, sisa_kuota_penerimaan) VALUES ('$id', '$ajur[$i]', '$ajum[$i]', '$ajum[$i]')")or die ("Ups! Gagal Ditambahkan, Silahkan Coba Lagi! ".mysql_error());
					}
					
					mysql_query(" UPDATE hb_du SET nama_penanggung_jawab='$nama_pj', mulai_pelaksanaan='$mulai', berakhir_pelaksanaan = '$berakhir', status_du='Menerima', seleksi_du = '$seleksi' WHERE id_du=$id") or die ("Ups! Gagal Diperbaharui, Silahkan Coba Lagi! ".mysql_error());


				?>
					<script>
						alert(" Status Telah Diperbaharui ");
						top.location='inputperizinan.php';
					</script><?php 
					
				}
			break;

			case "tambahpenerimajur":
				$id = $_GET["id"];
				$id_du = anti_injection($_POST["id_du"]);
				$jumlah = anti_injection($_POST["jumlah"]);

				mysql_query(" INSERT INTO hb_du_penerima(id_du, id_jurusan, jumlah_penerimaan, sisa_kuota_penerimaan) VALUES ('$id_du', '$id', '$jumlah', '$jumlah')")or die ("Ups! Gagal Ditambahkan, Silahkan Coba Lagi! ".mysql_error());
					

				?>
					<script>
						alert(" Berhasil Ditambahkan ");
						top.location='dupenerima.php';
					</script><?php 
					

			break;

			case "editjpenerima":
				if(isset($_POST['Perbaharui'])){
					
					$id = $_GET["id"];
					$id_jur = $_GET["id_jurusan"];
					$jpen = anti_injection($_POST["jpen"]);

					$j = mysql_fetch_array(mysql_query("SELECT * FROM hb_du_penerima WHERE id_du = '$id' AND id_jurusan = $id_jur"));

					$selisih = $j["jumlah_penerimaan"] - $j["sisa_kuota_penerimaan"];
					
					if ($selisih <= $jpen) {
						$hasil = $jpen - $selisih;
						mysql_query(" UPDATE hb_du_penerima SET jumlah_penerimaan='$jpen', sisa_kuota_penerimaan='$hasil' WHERE id_du = '$id' AND id_jurusan = $id_jur") or die ("Ups! Gagal Diperbaharui, Silahkan Coba Lagi! ".mysql_error());


						?>
							<script>
								alert(" Jumlah Penerimaan Telah Diperbaharui ");
								top.location='dupenerima.php';
							</script><?php 
						
					}

					if ($selisih > $jpen) {

						?>
							<script>
								alert(" Maaf Tidak Dapat Diperbaharui! \n Karena jumlah siswa yg terverifikasi sudah melebihi batas  jumlah penerimaan yang anda masukan! ");
								top.location='dupenerima.php';
							</script><?php 
						
					}
					
				}
			break;

			case "editperizinan":
				if(isset($_POST['Perbaharui'])){
					
					$id = $_GET["id"];
					$nama_du	= anti_injection($_POST['nama_du']);
					$alamat		= anti_injection($_POST['alamat']);
					$kota		= anti_injection($_POST['kota']);
					$email		= anti_injection($_POST['email']);
					$keterangan	= anti_injection($_POST['keterangan']);

					mysql_query(" UPDATE hb_du SET nama_du = '$nama_du', alamat = '$alamat', kota = '$kota', email = '$email', keterangan_du = '$keterangan' WHERE id_du = $id") or die ("Ups! Gagal Diperbaharui, Silahkan Coba Lagi! ".mysql_error());

					?>
					<script>
						alert(" Berhasil Diperbaharui ");
						top.location='inputperizinan.php';
					</script><?php 
				}
			break;

			case "editpenerima":
				if(isset($_POST['Perbaharui'])){
					
					$id = $_GET["id"];

					$nama_du	= anti_injection($_POST['nama_du']);
					$alamat		= anti_injection($_POST['alamat']);
					$kota		= anti_injection($_POST['kota']);
					$email		= anti_injection($_POST['email']);
					$keterangan	= anti_injection($_POST['keterangan']);
					$nama_pj	= anti_injection($_POST['nama_pj']);
					$mulai		= anti_injection($_POST['mulai']);
					$berakhir	= anti_injection($_POST['berakhir']);

					mysql_query(" UPDATE hb_du SET nama_du = '$nama_du', alamat = '$alamat', kota = '$kota', email = '$email', keterangan_du = '$keterangan', nama_penanggung_jawab = '$nama_pj', mulai_pelaksanaan= '$mulai', berakhir_pelaksanaan = '$berakhir' WHERE id_du = $id") or die ("Ups! Gagal Diperbaharui, Silahkan Coba Lagi! ".mysql_error());

					?>
					<script>
						alert(" Berhasil Diperbaharui ");
						top.location='dupenerima.php';
					</script><?php 
				}
			break;

			case "gantisistem":
				

					mysql_query(" UPDATE hb_du SET seleksi_du = 'Tidak', seleksi_tempat = '', seleksi_tanggal = '' WHERE id_du = $_GET[id]") or die ("Ups! Gagal Diperbaharui, Silahkan Coba Lagi! ".mysql_error());

					?>
					<script>
						alert(" Berhasil Diperbaharui ");
						top.location='dusistemseleksi.php';
					</script><?php 

			break;

			case "tambahseleksi":
				$id = anti_injection($_POST["id_du"]);
				mysql_query(" UPDATE hb_du SET seleksi_du = 'Ya' WHERE id_du = $id") or die ("Ups! Gagal Diperbaharui, Silahkan Coba Lagi! ".mysql_error());

					?>
					<script>
						alert(" Berhasil Ditambahkan ");
						top.location='dusistemseleksi.php';
					</script><?php 

			break;

			case "ketseleksi":

				$id = $_GET["id"];
				$tempat = anti_injection($_POST["tempat"]);
				$tanggal = anti_injection($_POST["tanggal"]);

				mysql_query(" UPDATE hb_du SET seleksi_tempat = '$tempat', seleksi_tanggal = '$tanggal', seleksi_du = 'Ya' WHERE id_du = $id") or die ("Ups! Gagal Diperbaharui, Silahkan Coba Lagi! ".mysql_error());

					?>
					<script>
						alert(" Berhasil Ditambahkan ");
						top.location='dusistemseleksi.php';
					</script><?php 
			break;

			case "hapus_penerima":

					$id = $_GET["id"];

					mysql_query(" UPDATE hb_du SET nama_penanggung_jawab = ' ', mulai_pelaksanaan= '0000-00-00', berakhir_pelaksanaan = '0000-00-00', status_du='Proses' WHERE id_du = $id") or die ("Ups! Gagal Diperbaharui, Silahkan Coba Lagi! ".mysql_error());
					mysql_query(" DELETE FROM hb_du_penerima WHERE id_du = $id") or die ("Ups! Gagal Diperbaharui, Silahkan Coba Lagi! ".mysql_error());
					mysql_query(" DELETE FROM hb_prakerin WHERE id_du = $id") or die ("Ups! Gagal Diperbaharui, Silahkan Coba Lagi! ".mysql_error());
					mysql_query(" DELETE FROM hb_monitoring WHERE id_du = $id") or die ("Ups! Gagal Diperbaharui, Silahkan Coba Lagi! ".mysql_error());

					?>
					<script>
						alert(" Berhasil Diperbaharui ");
						top.location='dupenerima.php';
					</script><?php 

				
			break; 

			case "hapuspenerimajurusan":

					$id = $_GET["id"];
					$id_jur = $_GET["id_jurusan"];

					mysql_query(" DELETE hb_du_penerima, hb_prakerin FROM hb_du_penerima INNER JOIN hb_prakerin ON hb_du_penerima.id_du = hb_prakerin.id_du INNER JOIN siswa ON hb_prakerin.nis = siswa.nis WHERE siswa.id_jurusan = '$id_jur' AND hb_du_penerima.id_jurusan = '$id_jur' AND hb_prakerin.id_du = '$id'") or die ("Ups! Gagal Diperbaharui, Silahkan Coba Lagi! ".mysql_error());
					mysql_query("DELETE FROM hb_du_penerima WHERE id_du = '$id' AND id_jurusan = '$id_jur'");
					?>
					<script>
						alert(" Berhasil Dihapus ");
						top.location='dupenerima.php';
					</script><?php 

				
			break;

			case "verifikasiperizinan":
				$id = $_GET["id"];
				mysql_query(" UPDATE hb_du SET status_du='Proses' WHERE id_du=$id") or die ("Ups! Gagal Diperbaharui, Silahkan Coba Lagi! ".mysql_error());

				?>
					<script>
						alert(" DU telah diverifikasi ");
						top.location='inputperizinansiswa.php';
					</script><?php 
				
			break;

			case "verifikasiprakerin":
				if(isset($_POST['Verifikasi'])){
					
					$id = $_GET["id"];
					$saran	= anti_injection($_POST['saran']);
					
					mysql_query(" UPDATE hb_prakerin SET status_verifikasi = 'Terverifikasi', status_prakerin = 'Menunggu Verifikasi Siswa', nip_guru = '$saran' WHERE id_prakerin = $id") or die ("Ups! Gagal Diperbaharui, Silahkan Coba Lagi! ".mysql_error());

					?>
					<script>
						alert(" Berhasil Diperbaharui ");
						top.location='rekapitulasikapprog.php';
					</script><?php 
				}		
			break;

			case "hapussiswaprakerin":
					
					$id = $_GET["id"];
					
					mysql_query(" UPDATE hb_prakerin SET status_verifikasi = 'Menunggu Verifikasi', status_prakerin = '' WHERE id_prakerin = $id") or die ("Ups! Gagal Diperbaharui, Silahkan Coba Lagi! ".mysql_error());

					?>
					<script>
						alert(" Berhasil Dihapus ");
						top.location='hasilrekapitulasi.php';
					</script><?php 
					
			break;


			case "inputberita":
				if (isset($_POST['Tambahkan'])){

					$kategori		= anti_injection($_POST['kategori']);
					$tgl_berita		= $_POST['tgl_berita'];
					$judul_berita	= anti_injection($_POST['judul_berita']);
					$isi_berita		= $_POST['isi_berita'];
					$keterangan		= anti_injection($_POST['keterangan']);
					$hits_berita	= anti_injection($_POST['hits_berita']);
					$sumber			= anti_injection($_POST['sumber']);

					$target_dir 	= "../images/uploads/";
					$target_file 	= $target_dir . basename($_FILES["thumbnail"]["name"]);
					$foto_berita	= $_FILES["thumbnail"]["name"];
					mysql_query(" INSERT INTO hb_berita(kategori, tgl_berita, judul_berita, isi_berita, keterangan, hits_berita, foto_berita, sumber ) VALUES ('$kategori', '$tgl_berita', '$judul_berita', '$isi_berita', '$keterangan', '$hits_berita', '$foto_berita', '$sumber')")or die ("Ups! Gagal Ditambahkan, Silahkan Coba Lagi! ".mysql_error());
					move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $target_file);

					?>
					<script>
						alert(" Berhasil Dimasukkan ");
						top.location='inputberita.php';
					</script><?php
				}
			break;

			case "editberita":
				if(isset($_POST['Perbaharui'])){
					
					$id = $_GET["id"];
					$kategori		= anti_injection($_POST['kategori']);
					$tgl_berita		= $_POST['tgl_berita'];
					$judul_berita	= anti_injection($_POST['judul_berita']);
					$isi_berita		= $_POST['isi_berita'];
					$keterangan		= anti_injection($_POST['keterangan']);
					$hits_berita	= anti_injection($_POST['hits_berita']);
					$sumber			= anti_injection($_POST['sumber']);
					$target_dir 	= "../images/uploads/";
					$target_file 	= $target_dir . basename($_FILES["thumbnail"]["name"]);

					if (file_exists($target_file)) {
						$c = mysql_fetch_array(mysql_query("SELECT * FROM hb_berita WHERE id_berita='$id'"));    
						$foto_berita	= $c['foto_berita'];
					}
					else{
						$c = mysql_fetch_array(mysql_query("SELECT * FROM hb_berita WHERE id_berita='$id'"));    
						$foto_berita_dulu	= "../images/uploads/".$c['foto_berita'];
						if(file_exists($foto_berita_dulu)){unlink($foto_berita_dulu);}

						$foto_berita	= $_FILES["thumbnail"]["name"];
						move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $target_file);
					}
					mysql_query(" UPDATE hb_berita SET kategori = '$kategori', tgl_berita = '$tgl_berita', judul_berita = '$judul_berita', isi_berita = '$isi_berita', keterangan = '$keterangan', hits_berita = '$hits_berita', foto_berita = '$foto_berita', sumber = '$sumber' WHERE id_berita = $id") or die ("Ups! Gagal Diperbaharui, Silahkan Coba Lagi! ".mysql_error());

					?>
					<script>
						alert(" Berhasil Diperbaharui ");
						top.location='inputberita.php';
					</script><?php 
				}
			break;


			case "hapusberita":
				$id = $_GET["id"];

				$c = mysql_fetch_array(mysql_query("SELECT * FROM hb_berita WHERE id_berita='$id'"));    
				$foto_berita_dulu	= "../images/uploads/".$c['foto_berita'];
				if(file_exists($foto_berita_dulu)){unlink($foto_berita_dulu);}

				mysql_query("DELETE FROM hb_berita WHERE id_berita = $id")or die ("Ups! Gagal Dihapus, Silahkan Coba Lagi! ".mysql_error());
				

				?>
					<script>
						alert(" Berita Telah Dihapus ");
						top.location='inputberita.php';
					</script><?php
			break;

		}
	
	}	
}else{
	header('location:../login.php');
}

?>


