<?php

include "../koneksidb.php";

if($_SESSION['level']=='admin'){
    if ($_SESSION['tahun_ajaran']!='') {
        $title="Permohonan Perizinan Prakerin Siswa";
        $active = "";
        $active2 = "active";
        $navactive1 ="nav-active";


        include "leftside.php"; ?>

        <!--body wrapper start-->
        <div class="wrapper">
            <div class="row">
                <div class="col-sm-12">
                    <section class="panel">
                    <header class="panel-heading custom-tab turquoise-tab">
                        <ul class="nav nav-tabs">
                            <li>
                                <a data-toggle="tab" href="#home">
                                   <i class="fa fa-user"></i>
                                    DU / DI Dari Kapprog
                                </a>
                            </li>
                            <li class="active">
                                <a data-toggle="tab" href="#permohonan">
                                    <i class="fa fa-user"></i>
                                    Permohonan Perizinan DU / DI 
                                </a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#ditolak">
                                    <i class="fa fa-user"></i>
                                    DU/DI Ditolak
                                </a>
                            </li>
                        </ul>
                    </header>
                    <div class="panel-body">
                        <div class="tab-content">
                            <div id="home" class="tab-pane ">
                                <div class="panel-body">
                                    <div class="adv-table">
                                    <table  class="display table table-bordered table-striped aa" id="dynamic-table">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Jurusan</th>
                                        <th>Nama DU/DI</th>
                                        <th>Alamat dan Email</th>
                                        <th>Keterangan</th>
                                        <th>Aksi</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $query = mysql_query("SELECT hb_du_umum.id_du, hb_du_umum.id_prov, hb_du_umum.id_kab, hb_du_umum.id_kec, hb_du_umum.id_kel, hb_du_umum.no_kodepos, hb_du_umum.nama_du, hb_du_umum.alamat, hb_du_umum.id_kab, hb_du_umum.email_du, hb_du_permintaan.keterangan_permintaan, jurusan.singkatan FROM hb_du_umum, jurusan, hb_du_permintaan WHERE permintaan_kapprog='Ya' AND status_permintaan='Terverifikasi' AND hb_du_permintaan.du_id_jurusan = jurusan.id_jurusan AND hb_du_umum.id_du = hb_du_permintaan.id_du ");
                                        $no =0;
                                        while ($d = mysql_fetch_array($query)) {
                                            $no = $no+1;
                                            $kel = mysql_fetch_array(mysql_query("SELECT nama FROM kelurahan WHERE id_kel='$d[id_kel]'"));
                                            $kec = mysql_fetch_array(mysql_query("SELECT nama FROM kecamatan WHERE id_kec='$d[id_kec]'"));
                                            $kab = mysql_fetch_array(mysql_query("SELECT nama FROM kabupaten WHERE id_kab='$d[id_kab]'"));
                                            $prov = mysql_fetch_array(mysql_query("SELECT nama FROM provinsi WHERE id_prov='$d[id_prov]'"));
                                            echo "
                                            <tr class='gradeA'>
                                                <td> $no </td>
                                                <td> $d[singkatan] </td>
                                                <td> $d[nama_du] </td>
                                                <td> $d[alamat]
                                                     <br> Kelurahan : $kel[nama]
                                                     <br> Kecamatan : $kec[nama]
                                                     <br> Kab/Kota : $kab[nama]
                                                     <br> Provinsi : $prov[nama]
                                                     <br> Kode Pos : $d[no_kodepos]
                                                     <br><br> Email : $d[email_du]
                                                </td>
                                                <td> $d[keterangan_permintaan]</td>
                                                <td>
                                                    <a href='#tolak$d[id_du]' data-toggle='modal'>
                                                        <button class='btn btn-sm btn-danger' type='button'><i class='fa fa-check'></i> Batalkan Verifikasi </button>
                                                    </a>
                                                </td>

                                                    <div  style='text-transform:none' aria-hidden='true' aria-labelledby='myModalLabel' role='dialog' tabindex='-1' id='tolak$d[id_du]' class='modal fade'>
                                                        <div class='modal-dialog'>
                                                            <div class='modal-content'>
                                                                <div class='modal-header'>
                                                                    <button aria-hidden='true' data-dismiss='modal' class='close' type='button'>×</button>
                                                                    <h5>Batalkan Verifikasi? </h5>
                                                                </div>
                                                                <div class='modal-body'>
                                                                    Batalkan Verifikasi DU :  $d[nama_du] ?
                                                                </div>
                                                               <div class='modal-footer'>
                                                                    <button type='button' class='btn btn-default' data-dismiss='modal'>Kembali</button>
                                                                    <a href='proses_admin.php?a=kembalikeverifikasi&id=$d[id_du]'>
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
                            </div>
                            <div id="permohonan" class="tab-pane active">
                                <div class="panel-body">
                                    <div class="adv-table">
                                    <table  class="display table table-bordered table-striped aa" id="dynamic-table">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Jurusan</th>
                                        <th>Nama DU/DI</th>
                                        <th>Alamat dan Email</th>
                                        <th>Keterangan</th>
                                        <th>Aksi</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $query = mysql_query("SELECT hb_du_umum.id_du, hb_du_umum.id_prov, hb_du_umum.id_kab, hb_du_umum.id_kec, hb_du_umum.id_kel, hb_du_umum.no_kodepos, hb_du_umum.nama_du, hb_du_umum.alamat, hb_du_umum.id_kab, hb_du_umum.email_du, hb_du_permintaan.keterangan_permintaan, jurusan.singkatan FROM hb_du_umum, jurusan, hb_du_permintaan WHERE permintaan_kapprog='Ya' AND status_permintaan='Belum Terverifikasi'AND hb_du_permintaan.du_id_jurusan = jurusan.id_jurusan AND hb_du_umum.id_du = hb_du_permintaan.id_du ");
                                        $no =0;

                                        while ($d = mysql_fetch_array($query)) {
                                            $no = $no+1;
                                            $kel = mysql_fetch_array(mysql_query("SELECT nama FROM kelurahan WHERE id_kel='$d[id_kel]'"));
                                            $kec = mysql_fetch_array(mysql_query("SELECT nama FROM kecamatan WHERE id_kec='$d[id_kec]'"));
                                            $kab = mysql_fetch_array(mysql_query("SELECT nama FROM kabupaten WHERE id_kab='$d[id_kab]'"));
                                            $prov = mysql_fetch_array(mysql_query("SELECT nama FROM provinsi WHERE id_prov='$d[id_prov]'"));
                                            echo "
                                            <tr class='gradeA'>
                                                <td> $no </td>
                                                <td> $d[singkatan] </td>
                                                <td> $d[nama_du] </td>
                                                <td> $d[alamat]
                                                     <br> Kelurahan : $kel[nama]
                                                     <br> Kecamatan : $kec[nama]
                                                     <br> Kab/Kota : $kab[nama]
                                                     <br> Provinsi : $prov[nama]
                                                     <br> Kode Pos : $d[no_kodepos]
                                                     <br><br> Email : $d[email_du]
                                                </td>
                                                <td> $d[keterangan_permintaan]</td>
                                                <td>
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
                                                                    <a href='proses_admin.php?a=verifikasi_permintaan_kapprog&id=$d[id_du]'>
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
                                                                    <h5>Berikan Alasan! (Pesan akan disampaikan ke Ketua Pemrograman)</h5>
                                                                </div>
                                                                <div class='modal-body'>
                                                                    <div class='form-group'>
                                                                        <form method='POST' action='proses_admin.php?a=tolak_permintaan_perusahaan&id=$d[id_du]'>
                                                                        <div class='col-lg-12'>
                                                                            <input type='text' class='form-control' name='alasan' placeholder='Berikan Alasan ....' required=''>
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
                                                </tr>";
                                            }

                                            $nol = mysql_num_rows($query);
                                            if ($nol == 0) {
                                                echo "
                                                    <tr> <td align='center' colspan='6'> Tidak Ada Permintaan </td> </tr>
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
                            </div>
                            <div id="ditolak" class="tab-pane">
                                <div class="panel-body">
                                    <div class="adv-table">
                                    <table  class="display table table-bordered table-striped" id="dynamic-table">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Jurusan</th>
                                        <th>Nama DU/DI</th>
                                        <th>Alamat dan Email</th>
                                        <th>Alasan Ditolak</th>
                                        <th>Aksi</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $query = mysql_query("SELECT hb_du_umum.id_du, hb_du_umum.id_prov, hb_du_umum.id_kab, hb_du_umum.id_kec, hb_du_umum.id_kel, hb_du_umum.no_kodepos, hb_du_umum.nama_du, hb_du_umum.alamat, hb_du_umum.id_kab, hb_du_umum.email_du, hb_du_permintaan.alasan_menolak, jurusan.singkatan FROM hb_du_umum, jurusan, hb_du_permintaan WHERE permintaan_kapprog='Ya' AND status_permintaan='Verifikasi Ditolak'AND hb_du_permintaan.du_id_jurusan = jurusan.id_jurusan AND hb_du_umum.id_du = hb_du_permintaan.id_du ");
                                        $no =0;

                                        while ($d = mysql_fetch_array($query)) {
                                            $no = $no+1;
                                            $kel = mysql_fetch_array(mysql_query("SELECT nama FROM kelurahan WHERE id_kel='$d[id_kel]'"));
                                            $kec = mysql_fetch_array(mysql_query("SELECT nama FROM kecamatan WHERE id_kec='$d[id_kec]'"));
                                            $kab = mysql_fetch_array(mysql_query("SELECT nama FROM kabupaten WHERE id_kab='$d[id_kab]'"));
                                            $prov = mysql_fetch_array(mysql_query("SELECT nama FROM provinsi WHERE id_prov='$d[id_prov]'"));
                                            echo "
                                            <tr class='gradeA'>
                                                <td> $no </td>
                                                <td> $d[singkatan] </td>
                                                <td> $d[nama_du] </td>
                                                <td> $d[alamat]
                                                     <br> Kelurahan : $kel[nama]
                                                     <br> Kecamatan : $kec[nama]
                                                     <br> Kab/Kota : $kab[nama]
                                                     <br> Provinsi : $prov[nama]
                                                     <br> Kode Pos : $d[no_kodepos]
                                                     <br><br> Email : $d[email_du]
                                                </td>
                                                <td> $d[alasan_menolak]</td>
                                                <td>
                                                    <a href='#tolak$d[id_du]' data-toggle='modal'>
                                                        <button class='btn btn-sm btn-danger' type='button'><i class='fa fa-check'></i> Batalkan Penolakan </button>
                                                    </a>
                                                </td>

                                                    

                                                </tr>";
                                                echo "<div  style='text-transform:none' aria-hidden='true' aria-labelledby='myModalLabel' role='dialog' tabindex='-1' id='tolak$d[id_du]' class='modal fade'>
                                                        <div class='modal-dialog'>
                                                            <div class='modal-content'>
                                                                <div class='modal-header'>
                                                                    <button aria-hidden='true' data-dismiss='modal' class='close' type='button'>×</button>
                                                                    <h5>Batalkan Penolakan? </h5>
                                                                </div>
                                                                <div class='modal-body'>
                                                                    Batalkan Penolakan DU :  $d[nama_du] ?
                                                                </div>
                                                               <div class='modal-footer'>
                                                                    <button type='button' class='btn btn-default' data-dismiss='modal'>Kembali</button>
                                                                    <a href='proses_admin.php?a=batalkanditolak&id=$d[id_du]'>
                                                                    <input type='submit' value='Ya' name='Ganti'class='btn btn-success'></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>";
                                            }

                                            $nol = mysql_num_rows($query);
                                            if ($nol == 0) {
                                                echo "
                                                    <tr> <td align='center' colspan='6'> Tidak Ada Permintaan </td> </tr>
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
