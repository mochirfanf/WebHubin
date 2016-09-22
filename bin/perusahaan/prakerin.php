<?php

include "../koneksidb.php";

if($_SESSION['level']=='perusahaan'){
        $title="Permohonan Perizinan Prakerin";
        $active = "";
        $active3 = "active";

		include "leftside.php";

        $f = mysql_query("SELECT * FROM hb_du_umum WHERE username='$_SESSION[username]'");
        $dl=mysql_fetch_array($f);

?>
    <!--body wrapper start-->
    <div class="wrapper">
        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading"> <big>Identitas Perusahaan</big> <span class="pull-right">

                     </span> </header>
                    <form class="form-horizontal form-label-left" method="POST" action="prosesperusahaan.php?a=update-prakerin" enctype="multipart/form-data">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Jurusan :</label>
                            <div class="input_fields_wrap col-lg-1">
                                <button class="btn  btn-danger add_field_button"><i class='fa fa-plus-square'></i></button>
                            </div>
                            <?php
                                                            $q1 = mysql_query("SELECT * FROM hb_du_penerima WHERE id_du=(SELECT id_du FROM hb_du WHERE username='$_SESSION[username]')")or die(mysql_error());

                                                            $q2 = mysql_query("SELECT count(*) no FROM hb_du_penerima WHERE id_du=(SELECT id_du FROM hb_du WHERE username='$_SESSION[username]')");

                                                            $q3 = mysql_query("SELECT * FROM hb_du WHERE id_du=(SELECT id_du FROM hb_du WHERE username='$_SESSION[username]')")or die(mysql_error());

                                                            $fa2 = mysql_fetch_array($q2);
                                                            $fa3 = mysql_fetch_array($q3);
        if($fa2['no']>0){while($d1=mysql_fetch_array($q1)){
            ?>
                                <div class="col-lg-4">
                                    <?php $name = ""; echo "
                                    <select class='form-control m-bot15' name='jurusan[]'>
                                        <option value=''> * Pilih Jurusan * </option>"; $jurusan = mysql_query("SELECT * FROM jurusan"); while($j = mysql_fetch_array($jurusan)){ echo "
                                        <option value='$j[id_jurusan]' "; if($d1['id_jurusan']==$j['id_jurusan']){echo "selected";} echo"> $j[nama_jurusan] </option>"; } echo " </select>";
            ?>
                                        <input type="text" class="form-control" name="jumlah[]" placeholder="Jumlah" value='<?php echo $d1['jumlah_penerimaan']?>'> </div>
                                <?php
                                                            }
                     }else{
            ?>
                                    <div class="col-lg-4">
                                        <?php $name = ""; echo "
                                    <select class='form-control m-bot15' name='jurusan[]'>
                                        <option value=''> * Pilih Jurusan * </option>"; $jurusan = mysql_query("SELECT * FROM jurusan"); while($j = mysql_fetch_array($jurusan)){ echo "
                                        <option value='$j[id_jurusan]'> $j[nama_jurusan] </option>"; } echo " </select>";?>
                                            <input type="text" class="form-control" name="jumlah[]" placeholder="Jumlah "> </div>
                                    <?php
        }
        ?>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Mulai Pelaksanaan Prakerin :</label>
                            <div class=" col-lg-offset-4 flat-green">
                                <div class="col-lg-1">
                                    <input name="mulai" type="date" value='<?php echo $fa3['mulai_pelaksanaan'];?>'> </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Akhir Pelaksanaan Prakerin :</label>
                            <div class=" col-lg-offset-4 flat-green">
                                <div class="col-lg-1">
                                    <input name="akhir" type="date" value='<?php echo $fa3['berakhir_pelaksanaan'];?>'> </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Jenis Seleksi :</label>
                            <div class=" col-lg-offset-4 flat-green">
                                <div class="col-lg-1">
                                    <input name="seleksi" value="Ya" type="checkbox" <?php if($fa3['seleksi_du']=='Ya'){echo "checked";}?>> </div>
                                <label> &nbsp; Menggunakan Seleksi</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Fasilitas :</label>
                            <div class=" col-lg-offset-4 flat-green">
                                <div class="col-lg-1">
                                    <input name="uangsaku" value="Ya" type="checkbox" <?php if($fa3['u_saku']!='Tidak'){echo "checked";}?>> </div>
                                <label> &nbsp; Uang Saku</label>
                                <select name='uangsaku2'>
                                    <option value='100.000-200.000' <?php if($fa3['u_saku']=='100.000-200.000'){echo "selected";}?>>100.000-200.000</option>
                                    <option value='200.000-300.000' <?php if($fa3['u_saku']=='200.000-300.000'){echo "selected";}?>>200.000-300.000</option>
                                </select>
                            </div>
                            <div class=" col-lg-offset-4 flat-green">
                                <div class="col-lg-1">
                                    <input name="asrama" value="Ya" type="checkbox"  <?php if($fa3['asrama']!='Tidak'){echo "checked";}?>> </div>
                                <label> &nbsp; Asrama/Mess</label>
                            </div>
                            <div class=" col-lg-offset-4 flat-green">
                                <div class="col-lg-1">
                                    <input name="uangmakan" value="Ya" type="checkbox"  <?php if($fa3['u_makan']!='Tidak'){echo "checked";}?>> </div>
                                <label> &nbsp; Uang Makan</label>
                                <select name='uangmakan2'>
                                    <option value='100.000-200.000' <?php if($fa3['u_makan']=='100.000-200.000'){echo "selected";}?>>100.000-200.000</option>
                                    <option value='200.000-300.000' <?php if($fa3['u_makan']=='200.000-300.000'){echo "selected";}?>>200.000-300.000</option>
                                </select>
                            </div>
                            <div class=" col-lg-offset-4 flat-green">
                                <div class="col-lg-1">
                                    <input name="uangtransport" value="Ya" type="checkbox"  <?php if($fa3['u_transport']!='Tidak'){echo "checked";}?>> </div>
                                <label> &nbsp; Uang Transport</label>
                                <select name='uangtransport2'>
                                    <option value='100.000-200.000'  <?php if($fa3['u_transport']=='100.000-200.000'){echo "selected";}?>>100.000-200.000</option>
                                    <option value='200.000-300.000' <?php if($fa3['u_transport']=='200.000-300.000'){echo "selected";}?>>200.000-300.000</option>
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
