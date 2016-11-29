<?php

include "../koneksidb.php";

if($_SESSION['level']=='kapprog'){
    if ($_SESSION['tahun_ajaran']!='') {
        $title="Permohonan Perizinan Prakerin";
        $active = "";
        $active9 = "active";
        $navactive3 ="nav-active";


        $data2 = mysql_query("SELECT * FROM hb_du_umum,hb_prakerin,siswa WHERE hb_prakerin.tahun_ajaran = '$_SESSION[tahun_ajaran]' AND siswa.id_jurusan='$_SESSION[jurusan]' AND hb_du_umum.id_du = hb_prakerin.id_du AND siswa.nis = hb_prakerin.nis");

        $data3 = mysql_query("SELECT * FROM hb_du_umum,hb_prakerin,siswa WHERE hb_prakerin.tahun_ajaran = '$_SESSION[tahun_ajaran]' AND siswa.id_jurusan='$_SESSION[jurusan]' AND hb_du_umum.id_du = hb_prakerin.id_du AND siswa.nis = hb_prakerin.nis");

        include "leftside.php"; ?>

        <!--body wrapper start-->
        <div class="wrapper">
            <div class="row">
                <div class="col-sm-12">
                    <section class="panel">
                    <header class="panel-heading">
                        <big>Permohonan DU/DI</big>
                         <span class="pull-right"></span>
                    </header>

                    <div class="panel-body">
                    <div class="adv-table">
                    <table  class="display table table-bordered table-striped" id="dynamic-table">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Siswa</th>
                        <th>Kelas</th>
                        <th>Status Siswa </th>
                        <th>Tempat Prakerin </th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                            $no =0;
                            while( $d = mysql_fetch_array($data2)) {

                                $no = $no+1;
                                echo "
                                    <tr class='gradeA'>
                                        <td> $no </td>
                                        <td> $d[nama_siswa] </td>
                                        <td> $d[kelas] </td>
                                        <td class='center'>";
                                            if ($d["status_verifikasi"]=="Ditolak Kapprog") {
                                                echo "<span class='label label-danger'><i class='fa fa-times'></i> Verifikasi Ditolak </span>";
                                            }
                                            if ($d["status_verifikasi"]=="Terverifikasi Kapprog") {
                                                echo "<span class='label label-primary'><i class='fa fa-check'></i> Terverifikasi </span>";
                                            }
                                            if ($d["status_verifikasi"]=="Menunggu Verifikasi Kapprog") {
                                                echo "<span class='label label-success'><i class='fa fa-spinner'></i> Menunggu Verifikasi </span>";
                                            }
                                 echo " </td>
                                        <td> $d[nama_du] </td>
                                        <td class='center'>";

                                            if ($d["status_verifikasi"]!="Menunggu Verifikasi Kapprog" && $d["dipilih_kapprog"]!="Ya") {
                                               echo "
                                                <a href='#tolak$d[id_prakerin]' data-toggle='modal'>
                                                    <button class='btn btn-sm btn-danger' type='button'><i class='fa fa-ban'></i> Batalkan </button>
                                                </a>";
                                            }
                                            elseif ($d["dipilih_kapprog"]=="Ya") {
                                               echo "
                                                <a href='#hapus$d[id_prakerin]' data-toggle='modal'>
                                                    <button class='btn btn-sm btn-primary' type='button'><i class='fa fa-trash-o'></i> Hapus </button>
                                                </a>";
                                            }else{
                                                echo "-";
                                            }




                                 echo " </td>

                                            <div style='text-transform:none' aria-hidden='true' aria-labelledby='myModalLabel' role='dialog' tabindex='-1' id='tolak$d[id_prakerin]' class='modal fade'>
                                                <div class='modal-dialog'>
                                                    <div class='modal-content'>
                                                        <div class='modal-header'>
                                                            <button aria-hidden='true' data-dismiss='modal' class='close' type='button'>×</button>
                                                            <h5>Konfirmasi!</h5>
                                                        </div>
                                                        <div class='modal-body'>
                                                            Apakah anda ingin membatalkan verifikasi? (Siswa : $d[nama_siswa])
                                                        </div>
                                                       <div class='modal-footer'>
                                                            <button type='button' class='btn btn-default' data-dismiss='modal'>Kembali</button>
                                                            <a href='proses_kapprog.php?a=batalkan_verifikasi_tempat_prakerin_siswa&id=$d[id_prakerin]'>
                                                            <input type='submit' value='Batalkan Verifikasi' name='Ganti'class='btn btn-danger'></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div style='text-transform:none' aria-hidden='true' aria-labelledby='myModalLabel' role='dialog' tabindex='-1' id='hapus$d[id_prakerin]' class='modal fade'>
                                                <form method='POST' action='proses_kapprog.php?a=hapus_tempat_prakerin_siswa_pendaftaran'>
                                                <div class='modal-dialog'>
                                                    <div class='modal-content'>
                                                        <div class='modal-header'>
                                                            <button aria-hidden='true' data-dismiss='modal' class='close' type='button'>×</button>
                                                            <h5>Konfirmasi!</h5>
                                                        </div>
                                                        <div class='modal-body'>
                                                            Apakah anda ingin menghapusnya? (Siswa : $d[nama_siswa])
                                                        </div>
                                                       <div class='modal-footer'>
                                                            <button type='button' class='btn btn-default' data-dismiss='modal'>Kembali</button>
                                                                <input type='hidden' name='nis' value='$d[nis]'>
                                                                <input type='hidden' name='id_du' value='$d[id_du]'>
                                                                <input type='submit' value='Hapus' name='Ganti'class='btn btn-danger'>
                                                        </div>
                                                    </div>
                                                </div>
                                                </form>
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
