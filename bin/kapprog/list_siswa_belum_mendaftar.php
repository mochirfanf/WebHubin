<?php

include "../koneksidb.php";

if($_SESSION['level']=='kapprog'){
    if ($_SESSION['tahun_ajaran']!='') {
        $title="Permohonan Perizinan Prakerin";
        $active = "";
        $active10 = "active";
        $navactive3 ="nav-active";


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
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $no =0;

                                    // $nisprakerin = mysql_query("SELECT COUNT (*) FROM siswa WHERE tahun_ajaran = '$_SESSION[tahun_ajaran]' AND id_jurusan='$_SESSION[jurusan]'");

                                    // $nissiswa = mysql_query("SELECT COUNT (*) FROM hb_prakerin,siswa WHERE hb_prakerin.tahun_ajaran = '$_SESSION[tahun_ajaran]' AND siswa.id_jurusan='$_SESSION[jurusan]' AND hb_prakerin.nis = siswa.nis");


                                    // if () {
                                        
                                    // }

                                    $adanis = mysql_query("SELECT nis, nama_siswa, kelas FROM siswa WHERE siswa.tahun_ajaran = '$_SESSION[tahun_ajaran]' AND siswa.id_jurusan='$_SESSION[jurusan]' AND nis != ( SELECT nis FROM hb_prakerin )");

                                    while( $d = mysql_fetch_array($adanis)) {

                                        $no = $no+1;
                                        echo "
                                            <tr class='gradeA'>
                                                <td> $no </td>
                                                <td> $d[nama_siswa] </td>
                                                <td class='center'> $d[kelas] </td>
                                                <td class='center'>
                                                        <a href='pilihkan_tempat.php?nis=$d[nis]' data-toggle='modal'>
                                                            <button class='btn btn-sm btn-danger' type='button'><i class='fa fa-edit'></i> Pilihkan Tempat Prakerin </button>
                                                        </a>
                                                </td>
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
