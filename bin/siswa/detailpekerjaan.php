<?php

include "../koneksidb.php";



$iddukerja=$_POST['id'];

                $query=mysql_query("SELECT * from hb_du_umum, hb_du_permintaan_kerja, hb_du_jumlah_permintaan_du_kerja WHERE hb_du_umum.id_du=hb_du_permintaan_kerja.id_du AND hb_du_jumlah_permintaan_du_kerja.id_du=hb_du_permintaan_kerja.id_du AND id_du_kerja=$iddukerja");



                $hasil=array();



                while($a=mysql_fetch_assoc($query)){

                    $hasil=$a;

                }



                echo json_encode($hasil);

// Close the connection

?>