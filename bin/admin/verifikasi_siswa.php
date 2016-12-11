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

if($_SESSION['level']=='admin'){ 
    if ($_SESSION['tahun_ajaran']!='') {
        $title="Permohonan Perizinan Prakerin";
        $active="";
        $active16 = "active";
        $navactive9 ="nav-active";

        $jurusan = $_GET["jurusan"];
        $j = mysql_fetch_array(mysql_query("SELECT * FROM jurusan WHERE singkatan='$jurusan'"));

        $data = mysql_query( "SELECT * FROM hb_du_umum, hb_du_penerima, hb_du_permintaan WHERE hb_du_umum.id_du = hb_du_penerima.id_du  AND status_penerimaan='Menerima'  AND hb_du_umum.id_du = hb_du_permintaan.id_du AND hb_du_penerima.tahun_ajaran='$_SESSION[tahun_ajaran]' AND id_jurusan = '$j[id_jurusan]' AND hb_du_penerima.sisa_kuota_penerimaan='0'");

        include "leftside.php"; ?>
                
        <!--body wrapper start-->
        <div class="wrapper">
            <div class="row">
                <div class="col-sm-12">
                    <section class="panel">
                    <header class="panel-heading">
                        <big>Verifikasi Prakerin Siswa <?php echo "$jurusan" ?></big>
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
                        <th>Pelaksanaan</th>
                        <th>Sumber</th>
                        <th>Aksi</th>
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
                                        <td> $mulai s/d $berakhir</td>
                                        <td class='center'>  $d[status_du] "; 
                                        if ($d["du_id_jurusan"]!=0) {
                                            echo "$s[singkatan]";
                                        }
                                  echo "</td>
                                        <td>
                                            <a href='#verifikasi$d[id_du]' data-toggle='modal'>
                                                <button class='btn btn-sm btn-danger' type='button'><i class='fa fa-check'></i> Verifikasi </button>
                                            </a>
                                            <a href='#tolak$d[id_du]' data-toggle='modal'>
                                                <button class='btn btn-sm btn-primary' type='button'><i class='fa fa-user'></i> Lihat Detail </button>
                                            </a>
                                        </td>
                                        
                                        <div  style='text-transform:none' aria-hidden='true' aria-labelledby='myModalLabel' role='dialog' tabindex='-1' id='verifikasi$d[id_du]' class='modal fade'>
                                            <div class='modal-dialog'>
                                                <div class='modal-content'>
                                                    <div class='modal-header'>
                                                        <button aria-hidden='true' data-dismiss='modal' class='close' type='button'>×</button>
                                                        <h5>Verifikasi Prakerin Siswa</h5>
                                                    </div>
                                                    <div class='modal-body'>
                                                        Apakah anda ingin memverifikasi prakerin siswa di :  $d[nama_du] ?
                                                    </div>
                                                   <div class='modal-footer'>
                                                        <button type='button' class='btn btn-default' data-dismiss='modal'>Kembali</button>
                                                        <a href='proses_admin.php?a=verifikasi_prakerin_siswa&id=$d[id_du]'>
                                                        <input type='submit' value='Ya' name='Ganti'class='btn btn-success'></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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