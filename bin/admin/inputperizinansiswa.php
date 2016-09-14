<?php

include "../koneksidb.php";

if($_SESSION['level']=='admin'){ 
    if ($_SESSION['tahun_ajaran']!='') {
        $title="Permohonan Perizinan Prakerin Siswa";
        $active = "";
        $active15 = "active";
        $navactive ="nav-active";

        function judultabel(){
            echo "  <th>No</th>
                    <th>Permintaan Siswa </th>
                    <th>Kelas</th>
                    <th>Nama Dunia Usaha</th>
                    <th>Alamat</th>
                    <th>Kota</th>
                    <th>Email</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>";
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
                        <td> $d[kota]</td>
                        <td> $d[email]</td>
                        <td> $d[keterangan_du]</td>
                        <td> 
                            <a href='#verifikasi$d[id_du]' data-toggle='modal'>
                                <button class='btn btn-sm btn-success' type='button'><i class='fa fa-check-square-o'></i> Verifikasi </button>
                            </a>
                        </td>
                            <div  style='text-transform:none' aria-hidden='true' aria-labelledby='myModalLabel' role='dialog' tabindex='-1' id='verifikasi$d[id_du]' class='modal fade'>
                                <div class='modal-dialog'>
                                    <div class='modal-content'>
                                        <div class='modal-header'>
                                            <button aria-hidden='true' data-dismiss='modal' class='close' type='button'>×</button>
                                                <h5>Konfirmasi</h5>
                                        </div>
                                        <div class='modal-body'>
                                            Verifikasi perizinan dengan Nama DU : $d[nama_du]?
                                        </div>
                                        <div class='modal-footer'>
                                            <button type='button' class='btn btn-default' data-dismiss='modal'>Kembali</button>
                                                <a href='proses_admin.php?a=verifikasiperizinan&id=$d[id_du]'>
                                                <input type='submit' value='Ya' name='Ganti'class='btn btn-success'></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                        <header class="panel-heading custom-tab blue-tab">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a data-toggle="tab" href="#home">
                                        <i class="fa fa-home"></i>
                                    </a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#rpl">
                                        <i class="fa fa-location-arrow"></i>
                                        RPL
                                    </a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#toi">
                                        <i class="fa fa-location-arrow"></i>
                                        TOI
                                    </a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#km">
                                        <i class="fa fa-location-arrow"></i>
                                        KM
                                    </a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#kp">
                                        <i class="fa fa-location-arrow"></i>
                                        KP
                                    </a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#tek">
                                        <i class="fa fa-location-arrow"></i>
                                        TEK
                                    </a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#tei">
                                        <i class="fa fa-location-arrow"></i>
                                        TEI
                                    </a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#tkj">
                                        <i class="fa fa-location-arrow"></i>
                                        TKJ
                                    </a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#tp4">
                                        <i class="fa fa-location-arrow"></i>
                                        TP4
                                    </a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#tptu">
                                        <i class="fa fa-location-arrow"></i>
                                        TPTU
                                    </a>
                                </li>
                            </ul>
                        </header>
                        <div class="panel-body">
                            <div class="tab-content">
                                <div id="home" class="tab-pane active">
                                    <div class="panel-body">
                                        <div class="adv-table">
                                        <table  class="display table table-bordered table-striped" id="dynamic-table">
                                        <thead>
                                        <tr>
                                           <th>No</th>
                                            <th>Nama Dunia Usaha</th>
                                            <th>Alamat</th>
                                            <th>Kota</th>
                                            <th>Email</th>
                                            <th>Keterangan</th>
                                            <th>Jurusan</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                            $query = mysql_query( "SELECT hb_du.id_du, siswa.nama, hb_du.nama_du, hb_du.alamat, hb_du.kota, hb_du.email, hb_du.keterangan_du, jurusan.singkatan FROM hb_du, siswa,jurusan WHERE siswa.id_jurusan = jurusan.id_jurusan AND hb_du.permintaan_siswa = siswa.nis AND status_du='DU_Siswa'");
                                            $no =0;
                                            while ($d = mysql_fetch_array($query)) {
                                                $no = $no+1;
                                                echo "
                                                <tr class='gradeA'>
                                                    <td> $no </td>
                                                    <td> $d[nama_du] </td>
                                                    <td> $d[alamat]</td>
                                                    <td> $d[kota]</td>
                                                    <td> $d[email]</td>
                                                    <td> $d[keterangan_du]</td>
                                                    <td> $d[singkatan]</td>
                                                </tr>";
                                             }
                                        ?>
                                        </tbody>
                                        </table>
                                        </div>
                                    </div>
                                </div>
                                <div id="rpl" class="tab-pane ">
                                    <div class="panel-body">
                                        <div class="adv-table">
                                            <!--<a href='' class='btn btn-warning'> Cetak </a> <br><br> -->
                                        <table  class="display table table-bordered table-striped" id="dynamic-table">
                                        <thead>
                                        <tr>
                                            <?php judultabel() ?>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $query = mysql_query( "SELECT hb_du.id_du, siswa.nama, hb_du.nama_du, hb_du.alamat, hb_du.kota, hb_du.email, hb_du.keterangan_du, siswa.kelas FROM hb_du, siswa WHERE hb_du.permintaan_siswa = siswa.nis AND id_jurusan = 1 AND status_du='DU_Siswa'");
                                                $jumlah = mysql_num_rows($query);
                                                if ($jumlah > 0) {
                                                    isinya($query);
                                                }else{
                                                    echo "<td colspan='8'> <center> Tidak Ada Permohonan <center> </td>";
                                                }
                                            ?>
                                        </tbody>
                                        </table>
                                        </div>
                                    </div>
                                </div>
                                <div id="toi" class="tab-pane ">
                                    <div class="panel-body">
                                        <div class="adv-table">
                                        <table  class="display table table-bordered table-striped" id="dynamic-table">
                                        <thead>
                                        <tr>
                                            <?php judultabel() ?>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $query = mysql_query( "SELECT hb_du.id_du, siswa.nama, siswa.kelas, hb_du.nama_du, hb_du.alamat, hb_du.kota, hb_du.email, hb_du.keterangan_du from hb_du,siswa WHERE hb_du.permintaan_siswa = siswa.nis AND id_jurusan = 7 AND status_du='DU_Siswa'");
                                                $jumlah = mysql_num_rows($query);
                                                if ($jumlah > 0) {
                                                    isinya($query);
                                                }else{
                                                    echo "<td colspan='8'> <center> Tidak Ada Permohonan <center> </td>";
                                                }
                                            ?>
                                        </tbody>
                                        </table>
                                        </div>
                                    </div>
                                </div>
                                <div id="km" class="tab-pane ">
                                    <div class="panel-body">
                                        <div class="adv-table">
                                        <table  class="display table table-bordered table-striped" id="dynamic-table">
                                        <thead>
                                        <tr>
                                            <?php judultabel() ?>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $query = mysql_query( "SELECT hb_du.id_du, siswa.nama , siswa.kelas, hb_du.nama_du, hb_du.alamat, hb_du.kota, hb_du.email, hb_du.keterangan_du from hb_du,siswa WHERE hb_du.permintaan_siswa = siswa.nis AND id_jurusan = 2 AND status_du='DU_Siswa'");
                                                $jumlah = mysql_num_rows($query);
                                                if ($jumlah > 0) {
                                                    isinya($query);
                                                }else{
                                                    echo "<td colspan='8'> <center> Tidak Ada Permohonan <center> </td>";
                                                }
                                            ?>
                                        </tbody>
                                        </table>
                                        </div>
                                    </div>
                                </div>
                                <div id="kp" class="tab-pane ">
                                    <div class="panel-body">
                                        <div class="adv-table">
                                        <table  class="display table table-bordered table-striped" id="dynamic-table">
                                        <thead>
                                        <tr>
                                            <?php judultabel() ?>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $query = mysql_query( "SELECT hb_du.id_du, siswa.nama , siswa.kelas, hb_du.nama_du, hb_du.alamat, hb_du.kota, hb_du.email, hb_du.keterangan_du from hb_du,siswa WHERE hb_du.permintaan_siswa = siswa.nis AND id_jurusan = 3 AND status_du='DU_Siswa'");
                                                $jumlah = mysql_num_rows($query);
                                                if ($jumlah > 0) {
                                                    isinya($query);
                                                }else{
                                                    echo "<td colspan='8'> <center> Tidak Ada Permohonan <center> </td>";
                                                }
                                            ?>
                                        </tbody>
                                        </table>
                                        </div>
                                    </div>
                                </div>
                                <div id="tek" class="tab-pane ">
                                    <div class="panel-body">
                                        <div class="adv-table">
                                        <table  class="display table table-bordered table-striped" id="dynamic-table">
                                        <thead>
                                        <tr>
                                            <?php judultabel() ?>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $query = mysql_query( "SELECT hb_du.id_du, siswa.nama, siswa.kelas, hb_du.nama_du, hb_du.alamat, hb_du.kota, hb_du.email, hb_du.keterangan_du from hb_du,siswa WHERE hb_du.permintaan_siswa = siswa.nis AND id_jurusan = 5 AND status_du='DU_Siswa'");
                                                $jumlah = mysql_num_rows($query);
                                                if ($jumlah > 0) {
                                                    isinya($query);
                                                }else{
                                                    echo "<td colspan='8'> <center> Tidak Ada Permohonan <center> </td>";
                                                }
                                            ?>
                                        </tbody>
                                        </table>
                                        </div>
                                    </div>
                                </div>
                                <div id="tei" class="tab-pane ">
                                    <div class="panel-body">
                                        <div class="adv-table">
                                        <table  class="display table table-bordered table-striped" id="dynamic-table">
                                        <thead>
                                        <tr>
                                            <?php judultabel() ?>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $query = mysql_query( "SELECT hb_du.id_du, siswa.nama, siswa.kelas, hb_du.nama_du, hb_du.alamat, hb_du.kota, hb_du.email, hb_du.keterangan_du from hb_du,siswa WHERE hb_du.permintaan_siswa = siswa.nis AND id_jurusan = 4 AND status_du='DU_Siswa'");
                                                $jumlah = mysql_num_rows($query);
                                                if ($jumlah > 0) {
                                                    isinya($query);
                                                }else{
                                                    echo "<td colspan='8'> <center> Tidak Ada Permohonan <center> </td>";
                                                }
                                            ?>
                                        </tbody>
                                        </table>
                                        </div>
                                    </div>
                                </div>
                                <div id="tkj" class="tab-pane ">
                                    <div class="panel-body">
                                        <div class="adv-table">
                                        <table  class="display table table-bordered table-striped" id="dynamic-table">
                                        <thead>
                                        <tr>
                                            <?php judultabel() ?>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $query = mysql_query( "SELECT hb_du.id_du, siswa.nama, siswa.kelas, hb_du.nama_du, hb_du.alamat, hb_du.kota, hb_du.email, hb_du.keterangan_du from hb_du,siswa WHERE hb_du.permintaan_siswa = siswa.nis AND id_jurusan = 6 AND status_du='DU_Siswa'");
                                                $jumlah = mysql_num_rows($query);
                                                if ($jumlah > 0) {
                                                    isinya($query);
                                                }else{
                                                    echo "<td colspan='8'> <center> Tidak Ada Permohonan <center> </td>";
                                                }
                                            ?>
                                        </tbody>
                                        </table>
                                        </div>
                                    </div>
                                </div>
                                <div id="tp4" class="tab-pane ">
                                    <div class="panel-body">
                                        <div class="adv-table">
                                        <table  class="display table table-bordered table-striped" id="dynamic-table">
                                        <thead>
                                        <tr>
                                            <?php judultabel() ?>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $query = mysql_query( "SELECT hb_du.id_du, siswa.nama, siswa.kelas, hb_du.nama_du, hb_du.alamat, hb_du.kota, hb_du.email, hb_du.keterangan_du from hb_du,siswa WHERE hb_du.permintaan_siswa = siswa.nis AND id_jurusan = 8 AND status_du='DU_Siswa'");
                                                $jumlah = mysql_num_rows($query);
                                                if ($jumlah > 0) {
                                                    isinya($query);
                                                }else{
                                                    echo "<td colspan='8'> <center> Tidak Ada Permohonan <center> </td>";
                                                }
                                            ?>
                                        </tbody>
                                        </table>
                                        </div>
                                    </div>
                                </div>
                                <div id="tptu" class="tab-pane ">
                                    <div class="panel-body">
                                        <div class="adv-table">
                                        <table  class="display table table-bordered table-striped" id="dynamic-table">
                                        <thead>
                                        <tr>
                                            <?php judultabel() ?>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $query = mysql_query( "SELECT hb_du.id_du, siswa.nama, siswa.kelas, hb_du.nama_du, hb_du.alamat, hb_du.kota, hb_du.email, hb_du.keterangan_du from hb_du,siswa WHERE hb_du.permintaan_siswa = siswa.nis AND id_jurusan = 9 AND status_du='DU_Siswa'");
                                                $jumlah = mysql_num_rows($query);
                                                if ($jumlah > 0) {
                                                    isinya($query);
                                                }else{
                                                    echo "<td colspan='8'> <center> Tidak Ada Permohonan <center> </td>";
                                                }
                                            ?>
                                        </tbody>
                                        </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    
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