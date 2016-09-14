<?php

include "../koneksidb.php";

if($_SESSION['level']=='admin'){ 
    if ($_SESSION['tahun_ajaran']!='') {
        $title="Rekapitulasi Kapprog";
        $active = "";
        $active16 = "active";
        $navactive1 ="nav-active";

        function judultabel(){
            echo "  <th>No</th>
                    <th>Nama Siswa</th>
                    <th>Tempat Prakerin</th>
                    <th>Saran Pembimbing</th>
                    <th>Aksi</th>";
        }
        function isinya($query){
                $no =0;
                while ($d = mysql_fetch_array($query)) {
                    $no = $no+1;
                    $d2 = mysql_fetch_array(mysql_query("SELECT nama FROM guru WHERE nip_guru ='$d[saran_pembimbing]'"));
                    $d3 = mysql_fetch_array(mysql_query("SELECT nama FROM siswa WHERE nis ='$d[nis]'"));
                    $d4 = mysql_fetch_array(mysql_query("SELECT nama_du FROM hb_du WHERE id_du ='$d[id_du]'"));
                    echo "
                        <tr class='gradeA'>
                            <td> $no </td>
                            <td> $d3[nama] </td>
                            <td> $d4[nama_du]</td>
                            <td> $d2[nama]</td>
                            <td class='center'>        
                                <a href='#verifikasi$d[id_prakerin]' data-toggle='modal'>
                                    <button class='btn btn-sm btn-success' type='button'><i class='fa fa-check-square-o'></i> Verifikasi </button>
                                </a>
                                <a href='#cari$d[id_prakerin]' data-toggle='modal'>
                                    <button class='btn btn-sm btn-success' type='button'><i class='fa fa-check-square-o'></i> Cari DU Lain </button>
                                </a>
                            </td>
                                <div  style='text-transform:none' aria-hidden='true' aria-labelledby='myModalLabel' role='dialog' tabindex='-1' id='cari$d[id_prakerin]' class='modal fade'>
                                    <div class='modal-dialog'>
                                        <div class='modal-content'>
                                            <div class='modal-header'>
                                                <button aria-hidden='true' data-dismiss='modal' class='close' type='button'>×</button>
                                                <h5>Konfirmasi</h5>
                                            </div>
                                            <div class='modal-body'>
                                                Cari DU Lain ?
                                            </div>
                                            <div class='modal-footer'>
                                                <button type='button' class='btn btn-default' data-dismiss='modal'>Kembali</button>
                                                <a href='proses_admin.php?...&id=$d[id_prakerin]'>
                                                 <input type='submit' value='Hapus' name='Ganti'class='btn btn-success'></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div  style='text-transform:none' aria-hidden='true' aria-labelledby='myModalLabel' role='dialog' tabindex='-1' id='verifikasi$d[id_prakerin]' class='modal fade'>
                                    <div class='modal-dialog'>
                                        <div class='modal-content'>
                                               <div class='modal-header'>
                                                    <button aria-hidden='true' data-dismiss='modal' class='close' type='button'>×</button>
                                                    <h5>Verifikasi Tempat Prakerin Siswa : $d3[nama]?</h5>
                                                </div>
                                        <div class='modal-body'> ";
                                                                                
                                    ?>
                                        <div class="form-group">
                                            <label class="col-lg-4 col-sm-4 control-label">Pembimbing</label>
                                            <div class="col-lg-8">
                                                <form method="POST" action="<?php echo "proses_admin.php?a=verifikasiprakerin&id=$d[id_prakerin]"; ?>" enctype='multipart/form-data' >
                                    <?php

                                                 echo "<select class='form-control m-bot15' name='saran'>
                                                          <option value=''> Pilih Pembimbing Siswa </option>";
                                                          $guru = mysql_query( "SELECT * FROM guru, hb_guru_jurusan WHERE guru.nip_guru = hb_guru_jurusan.nip_guru");
                                                          while($y = mysql_fetch_array($guru)){
                                                                echo " <option value='$y[nip_guru]'> $y[nama] </option>";
                                                          }
                                                 echo "</select>";
                                    ?>
                                            </div>
                                        </div><?php

                              echo "</div>
                                    <div class='modal-footer'>
                                        <button type='button' class='btn btn-default' data-dismiss='modal'>Kembali</button>
                                        <input type='submit' value='Verifikasi' name='Verifikasi' class='btn btn-success'>  </form>
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
                        <label><big>Rekapitulasi Kapprog</big></label>
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
                                            <th>Tempat Prakerin</th>
                                            <th>Saran Pembimbing</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                                $query = mysql_query( "SELECT * from hb_prakerin,siswa WHERE hb_prakerin.nis = siswa.nis AND status_verifikasi ='Menunggu Verifikasi'");
                                                $no =0;
                                                while ($d = mysql_fetch_array($query)) {
                                                    $no = $no+1;
                                                    $d2 = mysql_fetch_array(mysql_query("SELECT nama FROM guru WHERE nip_guru ='$d[saran_pembimbing]'"));
                                                    $d3 = mysql_fetch_array(mysql_query("SELECT nama,id_jurusan, kelas FROM siswa WHERE nis ='$d[nis]'"));
                                                    $d4 = mysql_fetch_array(mysql_query("SELECT nama_du FROM hb_du WHERE id_du ='$d[id_du]'"));
                                                    $jurusan = mysql_fetch_array(mysql_query("SELECT singkatan FROM jurusan WHERE id_jurusan = '$d3[id_jurusan]'"));
                                                    echo "
                                                        <tr class='gradeA'>
                                                            <td> $no </td>
                                                            <td> $d3[nama] </td>
                                                            <td> $jurusan[singkatan] - $d3[kelas] </td>
                                                            <td> $d4[nama_du]</td>
                                                            <td> $d2[nama]</td>
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
                                                $query = mysql_query( "SELECT * from hb_prakerin,siswa WHERE hb_prakerin.nis = siswa.nis AND id_jurusan = 1 AND status_verifikasi ='Menunggu Verifikasi'");
                                                $jumlah = mysql_num_rows($query);
                                                if ($jumlah > 0) {
                                                    isinya($query);
                                                }else{
                                                    echo "<td colspan='8'> <center> Tidak Ada Permintaan <center> </td>";
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
                                                $query = mysql_query( "SELECT * from hb_prakerin,siswa WHERE hb_prakerin.nis = siswa.nis AND id_jurusan = 7 AND status_verifikasi ='Menunggu Verifikasi'");
                                                $jumlah = mysql_num_rows($query);
                                                if ($jumlah > 0) {
                                                    isinya($query);
                                                }else{
                                                    echo "<td colspan='8'> <center> Tidak Ada Permintaan <center> </td>";
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
                                                $query = mysql_query( "SELECT * from hb_prakerin,siswa WHERE hb_prakerin.nis = siswa.nis AND id_jurusan = 2 AND status_verifikasi ='Menunggu Verifikasi'");
                                                $jumlah = mysql_num_rows($query);
                                                if ($jumlah > 0) {
                                                    isinya($query);
                                                }else{
                                                    echo "<td colspan='8'> <center> Tidak Ada Permintaan <center> </td>";
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
                                                $query = mysql_query( "SELECT * from hb_prakerin,siswa WHERE hb_prakerin.nis = siswa.nis AND id_jurusan = 3 AND status_verifikasi ='Menunggu Verifikasi'");
                                                $jumlah = mysql_num_rows($query);
                                                if ($jumlah > 0) {
                                                    isinya($query);
                                                }else{
                                                    echo "<td colspan='8'> <center> Tidak Ada Permintaan <center> </td>";
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
                                                $query = mysql_query( "SELECT * from hb_prakerin,siswa WHERE hb_prakerin.nis = siswa.nis AND id_jurusan = 5 AND status_verifikasi ='Menunggu Verifikasi'");
                                                $jumlah = mysql_num_rows($query);
                                                if ($jumlah > 0) {
                                                    isinya($query);
                                                }else{
                                                    echo "<td colspan='8'> <center> Tidak Ada Permintaan <center> </td>";
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
                                                $query = mysql_query( "SELECT * from hb_prakerin,siswa WHERE hb_prakerin.nis = siswa.nis AND id_jurusan = 4 AND status_verifikasi ='Menunggu Verifikasi'");
                                                $jumlah = mysql_num_rows($query);
                                                if ($jumlah > 0) {
                                                    isinya($query);
                                                }else{
                                                    echo "<td colspan='8'> <center> Tidak Ada Permintaan <center> </td>";
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
                                                $query = mysql_query( "SELECT * from hb_prakerin,siswa WHERE hb_prakerin.nis = siswa.nis AND id_jurusan = 6 AND status_verifikasi ='Menunggu Verifikasi'");
                                                $jumlah = mysql_num_rows($query);
                                                if ($jumlah > 0) {
                                                    isinya($query);
                                                }else{
                                                    echo "<td colspan='8'> <center> Tidak Ada Permintaan <center> </td>";
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
                                                $query = mysql_query( "SELECT * from hb_prakerin,siswa WHERE hb_prakerin.nis = siswa.nis AND id_jurusan = 8 AND status_verifikasi ='Menunggu Verifikasi'");
                                                $jumlah = mysql_num_rows($query);
                                                if ($jumlah > 0) {
                                                    isinya($query);
                                                }else{
                                                    echo "<td colspan='8'> <center> Tidak Ada Permintaan <center> </td>";
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
                                                $query = mysql_query( "SELECT * from hb_prakerin,siswa WHERE hb_prakerin.nis = siswa.nis AND id_jurusan = 9 AND status_verifikasi ='Menunggu Verifikasi'");
                                                $jumlah = mysql_num_rows($query);
                                                if ($jumlah > 0) {
                                                    isinya($query);
                                                }else{
                                                    echo "<td colspan='8'> <center> Tidak Ada Permintaan <center> </td>";
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