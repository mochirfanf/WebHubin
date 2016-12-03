<?php

include "../koneksidb.php";



$id=$_POST['id'];

                $query=mysql_query("SELECT * FROM hb_lamar_kerja INNER JOIN siswa ON hb_lamar_kerja.nis = siswa.nis INNER JOIN jurusan ON siswa.id_jurusan = jurusan.id_jurusan WHERE id_lamar='$id'");



                $hasil=array();



                while($a=mysql_fetch_assoc($query)){

                    $hasil=$a;

                }



                echo json_encode($hasil);

// Close the connection

?>