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
				if(isset($_POST['UPDATEE'])){

            $nama = anti_injection($_POST['nama']);
            $bidang = anti_injection($_POST['bidang']);
            $npj = anti_injection($_POST['npj']);
            $cp = anti_injection($_POST['cp']);
            $alamat = anti_injection($_POST['alamat']);
            $id_prov = anti_injection($_POST['prop']);
            $id_kab = anti_injection($_POST['kota']);
            $id_kec = anti_injection($_POST['kec']);
            $id_kel = anti_injection($_POST['kel']);
            $kodepos = anti_injection($_POST['kodepos']);
            $deskripsi = anti_injection($_POST['deskripsi']);

            if($_FILES['logo']['name']!=''){
            $namafolder="../images/uploads/";
            $jenis_gambar = $_FILES["logo"]["type"];
            if($jenis_gambar=="image/jpeg" || $jenis_gambar=="image/jpg" || $jenis_gambar=="image/gif" || $jenis_gambar=="image/png")
            {
              $file_ext = substr($_FILES["logo"]["name"], strripos($_FILES["logo"]["name"], '.')); // strip name
                  
                $lam1 = $namafolder . basename('du'.$_FILES["logo"]["name"]);
                $lam2 = $namafolder . basename('du'.$_SESSION['id_du']). $file_ext;
                $lam3 = basename('du'.$_SESSION['id_du']). $file_ext;   
                if (!move_uploaded_file($_FILES['logo']['tmp_name'], $lam2))
                {
                   die("Failed Upload the File");
                }
              }
              mysql_query("UPDATE hb_du_umum SET logo='$lam3', nama_du='$nama', bidang_usaha ='$bidang', nama_penanggung_jawab_umum='$npj', contact_person_umum='$cp', alamat='$alamat', id_prov='$id_prov', id_kab='$id_kab', id_kec='$id_kec', id_kel='$id_kel', no_kodepos = '$kodepos', deskripsi_perusahaan='$deskripsi' WHERE id_du='$_SESSION[id_du]'") or die ("Ups! Gagal Ditambahkan, Silahkan Coba Lagi! ".mysql_error());
            }else{
              mysql_query("UPDATE hb_du_umum SET nama_du='$nama', bidang_usaha ='$bidang', nama_penanggung_jawab_umum='$npj', contact_person_umum='$cp', alamat='$alamat', id_prov='$id_prov', id_kab='$id_kab', id_kec='$id_kec', id_kel='$id_kel', no_kodepos = '$kodepos', deskripsi_perusahaan='$deskripsi' WHERE id_du='$_SESSION[id_du]'") or die ("Ups! Gagal Ditambahkan, Silahkan Coba Lagi! ".mysql_error());
            }


            
            ?>
            <script>
              alert(" Berhasil ");
              top.location='identitas.php';
            </script><?php

				}else{
            ?>
            <script>
              alert(" Terjadi Kesalahan ");
              top.location='identitas.php';
            </script><?php
        }
			break;

      case "permintaan_prakerin":
        if (isset($_POST['Tambahkan'])){


          $nama_pj        = anti_injection($_POST['nama_pj']);
          $contact        = anti_injection($_POST['contact']);
          $fasilitas_lain = anti_injection($_POST['fasilitas_lain']);
          $mulai          = anti_injection($_POST['mulai']);
          $berakhir       = anti_injection($_POST['berakhir']);

                    $us = "Tidak";
                    $um = "Tidak";
                    $as = "Tidak";
                    $ut = "Tidak";
                    $seleksi="Tidak";

                    if(isset($_POST["seleksi"])){
                      $seleksi  = anti_injection($_POST['seleksi']);
                    }

                    if(isset($_POST['uangsaku'])){
                        $us = $_POST['uangsaku'];
                    }
                    if(isset($_POST['uangmakan'])){
                        $um = $_POST['uangmakan'];
                    }
                    if(isset($_POST['asrama'])){
                        $as = $_POST['asrama'];
                    }
                    if(isset($_POST['uangtransport'])){
                        $ut = $_POST['uangtransport'];
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
          if(isset($_POST["skill"])){
            $no=0;
              foreach($_POST["skill"] as $skill){
                $no= $no+1;
                $askill["$no"] = $skill;
              }
          }
          $seleksi= anti_injection($_POST['seleksi']);

                    if($seleksi=="Ya"){
                        $tanggal = $_POST['seleksi_tanggal'];
                        $tempat = anti_injection($_POST['seleksi_tempat']);
                      }else{
                        $tanggal = "0000-00-00";
                        $tempat = "-";
                      }

          $c  = mysql_fetch_array(mysql_query("SELECT id_du_permintaan FROM hb_du_permintaan WHERE id_du = '$_SESSION[id_du]' ORDER BY id_du_permintaan DESC LIMIT 1"));

          for ($i=1; $i<=$no; $i++) {
             mysql_query(" INSERT INTO hb_du_jumlah_permintaan_du(id_du, id_jurusan, jumlah_penerimaan, tahun_ajaran) VALUES ('$_SESSION[id_du]', '$ajur[$i]', '$ajum[$i]', '$_SESSION[tahun_ajaran]')")or die ("Ups! Gagal Ditambahkan, Silahkan Coba Lagi! ".mysql_error());
             $sk = explode(',', $askill[$i]);
             foreach($sk as $skill){
                mysql_query(" INSERT INTO hb_detail_skill(id_du_kerja,id_jurusan,kode_skill) VALUES ('$c[id_du_kerja]', '$ajur[$i]', '$skill')")or die ("Ups! Gagal Ditambahkan, Silahkan Coba Lagi! ".mysql_error());
              }
          }

          $c  = mysql_fetch_array(mysql_query("SELECT id_du FROM hb_du_permintaan WHERE id_du = '$_SESSION[id_du]' "));

          if (isset($c["id_du"])) {
            mysql_query("DELETE FROM hb_du_permintaan WHERE id_du = '$_SESSION[id_du]'");
          }

          mysql_query(" INSERT INTO hb_du_permintaan(id_du, seleksi_tanggal, seleksi_tempat, tahun_ajaran, permintaan_du, seleksi_du, status_permintaan, nama_penanggung_jawab, contact_person, uang_saku, asrama, uang_makan, uang_transport, fasilitas_lain, status_du, mulai_pelaksanaan, berakhir_pelaksanaan)
                                 VALUES ('$_SESSION[id_du]', '$tanggal', '$tempat', '$_SESSION[tahun_ajaran]', 'Ya', '$seleksi',  'Belum Terverifikasi' , '$nama_pj', '$contact', '$us', '$as', '$um', '$ut', '$fasilitas_lain', 'DU/DI dari Perusahaan', '$mulai', '$berakhir' )")or die ("Ups! Gagal Ditambahkan, Silahkan Coba Lagi! ".mysql_error());


            ?>
            <script>
              alert(" Terima kasih telah meminta siswa prakerin ");
              top.location='prakerin.php';
            </script><?php


        }
      break;


      case "hapus_permintaan":
        if (isset($_POST['HAPUSPERMINTAAN'])){


          mysql_query("DELETE FROM hb_du_jumlah_permintaan_du WHERE id_du='$_SESSION[id_du]'");
          mysql_query("DELETE FROM hb_du_permintaan WHERE id_du='$_SESSION[id_du]'");

        ?>
          <script>
            top.location='prakerin.php';
          </script><?php


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


