<?php

include "../koneksidb.php";



$id=$_POST['id'];

                $query=mysql_query("SELECT * from hb_bimbingan_tatap WHERE id_bimbingan_tatap='$id'");



                $hasil=array();



                while($a=mysql_fetch_assoc($query)){

                    $hasil=$a;

                }



                echo json_encode($hasil);

// Close the connection

?>