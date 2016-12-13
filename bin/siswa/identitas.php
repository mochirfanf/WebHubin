<?php

include "../koneksidb.php";

if($_SESSION['level']=='siswa'){
    if ($_SESSION['tahun_ajaran']!='') {
        $title="Permohonan Perizinan Prakerin";
        $active ="";
        $active1 = "active";

        $f = mysql_query("SELECT * FROM siswa INNER JOIN jurusan ON siswa.id_jurusan=jurusan.id_jurusan WHERE nis='$_SESSION[username]'")or die(mysql_error());
        $dl=mysql_fetch_array($f);
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
        include "leftside.php"; ?>

        <!--body wrapper start-->
        <div class="wrapper">
            <div class="row">
                <div class="col-sm-12">
                    <section class="panel">
                    <header class="panel-heading">
                        <big>Identitas Siswa</big>
                         <span class="pull-right">

                         </span>
                    </header>

                   <form class="form-horizontal form-label-left" method="POST" action="siswa-update-profil" enctype="multipart/form-data" >
                    <div class="panel-body">
                        <div class="adv-table">
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">NIS :<span class="required"></span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input value='<?php echo $dl['nis']?>' class="form-control col-md-7 col-xs-12" type="text" required disabled>
                                    </div>

                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Nama Siswa :<span class="required"></span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input value='<?php echo $dl['nama_siswa']?>' class="form-control col-md-7 col-xs-12" type="text" required disabled>
                                    </div>

                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Jurusan :<span class="required"></span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input value='<?php echo $dl['nama_jurusan']?>' class="form-control col-md-7 col-xs-12" type="text" required disabled>
                                    </div>

                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Tempat Lahir :<span class="required"></span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input name='tempat' value='<?php echo $dl['tempat_lahir']?>' class="form-control col-md-7 col-xs-12" type="text" required>
                                    </div>

                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Tanggal Lahir :<span class="required"></span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input name='tanggal' value='<?php echo $dl['tanggal_lahir']?>' data-date-format='yyyy/mm/dd' class="form-control col-md-7 col-xs-12 dpd1" type="text" required>
                                    </div>

                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Jenis Kelamin :<span class="required"></span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select name="jk" id="kota" class='form-control'>
                                            <?php if($dl['jenis_kelamin']=='L'){ $l = 'selected'; $p='';}else{ $p = 'selected'; $l=''; }?>
                                            <option value="L" <?php echo $l?>>L</option>
                                             <option value="P" <?php echo $p?>>P</option>
                                        </select>
                                    </div>

                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Agama :<span class="required"></span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select name="agama" id="kota" class='form-control'>
                                            <?php
                                                if($dl['agama']=='Islam'){ $a1 = 'selected'; $a2=''; $a3=''; $a4=''; $a5=''; $a6='';}
                                                else if($dl['agama']=='Protestan'){  $a2 = 'selected'; $a1=''; $a3=''; $a4=''; $a5='';$a6='';}
                                                else if($dl['agama']=='Katolik'){  $a3 = 'selected'; $a1=''; $a2=''; $a4=''; $a5='';$a6='';}
                                                else if($dl['agama']=='Budha'){  $a4 = 'selected'; $a1=''; $a3=''; $a2=''; $a5='';$a6='';}
                                                else if($dl['agama']=='Hindu'){  $a5 = 'selected'; $a1=''; $a3=''; $a4=''; $a2='';$a6='';}
                                                else{  $a6 = 'selected'; $a1=''; $a3=''; $a4=''; $a5=''; $a2='';}
                                            ?>
                                            <option value="Islam" <?php echo $a1?>>Islam</option>
                                            <option value="Protestan" <?php echo $a2?>>Protestan</option>
                                            <option value="Katolik" <?php echo $a3?>>Katolik</option>
                                            <option value="Budha" <?php echo $a4?>>Budha</option>
                                            <option value="Hindu" <?php echo $a5?>>Hindu</option>
                                            <option value="Konghucu" <?php echo $a6?>>Konghucu</option>

                                        </select>
                                    </div>

                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">No Telepon :<span class="required"></span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input name='no_telp' value='<?php echo $dl['no_telepon']?>' class="form-control col-md-7 col-xs-12" type="text" required>
                                    </div>

                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Gol Darah :<span class="required"></span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input name='goldar' value='<?php echo $dl['gol_darah']?>' class="form-control col-md-7 col-xs-12" type="text" required>
                                    </div>

                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Alamat :<span class="required"></span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea name='alamat' class="form-control col-md-7 col-xs-12" type="text" required><?php echo $dl['alamat_siswa']?></textarea>
                                    </div>

                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Email :<span class="required"></span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input name='email' value='<?php echo $dl['email_siswa']?>' class="form-control col-md-7 col-xs-12" type="text" required>
                                    </div>

                                </div>
                                <div class="form-group">
                        <div class="col-lg-offset-8 col-lg-10">
                            <br><br>
                                <button  type='submit' name='UPDATEE' value="UPDATEE" class="btn btn-primary"> Submit </button>
                            <br><br>
                        </div>
                    </div>
                        </div>
                    </div>
                    </form>
                    </section>
                </div>
            </div>
        </div>

        <!--body wrapper end-->

<?php       include "footer.php";
    }else{
        header('location:tahun_ajaran.php');
    }
}else{
    header('location:beranda');
}

?>
