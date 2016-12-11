<?php

include "../koneksidb.php";

if($_SESSION['level']=='siswa'){
    if ($_SESSION['tahun_ajaran']!='') {
        $title="Permohonan Perizinan Prakerin";
        $active ="";
        $active90 = "active";
        $navactive78 ="nav-active";
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
        $data = mysql_query( "SELECT * from hb_bimbingan_tatap WHERE nis='$_SESSION[username]'");

        include "leftside.php"; ?>

        <!--body wrapper start-->
        <div class="wrapper">
            <div class="row">
                <div class="col-sm-12">
                    <section class="panel">
                    <header class="panel-heading">
                        <big>Bimbingan Tatap Muka</big>
                         <span class="pull-right">

                         </span>
                    </header>
                    <a href='#tambah' data-toggle='modal'><span class='btn btn-primary' style='float:right;margin:20px;'>Tambah Bimbingan</span></a>
                    <div class="panel-body">
                    <div class="adv-table">
                    <table  class="display table table-bordered table-striped" id="dynamic-table">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Materi</th>
                        <th>Tanggal</th>
                        <th>Verifikasi</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                            $no =0;
                            while ($d = mysql_fetch_array($data)) {
                                $no = $no+1;
                                echo "
                                    <tr class='gradeA'>
                                        <td> $no </td>
                                        <td> $d[materi] </td>
                                        <td> $d[tanggal_bimbingan] </td>
                                        <td> $d[status] </td>
                                        <td class='center'>
                                            <a href='#hapus2' data-toggle='modal' data-id='$d[id_bimbingan_tatap]'>
                                                <button class='btn btn-sm btn-danger' type='button'><i class='fa fa-trash'></i> Hapus </button>
                                            </a>
                                            <a href='#update2' data-toggle='modal' data-id='$d[id_bimbingan_tatap]'>
                                                <button class='btn btn-sm btn-info' type='button'><i class='fa fa-check'></i> Ubah </button>
                                            </a>
                                        </td>
                                    </tr>
                                    ";
                            }
                        ?>
                    </tbody>
                    </table>
                    </div>
                    </div>
                    <label> <br>
                    </label>
                    </section>
                </div>
            </div>
        </div>

            <div class='modal fade' id='tambah' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
<?php

                                    

?>
        <div class='modal-dialog'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                    <h4 class='modal-title' id='myModalLabel'>Tambah Bimbingan</h4> </div>
                <div class='modal-body'>
                    <form class='form-horizontal form-label-left' method='POST' action='proses_siswa.php?a=tambahbimbingan' enctype='multipart/form-data'>
                        <div class='item form-group'>
                                <label class='control-label col-md-3 col-sm-3 col-xs-12' for='name'>Materi : <span class='required'></span> </label>
                                <div class='col-md-7 col-sm-9 col-xs-12' style='margin-bottom:20px;'>
                                <textarea class='form-control col-md-12 col-xs-12' id='portofolio' name='materi' required></textarea>
                                 </div>

                            </div>
                        <div class='item form-group'>
                                <label class='control-label col-md-3 col-sm-3 col-xs-12' for='name'>Tanggal : <span class='required'></span> </label>
                                <div class='col-md-7 col-sm-9 col-xs-12' style='margin-bottom:20px;'>
                                <input type='text' class='form-control col-md-12 col-xs-12 dpd1' id='portofolio' data-date-format='yyyy/mm/dd' name='tanggal' required>
                                 </div>
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


                <div class='modal fade' id='hapus2' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
<?php

                                    

?>
        <div class='modal-dialog'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                    <h4 class='modal-title' id='myModalLabel'>Terima Lamaran Pekerjaan</h4> </div>
                <div class='modal-body'>
                    <form class='form-horizontal form-label-left' method='POST' action='proses_siswa.php?a=hapuskegiatan' enctype='multipart/form-data'>
                        
                                    <div class='col-md-12'>
                                        <b>Hapus Kegiatan ?</span> ?</b>
                                    </div><?php
                                    echo "<input type='hidden' id='id' name='id'>";
                                    ?>
                </div>
                <div class='modal-footer'>
                    <div class='form-group'>
                        <div class='col-md-4 col-md-offset-8'>
                            <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
                            <button style=' margin-top: -5px;' value='Ya' id='send' type='submit' class='btn btn-success' name='pilih'>Ya</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


                <div class='modal fade' id='update2' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
<?php

                                    

?>
        <div class='modal-dialog'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                    <h4 class='modal-title' id='myModalLabel'>Update Kegiatan</h4> </div>
                <div class='modal-body'>
                    <form class='form-horizontal form-label-left' method='POST' action='proses_siswa.php?a=ubahkegiatanprakerin' enctype='multipart/form-data'>
                        <div class='item form-group'>
                        <input type='hidden' id='id' name='id'>
                                <label class='control-label col-md-3 col-sm-3 col-xs-12' for='name'>Kegiatan : <span class='required'></span> </label>
                                <div class='col-md-7 col-sm-9 col-xs-12' style='margin-bottom:20px;'>
                                <textarea class='form-control col-md-12 col-xs-12' id='kegiatan' name='kegiatan' required></textarea>
                                 </div>

                            </div>
                        <div class='item form-group'>
                                <label class='control-label col-md-3 col-sm-3 col-xs-12' for='name'>Minggu Ke : <span class='required'></span> </label>
                                <div class='col-md-7 col-sm-9 col-xs-12' style='margin-bottom:20px;'>
                                <input type='text' class='form-control col-md-12 col-xs-12' id='mk' name='mingguke' required>

                                 </div>
                            </div>
                </div>
                <div class='modal-footer'>
                    <div class='form-group'>
                        <div class='col-md-4 col-md-offset-8'>
                            <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
                            <button style=' margin-top: -5px;' value='pilih' id='send' type='submit' class='btn btn-success' name='pilih'>Ubah</button>
                        </div>
                    </div>
                    </form>
                </div>
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
