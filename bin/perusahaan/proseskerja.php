<?php

	include "../koneksidb.php";

	function anti_injection($param){
		$filter = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($param,ENT_QUOTES))));
		return $filter;
	}

if($_SESSION['level']=='perusahaan'){
	if (!empty($_GET ["a"])) {
		switch ($_GET ["a"]){
      case "tutup":

      $qr = mysql_query("SELECT id_du_kerja FROM hb_du_permintaan_kerja WHERE id_du='$_SESSION[id_du]' ORDER BY id_du_kerja DESC LIMIT 1");
      $dd = mysql_fetch_array($qr)or die(mysql_error());;

      mysql_query(" UPDATE hb_du_permintaan_kerja SET status_permintaan='Ditutup' WHERE id_du_kerja='$dd[id_du_kerja]'") or die ("Ups! Gagal Diperbaharui, Silahkan Coba Lagi! ".mysql_error());
      
      header('location:kerja.php');

      break;

           case "terima_kerja":
      mysql_query(" UPDATE hb_lamar_kerja SET status='Lamaran Diterima' WHERE id_lamar=$_POST[id]") or die ("Ups! Gagal Diperbaharui, Silahkan Coba Lagi! ".mysql_error());
                        $qr = mysql_query("SELECT nama_du,email_siswa FROM hb_du_umum INNER JOIN hb_du_permintaan_kerja ON hb_du_umum.id_du = hb_du_permintaan_kerja.id_du INNER JOIN hb_lamar_kerja ON hb_lamar_kerja.id_du_kerja = hb_du_permintaan_kerja.id_du_kerja INNER JOIN siswa ON siswa.nis = hb_lamar_kerja.nis WHERE id_lamar = $_POST[id]");
                        $dd = mysql_fetch_array($qr)or die(mysql_error());

                        $to     = $dd['email_siswa'];
                        $judul  = "Lamaran";
                        $dari   = "From: hubin.com\n";
                        $dari  .= "Content-type: text/html \r\n";

                        $pesan .= "<h4>Lamaran Anda diterima di ".$dd['nama_du'];

                        $kirim  = mail($to, $judul, $pesan, $dari)or die(mysql_error());
                header('location:lamaranaktif.php');

      break;

           case "terima_kerja":
      mysql_query(" UPDATE hb_lamar_kerja SET status='Lamaran Ditolak' WHERE id_lamar=$_POST[id]") or die ("Ups! Gagal Diperbaharui, Silahkan Coba Lagi! ".mysql_error());
                        $qr = mysql_query("SELECT nama_du,email_siswa FROM hb_du_umum INNER JOIN hb_du_permintaan_kerja ON hb_du_umum.id_du = hb_du_permintaan_kerja.id_du INNER JOIN hb_lamar_kerja ON hb_lamar_kerja.id_du_kerja = hb_du_permintaan_kerja.id_du_kerja INNER JOIN siswa ON siswa.nis = hb_lamar_kerja.nis WHERE id_lamar = $_POST[id]");
                        $dd = mysql_fetch_array($qr)or die(mysql_error());

                        $to     = $dd['email_siswa'];
                        $judul  = "Lamaran";
                        $dari   = "From: hubin.com\n";
                        $dari  .= "Content-type: text/html \r\n";

                        $pesan .= "<h4>Lamaran Anda belum diterima di ".$dd['nama_du'];

                        $kirim  = mail($to, $judul, $pesan, $dari)or die(mysql_error());
                header('location:lamaranaktif.php');

      break;
      case "update-prakerin":

					$mulai		= anti_injection($_POST['mulai']);
					$berakhir	= anti_injection($_POST['akhir']);
          $seleksi  = anti_injection($_POST['seleksi']);

					if($seleksi=="Ya"){
						$tanggal = $_POST['tanggal_seleksi'];
            $tempat = anti_injection($_POST['tempat_seleksi']);
					}else{
            $tanggal = "0000-00-00";
            $tempat = "-";
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

      case "permintaan_kerja":
        if (isset($_POST['Tambahkan'])){


          $nama_pj        = anti_injection($_POST['nama_pj']);
          $judul        = anti_injection($_POST['judul']);
          $lokasi        = anti_injection($_POST['lokasi']);
          $contact        = anti_injection($_POST['contact']);
          $gaji        = anti_injection($_POST['gaji']);
          $lainnya        = anti_injection($_POST['lainnya']);
          //$fasilitas_lain = anti_injection($_POST['fasilitas_lain']);

                    $seleksi= anti_injection($_POST['seleksi']);

                    if($seleksi=="Ya"){
                        $tanggal = $_POST['tanggal_seleksi'];
                        $tempat = anti_injection($_POST['tempat_seleksi']);
                      }else{
                        $tanggal = "0000-00-00";
                        $tempat = "-";
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
          /*
          $c  = mysql_fetch_array(mysql_query("SELECT id_du FROM hb_du_permintaan_kerja WHERE id_du = '$_SESSION[id_du]' "));
          if (isset($c["id_du"])) {
            mysql_query("DELETE FROM hb_du_permintaan_kerja WHERE id_du = '$_SESSION[id_du]'");
            mysql_query("DELETE FROM hb_du_jumlah_permintaan_du_kerja WHERE id_du = '$_SESSION[id_du]'");
          }*/
          

          mysql_query(" INSERT INTO hb_du_permintaan_kerja(id_du, judul, lokasi, seleksi, status_permintaan, penanggung_jawab, cp, gaji, lainnya, tempat_seleksi, tanggal_seleksi)
                                 VALUES ('$_SESSION[id_du]', '$judul', '$lokasi', '$seleksi',  'Belum Terverifikasi' , '$nama_pj', '$contact', '$gaji', '$lainnya', '$tempat', '$tanggal' )")or die ("Ups! Gagal Ditambahkan, Silahkan Coba Lagi! ".mysql_error());

            $c  = mysql_fetch_array(mysql_query("SELECT id_du_kerja FROM hb_du_permintaan_kerja WHERE id_du = '$_SESSION[id_du]' ORDER BY id_du_kerja DESC LIMIT 1"));

            for ($i=1; $i<=$no; $i++) {
             mysql_query(" INSERT INTO hb_du_jumlah_permintaan_du_kerja(id_du_kerja, id_jurusan, jumlah_penerimaan, tahun_ajaran) VALUES ('$c[id_du_kerja]', '$ajur[$i]', '$ajur[$i]', '$_SESSION[tahun_ajaran]')")or die ("Ups! Gagal Ditambahkan, Silahkan Coba Lagi! ".mysql_error());
             $sk = explode(',', $askill[$i]);
             foreach($sk as $skill){
                mysql_query(" INSERT INTO hb_detail_skill(id_du_kerja,id_jurusan,kode_skill) VALUES ('$c[id_du_kerja]', '$ajur[$i]', '$skill')")or die ("Ups! Gagal Ditambahkan, Silahkan Coba Lagi! ".mysql_error());
              }
          }

            

          header('location:kerja.php');
        ?>
          <script>
            alert(" Status Telah Diperbaharui ");
          </script><?php

        }
      break;

		}

	}
}else{
	header('location:../login.php');
}

?>


