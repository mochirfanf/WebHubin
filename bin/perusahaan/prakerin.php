<?php

include "../koneksidb.php";

if($_SESSION['level']=='perusahaan'){
        $title = "Permohonan Perizinan Prakerin";
        $active = "";
        $active3 = "active";

		include "leftside.php";

        $f = mysql_query("SELECT * FROM hb_du_umum WHERE username='$_SESSION[username]'");
        $dl=mysql_fetch_array($f);


        //$q1 = mysql_query("SELECT * FROM hb_du_penerima WHERE id_du=(SELECT id_du FROM hb_du WHERE username='$_SESSION[username]')")or die(mysql_error());
        //$q2 = mysql_query("SELECT count(*) no FROM hb_du_penerima WHERE id_du=(SELECT id_du FROM hb_du WHERE username='$_SESSION[username]')");
        //$q3 = mysql_query("SELECT * FROM hb_du WHERE id_du=(SELECT id_du FROM hb_du WHERE username='$_SESSION[username]')")or die(mysql_error());
        //$fa2 = mysql_fetch_array($q2);
        //$fa3 = mysql_fetch_array($q3);
        //if($fa2['no']>0){while($d1=mysql_fetch_array($q1)){


?>
    <!--body wrapper start-->
    <div class="wrapper">
        <div class="row">
            <div class="col-sm-12">

                <section class="panel">
                    <?php

                    $ada  = mysql_fetch_row(mysql_query("SELECT * FROM hb_du_jumlah_permintaan_du WHERE id_du='$_SESSION[id_du]'"));

                    if ($ada > 0) {

                            $x = mysql_fetch_array(mysql_query("SELECT * FROM hb_du_permintaan WHERE id_du='$_SESSION[id_du]'"));

                            if ($x["status_permintaan"] == "Verifikasi Ditolak" ) {
                                $di  = mysql_fetch_array(mysql_query("SELECT * FROM hb_du_permintaan WHERE id_du='$_SESSION[id_du]'"));?>

                                <header class="panel-heading"> <big> Permintaan Siswa Untuk Prakerin </big>

                               </header>
                                <form class="form-horizontal form-label-left" method="POST" action="prosesperusahaan.php?a=permintaan_prakerin" enctype="multipart/form-data">

                                    <div class="form-group">
                                        <br>
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Status :</label>
                                        <div style="margin-top:7px" class="col-lg-6 flat-green">
                                            Mohon maaf, permintaan siswa untuk prakerin anda ditolak.
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <br>
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Dikarenakan :</label>
                                        <div style="margin-top:7px" class="col-lg-6 flat-green">
                                            <?php echo "$di[alasan_menolak]";?>
                                            <br><br><br><br><br>
                                        </div>
                                    </div>
                            <?php
                            }
                            else{
                                $di  = mysql_fetch_array(mysql_query("SELECT * FROM hb_du_permintaan WHERE id_du='$_SESSION[id_du]'"));?>
                                <form method="POST" action="prosesperusahaan.php?a=hapus_permintaan" enctype="multipart/form-data">
                                <header class="panel-heading"> <big> Permintaan Siswa Untuk Prakerin </big>
                                  <span class="pull-right">
                                    <small>Status : <?php echo "$di[status_permintaan]";?></small> &nbsp; &nbsp; &nbsp;
                                    <button  type='submit' name='HAPUSPERMINTAAN' value="HAPUSPERMINTAAN" class="pull-right btn btn-danger btn-xs"> HAPUS / EDIT PERMINTAAN </button>
                                    </form>
                                 </span>
                               </header>
                                <form class="form-horizontal form-label-left" method="POST" action="prosesperusahaan.php?a=permintaan_prakerin" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <br><br>
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12"> Jurusan : </label>
                                        <div class="col-lg-6 flat-green">
                                            <table>
                                            <?php
                                            $query  = mysql_query("SELECT * FROM hb_du_jumlah_permintaan_du WHERE id_du='$_SESSION[id_du]' ");
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
                                            <?php echo "$di[nama_penanggung_jawab]";?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <br>
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Contact Person :</label>
                                        <div style="margin-top:7px" class="col-lg-6 flat-green">
                                            <?php echo "$di[contact_person]";?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <br>
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Jenis Seleksi :</label>
                                        <div style="margin-top:7px" class="col-lg-6 flat-green">
                                            <?php echo "$di[seleksi_du]";?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <br>
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12"> Fasilitas :</label>
                                        <div class=" flat-green">
                                            <div class="col-lg-1  flat-green">
                                                <input name="uangsaku" value="Ya" type="checkbox"  <?php if( $di["uang_saku"]=="Ya"){echo "checked";} ?> > </div>
                                                <label style="margin-left: -45px;"> Uang Saku</label>
                                            <!-- <select name='uangsaku2'>
                                                <option value='100.000-200.000' >100.000-200.000</option>
                                                <option value='200.000-300.000' >200.000-300.000</option>
                                            </select>-->
                                        </div>
                                        <div class=" col-lg-offset-4 flat-green">
                                            <div class="col-lg-1">
                                                <input name="asrama" value="Ya" type="checkbox"  <?php if( $di["asrama"]=="Ya"){echo "checked";} ?> > </div>
                                            <label style="margin-left: -28px;"> &nbsp; Asrama/Mess</label>
                                        </div>
                                        <div class=" col-lg-offset-4 flat-green">
                                            <div class="col-lg-1">
                                                <input name="uangmakan" value="Ya" type="checkbox"  <?php if( $di["uang_makan"]=="Ya"){echo "checked";} ?>> </div>
                                            <label style="margin-left: -28px;"> &nbsp; Uang Makan</label>
                                            <!--<select name='uangmakan2'>
                                                <option value='100.000-200.000'>100.000-200.000</option>
                                                <option value='200.000-300.000'>200.000-300.000</option>
                                            </select>-->
                                        </div>
                                        <div class=" col-lg-offset-4 flat-green">
                                            <div class="col-lg-1">
                                                <input name="uangtransport" value="Ya" type="checkbox" <?php if( $di["uang_transport"]=="Ya"){echo "checked";} ?>> </div>
                                                <label style="margin-left: -28px;"> &nbsp; Uang Transport</label>
                                                <!--<select name='uangtransport2'>
                                                    <option value='100.000-200.000'>100.000-200.000</option>
                                                    <option value='200.000-300.000' >200.000-300.000</option>
                                                </select> -->
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <br>
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Fasilitas Lain :</label>
                                        <div style="margin-top:7px" class="col-lg-6 flat-green">
                                            <?php echo "$di[fasilitas_lain]";?>
                                            <br><br><br>
                                        </div>
                                    </div>
                    <?php
                            }
                    }
                    else{


                    ?>
                    <header class="panel-heading"> <big>Permintaan Siswa Untuk Prakerin </big> <span class="pull-right">

                     </span> </header>
                    <form class="form-horizontal form-label-left" method="POST" action="prosesperusahaan.php?a=permintaan_prakerin" enctype="multipart/form-data">
                        <div class="form-group">
                            <br><br>
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Permintaan Jurusan : </label>
                                                        <div class="input_fields_wrap col-lg-1">
                                                            <button class="btn btn-danger add_field_button"><i class='fa fa-plus-square'></i></button>
                                                        </div>

                                                        <div style="margin-left: -50px;"  class="col-lg-4">
                                                            <?php
                                                            $name = "";
                                                             echo "<select class='form-control m-bot15' name='jurusan[]'>
                                                                      <option value=''> * Pilih Jurusan * </option>";
                                                                        $jurusan = mysql_query("SELECT * FROM jurusan");
                                                                        while($j = mysql_fetch_array($jurusan)){
                                                             echo " <option value='$j[id_jurusan]'> $j[nama_jurusan] </option>";
                                                                        }
                                                                     echo "
                                                                  </select>";
                                                            ?>

                                                        </div>
                                                        <div style="margin-left: -25px;"  class="col-lg-2">
                                                            <input type="text" class="form-control" name="jumlah[]" placeholder="Jumlah ">
                                                        </div>
                        </div>
                        <div class="form-group">
                            <br>
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Penanggung Jawab :</label>
                            <div class="col-lg-6 flat-green">
                                <input type="text" class="form-control" name="nama_pj" placeholder="Nama Penanggung Jawab">
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
                            <br><br>
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Jenis Seleksi :</label>
                            <div class="col-lg-6 flat-green">
                                <?php

                                    echo "<select class='form-control m-bot15' name='seleksi'>
                                                <option value='Ya'> Ya </option>
                                                <option value='Tidak'> Tidak </option>
                                          </select><br>";
                                ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12"> Fasilitas :</label>
                            <div class=" flat-green">
                                <div class="col-lg-1  flat-green">
                                    <input name="uangsaku" value="Ya" type="checkbox" > </div>
                                <label style="margin-left: -45px;"> Uang Saku</label>
                                <!-- <select name='uangsaku2'>
                                    <option value='100.000-200.000' >100.000-200.000</option>
                                    <option value='200.000-300.000' >200.000-300.000</option>
                                </select>-->
                            </div>
                            <div class=" col-lg-offset-3 flat-green">
                                <div class="col-lg-1">
                                    <input name="asrama" value="Ya" type="checkbox"  > </div>
                                <label style="margin-left: -28px;"> &nbsp; Asrama/Mess</label>
                            </div>
                            <div class=" col-lg-offset-3 flat-green">
                                <div class="col-lg-1">
                                    <input name="uangmakan" value="Ya" type="checkbox"> </div>
                                <label style="margin-left: -28px;"> &nbsp; Uang Makan</label>
                                <!--<select name='uangmakan2'>
                                    <option value='100.000-200.000'>100.000-200.000</option>
                                    <option value='200.000-300.000'>200.000-300.000</option>
                                </select>-->
                            </div>
                            <div class=" col-lg-offset-3 flat-green">
                                <div class="col-lg-1">
                                    <input name="uangtransport" value="Ya" type="checkbox"> </div>
                                    <label style="margin-left: -28px;"> &nbsp; Uang Transport</label>
                                    <!--<select name='uangtransport2'>
                                        <option value='100.000-200.000'>100.000-200.000</option>
                                        <option value='200.000-300.000' >200.000-300.000</option>
                                    </select> -->
                            </div>
                        </div>
                         <div class="form-group">
                            <br>
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Fasilitas Lain :</label>
                            <div class="col-lg-6 flat-green">
                                <input type="text" class="form-control" name="fasilitas_lain" placeholder="Fasilitas Lain (Opsional)">
                            </div>
                        </div>
                        <div class="form-group">
                        <div class="col-lg-offset-8 col-lg-10">
                            <br><br>
                                <button value='Tambahkan' name='Tambahkan' type='submit' name='submit' class="btn btn-primary"> Submit </button>
                            <br><br><br>
                        </div>
                    </div>
            <?php } ?>
                </section>
            </div>
        </div>
    </div>
    <!--body wrapper end-->
    <?php		include "footer.php";

}else{
	header('location:../login.php');
}

?>

