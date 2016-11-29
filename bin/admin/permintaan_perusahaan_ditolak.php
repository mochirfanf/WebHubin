<?php

include "../koneksidb.php";

if($_SESSION['level']=='admin'){
    if ($_SESSION['tahun_ajaran']!='') {
        $title="Permohonan Perizinan Prakerin";
        $active ="";
        $active10 = "active";
        $navactive5 ="nav-active";

        $data = mysql_query( "SELECT * from hb_du_umum, hb_du_permintaan WHERE status_permintaan='Verifikasi Ditolak' AND permintaan_du='Ya' AND hb_du_umum.id_du=hb_du_permintaan.id_du");

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
                        <th>Info Permintaan</th>
                        <th>Alasan Menolak</th>
                        <th></th>
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
                                        <td>
                                            $d[alasan_menolak]
                                        </td>
                                        <td>
                                            <a href='#verifikasi$d[id_du]' data-toggle='modal'>
                                                <button class='btn btn-sm btn-danger' type='button'><i class='fa fa-cogs'></i></button>
                                            </a>
                                        </td>
                                        <div  style='text-transform:none' aria-hidden='true' aria-labelledby='myModalLabel' role='dialog' tabindex='-1' id='verifikasi$d[id_du]' class='modal fade'>
                                                <div class='modal-dialog'>
                                                    <div class='modal-content'>
                                                        <div class='modal-header'>
                                                            <button aria-hidden='true' data-dismiss='modal' class='close' type='button'>×</button>
                                                            <h5>Kembalikan/Verifikasi Permintaan Prakerin</h5>
                                                        </div>
                                                        <div class='modal-body'>
                                                            Apakah anda ingin mengembalikan permintaan prakerin dari :  $d[nama_du]?
                                                        </div>
                                                       <div class='modal-footer'>
                                                            <button type='button' class='btn btn-default' data-dismiss='modal'>Kembali</button>
                                                            <a href='proses_admin.php?a=verifikasi_permintaan_perusahaan2&id=$d[id_du]'>
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
