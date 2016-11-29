<?php

include "../koneksidb.php";

if($_SESSION['level']=='admin'){
    if ($_SESSION['tahun_ajaran']!='') {
        $title="Permohonan Perizinan Prakerin";
        $active ="";
        $active7 = "active";
        $navactive2 ="nav-active";

        $data = mysql_query("SELECT * from hb_du_umum, hb_du_permintaan WHERE status_penerimaan='Menerima'  AND hb_du_umum.id_du = hb_du_permintaan.id_du ");

        include "leftside.php"; ?>


        <!--body wrapper start-->
       <div class="wrapper">
            <div class="row">
                <div class="col-sm-12">
                    <section class="panel">
                    <header class="panel-heading">
                        <big>Jawaban DU / DI untuk Prakerin</big>
                    </header>

                    <div class="panel-body">
                    <div class="adv-table">
                    <table  class="display table table-bordered table-striped" id="dynamic-table">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Dunia Usaha</th>
                        <th>Alamat dan Email</th>
                        <th>Menerima Jurusan</th>
                        <th>Sumber DU/DI</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                            $no =0;
                            while ($d = mysql_fetch_array($data)) {
                                $no = $no+1;
                                $kel = mysql_fetch_array(mysql_query("SELECT nama FROM kelurahan WHERE id_kel='$d[id_kel]'"));
                                $kec = mysql_fetch_array(mysql_query("SELECT nama FROM kecamatan WHERE id_kec='$d[id_kec]'"));
                                $kab = mysql_fetch_array(mysql_query("SELECT nama FROM kabupaten WHERE id_kab='$d[id_kab]'"));
                                $prov = mysql_fetch_array(mysql_query("SELECT nama FROM provinsi WHERE id_prov='$d[id_prov]'"));
                                $s = mysql_fetch_array(mysql_query("SELECT singkatan FROM jurusan, hb_du_permintaan WHERE hb_du_permintaan.du_id_jurusan = jurusan.id_jurusan AND id_jurusan='$d[du_id_jurusan]'"));
                                echo "
                                    <tr class='gradeA'>
                                        <td> $no </td>
                                        <td> $d[nama_du] </td>
                                        <td> $d[alamat]
                                             <br> Kelurahan : $kel[nama]
                                             <br> Kecamatan : $kec[nama]
                                             <br> Kab/Kota : $kab[nama]
                                             <br> Provinsi : $prov[nama]
                                             <br> Kode Pos : $d[no_kodepos]
                                             <br><br> Email : $d[email_du]
                                        </td>
                                        <td> ";

                                        $penerima = mysql_query("SELECT DISTINCT id_jurusan FROM hb_du_penerima WHERE id_du ='$d[id_du]'");

                                        while($e = mysql_fetch_array($penerima)) {
                                            $j = mysql_fetch_array(mysql_query("SELECT singkatan FROM jurusan WHERE id_jurusan='$e[id_jurusan]'"));
                                            echo "$j[singkatan] ; ";
                                        }
                                echo "  </td>
                                        <td class='center'>  $d[status_du] "; 
                                        if ($d["du_id_jurusan"]!=0) {
                                            echo "$s[singkatan]";
                                        }
                                  echo "</td>
                                    </tr>
                                    ";
                            }
                        ?>
                    </tbody>
                    </table>
                    </div>
                    </div>
                    </section>
                </div>
            </div>
        </div>
        <!--body wrapper end-->

<?php       include "footer.php";
    }else{
        header('location:tahun_ajaran.php');
    }
}else{
    header('location:../login.php');
}

?>
