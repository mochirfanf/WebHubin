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
                        <big>Dashboard Siswa</big>
                         <span class="pull-right">

                         </span>
                         
                    </header>
                    <div class="panel-body">
                        <div class='col-md-6 pp'>
                            <div class='col-md-12 bpk'>
                            <span class='col-md-12 hdl'>Berita Kerja</span>
                            <span class='col-md-12 hpt'></span>
                            <span>
                                <?php
                                    $f = mysql_query("SELECT *, hb_lamar_kerja.status as st FROM hb_lamar_kerja INNER JOIN hb_du_permintaan_kerja  ON hb_du_permintaan_kerja.id_du_kerja = hb_lamar_kerja.id_du_kerja INNER JOIN hb_du_umum ON hb_du_umum.id_du = hb_du_permintaan_kerja.id_du WHERE nis='$_SESSION[username]' AND ( hb_lamar_kerja.status='Lamaran Diterima' OR hb_lamar_kerja.status='Lamaran Ditolak')")or die(mysql_error());
                                    
                                    while($dl=mysql_fetch_array($f)){

                                        if($dl['st']=='Lamaran Diterima'){
                                            ?>
                                            <div class='col-md-12 blam'>
                                            <?php
                                            echo 'Lamaran Anda di '.$dl['nama_du']." diterima, Silahkan hubungi perusahaan yang bersangkutan ";
                                            ?>
                                            </div>
                                            <span class='btn btn-warning' style='float:right'>Detail</span>
                                            <?php

                                        }else if($dl['st']=='Lamaran Ditolak'){
                                            ?>
                                            <div class='col-md-12 blam'>
                                            <?php
                                            echo 'Mohon Maaf '.$dl['nama_du']." belum dapat menerima anda sebagai Karyawan";
                                            ?>
                                            </div>
                                            <span class='btn btn-warning' style='float:right'>Detail</span>
                                            <?php
                                        }
                                    }
                                ?>
                            </span>
                            </div>
                        </div>
                        <div class='col-md-6 pp'>
                            <div class='col-md-12 bpk'>
                            <span class='col-md-12 hdl'>Berita Prakerin</span>
                            <span class='col-md-12 hpt'></span>
                            <span>
                            <div class='col-md-12 blam'>

                                <?php
                                $d = mysql_query("SELECT id_du FROM hb_prakerin WHERE nis='$_SESSION[username]'");
                                 $g = mysql_fetch_array($d);

                                 echo $g['id_du'];

                                 //$f = mysql_fetch_row(mysql_query("SELECT * FROM hb_monitoring WHERE id_du='$g[id_du]'")) or die(mysql_error());
                                 
                                 //if($f>0){
                                 //   echo 'Tanggal Monitoring : '.$f['tgl_monitoring'];
                                 //}else{

                                 //   echo "Tanggal Monitoring Belum Ditentukan";
                                 //}
                                 //echo $f;

                                 ?>
                                 </div>
                            </span>
                            </div>
                        </div>
                    </div>
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
