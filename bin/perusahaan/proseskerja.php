<?php

	include "../koneksidb.php";

	function anti_injection($param){
		$filter = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($param,ENT_QUOTES))));
		return $filter;
	}

if($_SESSION['level']=='perusahaan'){
	if (!empty($_GET ["a"])) {
		switch ($_GET ["a"]){
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

      case "permintaan_kerja":
        if (isset($_POST['Tambahkan'])){


          $nama_pj        = anti_injection($_POST['nama_pj']);
          $contact        = anti_injection($_POST['contact']);
          //$fasilitas_lain = anti_injection($_POST['fasilitas_lain']);

                    $gaji = "Tidak";
                    $as = "Tidak";
                    $seleksi="Tidak";

                    if(isset($_POST["seleksi"])){
                      $seleksi  = anti_injection($_POST['seleksi']);
                    }

                    if(isset($_POST['gaji'])){
                        $gaji = $_POST['gaji'];
                    }
                    if(isset($_POST['asrama'])){
                        $as = $_POST['asrama'];
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
          
          $c  = mysql_fetch_array(mysql_query("SELECT id_du FROM hb_du_permintaan_kerja WHERE id_du = '$_SESSION[id_du]' "));
          if (isset($c["id_du"])) {
            mysql_query("DELETE FROM hb_du_permintaan_kerja WHERE id_du = '$_SESSION[id_du]'");
            mysql_query("DELETE FROM hb_du_jumlah_permintaan_du_kerja WHERE id_du = '$_SESSION[id_du]'");
          }
          for ($i=1; $i<=$no; $i++) {
             mysql_query(" INSERT INTO hb_du_jumlah_permintaan_du_kerja(id_du, id_jurusan, jumlah_penerimaan, tahun_ajaran) VALUES ('$_SESSION[id_du]', '$ajur[$i]', '$ajum[$i]', '$_SESSION[tahun_ajaran]')")or die ("Ups! Gagal Ditambahkan, Silahkan Coba Lagi! ".mysql_error());
          }



          mysql_query(" INSERT INTO hb_du_permintaan_kerja(id_du, tahun_ajaran, seleksi, status_permintaan, penanggung_jawab, cp, gaji, asrama)
                                 VALUES ('$_SESSION[id_du]', '$_SESSION[tahun_ajaran]', '$seleksi',  'Belum Terverifikasi' , '$nama_pj', '$contact', '$gaji', '$as' )")or die ("Ups! Gagal Ditambahkan, Silahkan Coba Lagi! ".mysql_error());


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


