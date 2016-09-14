<?php
	
	include "../koneksidb.php";

	function anti_injection($param){
		$filter = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($param,ENT_QUOTES))));
		return $filter;
	}

if($_SESSION['level']=='perusahaan'){ 
	if (!empty($_GET ["a"])) {
		switch ($_GET ["a"]){
			case "settahun_ajaran":
				if(isset($_POST['Oke'])){
					$tahun_ajaran	= $_POST['tahun_ajaran'];
					$_SESSION['tahun_ajaran'] = $tahun_ajaran;
					header("location:homepage.php");
				}
			break;
			case "update-profil":
				if(isset($_POST['submit'])){
                    $nama = anti_injection($_POST['nama']);
                    $bidang = anti_injection($_POST['bidang']);
                    $alamat = anti_injection($_POST['alamat']);
                    $kota = anti_injection($_POST['kota']);
                    $penanggungjawab = anti_injection($_POST['penanggungjawab']);
                    $email = anti_injection($_POST['email']);
                    $telepon = anti_injection($_POST['telepon']);
                    mysql_query("UPDATE hb_du SET nama_du='$nama',bidang='$bidang',alamat='$alamat',kota='$kota',nama_penanggung_jawab='$penanggungjawab',email='$email',telepon='$telepon' WHERE username='$_SESSION[username]'");
					header("location:identitas.php");
				}
			break;
            case "update-prakerin":
                    
					$mulai		= anti_injection($_POST['mulai']);
					$berakhir	= anti_injection($_POST['akhir']);
                
					if(isset($_POST["seleksi"])){ 
						$seleksi	= anti_injection($_POST['seleksi']);
					}else{
						$seleksi="Tidak";
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
                    $qr = mysql_query("SELECT id_du FROM hb_du WHERE username='$_SESSION[username]'");
                    $dd = mysql_fetch_array($qr);
                    $id = $dd['id_du'];
                    $qq = mysql_query("DELETE FROM hb_du_penerima WHERE id_du=$id");
					for ($i=1; $i<=$no; $i++) { 
						
						mysql_query(" INSERT INTO hb_du_penerima(id_du, id_jurusan, jumlah_penerimaan, sisa_kuota_penerimaan) VALUES ('$id', '$ajur[$i]', '$ajum[$i]', '$ajum[$i]')")or die ("Ups! Gagal Ditambahkan, Silahkan Coba Lagi! ".mysql_error());
					}
                    $us = "Tidak";
                    $um = "Tidak";
                    $as = "Tidak";
                    $ut = "Tidak";
                    
					if(isset($_POST['uangsaku'])){
                        $us = $_POST['uangsaku2'];
                    }
                    if(isset($_POST['uangmakan'])){
                        $um = $_POST['uangmakan2'];
                    }
                    if(isset($_POST['asrama'])){
                        $as = $_POST['asrama'];
                    }
                    if(isset($_POST['uangtransport'])){
                        $ut = $_POST['uangtransport2'];
                    }
                
					mysql_query(" UPDATE hb_du SET u_saku='$us', asrama='$as', u_transport='$ut', mulai_pelaksanaan='$mulai', berakhir_pelaksanaan = '$berakhir', seleksi_du = '$seleksi', u_makan='$um' WHERE id_du=$id") or die ("Ups! Gagal Diperbaharui, Silahkan Coba Lagi! ".mysql_error());
                header('location:prakerin.php');
            break;

		}
	
	}	
}else{
	header('location:../login.php');
}

?>


