<?php

include "../koneksidb.php";

if($_SESSION['level']=='perusahaan'){
        $title="Lamaran Aktif";
        $active ="";
        $active54 = "active";
        $navactive6 ="nav-active";

        $data = mysql_fetch_array(mysql_query("SELECT *, GROUP_CONCAT(nama_jurusan,' - ',jumlah_penerimaan) as jur from hb_du_umum, hb_du_permintaan_kerja, hb_du_jumlah_permintaan_du_kerja, jurusan WHERE hb_du_umum.id_du=hb_du_permintaan_kerja.id_du AND hb_du_jumlah_permintaan_du_kerja.id_du_kerja=hb_du_permintaan_kerja.id_du_kerja AND hb_du_jumlah_permintaan_du_kerja.id_jurusan=jurusan.id_jurusan AND hb_du_permintaan_kerja.id_du_kerja='$_GET[id]'"));
        $data2 = mysql_query("SELECT * from hb_lamar_kerja INNER JOIN siswa ON hb_lamar_kerja.nis = siswa.nis WHERE id_du_kerja='$_GET[id]' AND status='Lamaran Diterima'")or die(mysql_error());
        $data3 = mysql_query("SELECT * from hb_lamar_kerja INNER JOIN siswa ON hb_lamar_kerja.nis = siswa.nis WHERE id_du_kerja='$_GET[id]'")or die(mysql_error());
        

        include "leftside.php"; ?>

        <!--body wrapper start-->
        <div class="wrapper">
            <div class="row">
                <div class="col-sm-12">
                    <section class="panel">
                    <header class="panel-heading">
                        <big>Detail Riwayat Permintaan</big>
                         <span class="pull-right">

                         </span>
                    </header>

                    <div class="panel-body">
                    
                    <ul class="nav nav-tabs">
                          <li class="active"><a data-toggle="tab" href="#home">Detail Pekerjaan</a></li>
                          <li><a data-toggle="tab" href="#menu1">Lamaran Diterima</a></li>
                          <li><a data-toggle="tab" href="#menu2">Lamaran Masuk (Semua)</a></li>
                        </ul>

                        <div class="tab-content">
                          <div id="home" class="tab-pane fade in active">
                            <div class="form-group">
                                        <h3 class="control-label col-md-12 col-sm-12 col-xs-12" style='margin-bottom: 20px'> <?php echo $data['judul'].'';?></h3>
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12"> Jurusan : </label>
                                        <div class="col-lg-6 flat-green">
                                            <table style="margin-top: 7px">
                                                <?php

                                                $query  = mysql_query("SELECT * FROM hb_du_jumlah_permintaan_du_kerja WHERE id_du_kerja='$data[id_du_kerja]'");

                                                while ($d = mysql_fetch_array($query)) {
                                                    $j = mysql_fetch_array(mysql_query("SELECT * FROM jurusan WHERE id_jurusan='$d[id_jurusan]'"));
                                                    echo " <tr>
                                                    <td> $j[nama_jurusan] </td>
                                                    <td> &nbsp;&nbsp; - &nbsp;&nbsp; </td>
                                                    <td> $d[jumlah_penerimaan] orang</td>
                                                    </tr> ";
                                                }

                                                ?>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <br>
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Nama Penanggung Jawab :</label>
                                        <div style="margin-top:7px" class="col-lg-6 flat-green">
                                            <?php echo "$data[penanggung_jawab]";?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <br>
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Kontak Penanggung Jawab :</label>
                                        <div style="margin-top:7px" class="col-lg-6 flat-green">
                                            <?php echo "$data[cp]";?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <br>
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Jenis Seleksi :</label>
                                        <div style="margin-top:7px" class="col-lg-6 flat-green">
                                            <?php echo "$data[seleksi]";?>
                                        </div>
                                    </div>
                                    <?php if($data['seleksi']=='Ya'){
                                        ?>
                                    <div class="form-group">
                                        <br>
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Tempat Seleksi :</label>
                                        <div style="margin-top:7px" class="col-lg-6 flat-green">
                                            <?php echo "$data[tempat_seleksi]";?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <br>
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Tanggal Seleksi :</label>
                                        <div style="margin-top:7px" class="col-lg-6 flat-green">
                                            <?php echo "$data[tanggal_seleksi]";?>
                                        </div>
                                    </div>
                                    
                                    <?php
                                    }
                                    ?>
                                    <div class="form-group">
                                        <br>
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Gaji :</label>
                                        <div style="margin-top:7px" class="col-lg-6 flat-green">
                                            <?php echo "$data[gaji]";?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <br>
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Deskripsi Pekerjaan :</label>
                                        <div style="margin-top:7px" class="col-lg-6 flat-green">
                                            <?php echo "$data[lainnya]";?>
                                        </div>
                                    </div>
                          </div>
                          <div id="menu1" class="tab-pane fade">
                                <?php
                                $j = mysql_fetch_array(mysql_query("SELECT * FROM jurusan WHERE id_jurusan='$data2[id_jurusan]'"));
                                ?>
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
                                        while ($d = mysql_fetch_array($data2)) {
                                            $no = $no+1;
                                            echo "
                                                <tr class='gradeA'>
                                                    <td> $no </td>
                                                    <td> $d[nama_siswa] </td>
                                                    <td> $j[nama_jurusan]</td>
                                                    <td><a href='#detaillamar' data-toggle='modal' data-id='$d[id_lamar]'>
                                                <button class='btn btn-sm btn-info' type='button'><i class='fa fa-check'></i> Detail </button>
                                                    </a></td>
                                                ";
                                        }
                                    ?>
                                </tbody>
                                </table>
                                </div>
                          </div>
                          <div id="menu2" class="tab-pane fade">
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
                                        while ($d = mysql_fetch_array($data3)) {
                                            $no = $no+1;
                                            echo "
                                                <tr class='gradeA'>
                                                    <td> $no </td>
                                                    <td> $d[nama_siswa] </td>
                                                    <td> $j[nama_jurusan]</td>
                                                    <td><a href='#detaillamar' data-toggle='modal' data-id='$d[id_lamar]'>
                                                <button class='btn btn-sm btn-info' type='button'><i class='fa fa-check'></i> Detail </button>
                                                    </a></td>
                                                ";
                                        }
                                    ?>
                                </tbody>
                                </table>
                                </div>
                          </div>
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
                                <a href='#' id='lam' target='_blank' download='#'>Unduh Lampiran</a>
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

        <!--body wrapper end-->

<?php       include "footer.php";
    
}else{
    header('location:../login.php');
}

?>
