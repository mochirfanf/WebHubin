<?php

include "../koneksidb.php";

if($_SESSION['level']=='kapprog'){
    if ($_SESSION['tahun_ajaran']!='') {
        $title="Permohonan Perizinan Prakerin Siswa";
        $active = "";
        $active4 = "active";
        $navactive1 ="nav-active";

        include "leftside.php"; ?>

        <!--body wrapper start-->
        <div class="wrapper">
            <div class="row">
                <div class="col-sm-12">
                    <section class="panel">
                    <header class="panel-heading">
                        <label><big> DU / DI yang Telah Diizinkan </big></label>
                    </header>

                   <section class="panel">
                        <div class="panel-body">
                                    <div class="adv-table">
                                    <table  class="display table table-bordered table-striped" id="dynamic-table">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama DU/DI</th>
                                        <th>Alamat </th>
                                        <th>Email</th>
                                        <th>Keterangan</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $query = mysql_query("SELECT hb_du_umum.id_du, hb_du_umum.id_prov, hb_du_umum.id_kab, hb_du_umum.id_kec, hb_du_umum.id_kel, hb_du_umum.no_kodepos, hb_du_umum.nama_du, hb_du_umum.alamat, hb_du_umum.id_kab, hb_du_umum.email_du, hb_du_permintaan.keterangan_permintaan, jurusan.singkatan FROM hb_du_umum, jurusan, hb_du_permintaan WHERE permintaan_kapprog='Ya' AND status_permintaan='Terverifikasi' AND hb_du_permintaan.du_id_jurusan = jurusan.id_jurusan AND hb_du_umum.id_du = hb_du_permintaan.id_du AND hb_du_permintaan.du_id_jurusan = '$_SESSION[jurusan]' ");
                                        $no =0;
                                        while ($d = mysql_fetch_array($query)) {
                                            $no = $no+1;
                                            $kel = mysql_fetch_array(mysql_query("SELECT nama FROM kelurahan WHERE id_kel='$d[id_kel]'"));
                                            $kec = mysql_fetch_array(mysql_query("SELECT nama FROM kecamatan WHERE id_kec='$d[id_kec]'"));
                                            $kab = mysql_fetch_array(mysql_query("SELECT nama FROM kabupaten WHERE id_kab='$d[id_kab]'"));
                                            $prov = mysql_fetch_array(mysql_query("SELECT nama FROM provinsi WHERE id_prov='$d[id_prov]'"));
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
                                                </td>
                                                <td> $d[email_du] </td>
                                                <td> $d[keterangan_permintaan]</td>
                                            </tr>";
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
