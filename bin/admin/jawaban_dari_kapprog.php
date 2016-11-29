<?php

include "../koneksidb.php";

if($_SESSION['level']=='admin'){
    if ($_SESSION['tahun_ajaran']!='') {
        $title="Permohonan Perizinan Prakerin";
        $active ="";
        $active6 = "active";
        $navactive2 ="nav-active";

        $data = mysql_query("SELECT * from hb_du_umum, hb_du_permintaan,jurusan WHERE hb_du_umum.id_du = hb_du_permintaan.id_du AND permintaan_kapprog='Ya' AND status_permintaan='Terverifikasi' AND jurusan.id_jurusan = hb_du_permintaan.du_id_jurusan");

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
                        <th>Jurusan</th>
                        <th>Nama Dunia Usaha</th>
                        <th>Alamat </th>
                        <th>Email </th>
                        <th>Menerima/Menolak</th>
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
                                echo "
                                    <tr class='gradeA'>
                                        <td> $no </td>
                                        <td> $d[singkatan] </td>
                                        <td> $d[nama_du] </td>
                                        <td> $d[alamat]
                                             <br> Kelurahan : $kel[nama]
                                             <br> Kecamatan : $kec[nama]
                                             <br> Kab/Kota : $kab[nama]
                                             <br> Provinsi : $prov[nama]
                                             <br> Kode Pos : $d[no_kodepos]
                                        </td>
                                        <td> $d[email_du]</td>
                                        <td class='center'> ";
                                        if($d["status_penerimaan"]=='Menerima') {
                                            echo "<span class='label label-primary'><i class='fa fa-check'></i> Menerima</span>";
                                        }
                                        if($d["status_penerimaan"]=='Menolak') {
                                           echo "<span class='label label-danger'><i class='fa fa-times'></i> Menolak</span>";
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
