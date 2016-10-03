<?php

include "../koneksidb.php";

if($_SESSION['level']=='kapprog'){
    if ($_SESSION['tahun_ajaran']!='') {
        $title="Permohonan Perizinan Prakerin Siswa";
        $active = "";
        $active12 = "active";
        $navactive1 ="nav-active";

        function judultabel(){
            echo "  <th>No</th>
                    <th>Permintaan Siswa </th>
                    <th>Kelas</th>
                    <th>Nama Dunia Usaha</th>
                    <th>Alamat</th>
                    <th>Email</th>
                    <th>Alasan Ditolak</th>";
        }

        function isinya($query){
                $no =0;
                while ($d = mysql_fetch_array($query)) {
                    $no = $no+1;
                    echo "
                    <tr class='gradeA'>
                        <td> $no </td>
                        <td> $d[nama] </td>
                        <td> $d[kelas] </td>
                        <td> $d[nama_du] </td>
                        <td> $d[alamat]</td>
                        <td> $d[email]</td>
                        <td> $d[alasan_menolak]</td>
                    </tr>";
                 }
        }

        include "leftside.php"; ?>

        <!--body wrapper start-->
        <div class="wrapper">
            <div class="row">
                <div class="col-sm-12">
                    <section class="panel">
                    <header class="panel-heading">
                        <label><big>Permohonan Perizinan Prakerin Siswa</big></label>
                    </header>

                   <section class="panel">
                        <div class="panel-body">
                                    <div class="panel-body">
                                        <div class="adv-table">
                                        <table  class="display table table-bordered table-striped" id="dynamic-table">
                                        <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Permintaan</th>
                                            <th>Nama DU/DI</th>
                                            <th>Alamat dan Email</th>
                                            <th>Alasan Ditolak</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $query = mysql_query("SELECT hb_du_umum.id_du, hb_du_umum.id_prov, hb_du_umum.id_kab, hb_du_umum.id_kec, hb_du_umum.id_kel, hb_du_umum.no_kodepos, siswa.nama_siswa, hb_du_umum.nama_du, hb_du_umum.alamat, hb_du_umum.id_kab, hb_du_umum.email_du, hb_du_permintaan.alasan_menolak, jurusan.singkatan, siswa.nama_siswa, siswa.kelas, siswa.nis FROM hb_du_umum, siswa, jurusan, hb_du_permintaan WHERE permintaan_siswa='Ya' AND jurusan.id_jurusan='$_SESSION[tahun_ajaran]' AND status_permintaan='Verifikasi Ditolak'AND siswa.id_jurusan = jurusan.id_jurusan AND hb_du_permintaan.du_siswa = siswa.nis AND hb_du_umum.id_du = hb_du_permintaan.id_du ");
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
                                                    <td> Jurusan &nbsp; : $d[singkatan] <br>
                                                         NIS &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;: $d[nis] <br>
                                                         Nama  &nbsp;&nbsp; &nbsp; : $d[nama_siswa] <br>
                                                         Kelas  &nbsp; &nbsp; &nbsp;&nbsp;: $d[kelas] <br>
                                                    </td>
                                                    <td> $d[nama_du] </td>
                                                    <td> $d[alamat]
                                                         <br> Kelurahan : $kel[nama]
                                                         <br> Kecamatan : $kec[nama]
                                                         <br> Kab/Kota : $kab[nama]
                                                         <br> Provinsi : $prov[nama]
                                                         <br> Kode Pos : $d[no_kodepos]
                                                         <br><br> Email : $d[email_du]
                                                    </td>
                                                    <td> $d[alasan_menolak]</td>
                                                </tr>";
                                             }
                                        ?>
                                        </tbody>
                                        </table>
                                        </div>
                                    </div>
                        </div>

                    <label> <br>
                        &nbsp; &nbsp; ** Hati - hati jika anda menolak permintaan! <br><br>
                    </label>
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
