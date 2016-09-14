<?php

include "../koneksidb.php";

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

if($_SESSION['level']=='perusahaan'){ 
    if ($_SESSION['tahun_ajaran']!='') {
        $title="Permohonan Perizinan Prakerin";
        $active="";
        $active1 = "active";
        $navactive2 ="nav-active";

        $j    = mysql_fetch_array(mysql_query("SELECT * FROM hb_du,hb_du_penerima,hb_guru_jurusan,jurusan WHERE hb_du.id_du = hb_du_penerima.id_du AND hb_guru_jurusan.id_jurusan = jurusan.id_jurusan AND nip_guru = '$_SESSION[username]' AND tahun_ajaran ='$_SESSION[tahun_ajaran]'")) ;
        $data = mysql_query( "select * from hb_du,hb_du_penerima WHERE hb_du.id_du = hb_du_penerima.id_du AND id_jurusan = '$j[id_jurusan]' AND status_du='Menerima'");

        include "leftside.php"; ?>
                
        <!--body wrapper start-->
        <div class="wrapper">
            <div class="row">
                <div class="col-sm-12">
                    <section class="panel">
                    <header class="panel-heading">
                        <big>Tempat Prakerin Untuk Jurusan <?php echo "$j[singkatan]"; ?></big>
                         <span class="pull-right"> Status : </span>
                    </header>
                   
                    <div class="panel-body">
                    <div class="adv-table">
                    <table  class="display table table-bordered table-striped" id="dynamic-table">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Dunia Usaha</th>
                        <th>Alamat</th>
                        <th>Kota</th>
                        <th>Jumlah Penerimaan</th>
                        <th>Sisa Kuota Penerimaan</th>
                        <th>Pelaksanaan</th>
                        <th>Seleksi</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $no =0;
                            while ($d = mysql_fetch_array($data)) {
                                $no = $no+1;
                                $mulai = tanggal($d["mulai_pelaksanaan"]);
                                $berakhir = tanggal($d["berakhir_pelaksanaan"]);
                                echo "
                                    <tr class='gradeA'>
                                        <td> $no </td>
                                        <td> $d[nama_du] </td>
                                        <td> $d[alamat]</td>
                                        <td> $d[kota]</td>
                                        <td> $d[jumlah_penerimaan]</td>
                                        <td> ";
                                            if ($d["sisa_kuota_penerimaan"] == 0) {
                                                echo "Telah Terpenuhi";
                                            }else{
                                                echo "$d[sisa_kuota_penerimaan] orang";
                                            }
                                  echo "</td>
                                        <td> $mulai s/d $berakhir</td>
                                        <td class='center'>  $d[seleksi_du]</td>
                                    </tr>
                                    ";
                            }
                        ?>
                    </tbody>
                    </table>
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