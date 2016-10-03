<?php

include "../koneksidb.php";

if($_SESSION['level']=='admin'){
    if ($_SESSION['tahun_ajaran']!='') {
        $title="Permohonan Perizinan Prakerin Siswa";
        $active = "";
        $active2 = "active";
        $navactive1 ="nav-active";

        function judultabel(){
            echo "  <th>No</th>
                    <th>Permintaan Siswa </th>
                    <th>Kelas</th>
                    <th>Nama Dunia Usaha</th>
                    <th>Alamat</th>
                    <th>Email</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>";
        }

        function isinya($query){
                $no =0;
                while ($d = mysql_fetch_array($query)) {
                    $no = $no+1;
                    echo "
                    <tr class='gradeA'>
                        <td> $no </td>
                        <td> $d[nama] </td>
                        <td> $d[kelas] </td>
                        <td> $d[nama_du] </td>
                        <td> $d[alamat]</td>
                        <td> $d[email]</td>
                        <td> $d[keterangan_du]</td>
                        <td>
                            <a href='#verifikasi$d[id_du]' data-toggle='modal'>
                                <button class='btn btn-sm btn-success' type='button'><i class='fa fa-check-square-o'></i> Verifikasi </button>
                            </a>
                        </td>
                            <div  style='text-transform:none' aria-hidden='true' aria-labelledby='myModalLabel' role='dialog' tabindex='-1' id='verifikasi$d[id_du]' class='modal fade'>
                                <div class='modal-dialog'>
                                    <div class='modal-content'>
                                        <div class='modal-header'>
                                            <button aria-hidden='true' data-dismiss='modal' class='close' type='button'>×</button>
                                                <h5>Konfirmasi</h5>
                                        </div>
                                        <div class='modal-body'>
                                            Verifikasi perizinan dengan Nama DU : $d[nama_du]?
                                        </div>
                                        <div class='modal-footer'>
                                            <button type='button' class='btn btn-default' data-dismiss='modal'>Kembali</button>
                                                <a href='proses_admin.php?a=verifikasiperizinan&id=$d[id_du]'>
                                                <input type='submit' value='Ya' name='Ganti'class='btn btn-success'></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </tr>";
                 }
        }

        include "leftside.php"; ?>

        <!--body wrapper start-->
        <div class="wrapper">
            <div class="row">
                <div class="col-sm-12">
                    <section class="panel">
                    <header class="panel-heading">
                        <label><big>Permohonan Perizinan Prakerin Siswa</big></label>
                    </header>

                   <section class="panel">
                        <div class="panel-body">
                                    <div class="panel-body">
                                        <div class="adv-table">
                                        <table  class="display table table-bordered table-striped" id="dynamic-table">
                                        <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Permintaan</th>
                                            <th>Nama DU/DI</th>
                                            <th>Alamat dan Email</th>
                                            <th>Keterangan</th>
                                            <th>Aksi</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $query = mysql_query("SELECT hb_du_umum.id_du, hb_du_umum.id_prov, hb_du_umum.id_kab, hb_du_umum.id_kec, hb_du_umum.id_kel, hb_du_umum.no_kodepos, siswa.nama_siswa, hb_du_umum.nama_du, hb_du_umum.alamat, hb_du_umum.id_kab, hb_du_umum.email_du, hb_du_permintaan.keterangan_permintaan, jurusan.singkatan, siswa.nama_siswa, siswa.kelas, siswa.nis FROM hb_du_umum, siswa, jurusan, hb_du_permintaan WHERE permintaan_siswa='Ya' AND status_permintaan='Belum Terverifikasi'AND siswa.id_jurusan = jurusan.id_jurusan AND hb_du_permintaan.du_siswa = siswa.nis AND hb_du_umum.id_du = hb_du_permintaan.id_du ");
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
                                                    <td> Jurusan &nbsp; : $d[singkatan] <br>
                                                         NIS &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;: $d[nis] <br>
                                                         Nama  &nbsp;&nbsp; &nbsp; : $d[nama_siswa] <br>
                                                         Kelas  &nbsp; &nbsp; &nbsp;&nbsp;: $d[kelas] <br>
                                                    </td>
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
                                                                        <h5>Berikan Alasan! (Pesan akan disampaikan ke Ketua Pemrograman)</h5>
                                                                    </div>
                                                                    <div class='modal-body'>
                                                                        <div class='form-group'>
                                                                            <form method='POST' action='proses_admin.php?a=tolak_permintaan_perusahaan&id=$d[id_du]'>
                                                                            <div class='col-lg-12'>
                                                                                <input type='text' class='form-control' name='alasan' placeholder='Berikan Alasan ....'>
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
                                        ?>
                                        </tbody>
                                        </table>
                                        </div>
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
