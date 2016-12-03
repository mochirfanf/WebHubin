<?php

include "../koneksidb.php";

if($_SESSION['level']=='guru'){ 
    if ($_SESSION['tahun_ajaran']!='') {
        $title="Daftar Siswa yang Dimonitoring";
        $active ="";
        $active17 = "active";
        $navactive7 ="nav-active";
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
        $data = mysql_query( "SELECT * FROM hb_prakerin WHERE saran_pembimbing = $_SESSION[username] AND tahun_ajaran='$_SESSION[tahun_ajaran]'");
       
        include "leftside.php"; ?>
                
        <!--body wrapper start-->
        <div class="wrapper">
            <div class="row">
                <div class="col-sm-12">
                    <section class="panel">
                    <header class="panel-heading">
                        <big>Daftar Siswa yang Dimonitoring</big>
                         
                    </header>
                   
                    <div class="panel-body">
                    <div class="adv-table">
                    <table  class="display table table-bordered table-striped" id="dynamic-table">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Tempat Prakerin</th>
                        <th>Alamat Tempat Prakerin</th>
                        <th>Kota</th>
                        <th>Penanggung Jawab</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $no =0;
                            while ($d = mysql_fetch_array($data)) {
                                $no = $no+1;
                                $d2 = mysql_fetch_array(mysql_query("SELECT nama_guru FROM guru WHERE nip_guru ='$d[saran_pembimbing]'"))or die(mysql_error());
                                $d3 = mysql_fetch_array(mysql_query("SELECT nama_siswa,id_jurusan,kelas FROM siswa WHERE nis ='$d[nis]'"));
                                $d4 = mysql_fetch_array(mysql_query("SELECT id_du, kabupaten.nama AS namakab, nama_du, alamat, nama_penanggung_jawab_umum FROM hb_du_umum INNER JOIN kabupaten ON kabupaten.id_kab=hb_du_umum.id_kab WHERE id_du ='$d[id_du]'"))or die(mysql_error());

                                $j = mysql_fetch_array(mysql_query("SELECT * FROM jurusan WHERE id_jurusan='$d3[id_jurusan]'"));
                                $tgl = mysql_fetch_array(mysql_query("SELECT * FROM hb_monitoring WHERE id_du='$d[id_du]'"));
                                echo "
                                    <tr class='gradeA'>
                                        <td> $no </td>
                                        <td> $d4[nama_du]</td>
                                        <td> $d4[alamat]</td>
                                        <td> $d4[namakab]</td>
                                        <td> $d4[nama_penanggung_jawab_umum]</td>
                                        <td>
";
if(!empty($tgl['tgl_monitoring'])){
    echo $tgl['tgl_monitoring'];
}else{
    echo "Belum Ditentukan";
}
                                        
echo "
                                        </td>
                                        <td><a href='#' data-toggle='modal' data-target='#tgl$d[id_du]' data-du='$d[id_du]'>
                                                            <button class='btn btn-sm btn-primary' type='button'><i class='fa fa-edit'></i> Ubah Tanggal </button>
                                                        </a>
                                                        </td>
                                    </tr>
                                    ";
                                    ?>
                                            <div class='modal fade' id='tgl<?php echo $d['id_du']?>' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
<?php

                                    

?>
        <div class='modal-dialog'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                    <h4 class='modal-title' id='myModalLabel'>Tanggal Monitoring</h4> </div>
                <div class='modal-body'>
                    <form class='form-horizontal form-label-left' method='POST' action='proses_guru.php?a=tanggalmonitoring' enctype='multipart/form-data'>
                        
                        <label class='control-label col-md-3 col-sm-3 col-xs-12' for='name'>Tanggal : <span class='required'></span> </label>
                        <div class="col-lg-8"><?php
                                    $name = "";
                                    echo "<input type='hidden' id='id_du' name='iddu' value='$d[id_du]'>";
                                    echo "<input type='text' class='form-control dpd1' data-date-format='yyyy/mm/dd' name='tgl_monitoring' placeholder='Tanggal Monitoring' required value='$tgl[tgl_monitoring]'>";?>
                                </div>
                </div>
                <div class='modal-footer'>
                    <div class='form-group'>
                        <div class='col-md-4 col-md-offset-8'>
                            <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
                            <button style=' margin-top: -5px;' value='pilih' id='send' type='submit' class='btn btn-success' name='pilih'>Pilih</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
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