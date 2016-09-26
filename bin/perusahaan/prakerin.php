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
                    <header class="panel-heading"> <big>Permintaan Siswa Untuk Prakerin</big> <span class="pull-right">

                     </span> </header>
                    <form class="form-horizontal form-label-left" method="POST" action="prosesperusahaan.php?a=update-prakerin" enctype="multipart/form-data">
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
                                <input type="text" class="form-control" name="nama_pj" placeholder="Contact Person ">
                            </div>
                        </div>
                        <div class="form-group">
                            <br><br>
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Jenis Seleksi :</label>
                            <div class="col-lg-6 flat-green">
                                <?php

                                                             echo "<select class='form-control m-bot15' name='jurusan[]'>
                                                                      <option value='ya'> Ya </option>
                                                                      <option value='tidak'> Tidak </option>
                                                                  </select>";
                                                            ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Fasilitas :</label>
                            <div class=" flat-green">
                                <div class="col-lg-1">
                                    <input name="uangsaku" value="Ya" type="checkbox" > </div>
                                <label> Uang Saku</label>
                                <select name='uangsaku2'>
                                    <option value='100.000-200.000' >100.000-200.000</option>
                                    <option value='200.000-300.000' >200.000-300.000</option>
                                </select>
                            </div>
                            <div class=" col-lg-offset-3 flat-green">
                                <div class="col-lg-1">
                                    <input name="asrama" value="Ya" type="checkbox"  > </div>
                                <label> &nbsp; Asrama/Mess</label>
                            </div>
                            <div class=" col-lg-offset-3 flat-green">
                                <div class="col-lg-1">
                                    <input name="uangmakan" value="Ya" type="checkbox"> </div>
                                <label> &nbsp; Uang Makan</label>
                                <select name='uangmakan2'>
                                    <option value='100.000-200.000'>100.000-200.000</option>
                                    <option value='200.000-300.000'>200.000-300.000</option>
                                </select>
                            </div>
                            <div class=" col-lg-offset-3 flat-green">
                                <div class="col-lg-1">
                                    <input name="uangtransport" value="Ya" type="checkbox"> </div>
                                <label> &nbsp; Uang Transport</label>
                                <select name='uangtransport2'>
                                    <option value='100.000-200.000'>100.000-200.000</option>
                                    <option value='200.000-300.000' >200.000-300.000</option>
                                </select>
                            </div>
                        </div>
                        <input type='submit' name='submit'> </form>
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
