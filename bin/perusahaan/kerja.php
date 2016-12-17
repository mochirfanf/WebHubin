<?php

include "../koneksidb.php";

if($_SESSION['level']=='perusahaan'){
        $title="Permohonan Perizinan Prakerin";
        $active = "";
        $active12 = "active";
        $navactive6 ="nav-active";
        include "leftside.php";
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
        $f = mysql_query("SELECT * FROM hb_du_umum WHERE username='$_SESSION[username]'");
        $dl=mysql_fetch_array($f);

?>
    <!--body wrapper start-->
    <div class="wrapper">
        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                <?php
                            // Ini Informasi Kalo Perusahaan Udah Input 

                            $x = mysql_fetch_array(mysql_query("SELECT * FROM hb_du_permintaan_kerja WHERE id_du='$_SESSION[id_du]' ORDER BY id_du_kerja DESC"));

                            if ($x["status_permintaan"] == "Verifikasi Ditolak" ) {

                                // Ini Yang Ditolak

                                $di  = mysql_fetch_array(mysql_query("SELECT * FROM hb_du_permintaan_kerja WHERE id_du='$_SESSION[id_du]'"));?>

                                <header class="panel-heading"> <big> Permintaan Lowongan Pekerjaan </big>

                               </header>
                               <a href='#tutup' data-toggle='modal'><span style='margin: 10px' class='pull-right btn btn-danger btn-xs'> TUTUP PERMINTAAN </span></a><br>

                                    <div class="form-group">
                                        <br>
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Status :</label>
                                        <div style="margin-top:7px" class="col-lg-6 flat-green">
                                            Mohon maaf, permintaan lowongan kerja anda ditolak.
                                        </div>
                                    </div><br><br>
                            <?php
                            }
                            else if(($x["status_permintaan"] == "Sudah Terverifikasi" || $x["status_permintaan"] == "Belum Terverifikasi")){

                                // Ini Yang Diterima 

                                $di  = mysql_fetch_array(mysql_query("SELECT * FROM hb_du_permintaan_kerja WHERE id_du='$_SESSION[id_du]' ORDER BY id_du_kerja DESC LIMIT 1"));?>
                                <form method="POST" action="prosesperusahaan.php?a=hapus_permintaan" enctype="multipart/form-data">
                                <header class="panel-heading"> <big> Permintaan Siswa Untuk Prakerin </big>
                                  <span class="pull-right">
                                    <small>Status : <?php echo "Aktif";?></small> &nbsp; &nbsp; &nbsp;
                                    <a href='#tutup' data-toggle='modal'><span class='pull-right btn btn-danger btn-xs'> TUTUP PERMINTAAN </span></a><br>
                                    </form>
                                 </span>
                               </header>
                                <span class="form-horizontal form-label-left">
                                    <div class="form-group">
                                        <br><br>
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12"> Jurusan : </label>
                                        <div class="col-lg-6 flat-green">
                                            <table style="margin-top: 7px">
                                                <?php

                                                $query  = mysql_query("SELECT * FROM hb_du_jumlah_permintaan_du_kerja WHERE id_du_kerja='$di[id_du_kerja]'");

                                                if ($di["status_permintaan"] == "Terverifikasi") {
                                                    $query  = mysql_query("SELECT * FROM hb_du_penerima WHERE id_du='$_SESSION[id_du]' ");
                                                }

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
                                            <?php echo "$di[penanggung_jawab]";?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <br>
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Kontak Penanggung Jawab :</label>
                                        <div style="margin-top:7px" class="col-lg-6 flat-green">
                                            <?php echo "$di[cp]";?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <br>
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Jenis Seleksi :</label>
                                        <div style="margin-top:7px" class="col-lg-6 flat-green">
                                            <?php echo "$di[seleksi]";?>
                                        </div>
                                    </div>
                                    <?php if($di['seleksi']=='Ya'){
                                        ?>
                                    <div class="form-group">
                                        <br>
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Tempat Seleksi :</label>
                                        <div style="margin-top:7px" class="col-lg-6 flat-green">
                                            <?php echo "$di[tempat_seleksi]";?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <br>
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Tanggal Seleksi :</label>
                                        <div style="margin-top:7px" class="col-lg-6 flat-green">
                                            <?php echo "$di[tanggal_seleksi]";?>
                                        </div>
                                    </div>
                                    
                                    <?php
                                    }
                                    ?>
                                    <div class="form-group">
                                        <br>
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Gaji :</label>
                                        <div style="margin-top:7px" class="col-lg-6 flat-green">
                                            <?php echo "$di[gaji]";?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <br>
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Deskripsi Pekerjaan :</label>
                                        <div style="margin-top:7px" class="col-lg-6 flat-green">
                                            <?php echo "$di[lainnya]";?>
                                        </div>
                                    </div>


                                    <br>
                    <?php
                            }
                        else{
                            ?><?php
                        
                        ?>
                    <header class="panel-heading"> <big>Permintaan Kerja</big> <span class="pull-right">

                     </span> </header>
                     
                    <form class="form-horizontal form-label-left" method="POST" action="proseskerja.php?a=permintaan_kerja" enctype="multipart/form-data">
                    <div class="form-group">
                            <br>
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Judul Pekerjaan :</label>
                            <div class="col-lg-6 flat-green">
                                <input type="text" class="form-control" name="judul" placeholder="Judul">
                            </div>
                        </div>
                        <div class="form-group">
                            <br><br>
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Permintaan Jurusan : </label>
                                                        <div class="input_fields_wrap col-lg-1">
                                                            <span class="btn btn-danger add_field_button"><i class='fa fa-plus-square'></i></span>
                                                        </div>

                                                        <div style="margin-left: -50px;"  class="col-lg-4">
                                                            <?php
                                                            $name = "";
                                                             echo "<select class='form-control m-bot15 sk' name='jurusan[]'>
                                                                      <option value=''> * Pilih Jurusan * </option>";
                                                                        $jurusan = mysql_query("SELECT * FROM jurusan");
                                                                        while($j = mysql_fetch_array($jurusan)){
                                                             echo " <option value='$j[id_jurusan]'> $j[nama_jurusan] </option>";
                                                                        }
                                                                     echo "
                                                                  </select>";
                                                            ?>

                                                        </div>
                                                        
                                                        <div style="margin-left: -25px;"  class="col-lg-1">
                                                            <input type="text" class="form-control" name="jumlah[]" placeholder="Jumlah">
                                                        </div>

                                                        <div class='col-md-5 col-md-offset-3'>
                                                            <div class='col-md-12' style='padding:0 10px 0 0'>
                                                                <input type="text" name="skill[]" placeholder="Web,Teknisi,Android" class="form-control">
                                                            </div>
                                                            <div class='col-md-12' style='padding:0'>
                                                                <small style='color: #D9534F'>Pisahkan Skill dengan Koma</small>
                                                            </div>
                                                        </div>
                                                        <div class="input_fields col-md-6 col-md-offset-3">
                                                            
                                                        </div>
                        </div>
                        <div class="form-group">
                            <br>
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Perwakilan Perusahaan :</label>
                            <div class="col-lg-6 flat-green">
                                <input type="text" class="form-control" name="nama_pj" placeholder="Nama Perwakilan">
                            </div>
                        </div>
                        <div class="form-group">
                            <br><br>
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Contact Person :</label>
                            <div class="col-lg-6 flat-green">
                                <input type="text" class="form-control" name="contact" placeholder="Contact Person ">
                            </div>
                        </div>
                        <div class="form-group">
                            <br>
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Lokasi Kerja :</label>
                            <div class="col-lg-6 flat-green">
                                <input type="text" class="form-control" name="lokasi" placeholder="Lokasi Kerja">
                            </div>
                        </div>
                        <div class="form-group">
                            <br><br>
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Recruitment melalui :</label>
                            <div class="col-lg-6 flat-green">
                                <?php

                                                             echo "<select class='form-control m-bot15' name='seleksi' id='sel'>
                                                                      <option value='Tidak'> Tanpa Seleksi </option>
                                                                      <option value='Ya'> Seleksi </option>
                                                                  </select>";
                                                            ?>
                            </div>
                        </div>
                        <div id='selek' style='display: none'>
                        <div class="form-group">
                            <br>
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Tempat Seleksi :</label>
                            <div class="col-lg-6 flat-green">
                                <input type="text" class="form-control" name="tempat_seleksi" placeholder="Tempat Seleksi">
                            </div>
                        </div>

                        <div class="form-group">
                            <br><br>
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal Seleksi :</label>
                            <div class="col-lg-6 flat-green">
                                <input type="text" class="form-control dpd1"  data-date-format='yyyy/mm/dd' name="tanggal_seleksi" placeholder="Tanggal Seleksi">
                            </div>
                        </div>

                        <div class="form-group">
                            <br><br>
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Ketentuan :</label>
                            <div class="col-lg-6 flat-green">
                                <span class='btn btn-info'>Baca Ketentuan</span>
                            </div>
                        </div>
                        </div>
                        <div class="form-group"><br>
                            <label class="control-label col-md-3 col-sm-3 col-xs-12"> Gaji :</label>
                            <div class=" flat-green">
                                <div class="col-lg-6  flat-green">
                                <select name='gaji' class="form-control">
                                    <option value='Belum Ditentukan' > Belum Ditentukan</option>
                                    <option value='100.000-200.000' >1000.000-2000.000</option>
                                    <option value='200.000-300.000' >2000.000-3000.000</option>
                                    <option value='>3000.000' > >3000.000</option>
                                </select>
                            </div>
                        </div>
                        </div>

                        <div class="form-group">
                            <br>
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Keterangan Lainnya :</label>
                            <div class="col-lg-6 flat-green">
                                <textarea type="text" class="form-control" name="lainnya" placeholder="Keterangan Lainnya"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                        <div class="col-lg-offset-8 col-lg-10">
                            <br><br>
                                <button value='Tambahkan' name='Tambahkan' type='submit' name='submit' class="btn btn-primary"> Submit </button>
                            <br><br><br>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>





<?php }
?>
                    <div class='modal fade' id='tutup' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
<?php

                                    

?>
        <div class='modal-dialog'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                    <h4 class='modal-title' id='myModalLabel'>Tutup Lamaran</h4> </div>
                <div class='modal-body'>
                    <form class='form-horizontal form-label-left' method='POST' action='proseskerja.php?a=tutup' enctype='multipart/form-data'>
                        
                                    <div class='col-md-12'>
                                        <b>Tutup Permintaan ?</span></b>
                                    </div><?php
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
