<?php

include "../koneksidb.php";

if (empty($_GET["nis"])) {
    header("location:list_siswa_belum_mendaftar.php");
}

if($_SESSION['level']=='kapprog'){
    if ($_SESSION['tahun_ajaran']!='') {
    $title="Permohonan Perizinan Prakerin";
    $active = "";
    $active10 = "active";
    $navactive3 ="nav-active";

    include "leftside.php"; ?>
    
    <!--body wrapper start-->
    <div class="wrapper">
        <div class="row">
            <div class="col-sm-12">

                <section class="panel">
                    <header class="panel-heading"> <big>Tambahkan Siswa Untuk Prakerin </big> 
                    <?php $nama = mysql_fetch_array(mysql_query("SELECT nama_siswa FROM siswa WHERE nis = '$_GET[nis]' ")) ?>
                    <span class="pull-right"> <small> Nama Siswa : <?php echo "$nama[nama_siswa]";?> </small></span>
                    </header>
                    <form class="form-horizontal form-label-left" method="POST" action="<?php echo "proses_kapprog.php?a=pilihkantempat"; ?>" enctype="multipart/form-data">

                        <div class="panel-body">
                            <div class="form-group">
                                <br>
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"> Pilih Tempat Prakerin : </label>
                                <div  class="col-lg-6"><?php
                                    $name = "";
                                    echo "<select required class='form-control m-bot15' name='id_du'>
                                            <option value=''> * Pilih Tempat Prakerin * </option>";
                                                $tempat = mysql_query("SELECT * FROM hb_du_umum, hb_du_penerima, hb_du_permintaan WHERE hb_du_umum.id_du = hb_du_penerima.id_du AND hb_du_umum.id_du = hb_du_permintaan.id_du AND hb_du_penerima.id_jurusan = '$_SESSION[jurusan]' AND status_penerimaan='Menerima'  AND hb_du_penerima.tahun_ajaran='$_SESSION[tahun_ajaran]'");
                                                while($j = mysql_fetch_array($tempat)){
                                     echo " <option value='$j[id_du]'> $j[nama_du] </option>";
                                                }
                                    echo "</select>";?>
                                </div>
                            </div>
                            <div class="form-group">
                                <br>
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"> Alasan :</label>
                                <div class="col-lg-6 flat-green">
                                    <textarea class="form-control" name="alasan" rows="10"> </textarea>
                                    <input type="hidden" name="nis" value="<?php echo "$_GET[nis]";?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-offset-7 col-lg-5">
                                        <a type="button" href="hasil_dupenerima.php" class="btn btn-danger"> Lihat Detail Penerimaan </a>
                                        <button value='Tambahkan' name='Tambahkan' type='submit' class="btn btn-primary"> Submit </button>
                                    <br><br><br>
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
    header('location:../login.php');
}

?>
?>
