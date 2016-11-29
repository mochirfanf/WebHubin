<?php

include "../koneksidb.php";

if($_SESSION['level']=='kapprog'){
    if ($_SESSION['tahun_ajaran']!='') {
        $title="Permohonan Perizinan Prakerin";
        $active = "";
        $active8 = "active";
        $navactive3 ="nav-active";


        $data2 = mysql_query("SELECT * FROM hb_du_umum,hb_prakerin,siswa WHERE status_verifikasi='Menunggu Verifikasi Kapprog' AND hb_prakerin.tahun_ajaran = '$_SESSION[tahun_ajaran]' AND siswa.id_jurusan='$_SESSION[jurusan]' AND hb_du_umum.id_du = hb_prakerin.id_du AND siswa.nis = hb_prakerin.nis");

        $data3 = mysql_query("SELECT * FROM hb_du_umum,hb_prakerin,siswa WHERE status_verifikasi='Menunggu Verifikasi Kapprog' AND hb_prakerin.tahun_ajaran = '$_SESSION[tahun_ajaran]' AND siswa.id_jurusan='$_SESSION[jurusan]' AND hb_du_umum.id_du = hb_prakerin.id_du AND siswa.nis = hb_prakerin.nis");

        include "leftside.php"; ?>

        <!--body wrapper start-->
        <div class="wrapper">
            <div class="row">
                <div class="col-sm-12">
                    <section class="panel">
                    <header class="panel-heading">
                        <big>Permohonan DU/DI</big>
                         <span class="pull-right">
                        <?php
                             while ($t = mysql_fetch_array($data3)) {
                                ?>
                                <div style="text-transform:none" aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="<?php echo "edit$t[id_du]";?>" class="modal fade">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                                <h5><big>Edit Perizinan</big></h5>
                                            </div>
                                            <div class="modal-body">
                                                <?php $dl = mysql_fetch_array(mysql_query("SELECT * FROM hb_du_umum, hb_du_permintaan WHERE hb_du_umum.id_du='$t[id_du]' AND hb_du_umum.id_du = hb_du_permintaan.id_du")); ?>
                                                
                                                <form method="POST" action="proses_kapprog.php?a=editperizinan<?php echo "&id=$t[id_du]";?>"  enctype='multipart/form-data' class="form-horizontal" role="form">
                                                    
                                                    <div class="form-group">
                                                        <label class="col-lg-3 col-sm-3 control-label">Nama DU</label>
                                                        <div class="col-lg-9">
                                                            <input type="text" class="form-control" name="nama_du"  value='<?php echo $dl['nama_du']?>' placeholder="Nama Dunia Usaha" required="" >
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-lg-3 col-sm-3 control-label">Email</label>
                                                        <div class="col-lg-9">
                                                            <input type="email"  value='<?php echo $dl['email_du']?>'  class="form-control" name="email_du" placeholder="Email" required="" >
                                                        </div>
                                                    </div>
                                                     <div class="form-group">
                                                        <label class="col-lg-3 col-sm-3 control-label">Alamat</label>
                                                        <div class="col-lg-9">
                                                            <textarea cols="3" class='form-control col-md-7 col-xs-13' name='alamat' required='required' placeholder='Alamat' type='number'>  <?php echo $dl['alamat']?> </textarea>
                                                        </div>
                                                    </div>
                                                     <div class="form-group">
                                                        <label class="col-lg-3 col-sm-3 control-label">Tambah Keterangan</label>
                                                        <div class="col-lg-9">
                                                            <textarea cols="3" class='form-control col-md-7 col-xs-13' name='keterangan' required='required' placeholder='Alamat' type='number'>  <?php echo $dl['keterangan_permintaan']?> </textarea>
                                                        </div>
                                                    </div>
                                            </div>
                                           <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                                                <input type='submit' value='Perbaharui' name='Perbaharui'class='btn btn-success'>  </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        ?>
                        <!-- modal -->
                     </span>
                    </header>

                    <div class="panel-body">
                    <div class="adv-table">
                    <table  class="display table table-bordered table-striped" id="dynamic-table">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Siswa</th>
                        <th>Kelas</th>
                        <th>Memilih Tempat Prakerin di </th>
                        <th>Alasan </th>
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
                                        <td> $d[nama_du] </td>
                                        <td> $d[alasan_memilih]</td>
                                        <td class='center'>
                                             <a href='#verifikasi$d[id_prakerin]' data-toggle='modal'>
                                                <button class='btn btn-sm btn-info' type='button'><i class='fa fa-check'></i> Verifikasi </button>
                                            </a>
                                            <a href='#tolak$d[id_prakerin]' data-toggle='modal'>
                                                <button class='btn btn-sm btn-danger' type='button'><i class='fa fa-ban'></i> Tolak Permintaan </button>
                                            </a>
                                        </td>
                                            <div style='text-transform:none' aria-hidden='true' aria-labelledby='myModalLabel' role='dialog' tabindex='-1' id='verifikasi$d[id_prakerin]' class='modal fade'>
                                                <div class='modal-dialog'>
                                                    <div class='modal-content'>
                                                        <div class='modal-header'>
                                                            <button aria-hidden='true' data-dismiss='modal' class='close' type='button'>×</button>
                                                            <h5>Konfirmasi!</h5>
                                                        </div>
                                                        <div class='modal-body'>
                                                            Apakah anda ingin memverifikasi? (Siswa : $d[nama_siswa])
                                                        </div>
                                                       <div class='modal-footer'>
                                                            <button type='button' class='btn btn-default' data-dismiss='modal'>Kembali</button>
                                                            <a href='proses_kapprog.php?a=verifikasi_tempat_prakerin_siswa&id=$d[id_prakerin]'>
                                                            <input type='submit' value='Verifikasi' name='Ganti'class='btn btn-success'></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div  style='text-transform:none' aria-hidden='true' aria-labelledby='myModalLabel' role='dialog' tabindex='-1' id='tolak$d[id_prakerin]' class='modal fade'>
                                                <div class='modal-dialog'>
                                                    <div class='modal-content'>
                                                        <div class='modal-header'>
                                                            <button aria-hidden='true' data-dismiss='modal' class='close' type='button'>×</button>
                                                            <h5>Berikan Alasan! (Pesan akan disampaikan ke Siswa : $d[nama_siswa])</h5>
                                                        </div>
                                                        <div class='modal-body'>
                                                            <div class='form-group'>
                                                                <form method='POST' action='proses_kapprog.php?a=tolak_permintaan_siswa&id=$d[id_prakerin]'>
                                                                <div class='col-lg-12'>
                                                                    <input type='text' class='form-control' name='alasan' placeholder='Berikan Alasan ....' required=''>
                                                                    <input type='hidden' name='id_du' value='$d[id_du]'>
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
