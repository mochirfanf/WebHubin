<?php

include "../koneksidb.php";

if($_SESSION['level']=='kapprog'){
	if ($_SESSION['tahun_ajaran']!='') {
        $title="Permohonan Perizinan Prakerin";
        $active = "";
        $active13 = "active";
        $navactive2 ="nav-active";



        $data = mysql_query("SELECT hb_du_umum.id_du, hb_du_umum.id_prov, hb_du_umum.id_kab, hb_du_umum.id_kec, hb_du_umum.id_kel, hb_du_umum.no_kodepos, hb_du_umum.nama_du, hb_du_umum.alamat, hb_du_umum.id_kab, hb_du_umum.email_du, hb_du_permintaan.keterangan_permintaan, jurusan.singkatan FROM hb_du_umum, jurusan, hb_du_permintaan WHERE permintaan_kapprog='Ya' AND status_permintaan='Terverifikasi' AND status_penerimaan='Proses' AND hb_du_permintaan.du_id_jurusan = jurusan.id_jurusan AND hb_du_umum.id_du = hb_du_permintaan.id_du  AND hb_du_permintaan.du_id_jurusan = '$_SESSION[jurusan]'");


		include "leftside.php"; ?>

        <!--body wrapper start-->
       <div class="wrapper">
            <div class="row">
                <div class="col-sm-12">
                    <section class="panel">
                    <header class="panel-heading">
                        <big>Jawaban DU / DI untuk Prakerin</big>
                         <span class="pull-right">
                        
                     </span>
                    </header>

                    <div class="panel-body">
                    <div class="adv-table">
                    <table  class="display table table-bordered table-striped" id="dynamic-table">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Dunia Usaha</th>
                        <th>Alamat </th>
                        <th>Email </th>
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
                                        </td>
                                        <td> $d[email_du]</td>
                                        <td class='center'>
                                            <a href='prakerin.php?id=$d[id_du]' data-toggle='modal'>
                                                <button class='btn btn-sm btn-info' type='button'><i class='fa fa-check'></i> Menerima </button>
                                            </a>
                                            <a href='#menolak$d[id_du]' data-toggle='modal'>
                                                <button class='btn btn-sm btn-danger' type='button'><i class='fa fa-ban'></i> Menolak </button>
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
                                                            Apakah DU $d[nama_du] Telah Menolak Perizinan Prakerin?
                                                        </div>
                                                       <div class='modal-footer'>
                                                            <button type='button' class='btn btn-default' data-dismiss='modal'>Kembali</button>
                                                            <a href='proses_kapprog.php?a=menolak&id=$d[id_du]'>
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

<?php		include "footer.php";
	}else{
		header('location:tahun_ajaran.php');
	}
}else{
	header('location:../login.php');
}

?>
