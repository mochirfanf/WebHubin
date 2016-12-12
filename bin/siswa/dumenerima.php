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

if($_SESSION['level']=='siswa'){ 

        $title="Permohonan Perizinan Prakerin";
        $active="";
        $active2 = "active";
        $navactive ="nav-active";

        $data = mysql_query( "SELECT * FROM hb_du_umum, hb_du_penerima, hb_du_permintaan WHERE hb_du_umum.id_du = hb_du_penerima.id_du AND hb_du_umum.id_du = hb_du_permintaan.id_du AND hb_du_penerima.id_jurusan = '$_SESSION[jurusan]' AND status_penerimaan='Menerima'  AND hb_du_penerima.tahun_ajaran='$_SESSION[tahun_ajaran]' ");

        $j = mysql_fetch_array(mysql_query("SELECT singkatan FROM jurusan WHERE id_jurusan = '$_SESSION[jurusan]'"));

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
                        <th>Jumlah Penerimaan</th>
                        <th>Sisa Kuota Penerimaan</th>
                        <th>Pelaksanaan</th>
                        <th>Seleksi</th>
                        <th>Sumber</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $no =0;
                            while ($d = mysql_fetch_array($data)) {
                                $no = $no+1;
                                $mulai = tanggal($d["mulai_pelaksanaan"]);
                                $berakhir = tanggal($d["berakhir_pelaksanaan"]);
                                $s = mysql_fetch_array(mysql_query("SELECT singkatan FROM jurusan, hb_du_permintaan WHERE hb_du_permintaan.du_id_jurusan = jurusan.id_jurusan AND id_jurusan='$d[du_id_jurusan]'"));
                                echo "
                                    <tr class='gradeA'>
                                        <td> $no </td>
                                        <td> $d[nama_du] </td>
                                        <td> $d[jumlah_penerimaan] orang </td>
                                        <td> ";
                                            if ($d["sisa_kuota_penerimaan"] == 0) {
                                                echo "Telah Terpenuhi";
                                            }else{
                                                echo "$d[sisa_kuota_penerimaan] orang";
                                            }
                                  echo "</td>
                                        <td> $mulai s/d $berakhir</td>
                                        <td class='center'>  $d[seleksi_du]</td>
                                        <td class='center'>  $d[status_du] "; 
                                        if ($d["du_id_jurusan"]!=0) {
                                            echo "$s[singkatan]";
                                        }
                                  echo "</td>
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
    header('location:beranda');
}

?>