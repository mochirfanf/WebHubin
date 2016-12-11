<?php

include "../koneksidb.php";

if($_SESSION['level']=='kapprog'){ 
    if ($_SESSION['tahun_ajaran']!='') {
        $title="Daftar Siswa yang Dimonitoring";
        $active ="";
        $active19 = "active";
        $navactive7 ="nav-active";

        $data = mysql_query( "SELECT * FROM hb_prakerin INNER JOIN hb_monitoring ON hb_prakerin.id_du=hb_monitoring.id_du INNER JOIN hb_du_jumlah_permintaan_du ON hb_du_jumlah_permintaan_du.id_du = hb_prakerin.id_du WHERE hb_prakerin.tahun_ajaran='2013-2014' AND hb_du_jumlah_permintaan_du.id_jurusan=$_SESSION[jurusan]")or die(mysql_error());
       
       
        include "leftside.php"; ?>
                
        <!--body wrapper start-->
        <div class="wrapper">
            <div class="row">
                <div class="col-sm-12">
                    <section class="panel">
                    <header class="panel-heading">
                        <big>Daftar Perusahaan</big>
                         
                    </header>
                   
                    <div class="panel-body">
                    <div class="adv-table">
                    <table  class="display table table-bordered table-striped" id="dynamic-table">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Tempat Prakerin</th>
                        <th>Alamat Tempat Prakerin</th>
                        <th>Kota</th>
                        <th>Penanggung Jawab</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $no =0;
                            while ($d = mysql_fetch_array($data)) {
                                $no = $no+1;
                                $d2 = mysql_fetch_array(mysql_query("SELECT nama_guru FROM guru WHERE nip_guru ='$d[saran_pembimbing]'"))or die(mysql_error());
                                $d3 = mysql_fetch_array(mysql_query("SELECT nama_siswa,id_jurusan,kelas FROM siswa WHERE nis ='$d[nis]'"));
                                $d4 = mysql_fetch_array(mysql_query("SELECT id_du, kabupaten.nama AS namakab, nama_du, alamat, nama_penanggung_jawab_umum FROM hb_du_umum INNER JOIN kabupaten ON kabupaten.id_kab=hb_du_umum.id_kab WHERE id_du ='$d[id_du]'"))or die(mysql_error());

                                $j = mysql_fetch_array(mysql_query("SELECT * FROM jurusan WHERE id_jurusan='$d3[id_jurusan]'"));
                                echo "
                                    <tr class='gradeA'>
                                        <td> $no </td>
                                        <td> $d4[nama_du]</td>
                                        <td> $d4[alamat]</td>
                                        <td> $d4[namakab]</td>
                                        <td> $d4[nama_penanggung_jawab_umum]</td>
                                        <td><a href='#' data-toggle='modal' data-target='#pilihmon' data-iddu='$d[id_du]'>
                                                            <button class='btn btn-sm btn-primary' type='button'><i class='fa fa-edit'></i> Pilih Guru </button>
                                                        </a>
                                                        </td>
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



<div class='modal fade' id='pilihmon' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
<?php

$gurujur = mysql_query("SELECT a.nip_guru, nama_guru FROM guru a INNER JOIN hb_guru_jurusan b ON a.nip_guru = b.nip_guru WHERE id_jurusan=$_SESSION[jurusan]");

                                    

?>
        <div class='modal-dialog'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                    <h4 class='modal-title' id='myModalLabel'>Pilih Petugas</h4> </div>
                <div class='modal-body'>
                    <form class='form-horizontal form-label-left' method='POST' action='proses_kapprog.php?a=pilihpem' enctype='multipart/form-data'>
                        
                        <label class='control-label col-md-3 col-sm-3 col-xs-12' for='name'>Petugas : <span class='required'></span> </label>
                        <div class="col-lg-8"><?php
                                    $name = "";
                                    echo "<input type='hidden' id='nis' name='nis'>";
                                    echo "<select required class='form-control m-bot15' name='pembimbing'>
                                            ";
                                                while($a = mysql_fetch_array($gurujur)){
                                     echo " <option value='$a[nip_guru]'> $a[nama_guru] </option>";
                                                }
                                    echo "</select>";?>
                                </div>
                </div>
                <div class='modal-footer'>
                    <div class='form-group'>
                        <div class='col-md-4 col-md-offset-8'>
                            <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
                            <button style=' margin-top: -5px;' value='pilih' id='send' type='submit' class='btn btn-success' name='pilih'>Pilih</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



        <div class='modal fade' id='nilai' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
<?php

//$gurujur = mysql_query("SELECT a.nip_guru, nama_guru FROM guru a INNER JOIN hb_guru_jurusan b ON a.nip_guru = b.nip_guru WHERE id_jurusan=$_SESSION[jurusan]");

                                    

?>
        <div class='modal-dialog'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                    <h4 class='modal-title' id='myModalLabel'>Register Perusahaan</h4> </div>
                <div class='modal-body'>
                    <form class='form-horizontal form-label-left' method='POST' action='proses_guru.php?a=monitoring' enctype='multipart/form-data'>
                       <input type='hidden' id='iddu' name='iddu'>
                            <div class='item form-group'>
                                <label class='control-label col-md-5 col-sm-3 col-xs-12' for='name'>Yang Menerima : <span class='required'></span> </label>
                                <div class='col-md-7 col-sm-9 col-xs-12' style='margin-bottom:20px;'>
                                <input class='form-control col-md-7 col-xs-12' id='yg_menerima' name='yg_menerima'  placeholder='Nama Penerima Monitoring' type='text' required> </div>
                            </div>
                            <div class='item form-group'>
                                <label class='control-label col-md-5 col-sm-3 col-xs-12' for='name'>Kegiatan Siswa : <span class='required'></span> </label>
                                <div class='col-md-7 col-sm-9 col-xs-12' style='margin-bottom:20px;'>
                                <input class='form-control col-md-7 col-xs-12' id='kegiatan' name='kegiatansiswa'  placeholder='Kegiatan Siswa' type='text' required> </div>
                            </div>
                            <div class='item form-group'>
                                <label class='control-label col-md-5 col-sm-3 col-xs-12' for='name'>Nilai : <span class='required'></span> </label>
                                <div class='col-md-7 col-sm-9 col-xs-12' style='margin-bottom:20px;'>
                                <input class='form-control col-md-7 col-xs-12' name='nilai'  id='nilai' placeholder='Nilai' type='text' required> </div>
                            </div>
                            <div class='item form-group'>
                                <label class='control-label col-md-5 col-sm-3 col-xs-12' for='name'>Masalah yang Ditemukan : <span class='required'></span> </label>
                                <div class='col-md-7 col-sm-9 col-xs-12' style='margin-bottom:20px;'>
                                <textarea class='form-control col-md-7 col-xs-12' id='masalah' name='masalah' required></textarea> </div>
                            </div>
                            <div class='item form-group'>
                                <label class='control-label col-md-5 col-sm-3 col-xs-12' for='name'>Saran : <span class='required'></span> </label>
                                <div class='col-md-7 col-sm-9 col-xs-12' style='margin-bottom:20px;'>
                                <textarea class='form-control col-md-7 col-xs-12' id='saran' name='saran'  required> </textarea></div>
                            </div>
                                    
                </div>
                <div class='modal-footer'>
                    <div class='form-group'>
                        <div class='col-md-4 col-md-offset-8'>
                            <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
                            <button style=' margin-top: -5px;' value='pilih' id='send' type='submit' class='btn btn-success' name='pilih'>Simpan</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php       include "footer.php";
    }else{
        header('location:tahun_ajaran.php');
    }
}else{
    header('location:../login.php');
}

?>