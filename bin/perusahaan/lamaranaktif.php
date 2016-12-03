<?php

include "../koneksidb.php";

if($_SESSION['level']=='perusahaan'){
        $title="Lamaran Aktif";
        $active ="";
        $active13 = "active";
        $navactive6 ="nav-active";

        $terbr = mysql_query( "SELECT id_du_kerja from hb_du_permintaan_kerja WHERE id_du='$_SESSION[id_du]' AND status_permintaan!='Ditutup'ORDER BY id_du_kerja DESC LIMIT 1 ")or die(mysql_error());
        $aa = mysql_fetch_array($terbr);
        $data = mysql_query( "SELECT * from hb_lamar_kerja INNER JOIN siswa ON hb_lamar_kerja.nis = siswa.nis WHERE id_du_kerja='$aa[id_du_kerja]'")or die(mysql_error());

        include "leftside.php"; ?>

        <!--body wrapper start-->
        <div class="wrapper">
            <div class="row">
                <div class="col-sm-12">
                    <section class="panel">
                    <header class="panel-heading">
                        <big>Lamaran Aktif</big>
                         <span class="pull-right">

                         </span>
                    </header>

                    <div class="panel-body">
                    <div class="adv-table">
                    <table  class="display table table-bordered table-striped" id="dynamic-table">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Siswa</th>
                        <th>Jurusan</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                            $no =0;
                            while ($d = mysql_fetch_array($data)) {
                                $no = $no+1;
                                $j = mysql_fetch_array(mysql_query("SELECT * FROM jurusan WHERE id_jurusan='$d[id_jurusan]'"));

                                $adaatau = mysql_query("SELECT * FROM hb_lamar_kerja WHERE id_lamar=$d[id_lamar] AND nis = $d[nis] AND status!='Belum Diterima'");
                                $ada = mysql_fetch_array($adaatau);
                                if(!empty($ada)){
                                    $isi = 1;
                                    $tul = $ada['status'];
                                }else{
                                    $isi = 0;
                                    $ahref= "#apply";
                                    $tul= $ada['status'];
                                }

                                echo "
                                    <tr class='gradeA'>
                                        <td> $no </td>
                                        <td> $d[nama_siswa] </td>
                                        <td> $j[nama_jurusan]
                                        </td>
                                        <td class='center'>
                                            <a href='#detaillamar' data-toggle='modal' data-id='$d[id_lamar]'>
                                                <button class='btn btn-sm btn-info' type='button'><i class='fa fa-check'></i> Detail </button>
                                            </a>
                                            ";
                                            if($isi==0){
                                            echo "
                                            <a href='#terima' data-toggle='modal' data-id='$d[id_lamar]' data-nama='$d[nama_siswa]'>
                                                <button class='btn btn-sm btn-primary' type='button' $isi><i class='fa fa-circle'></i> Terima </button>
                                            </a>
                                            <a href='#tolak' data-toggle='modal' data-id='$d[id_lamar]'>
                                                <button class='btn btn-sm btn-danger' type='button'><i class='fa fa-circle'></i> Tolak </button>
                                            </a>";
                                        }else{
                                            echo "
                                            <a href='' data-toggle='modal'>
                                                <button class='btn btn-sm btn-primary' type='button' disabled><i class='fa fa-circle'></i> $tul </button>
                                            </a>
                                            ";}
                                            echo "
                                        </td>

                                    </tr>
                                    ";
                            }
                        ?>
                    </tbody>
                    </table>
                    </div>
                    </div>
                    <label> <br>
                    </label>
                    </section>
                </div>
            </div>
        </div>

        <div class='modal fade' id='detaillamar' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
<?php

                                    

?>
        <div class='modal-dialog'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                    <h4 class='modal-title' id='myModalLabel'>Lamaran Pekerjaan</h4> </div>
                <div class='modal-body'>
                    <form class='form-horizontal form-label-left' method='POST' action='proses_siswa.php?a=lamarkerja' enctype='multipart/form-data'>
                        <div class='col-md-12'>
                            <div class='col-md-3'>
                                <img id='poto' class='img-responsive' >
                            </div>
                            <div class='col-md-8 img-responsive'>
                                <strong><h4 id='namasiswa'>Muhammad MuhMuhMuh</h4></strong>
                                
                                <table>
                                    <tr>
                                        <td>Jurusan</td><td>&emsp;:&emsp;</td><td><span id='jur'>Bandung, 90 Desember 19999</span></td>
                                    </tr>
                                    <tr>
                                        <td>TTL</td><td>&emsp;:&emsp;</td><td><span id='ttl'>Bandung, 90 Desember 19999</span><span id='tgl'></span></td>
                                    </tr>
                                    <tr>
                                        <td>Jenis Kelamin</td><td>&emsp;:&emsp;</td><td><span id='jk'>Laki-Laki</span></td>
                                    </tr>
                                    <tr>
                                        <td>Agama</td><td>&emsp;:&emsp;</td><td><span id='agama'>Islam</span></td>
                                    </tr>
                                    <tr>
                                        <td>Gol Darah</td><td>&emsp;:&emsp;</td><td><span id='goldar'>O</span></td>
                                    </tr>
                                    <tr>
                                        <td>Email</td><td>&emsp;:&emsp;</td><td><span id='email'>Laki-Laki</span></td>
                                    </tr>
                                    <tr>
                                        <td>No Telp</td><td>&emsp;:&emsp;</td><td><span id='notelp'>Laki-Laki</span></td>
                                    </tr>
                                </table>
                            </div>
                            <div class='col-md-12' style='padding: 20px'>
                                <h4>Portofolio</h4>
                                <p id='porto'>
                                Saya hsdvghjacj asdasgh afsda df qwd a fdafdad fdwsadf  fdwqdf fdqawfd. Saya hsdvghjacj asdasgh afsda df qwd a fdafdad fdwsadf  fdwqdf fdqawfd. Saya hsdvghjacj asdasgh afsda df qwd a fdafdad fdwsadf  fdwqdf fdqawfd. Saya hsdvghjacj asdasgh afsda df qwd a fdafdad fdwsadf  fdwqdf fdqawfd. Saya hsdvghjacj asdasgh afsda df qwd a fdafdad fdwsadf  fdwqdf fdqawfd
                                </p>
                            </div>
                            <div class='col-md-12' style='padding: 20px'>
                                <h4 id='text'>Lampiran</h4>
                                <p id=''>
                                <a href='#' id='lam'>Unduh Lampiran</a>
                                </p>
                            </div>
                        </div><?php
                                    $name = "";
                                    echo "<input type='hidden' id='id' name='id'>";
                                    ?>
                </div>
                <div class='modal-footer'  style='border: 0'>
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


            <div class='modal fade' id='terima' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
<?php

                                    

?>
        <div class='modal-dialog'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                    <h4 class='modal-title' id='myModalLabel'>Terima Lamaran Pekerjaan</h4> </div>
                <div class='modal-body'>
                    <form class='form-horizontal form-label-left' method='POST' action='proseskerja.php?a=terima_kerja' enctype='multipart/form-data'>
                        
                                    <div class='col-md-12'>
                                        <b>Terima <span id='namasiswa'></span> ?</b>
                                    </div><?php
                                    echo "<input type='hidden' id='id' name='id'>";
                                    ?>
                </div>
                <div class='modal-footer'>
                    <div class='form-group'>
                        <div class='col-md-4 col-md-offset-8'>
                            <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
                            <button style=' margin-top: -5px;' value='Ya' id='send' type='submit' class='btn btn-success' name='pilih'>Ya</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
        <!--body wrapper end-->

<?php       include "footer.php";
    
}else{
    header('location:../login.php');
}

?>
