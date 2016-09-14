<?php

include "../koneksidb.php";

if($_SESSION['level']=='admin'){ 
    if ($_SESSION['tahun_ajaran']!='') {
        $title="Hasil Rekapitulasi";
        $active = "";
        $active6 = "active";
        $navactive1 ="nav-active";

        function tanggal($tglnya){
            $asli = date($tglnya);
            $ganti=str_replace("-", "/", $asli);
            $jadi= strtotime($ganti);

            $tanggal = date("j", $jadi);
            $tahun = date("Y", $jadi);
            $bulan = date("n", $jadi);

            $array_bulan = array(1 => "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember" );
            $bulan2 = $array_bulan[date($bulan)];
            
            $hasil = "$tanggal $bulan2 $tahun";
            return $hasil;
        }

        function judultabel(){
            echo "  <th>No</th>
                    <th>Nama Siswa</th>
                    <th>Kelas</th>
                    <th>Pembimbing</th>
                    <th>Tempat Prakerin</th>
                    <th>Mulai Pelaksanaan</th>
                    <th>Penanggung Jawab</th>
                    <th>Aksi</th>";
        }
        function isinya($query){
                $no =0;
                while ($d = mysql_fetch_array($query)) {
                    $no = $no+1;
                    $d4 = mysql_fetch_array(mysql_query("SELECT mulai_pelaksanaan, berakhir_pelaksanaan, nama_du, nama_penanggung_jawab FROM hb_du WHERE id_du ='$d[id_du]'"));
                    $mulai = tanggal($d4["mulai_pelaksanaan"]);
                    $berakhir = tanggal($d4["berakhir_pelaksanaan"]);
                    $d2 = mysql_fetch_array(mysql_query("SELECT nama FROM guru WHERE nip_guru ='$d[nip_guru]'"));
                    $d3 = mysql_fetch_array(mysql_query("SELECT nama,id_jurusan, kelas FROM siswa WHERE nis ='$d[nis]'"));
                    $jurusan = mysql_fetch_array(mysql_query("SELECT singkatan FROM jurusan WHERE id_jurusan = '$d3[id_jurusan]'"));
                        echo "
                            <tr class='gradeA'>
                                <td> $no </td>
                                <td> $d3[nama] </td>
                                <td> $d3[kelas] </td>
                                <td> $d2[nama]</td>
                                <td> $d4[nama_du]</td>
                                <td> $mulai - $berakhir</td>
                                <td> $d4[nama_penanggung_jawab]</td>
                                <td>
                                    <a href='#hapusS$d[id_prakerin]' data-toggle='modal'>
                                        <button class='btn btn-sm btn-primary' type='button'><i class='fa fa-trash-o'></i> Hapus </button>
                                    </a>
                                </td>
                                <div  style='text-transform:none' aria-hidden='true' aria-labelledby='myModalLabel' role='dialog' tabindex='-1' id='hapusS$d[id_prakerin]' class='modal fade'>
                                    <div class='modal-dialog'>
                                        <div class='modal-content'>
                                            <div class='modal-header'>
                                                <button aria-hidden='true' data-dismiss='modal' class='close' type='button'>×</button>
                                                <h5>Konfirmasi</h5>
                                            </div>
                                            <div class='modal-body'>
                                                Anda yakin ingin menghapus siswa : $d3[nama] ?
                                            </div>
                                            <div class='modal-footer'>
                                                <button type='button' class='btn btn-default' data-dismiss='modal'>Kembali</button>
                                                <a href='proses_admin.php?a=hapussiswaprakerin&id=$d[id_prakerin]'>
                                                 <input type='submit' value='Hapus' name='Ganti'class='btn btn-success'></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </tr>
                         ";
                }                        
        }

        include "leftside.php"; ?>
                
        <!--body wrapper start-->
        <div class="wrapper">
            <div class="row">
                <div class="col-sm-12">
                    <section class="panel">
                    <header class="panel-heading">
                        <label><big>Hasil Rekapitulasi Prakerin</big></label>
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
                                            <th>Nama Siswa</th>
                                            <th>Jurusan</th>
                                            <th>Pembimbing</th>
                                            <th>Tempat Prakerin</th>
                                            <th>Mulai Pelaksanaan</th>
                                            <th>Penanggung Jawab</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                                $query = mysql_query( "SELECT * from hb_prakerin,siswa WHERE hb_prakerin.nis = siswa.nis AND status_verifikasi ='Terverifikasi'");
                                                $no =0;
                                                while ($d = mysql_fetch_array($query)) {
                                                    $no = $no+1;

                                                    $d4 = mysql_fetch_array(mysql_query("SELECT mulai_pelaksanaan, berakhir_pelaksanaan, nama_du, nama_penanggung_jawab FROM hb_du WHERE id_du ='$d[id_du]'"));
                                                    $mulai = tanggal($d4["mulai_pelaksanaan"]);
                                                    $berakhir = tanggal($d4["berakhir_pelaksanaan"]);
                                                    $d2 = mysql_fetch_array(mysql_query("SELECT nama FROM guru WHERE nip_guru ='$d[nip_guru]'"));
                                                    $d3 = mysql_fetch_array(mysql_query("SELECT nama,id_jurusan, kelas FROM siswa WHERE nis ='$d[nis]'"));
                                                    $jurusan = mysql_fetch_array(mysql_query("SELECT singkatan FROM jurusan WHERE id_jurusan = '$d3[id_jurusan]'"));
                                                    echo "
                                                        <tr class='gradeA'>
                                                            <td> $no </td>
                                                            <td> $d3[nama] </td>
                                                            <td> $jurusan[singkatan] - $d3[kelas] </td>
                                                            <td> $d2[nama]</td>
                                                            <td> $d4[nama_du]</td>
                                                            <td> $mulai - $berakhir</td>
                                                            <td> $d4[nama_penanggung_jawab]</td>
                                                        </tr>
                                                        ";
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
                                                $query = mysql_query( "SELECT * from hb_prakerin,siswa WHERE id_jurusan = 1 AND hb_prakerin.nis = siswa.nis AND status_verifikasi ='Terverifikasi' ");
                                                $jumlah = mysql_num_rows($query);
                                                if ($jumlah > 0) {
                                                    isinya($query);
                                                }else{
                                                    echo "<td colspan='8'> <center> Belum Ada Yang Diverifikasi <center> </td>";
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
                                            <!--<a href='' class='btn btn-warning'> Cetak </a> <br><br> -->
                                        <table  class="display table table-bordered table-striped" id="dynamic-table">
                                        <thead>
                                        <tr>
                                            <?php judultabel() ?>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $query = mysql_query( "SELECT * from hb_prakerin,siswa WHERE id_jurusan = 7 AND hb_prakerin.nis = siswa.nis AND status_verifikasi ='Terverifikasi' ");
                                                $jumlah = mysql_num_rows($query);
                                                if ($jumlah > 0) {
                                                    isinya($query);
                                                }else{
                                                    echo "<td colspan='8'> <center> Belum Ada Yang Diverifikasi <center> </td>";
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
                                            <!--<a href='' class='btn btn-warning'> Cetak </a> <br><br> -->
                                        <table  class="display table table-bordered table-striped" id="dynamic-table">
                                        <thead>
                                        <tr>
                                            <?php judultabel() ?>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $query = mysql_query( "SELECT * from hb_prakerin,siswa WHERE id_jurusan = 2 AND hb_prakerin.nis = siswa.nis AND status_verifikasi ='Terverifikasi' ");
                                                $jumlah = mysql_num_rows($query);
                                                if ($jumlah > 0) {
                                                    isinya($query);
                                                }else{
                                                    echo "<td colspan='8'> <center> Belum Ada Yang Diverifikasi <center> </td>";
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
                                            <!--<a href='' class='btn btn-warning'> Cetak </a> <br><br> -->
                                        <table  class="display table table-bordered table-striped" id="dynamic-table">
                                        <thead>
                                        <tr>
                                            <?php judultabel() ?>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $query = mysql_query( "SELECT * from hb_prakerin,siswa WHERE id_jurusan = 3 AND hb_prakerin.nis = siswa.nis AND status_verifikasi ='Terverifikasi' ");
                                                $jumlah = mysql_num_rows($query);
                                                if ($jumlah > 0) {
                                                    isinya($query);
                                                }else{
                                                    echo "<td colspan='8'> <center> Belum Ada Yang Diverifikasi <center> </td>";
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
                                            <!--<a href='' class='btn btn-warning'> Cetak </a> <br><br> -->
                                        <table  class="display table table-bordered table-striped" id="dynamic-table">
                                        <thead>
                                        <tr>
                                            <?php judultabel() ?>
                                        </tr>
                                        </thead>
                                        <tbody>
                                           <?php 
                                                $query = mysql_query( "SELECT * from hb_prakerin,siswa WHERE id_jurusan = 5 AND hb_prakerin.nis = siswa.nis AND status_verifikasi ='Terverifikasi' ");
                                                $jumlah = mysql_num_rows($query);
                                                if ($jumlah > 0) {
                                                    isinya($query);
                                                }else{
                                                    echo "<td colspan='8'> <center> Belum Ada Yang Diverifikasi <center> </td>";
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
                                            <!--<a href='' class='btn btn-warning'> Cetak </a> <br><br> -->
                                        <table  class="display table table-bordered table-striped" id="dynamic-table">
                                        <thead>
                                        <tr>
                                            <?php judultabel() ?>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $query = mysql_query( "SELECT * from hb_prakerin,siswa WHERE id_jurusan = 4 AND hb_prakerin.nis = siswa.nis AND status_verifikasi ='Terverifikasi' ");
                                                $jumlah = mysql_num_rows($query);
                                                if ($jumlah > 0) {
                                                    isinya($query);
                                                }else{
                                                    echo "<td colspan='8'> <center> Belum Ada Yang Diverifikasi <center> </td>";
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
                                            <!--<a href='' class='btn btn-warning'> Cetak </a> <br><br> -->
                                        <table  class="display table table-bordered table-striped" id="dynamic-table">
                                        <thead>
                                        <tr>
                                            <?php judultabel() ?>
                                        </tr>
                                        </thead>
                                        <tbody>
                                           <?php 
                                                $query = mysql_query( "SELECT * from hb_prakerin,siswa WHERE id_jurusan = 6 AND hb_prakerin.nis = siswa.nis AND status_verifikasi ='Terverifikasi' ");
                                                $jumlah = mysql_num_rows($query);
                                                if ($jumlah > 0) {
                                                    isinya($query);
                                                }else{
                                                    echo "<td colspan='8'> <center> Belum Ada Yang Diverifikasi <center> </td>";
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
                                            <!--<a href='' class='btn btn-warning'> Cetak </a> <br><br> -->
                                        <table  class="display table table-bordered table-striped" id="dynamic-table">
                                        <thead>
                                        <tr>
                                            <?php judultabel() ?>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $query = mysql_query( "SELECT * from hb_prakerin,siswa WHERE id_jurusan = 8 AND hb_prakerin.nis = siswa.nis AND status_verifikasi ='Terverifikasi' ");
                                                $jumlah = mysql_num_rows($query);
                                                if ($jumlah > 0) {
                                                    isinya($query);
                                                }else{
                                                    echo "<td colspan='8'> <center> Belum Ada Yang Diverifikasi <center> </td>";
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
                                            <!--<a href='' class='btn btn-warning'> Cetak </a> <br><br> -->
                                        <table  class="display table table-bordered table-striped" id="dynamic-table">
                                        <thead>
                                        <tr>
                                            <?php judultabel() ?>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $query = mysql_query( "SELECT * from hb_prakerin,siswa WHERE id_jurusan = 9 AND hb_prakerin.nis = siswa.nis AND status_verifikasi ='Terverifikasi' ");
                                                $jumlah = mysql_num_rows($query);
                                                if ($jumlah > 0) {
                                                    isinya($query);
                                                }else{
                                                    echo "<td colspan='8'> <center> Belum Ada Yang Diverifikasi <center> </td>";
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