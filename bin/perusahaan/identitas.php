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
                                        <input name='provinsi' value='<?php echo $dl['nama_provinsi']?>' class="form-control col-md-7 col-xs-12" type="text" required>
                                    </div>
                                </div>
                        </div>
                    </div>

                    <div class="panel-body">
                        <div class="adv-table">
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Kota/Kabupaten :<span class="required"></span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input name='kabupaten' value='<?php echo $dl['nama_kabupaten']?>' class="form-control col-md-7 col-xs-12" type="text" required>
                                    </div>
                                </div>
                        </div>
                    </div>

                    <div class="panel-body">
                        <div class="adv-table">
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Kelurahan/Desa :<span class="required"></span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input name='kelurahan' value='<?php echo $dl['nama_kelurahan']?>' class="form-control col-md-7 col-xs-12" type="text" required>
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

                    <div class="form-group">
                        <div class="col-lg-offset-8 col-lg-10">
                            <br><br>
                                <button  type='submit' name='submit' class="btn btn-primary"> Submit </button>
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
