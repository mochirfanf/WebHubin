<?php

include "../koneksidb.php";

if($_SESSION['level']=='siswa'){
    $title="Permohonan Perizinan Prakerin";
    $active = "";
    $active3 = "active";
    $navactive ="nav-active";

    include "leftside.php"; ?>
    
    <!--body wrapper start-->
    <div class="wrapper">
        <div class="row">
            <div class="col-sm-12">

                <section class="panel">
                    <?php

                    $query = mysql_query("SELECT * FROM hb_prakerin, hb_du_penerima, siswa WHERE hb_prakerin.nis = siswa.nis AND hb_prakerin.id_du= hb_du_penerima.id_du AND hb_du_penerima.id_jurusan = '$_SESSION[jurusan]' AND hb_prakerin.tahun_ajaran = '$_SESSION[tahun_ajaran]' AND hb_du_penerima.tahun_ajaran = '$_SESSION[tahun_ajaran]' AND hb_prakerin.nis = '$_SESSION[username]' AND hb_prakerin.status_verifikasi = 'Menunggu Verifikasi Kapprog'");

                    $ada  = mysql_fetch_row($query);

                    if ($ada > 0) {

                            $query1 = mysql_query("SELECT * FROM hb_prakerin, hb_du_penerima, siswa WHERE hb_prakerin.nis = siswa.nis AND hb_prakerin.id_du= hb_du_penerima.id_du AND hb_du_penerima.id_jurusan = '$_SESSION[jurusan]' AND hb_prakerin.tahun_ajaran = '$_SESSION[tahun_ajaran]' AND hb_du_penerima.tahun_ajaran = '$_SESSION[tahun_ajaran]' AND hb_prakerin.nis = '$_SESSION[username]' AND hb_prakerin.status_verifikasi = 'Menunggu Verifikasi Kapprog'");
                            $di = mysql_fetch_array($query1);
                            
?>
                            <form method="POST" action="proses_siswa.php?a=hapus_permintaan" enctype="multipart/form-data">
                                <header class="panel-heading"> <big> Anda Telah Mendaftar Memilih Tempat Prakerin </big>
                                  <span class="pull-right">
                                    <small>Status : <?php echo "$di[status_verifikasi]";?></small> &nbsp; &nbsp; &nbsp;
                                    <?php 
                                        if ($di["status_verifikasi"] == "Menunggu Verifikasi Kapprog") {
                                           echo " <button  type='submit' name='HAPUSPERMINTAAN' value='HAPUSPERMINTAAN' class='pull-right btn btn-danger btn-xs'> HAPUS / EDIT </button>";
                                        }
                                    
                                    ?>
                                    <input type="hidden" name="id_du" value="<?php echo "$di[id_du]";?>">
                                 </span>
                               </header>
                            </form>
                            <form class="form-horizontal form-label-left" method="POST" action="<?php echo "proses_siswa.php?a=hapus_permintaan&id=$di[id_prakerin]"; ?>" enctype="multipart/form-data">

                                <div class="panel-body">
                                    <div class="form-group">
                                        <br>
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12"> Memilih Tempat Prakerin : </label>
                                        <div  class="col-lg-6"><?php
                                            $name = "";
                                            echo "<select required class='form-control m-bot15' name='id_du' disabled>
                                                    <option value=''> * Pilih Tempat Prakerin * </option>";
                                                        $tempat = mysql_query("SELECT * FROM hb_du_umum, hb_du_penerima, hb_du_permintaan WHERE hb_du_umum.id_du = hb_du_penerima.id_du AND hb_du_umum.id_du = hb_du_permintaan.id_du AND hb_du_penerima.id_jurusan = '$_SESSION[jurusan]' AND status_penerimaan='Menerima'  AND hb_du_penerima.tahun_ajaran='$_SESSION[tahun_ajaran]'");
                                                        while($j = mysql_fetch_array($tempat)){
                                             echo " <option value='$j[id_du]' "; if($j["id_du"]==$di["id_du"]){echo "selected";} echo "> $j[nama_du] </option>";
                                                        }
                                            echo "</select>";?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <br>
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12"> Alasan Memilih :</label>
                                        <div class="col-lg-6 flat-green">
                                            <textarea class="form-control" name="alasan" rows="10" disabled > <?php echo"$di[alasan_memilih]";?></textarea>
                                        </div>
                                    </div>
                                </div> 
                            </form>                          
                            <br><br>
                    <?php
                           }
                    else{
                            // Form Untuk Menambahkan Prakerin

                    ?>
                    <header class="panel-heading"> <big>Informasi Penerimaan Siswa Untuk Prakerin </big> </header>
                    <form class="form-horizontal form-label-left" method="POST" action="<?php echo "proses_siswa.php?a=pilihtempat"; ?>" enctype="multipart/form-data">

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
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"> Portofolio :</label>
                                <div class="col-lg-6 flat-green">
                                    <textarea class="form-control" name="alasan" rows="10"> Berikut Portofolio yang saya miliki : </textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-offset-7 col-lg-5">
                                        <a type="button" href="dumenerima.php" class="btn btn-danger"> Lihat Detail Penerimaan </a>
                                        <button value='Tambahkan' name='Tambahkan' type='submit' class="btn btn-primary"> Submit </button>
                                    <br><br><br>
                                </div>
                            </div>
                        </div>
                    </form>
            <?php } ?>
                </section>
            </div>
        </div>
    </div>
    <!--body wrapper end-->

<?php       include "footer.php";
    
}else{
    header('location:../login.php');
}

?>
