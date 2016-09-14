<?php

include "../koneksidb.php";

if($_SESSION['level']=='perusahaan'){ 
	if ($_SESSION['tahun_ajaran']!='') {
        $title="Permohonan Perizinan Prakerin";
        $active = "";
        $active3 = "active";
        $navactive2 ="nav-active";

		include "leftside.php";
        
        $f = mysql_query("SELECT * FROM hb_du WHERE username='$_SESSION[username]'");
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

                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Nama Perusahaan :<span class="required"></span>

                                            </label>

                                            <div class="col-md-6 col-sm-6 col-xs-12">

                                                 <input name='nama' value='<?php echo $dl['nama_du']?>' class="form-control col-md-7 col-xs-12" type="text" required>
                                            </div>

                                        </div>
                    </div>
                    </div>
                        
                        <div class="panel-body">
                    <div class="adv-table">
                            <div class="item form-group">

                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Bidang Usaha :<span class="required"></span>

                                            </label>

                                            <div class="col-md-6 col-sm-6 col-xs-12">

                                                 <input name='bidang' value='<?php echo $dl['bidang']?>' class="form-control col-md-7 col-xs-12" type="text" required>
                                            </div>

                                        </div>
                    </div>
                    </div>
                        
                        <div class="panel-body">
                    <div class="adv-table">
                            <div class="item form-group">

                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Alamat :<span class="required"></span>

                                            </label>

                                            <div class="col-md-6 col-sm-6 col-xs-12">

                                                 <input name='alamat' value='<?php echo $dl['alamat']?>' class="form-control col-md-7 col-xs-12" type="text" required>
                                            </div>

                                        </div>
                    </div>
                    </div>
                        
                        <div class="panel-body">
                    <div class="adv-table">
                            <div class="item form-group">

                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Kota :<span class="required"></span>

                                            </label>

                                            <div class="col-md-6 col-sm-6 col-xs-12">

                                                 <input name='kota' value='<?php echo $dl['kota']?>' class="form-control col-md-7 col-xs-12" type="text" required>
                                            </div>

                                        </div>
                    </div>
                    </div>
                        
                        
                        <div class="panel-body">
                    <div class="adv-table">
                            <div class="item form-group">

                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Nama Penanggung Jawab :<span class="required"></span>

                                            </label>

                                            <div class="col-md-6 col-sm-6 col-xs-12">

                                                 <input name='penanggungjawab' value='<?php echo $dl['nama_penanggung_jawab']?>' class="form-control col-md-7 col-xs-12" type="text" required>
                                            </div>

                                        </div>
                    </div>
                    </div>
                        
                        <div class="panel-body">
                    <div class="adv-table">
                            <div class="item form-group">

                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Email :<span class="required"></span>

                                            </label>

                                            <div class="col-md-6 col-sm-6 col-xs-12">

                                                 <input name='email' value='<?php echo $dl['email']?>' class="form-control col-md-7 col-xs-12" type="email" required>
                                            </div>

                                        </div>
                    </div>
                    </div>
                        
                        <div class="panel-body">
                    <div class="adv-table">
                            <div class="item form-group">

                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Telepon :<span class="required"></span>

                                            </label>

                                            <div class="col-md-6 col-sm-6 col-xs-12">

                                                 <input name='telepon' value='<?php echo $dl['telepon']?>' class="form-control col-md-7 col-xs-12" type="text" required>
                                            </div>

                                        </div>
                    </div>
                    </div>
                        
                        <input type='submit' name='submit'>
                        </form>
                    </section>
                </div>
            </div>
        </div>
        <!--body wrapper end-->

<?php		include "footer.php";
	}else{
		header('location:tahun_ajaran.php');
	}
}else{
	header('location:../login.php');
}

?>