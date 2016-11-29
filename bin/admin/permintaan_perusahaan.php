<?php

include "../koneksidb.php";

if($_SESSION['level']=='admin'){
    if ($_SESSION['tahun_ajaran']!='') {
        $title="Permohonan Perizinan Prakerin";
        $active ="";
        $active9 = "active";
        $navactive5 ="nav-active";

        $data = mysql_query( "SELECT * from hb_du_umum, hb_du_permintaan WHERE status_permintaan='Belum Terverifikasi' AND permintaan_du='Ya' AND hb_du_umum.id_du=hb_du_permintaan.id_du");
        $data2 = mysql_query( "SELECT * from hb_du_umum, hb_du_permintaan  WHERE status_permintaan='Belum Terverifikasi' AND permintaan_du='Ya' AND hb_du_umum.id_du=hb_du_permintaan.id_du");
        $data3 = mysql_query( "SELECT * from hb_du_umum, hb_du_permintaan  WHERE status_permintaan='Belum Terverifikasi' AND permintaan_du='Ya'  AND hb_du_umum.id_du=hb_du_permintaan.id_du");

        include "leftside.php"; ?>

        <!--body wrapper start-->
        <div class="wrapper">
            <div class="row">
                <div class="col-sm-12">
                    <section class="panel">
                    <header class="panel-heading">
                        <big>Permohonan Perizinan Prakerin</big>
                         <span class="pull-right">

                         </span>
                    </header>

                    <div class="panel-body">
                    <div class="adv-table">
                    <table  class="display table table-bordered table-striped" id="dynamic-table">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama DU/DI</th>
                        <th>Alamat dan Email</th>
                        <th>Penanggung Jawab</th>
                        <th>Info Permintaan</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                            $no =0;
                            while ($d = mysql_fetch_array($data)) {
                                $no = $no+1;
                                $kel = mysql_fetch_array(mysql_query("SELECT nama FROM kelurahan WHERE id_kel='$d[id_kel]'"));
                                $kec = mysql_fetch_array(mysql_query("SELECT nama FROM kecamatan WHERE id_kec='$d[id_kec]'"));
                                $kab = mysql_fetch_array(mysql_query("SELECT nama FROM kabupaten WHERE id_kab='$d[id_kab]'"));
                                $prov = mysql_fetch_array(mysql_query("SELECT nama FROM provinsi WHERE id_prov='$d[id_prov]'"));
                                echo "
                                    <tr class='gradeA'>
                                        <td> $no </td>
                                        <td> $d[nama_du] </td>
                                        <td> $d[alamat]
                                             <br> Kelurahan : $kel[nama]
                                             <br> Kecamatan : $kec[nama]
                                             <br> Kab/Kota : $kab[nama]
                                             <br> Provinsi : $prov[nama]
                                             <br> Kode Pos : $d[no_kodepos]
                                             <br><br> Email : $d[email_du]
                                        </td>
                                        <td> $d[nama_penanggung_jawab] <br> $d[contact_person]</td>
                                        <td>";

                                                $query  = mysql_query("SELECT * FROM hb_du_jumlah_permintaan_du WHERE id_du='$d[id_du]' ");
                                                while ($x = mysql_fetch_array($query)) {
                                                    $j = mysql_fetch_array(mysql_query("SELECT * FROM jurusan WHERE id_jurusan='$x[id_jurusan]'"));
                                                    echo " $j[nama_jurusan] - $x[jumlah_penerimaan] orang <br>";
                                                }

                                            echo "
                                            <br>
                                            <b> Fasilitas : </b><br>

                                                Uang Saku  &nbsp; &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp; : $d[uang_saku] <br>
                                                Asrama  &nbsp; &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;   &nbsp;  &nbsp;: $d[asrama] <br>
                                                Uang Makan  &nbsp; &nbsp;  &nbsp;  &nbsp;  &nbsp; : $d[uang_makan] <br>
                                                Uang Transport &nbsp;  &nbsp;&nbsp; : $d[uang_transport] <br><br>

                                            <b> Fasilitas Lain: </b><br>
                                                $d[fasilitas_lain] <br>
                                            </div>
                                        </td>
                                        <td class='center'>
                                            <a href='#verifikasi$d[id_du]' data-toggle='modal'>
                                                <button class='btn btn-sm btn-info' type='button'><i class='fa fa-check'></i> Verifikasi </button>
                                            </a>
                                            <a href='#tolak$d[id_du]' data-toggle='modal'>
                                                <button class='btn btn-sm btn-danger' type='button'><i class='fa fa-ban'></i> Tolak Permintaan </button>
                                            </a>
                                        </td>

                                            <div  style='text-transform:none' aria-hidden='true' aria-labelledby='myModalLabel' role='dialog' tabindex='-1' id='verifikasi$d[id_du]' class='modal fade'>
                                                <div class='modal-dialog'>
                                                    <div class='modal-content'>
                                                        <div class='modal-header'>
                                                            <button aria-hidden='true' data-dismiss='modal' class='close' type='button'>×</button>
                                                            <h5>Verifikasi Permintaan Prakerin</h5>
                                                        </div>
                                                        <div class='modal-body'>
                                                            Apakah anda ingin menerima permintaan prakerin dari :  $d[nama_du] ?
                                                        </div>
                                                       <div class='modal-footer'>
                                                            <button type='button' class='btn btn-default' data-dismiss='modal'>Kembali</button>
                                                            <a href='proses_admin.php?a=verifikasi_permintaan_perusahaan&id=$d[id_du]'>
                                                            <input type='submit' value='Ya' name='Ganti'class='btn btn-success'></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div  style='text-transform:none' aria-hidden='true' aria-labelledby='myModalLabel' role='dialog' tabindex='-1' id='tolak$d[id_du]' class='modal fade'>
                                                <div class='modal-dialog'>
                                                    <div class='modal-content'>
                                                        <div class='modal-header'>
                                                            <button aria-hidden='true' data-dismiss='modal' class='close' type='button'>×</button>
                                                            <h5>Berikan Alasan! (Pesan akan disampaikan ke Perusahaan)</h5>
                                                        </div>
                                                        <div class='modal-body'>
                                                            <div class='form-group'>
                                                                <form method='POST' action='proses_admin.php?a=tolak_permintaan_perusahaan&id=$d[id_du]'>
                                                                <div class='col-lg-12'>
                                                                    <input type='text' class='form-control' name='alasan' placeholder='Berikan Alasan ....' required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                       <div class='modal-footer'>
                                                            <button type='button' class='btn btn-info' data-dismiss='modal'>Kembali</button>
                                                            <input type='submit' value='Tolak Permintaan dan Kirim Pesan' name='Ganti'class='btn btn-danger'>
                                                        </div>
                                                    </div>
                                                    </form>
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
                    <label> <br>
                        &nbsp; &nbsp; ** Hati - hati jika anda menolak permintaan! <br><br>
                    </label>
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
