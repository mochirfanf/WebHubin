<?php

include "../koneksidb.php";

if($_SESSION['level']=='perusahaan'){ 
    if ($_SESSION['tahun_ajaran']!='') {
        $title="Daftar Siswa yang Dimonitoring";
        $active ="";
        $active6 = "active";
        $navactive1 ="nav-active";

        $data = mysql_query( "SELECT * FROM hb_prakerin WHERE nip_guru = $_SESSION[username] AND status_verifikasi = 'Terverifikasi'");
       
        include "leftside.php"; ?>
                
        <!--body wrapper start-->
        <div class="wrapper">
            <div class="row">
                <div class="col-sm-12">
                    <section class="panel">
                    <header class="panel-heading">
                        <big>Daftar Siswa yang Dimonitoring</big>
                         
                    </header>
                   
                    <div class="panel-body">
                    <div class="adv-table">
                    <table  class="display table table-bordered table-striped" id="dynamic-table">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Siswa</th>                        
                        <th>Jurusan</th>     
                        <th>Kelas</th>
                        <th>Tempat Prakerin</th>
                        <th>Alamat Tempat Prakerin</th>
                        <th>Kota</th>
                        <th>Penanggung Jawab</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $no =0;
                            while ($d = mysql_fetch_array($data)) {
                                $no = $no+1;
                                $d2 = mysql_fetch_array(mysql_query("SELECT nama FROM guru WHERE nip_guru ='$d[saran_pembimbing]'"));
                                $d3 = mysql_fetch_array(mysql_query("SELECT nama,id_jurusan,kelas FROM siswa WHERE nis ='$d[nis]'"));
                                $d4 = mysql_fetch_array(mysql_query("SELECT nama_du, alamat, kota, nama_penanggung_jawab FROM hb_du WHERE id_du ='$d[id_du]'"));
                                $j = mysql_fetch_array(mysql_query("SELECT * FROM jurusan WHERE id_jurusan='$d3[id_jurusan]'"));
                                echo "
                                    <tr class='gradeA'>
                                        <td> $no </td>
                                        <td> $d3[nama] </td>
                                        <td> $j[nama_jurusan] </td>
                                        <td> $d3[kelas]</td>
                                        <td> $d4[nama_du]</td>
                                        <td> $d4[alamat]</td>
                                        <td> $d4[kota]</td>
                                        <td> $d4[nama_penanggung_jawab]</td>
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