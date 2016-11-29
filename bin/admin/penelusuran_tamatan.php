<?php

include "../koneksidb.php";

if($_SESSION['level']=='admin'){
    if ($_SESSION['tahun_ajaran']!='') {
        $title="Permohonan Perizinan Prakerin";
        $active = "";
        $active16 = "active";
        $navactive11 ="nav-active";
       
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

        $data = mysql_query("SELECT * FROM hb_riwayat_siswa");

        include "leftside.php"; ?>

        <!--body wrapper start-->
        <div class="wrapper">
            <div class="row">
                <div class="col-sm-12">
                    <section class="panel">
                    <header class="panel-heading">
                        <label><big>Riwayat Kegiatan</big></label>
                    </header>
                    <div class="panel-body">
                    <div class="adv-table">
                    <table  class="display table table-bordered table-striped" id="dynamic-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIS</th>
                                <th>Kegiatan</th>
                                <th>Tempat</th>
                                <th>Alamat</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Berakhir</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $no =0;
                                while ($d = mysql_fetch_array($data)) {
                                    $no = $no+1;

                                    $awal = tanggal($d["tanggal_awal_riwayat"]);
                                    $akhir = tanggal($d["tanggal_selesai_riwayat"]);
                                    echo "
                                        <tr class='gradeA'>
                                            <td> $no </td>
                                            <td> $d[nis] </td>
                                            <td> $d[nama_kegiatan] </td>
                                            <td> $d[nama_tempat]</td>
                                            <td> $d[alamat_tempat]</td>
                                            <td> $awal</td>
                                            <td>";
                                                if ($d["tanggal_selesai_riwayat"] == "") {
                                                   echo "Belum Ditentukan";
                                                }else{
                                                    echo $akhir;
                                                }
                                     echo " </td>
                                            <td> $d[status]</td>

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
