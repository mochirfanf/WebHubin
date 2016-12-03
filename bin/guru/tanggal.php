<?php

include "../koneksidb.php";



$id_du=$_POST['id'];

                $query=mysql_query("SELECT * FROM hb_monitoring WHERE id_du='$id_du'");



                $hasil=array();



                while($a=mysql_fetch_assoc($query)){

                    $hasil=$a;

                }



                echo json_encode($hasil);

// Close the connection

?>