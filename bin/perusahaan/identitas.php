<?php

include "../koneksidb.php";

if($_SESSION['level']=='perusahaan'){

        $title="Permohonan Perizinan Prakerin";
        $active = "";
        $active2 = "active";

		include "leftside.php";

        $f = mysql_query("SELECT * FROM hb_du_umum WHERE username='$_SESSION[username]'");
        $dl=mysql_fetch_array($f);

?>

        <!--body wrapper start-->
        <div class="wrapper">
            <div class="row">
                <div class="col-sm-12">
                    <section class="panel">
                    <header class="panel-heading">
                        <big>Identitas Perusahaan</big>
                         <span class="pull-right">

                     </span>
                    </header>
                   <form class="form-horizontal form-label-left" method="POST" action="prosesperusahaan.php?a=update-profil" enctype="multipart/form-data" >
                    <div class="panel-body">
                        <div class="adv-table">
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Nama Perusahaan :<span class="required"></span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input name='nama' value='<?php echo $dl['nama_du']?>' class="form-control col-md-7 col-xs-12" type="text" required>
                                    </div>

                                </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="adv-table">
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Email Perusahaan :<span class="required"></span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input name='email' value='<?php echo $dl['email_du']?>' class="form-control col-md-7 col-xs-12" type="text" required disabled>
                                    </div>

                                </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="adv-table">
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Bidang Usaha :<span class="required"></span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input name='bidang' value='<?php echo $dl['bidang_usaha']?>' class="form-control col-md-7 col-xs-12" type="text" required>
                                    </div>
                                </div>
                        </div>
                    </div>

                    <div class="panel-body">
                        <div class="adv-table">
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Penanggung Jawab :<span class="required"></span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input name='npj' value='<?php echo $dl['nama_penanggung_jawab_umum']?>' class="form-control col-md-7 col-xs-12" type="text" required>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="adv-table">
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Contact Person :<span class="required"></span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input name='cp' value='<?php echo $dl['contact_person_umum']?>' class="form-control col-md-7 col-xs-12" type="text" required>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="adv-table">
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number"> Alamat :<span class="required"></span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea class='form-control col-md-6 col-sm-6 col-xs-12' name='alamat' required='required' placeholder='Alamat' type='number'> <?php echo $dl['alamat']?> </textarea>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="adv-table">
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Provinsi :<span class="required"></span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select name="prop" id="prop" onclick="ajaxkota(this.value)" class='form-control'>
                                            <option value="">Pilih Provinsi</option>
                                            <?php
                                              include 'koneksi.php';
                                              $query=$db->prepare("SELECT id_prov,nama FROM provinsi ORDER BY nama");
                                              $query->execute();
                                              while ($data=$query->fetchObject()){
                                              echo '<option value="'.$data->id_prov.'"';

                                                $x = mysql_fetch_array( mysql_query("SELECT id_prov FROM hb_du_umum WHERE id_du='$_SESSION[id_du]'"));

                                                if( $x["id_prov"] == $data->id_prov){
                                                    echo "selected";
                                                }
                                              echo '>'.$data->nama.'</option>';
                                              }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                        </div>
                    </div>

                    <div class="panel-body">
                        <div class="adv-table">
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Kota/Kabupaten :<span class="required"></span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select name="kota" id="kota" onchange="ajaxkec(this.value)" class='form-control'>
                                            <?php
                                                $ko = mysql_fetch_array( mysql_query("SELECT id_kab FROM hb_du_umum WHERE id_du='$_SESSION[id_du]'"));
                                                $ta = mysql_fetch_array( mysql_query("SELECT * FROM kabupaten WHERE id_kab='$ko[id_kab]'"));
                                            ?>
                                            <option value="<?php echo "$ko[id_kab]";?>"><?php echo "$ta[nama]";?></option>
                                        </select>
                                    </div>
                                </div>
                        </div>
                    </div>

                    <div class="panel-body">
                        <div class="adv-table">
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number"> Kecamatan :<span class="required"></span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select name="kec" id="kec" onchange="ajaxkel(this.value)" class='form-control'>
                                            <?php
                                                $ke = mysql_fetch_array( mysql_query("SELECT id_kec FROM hb_du_umum WHERE id_du='$_SESSION[id_du]'"));
                                                $ca = mysql_fetch_array( mysql_query("SELECT * FROM kecamatan WHERE id_kec='$ke[id_kec]'"));
                                            ?>
                                            <option value="<?php echo "$ke[id_kec]";?>"><?php echo "$ca[nama]";?></option>
                                        </select>
                                    </div>
                                </div>
                        </div>
                    </div>

                    <div class="panel-body">
                        <div class="adv-table">
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number"> Kelurahan :<span class="required"></span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select name="kel" id="kel" onchange="showCoordinate();" class='form-control'>
                                            <?php
                                                $kelu = mysql_fetch_array( mysql_query("SELECT id_kel FROM hb_du_umum WHERE id_du='$_SESSION[id_du]'"));
                                                $rahan = mysql_fetch_array( mysql_query("SELECT nama FROM kelurahan WHERE id_kel='$kelu[id_kel]'"));
                                            ?>
                                            <option value="<?php echo "$kelu[id_kel]";?>"><?php echo "$rahan[nama]";?></option>
                                        </select>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="adv-table">
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Kode Pos :<span class="required"></span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input name='kodepos' value='<?php echo $dl['no_kodepos']?>' class="form-control col-md-7 col-xs-12" type="text" required>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="adv-table">
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number"> Deskripsi Perusahaan :<span class="required"></span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea rows="8" class='form-control col-md-6 col-sm-6 col-xs-12' name='deskripsi' required='required' type='number'> <?php echo $dl['deskripsi_perusahaan']?> </textarea>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-offset-8 col-lg-10">
                            <br><br>
                                <button  type='submit' name='UPDATEE' value="UPDATEE" class="btn btn-primary"> Submit </button>
                            <br><br>
                        </div>
                    </div>

                    </form>
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
