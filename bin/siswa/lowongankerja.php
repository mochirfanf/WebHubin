<?php

include "../koneksidb.php";

if($_SESSION['level']=='siswa'){
    if ($_SESSION['tahun_ajaran']!='') {
        $title="Permohonan Perizinan Prakerin";
        $active ="";
        $active19 = "active";
        $navactive22 ="nav-active";

        $data = mysql_query( "SELECT * from hb_du_umum, hb_du_permintaan_kerja, hb_du_jumlah_permintaan_du_kerja WHERE status_permintaan='Sudah Terverifikasi' AND hb_du_umum.id_du=hb_du_permintaan_kerja.id_du AND hb_du_jumlah_permintaan_du_kerja.id_du_kerja=hb_du_permintaan_kerja.id_du_kerja AND hb_du_jumlah_permintaan_du_kerja.id_jurusan=$_SESSION[jurusan]");
        $data2 = mysql_query( "SELECT * from hb_du_umum, hb_du_permintaan  WHERE status_permintaan='Belum Terverifikasi' AND permintaan_du='Ya' AND hb_du_umum.id_du=hb_du_permintaan.id_du");
        $data3 = mysql_query( "SELECT * from hb_du_umum, hb_du_permintaan  WHERE status_permintaan='Belum Terverifikasi' AND permintaan_du='Ya'  AND hb_du_umum.id_du=hb_du_permintaan.id_du");

        include "leftside.php"; ?>

        <!--body wrapper start-->
        <div class="wrapper">
            <div class="row">
                <div class="col-sm-12">
                    <section class="panel">
                    <header class="panel-heading">
                        <big>Permohonan Lowongan Pekerjaan</big>
                         <span class="pull-right">

                         </span>
                    </header>

                    <div class="panel-body">
                    <div class="adv-table">
                    <table  class="display table table-bordered table-striped" id="dynamic-table">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama DU/DI</th>
                        <th>Alamat</th>
                        <th>Penanggung Jawab</th>
                        <th>Info Permintaan</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                            $no =0;
                            while ($d = mysql_fetch_array($data)) {
                                $no = $no+1;
                                $kab = mysql_fetch_array(mysql_query("SELECT nama FROM kabupaten WHERE id_kab='$d[id_kab]'"));

                                $adaatau = mysql_query("SELECT * FROM hb_lamar_kerja WHERE id_du_kerja=$d[id_du_kerja] AND nis = $_SESSION[username]");
                                $ada = mysql_fetch_array($adaatau);
                                if(!empty($ada)){
                                    $isi = "disabled";
                                    $ahref= "";
                                    $tul = "Lamaran Terkirim";
                                }else{
                                    $isi = "";
                                    $ahref= "#apply";
                                    $tul= "Lamar Pekerjaan";
                                }
                                echo "
                                    <tr class='gradeA'>
                                        <td> $no </td>
                                        <td> $d[nama_du] </td>
                                        <td> $d[alamat]
                                             <br> Kab/Kota : $kab[nama]
                                        </td>
                                        <td> $d[penanggung_jawab] <br> $d[cp]</td>
                                        <td>";

                                                $query  = mysql_query("SELECT * FROM hb_du_jumlah_permintaan_du_kerja WHERE id_du_kerja='$d[id_du_kerja]' ");
                                                while ($x = mysql_fetch_array($query)) {
                                                    $j = mysql_fetch_array(mysql_query("SELECT * FROM jurusan WHERE id_jurusan='$x[id_jurusan]'"));
                                                    echo " $j[nama_jurusan] - $x[jumlah_penerimaan] orang <br>";
                                                }

                                            echo "
                                            </div>
                                        </td>
                                        <td class='center'>
                                            <a href='#detail' data-toggle='modal' data-id='$d[id_du_kerja]'>
                                                <button class='btn btn-sm btn-info' type='button'><i class='fa fa-check'></i> Detail </button>
                                            </a>
                                            <a href='$ahref' data-toggle='modal' data-id='$d[id_du_kerja]'>
                                                <button class='btn btn-sm btn-primary' type='button' $isi><i class='fa fa-circle'></i> $tul </button>
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
                    <label> <br>
                        &nbsp; &nbsp; ** Hati - hati jika anda menolak permintaan! <br><br>
                    </label>
                    </section>
                </div>
            </div>
        </div>

        <div class='modal fade' id='apply' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
<?php

                                    

?>
        <div class='modal-dialog'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                    <h4 class='modal-title' id='myModalLabel'>Lamaran Pekerjaan</h4> </div>
                <div class='modal-body'>
                    <form class='form-horizontal form-label-left' method='POST' action='proses_siswa.php?a=lamarkerja' enctype='multipart/form-data'>
                        <div class='item form-group'>
                                <label class='control-label col-md-3 col-sm-3 col-xs-12' for='name'>Portofolio : <span class='required'></span> </label>
                                <div class='col-md-7 col-sm-9 col-xs-12' style='margin-bottom:20px;'>
                                <textarea class='form-control col-md-12 col-xs-12' id='portofolio' name='portofolio' required></textarea>
                                 </div>
                            </div>

                            <div class='item form-group'>
                                <label class='control-label col-md-3 col-sm-3 col-xs-12' for='name'>Lampiran : <span class='required'></span> </label>
                                <div class='col-md-7 col-sm-9 col-xs-12' style='margin-bottom:20px;'>
                                <input type='file' class='form-control col-md-12 col-xs-12' id='lampiran' name='lampiran' required></textarea>
                                 </div>
                            </div>
                            <?php
                                    $name = "";
                                    echo "<input type='hidden' id='id' name='id'>";
                                    ?>
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


            <div class='modal fade' id='detail' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
<?php

                                    

?>
        <div class='modal-dialog'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                    <h4 class='modal-title' id='myModalLabel'>Detail Pekerjaan Kerja</h4> </div>
                <div class='modal-body'>
                    <form class='form-horizontal form-label-left' method='POST' action='proses_admin.php?a=tolak_kerja' enctype='multipart/form-data'>
                        
                        <div class="col-lg-8"><?php
                                    echo "<input type='hidden' id='id' name='id'>";
                                    ?>
                                    <div class='col-md-8'>
                                        <b><p id='namadu'></p></b>
                                    </div>
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
        <!--body wrapper end-->

<?php       include "footer.php";
    }else{
        header('location:tahun_ajaran.php');
    }
}else{
    header('location:../login.php');
}

?>
