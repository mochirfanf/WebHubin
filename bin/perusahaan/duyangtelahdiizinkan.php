<?php

include "../koneksidb.php";

if($_SESSION['level']=='perusahaan'){ 
    if ($_SESSION['tahun_ajaran']!='') {
        $title="DU Yang Telah Diizinkan";
        $active = "";
        $active4 = "active";
        $navactive2 ="nav-active";

        $j    = mysql_fetch_array(mysql_query("SELECT * FROM hb_du,hb_du_penerima,hb_guru_jurusan,jurusan WHERE hb_du.id_du = hb_du_penerima.id_du AND hb_guru_jurusan.id_jurusan = jurusan.id_jurusan AND nip_guru = '$_SESSION[username]' AND tahun_ajaran ='$_SESSION[tahun_ajaran]'")) ;
        
        $data = mysql_query( "SELECT keterangan_du, id_du, hb_du.tahun_ajaran AS 'tahun_ajaran_du', nama_du, hb_du.alamat AS 'alamat_du', kota, status_du, hb_du.email AS 'email_du', permintaan_siswa, du_siswa, nis, id_jurusan, siswa.nama AS 'nama_siswa', kelas, siswa.tahun_ajaran AS 'tahun_ajaran_siswa' from hb_du,siswa WHERE status_du!='du_siswa' AND du_siswa = 'Yes' AND hb_du.permintaan_siswa = siswa.nis AND hb_du.tahun_ajaran = '$_SESSION[tahun_ajaran]' AND siswa.tahun_ajaran = '$_SESSION[tahun_ajaran]'  AND id_jurusan=$j[id_jurusan]");
        $data2 = mysql_query( "SELECT keterangan_du, id_du, hb_du.tahun_ajaran AS 'tahun_ajaran_du', nama_du, hb_du.alamat AS 'alamat_du', kota, status_du, hb_du.email AS 'email_du', permintaan_siswa, du_siswa, nis, id_jurusan, siswa.nama AS 'nama_siswa', kelas, siswa.tahun_ajaran AS 'tahun_ajaran_siswa' from hb_du,siswa WHERE status_du!='du_siswa' AND du_siswa = 'Yes' AND hb_du.permintaan_siswa = siswa.nis AND hb_du.tahun_ajaran = '$_SESSION[tahun_ajaran]' AND siswa.tahun_ajaran = '$_SESSION[tahun_ajaran]'  AND id_jurusan=$j[id_jurusan]");

        include "leftside.php"; ?>
                
        <!--body wrapper start-->
        <div class="wrapper">
            <div class="row">
                <div class="col-sm-12">
                    <section class="panel">
                    <header class="panel-heading">
                        <big>Dunia Usaha Yang Telah Diizinkan Oleh Hubin</big>
                         <span class="pull-right">
                     </span>
                    </header>
                   
                    <div class="panel-body">
                    <div class="adv-table">
                    <table  class="display table table-bordered table-striped" id="dynamic-table">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Permintaan</th>
                        <th>Nama Dunia Usaha</th>
                        <th>Alamat</th>
                        <th>Kota</th>
                        <th>Email</th>
                        <th>Keterangan </th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $no =0;

                            while ($d = mysql_fetch_array($data)) {
                                $s = mysql_fetch_array(mysql_query("SELECT * FROM siswa WHERE nis = '$d[permintaan_siswa]'"));
                                $no = $no+1;
                                echo "
                                    <tr class='gradeA'>
                                        <td> $no </td>
                                        <td> $s[nama]</td>
                                        <td> $d[nama_du] </td>
                                        <td> $d[alamat_du]</td>
                                        <td> $d[kota]</td>
                                        <td> $d[email_du]</td>
                                        <td> $d[keterangan_du]</td>
                                    </tr>
                                    ";
                            }
                        ?>
                    </tbody>
                    </table>
                    </div>
                    </div>
                    <label> <br>
                        &nbsp; &nbsp; ** Hubin Telah Mengirimkan Permintaan kepada DU yang bersangkutan <br> 
                        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Jika DU yg bersangkutan telah menerima, maka akan ada di menu 'Tempat Prakerin yang Telah Menerima' <br><br>
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