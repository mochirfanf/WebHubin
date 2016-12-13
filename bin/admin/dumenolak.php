<?php

include "../koneksidb.php";

if($_SESSION['level']=='admin'){
    if ($_SESSION['tahun_ajaran']!='') {
        $title="Permohonan Perizinan Prakerin Siswa";
        $active = "";
        $active8 = "active";
        $navactive2 ="nav-active";

        include "leftside.php"; ?>

        <!--body wrapper start-->
        <div class="wrapper">
            <div class="row">
                <div class="col-sm-12">
                    <section class="panel">
                    <header class="panel-heading">
                        <label><big> DU / DI yang Telah Ditolak </big></label>
                    </header>

                   <section class="panel">
                        <div class="panel-body">
                                    <div class="adv-table">
                                    <table  class="display table table-bordered table-striped" id="dynamic-table">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama DU/DI</th>
                                        <th>Alamat </th>
                                        <th>Email</th>
                                        <th>Sumber DU/DI</th>
                                        <th>Aksi</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $query = mysql_query("SELECT hb_du_umum.id_du, hb_du_umum.id_prov, hb_du_umum.id_kab, hb_du_umum.id_kec, hb_du_umum.id_kel, hb_du_umum.no_kodepos, hb_du_umum.nama_du, hb_du_umum.alamat, hb_du_umum.id_kab, hb_du_umum.email_du, hb_du_permintaan.keterangan_permintaan, hb_du_permintaan.status_du, hb_du_permintaan.du_id_jurusan FROM hb_du_umum,  hb_du_permintaan WHERE status_penerimaan = 'Menolak' AND hb_du_umum.id_du = hb_du_permintaan.id_du ");
                                        $no =0;
                                        while ($d = mysql_fetch_array($query)) {
                                            $no = $no+1;
                                            $kel = mysql_fetch_array(mysql_query("SELECT nama FROM kelurahan WHERE id_kel='$d[id_kel]'"));
                                            $kec = mysql_fetch_array(mysql_query("SELECT nama FROM kecamatan WHERE id_kec='$d[id_kec]'"));
                                            $kab = mysql_fetch_array(mysql_query("SELECT nama FROM kabupaten WHERE id_kab='$d[id_kab]'"));
                                            $prov = mysql_fetch_array(mysql_query("SELECT nama FROM provinsi WHERE id_prov='$d[id_prov]'"));

                                            $s = mysql_fetch_array(mysql_query("SELECT singkatan FROM jurusan, hb_du_permintaan WHERE hb_du_permintaan.du_id_jurusan = jurusan.id_jurusan AND id_jurusan='$d[du_id_jurusan]'"));

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
                                                </td>
                                                <td> $d[email_du] </td>
                                                <td class='center'>  $d[status_du] "; 
                                                    if ($d["du_id_jurusan"]!=0) {
                                                        echo "$s[singkatan]";
                                                    }
                                         echo "</td>

                                                <td class='center'>
                                                    <a href='#menolak$d[id_du]' data-toggle='modal'>
                                                        <button class='btn btn-sm btn-danger' type='button'><i class='fa fa-times'></i> Batalkan </button>
                                                    </a>
                                                </td>

                                                    <div  style='text-transform:none' aria-hidden='true' aria-labelledby='myModalLabel' role='dialog' tabindex='-1' id='menolak$d[id_du]' class='modal fade'>
                                                        <div class='modal-dialog'>
                                                            <div class='modal-content'>
                                                                <div class='modal-header'>
                                                                    <button aria-hidden='true' data-dismiss='modal' class='close' type='button'>×</button>
                                                                    <h5>Konfirmasi</h5>
                                                                </div>
                                                                <div class='modal-body'>
                                                                   Batalkan Jawaban Menolak dari DU <b>$d[nama_du]</b> ?
                                                                </div>
                                                               <div class='modal-footer'>
                                                                    <button type='button' class='btn btn-default' data-dismiss='modal'>Kembali</button>
                                                                    <a href='proses_admin.php?a=tidak_jadi_menolak&id=$d[id_du]'>
                                                                    <input type='submit' value='Ya' name='Ganti'class='btn btn-success'></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                            </tr>";
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
