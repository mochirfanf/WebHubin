<?php

include "../koneksidb.php";

if($_SESSION['level']=='admin'){
    if ($_SESSION['tahun_ajaran']!='') {
        $title="Permohonan Perizinan Prakerin";
        $active ="";
        $active12 = "active";
        $navactive7 ="nav-active";

        $data = mysql_query( "SELECT * FROM hb_du_permintaan INNER JOIN hb_du_jumlah_permintaan_du ON hb_du_permintaan.id_du = hb_du_jumlah_permintaan_du.id_du INNER JOIN hb_du_umum ON hb_du_umum.id_du = hb_du_permintaan.id_du GROUP BY hb_du_permintaan.id_du")or die(mysql_error());
        //$data2 = mysql_query( "SELECT * FROM hb_prakerin INNER JOIN hb_monitoring ON hb_prakerin.id_du=hb_monitoring.id_du INNER JOIN hb_du_jumlah_permintaan_du ON hb_du_jumlah_permintaan_du.id_du = hb_prakerin.id_du WHERE hb_prakerin.tahun_ajaran='$_SESSION[tahun_ajaran]'");
        //$data3 = mysql_query( "SELECT * FROM hb_prakerin INNER JOIN hb_monitori.ng ON hb_prakerin.id_du=hb_monitoring.id_du INNER JOIN hb_du_jumlah_permintaan_du ON hb_du_jumlah_permintaan_du.id_du = hb_prakerin.id_du WHERE hb_prakerin.tahun_ajaran='$_SESSION[tahun_ajaran]'");

        include "leftside.php"; ?>

        <!--body wrapper start-->
        <div class="wrapper">
            <div class="row">
                <div class="col-sm-12">
                    <section class="panel">
                    <header class="panel-heading">
                        <big>Permohonan Perizinan Prakerin</big>
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
                        <th>Alamat dan Email</th>
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
                                $kel = mysql_fetch_array(mysql_query("SELECT nama FROM kelurahan WHERE id_kel='$d[id_kel]'"));
                                $kec = mysql_fetch_array(mysql_query("SELECT nama FROM kecamatan WHERE id_kec='$d[id_kec]'"));
                                $kab = mysql_fetch_array(mysql_query("SELECT nama FROM kabupaten WHERE id_kab='$d[id_kab]'"));
                                $prov = mysql_fetch_array(mysql_query("SELECT nama FROM provinsi WHERE id_prov='$d[id_prov]'"));
                                echo "
                                    <tr class='gradeA'>
                                        <td> $no </td>
                                        <td> $d[nama_du] </td>
                                        <td> $d[alamat]
                                             <br> Kelurahan : $kel[nama]
                                             <br> Kecamatan : $kec[nama]
                                             <br> Kab/Kota : $kab[nama]
                                             <br> Provinsi : $prov[nama]
                                             <br> Kode Pos : $d[no_kodepos]
                                             <br><br> Email : $d[email_du]
                                        </td>
                                        <td> $d[nama_penanggung_jawab] <br> $d[contact_person]</td>
                                        <td>";

                                                $query  = mysql_query("SELECT * FROM hb_du_jumlah_permintaan_du WHERE id_du='$d[id_du]' ");
                                                while ($x = mysql_fetch_array($query)) {
                                                    $j = mysql_fetch_array(mysql_query("SELECT * FROM jurusan WHERE id_jurusan='$x[id_jurusan]'"));
                                                    echo " $j[nama_jurusan] - $x[jumlah_penerimaan] orang <br>";
                                                }

                                            echo "
                                            <br>
                                            <b> Fasilitas : </b><br>

                                                Uang Saku  &nbsp; &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp; : $d[uang_saku] <br>
                                                Asrama  &nbsp; &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;   &nbsp;  &nbsp;: $d[asrama] <br>
                                                Uang Makan  &nbsp; &nbsp;  &nbsp;  &nbsp;  &nbsp; : $d[uang_makan] <br>
                                                Uang Transport &nbsp;  &nbsp;&nbsp; : $d[uang_transport] <br><br>

                                            <b> Fasilitas Lain: </b><br>
                                                $d[fasilitas_lain] <br>
                                            </div>
                                        </td>
                                        <td class='center'>
                                            <a href='#' data-toggle='modal' data-target='#pilihmon' data-id='$d[id_du]'>
                                                            <button class='btn btn-sm btn-primary' type='button'><i class='fa fa-edit'></i> Pilih Petugas </button>
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

        <div class='modal fade' id='pilihmon' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
<?php

$jur = mysql_query("SELECT * FROM jurusan");

                                    

?>
        <div class='modal-dialog'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                    <h4 class='modal-title' id='myModalLabel'>Pilih Petugas</h4> </div>
                <div class='modal-body'>
                    <form class='form-horizontal form-label-left' method='POST' action='proses_admin.php?a=petugasmon' enctype='multipart/form-data'>
                        
                        <label class='control-label col-md-3 col-sm-3 col-xs-12' for='name'>Jurusan : <span class='required'></span> </label>
                        <div class="col-lg-8"><?php
                                    $name = "";
                                    echo "<input type='hidden' id='id' name='id_du'>";

                                    echo "<select required class='form-control m-bot15' id='jurusan' name='jurusan'>
                                            ";
                                                while($a = mysql_fetch_array($jur)){
                                     echo " <option value='$a[id_jurusan]'> $a[nama_jurusan] </option>";
                                                }
                                    echo "</select>";
                        echo "</div><label class='control-label col-md-3 col-sm-3 col-xs-12' for='name'>Petugas : <span class='required'></span> </label><div class='col-lg-8'>";
                                    echo "";
                                    echo "<select required class='form-control m-bot15' name='nip_guru' id='petugas'></select>
                                            ";?>
                                            </div>
                                
                </div>
                <div class='modal-footer' style="border: 0">
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
