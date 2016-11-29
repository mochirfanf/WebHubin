<?php

include "../koneksidb.php";

if($_SESSION['level']=='perusahaan'){
        $title="Permohonan Perizinan Prakerin";
        $active = "";
        $active4 = "active";

		include "leftside.php";

        $f = mysql_query("SELECT * FROM hb_du_umum WHERE username='$_SESSION[username]'");
        $dl=mysql_fetch_array($f);

?>
    <!--body wrapper start-->
    <div class="wrapper">
        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading"> <big>Permintaan Kerja</big> <span class="pull-right">

                     </span> </header>
                     
                    <form class="form-horizontal form-label-left" method="POST" action="proseskerja.php?a=permintaan_kerja" enctype="multipart/form-data">
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
                                                        <div class='col-md-10 skill'>
                                                        jk
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
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Recruitment melalui :</label>
                            <div class="col-lg-6 flat-green">
                                <?php

                                                             echo "<select class='form-control m-bot15' name='seleksi'>
                                                                      <option value='Ya'> Seleksi </option>
                                                                      <option value='Tidak'> Tidak Seleksi </option>
                                                                  </select><br>";
                                                            ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12"> Fasilitas :</label>
                            <div class=" flat-green">
                                <div class="col-lg-1  flat-green">
                                    <input name="gaji" value="Ya" type="checkbox" > </div>
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
    <!--body wrapper end-->
    <?php		include "footer.php";

}else{
	header('location:../login.php');
}

?>
