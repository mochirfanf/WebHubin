<?php

include "../koneksidb.php";

if($_SESSION['level']=='kapprog'){
    if ($_SESSION['tahun_ajaran']!='') {
        $title="Permohonan Perizinan Prakerin";
        $active = "";
        $active16 = "active";


        $data3 = mysql_query("SELECT * FROM hb_du_umum,hb_prakerin,siswa WHERE hb_prakerin.tahun_ajaran = '$_SESSION[tahun_ajaran]' AND siswa.id_jurusan='$_SESSION[jurusan]' AND hb_du_umum.id_du = hb_prakerin.id_du AND siswa.nis = hb_prakerin.nis") or die(mysql_error());

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
                                <th>Tempat Prakerin</th>
                                <th>Pembimbing</th>
                                <th>Ubah</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $no =0;

                                    // $nisprakerin = mysql_query("SELECT COUNT (*) FROM siswa WHERE tahun_ajaran = '$_SESSION[tahun_ajaran]' AND id_jurusan='$_SESSION[jurusan]'");

                                    // $nissiswa = mysql_query("SELECT COUNT (*) FROM hb_prakerin,siswa WHERE hb_prakerin.tahun_ajaran = '$_SESSION[tahun_ajaran]' AND siswa.id_jurusan='$_SESSION[jurusan]' AND hb_prakerin.nis = siswa.nis");


                                    // if () {
                                        
                                    // }

                                    

                                    while( $d = mysql_fetch_array($data3)) {
                                        $adapem= mysql_query("SELECT nama_guru FROM hb_prakerin a INNER JOIN guru b ON a.saran_pembimbing=b.nip_guru WHERE nis='$d[nis]'");

                                        $no = $no+1;
                                        echo "
                                            <tr class='gradeA'>
                                                <td> $no </td>
                                                <td> $d[nama_siswa] </td>
                                                <td class='center'> $d[kelas] </td>
                                                <td class='center'> $d[nama_du] </td>
                                                <td class='center'>
                                                    ";
                                                    while($bb=mysql_fetch_array($adapem)){
                                                        if($bb['nama_guru']==""){
                                                        echo"-";
                                                    }
                                                        else{
                                                            echo $bb['nama_guru'];
                                                        }
                                                        
                                                    }
                                                        echo "
                                                </td>
                                                <td class='center'>
                                                    ";
                                                        echo"
                                                        <a href='#' data-toggle='modal' data-target='#pilihpem' data-nis='$d[nis]'>
                                                            <button class='btn btn-sm btn-primary' type='button'><i class='fa fa-edit'></i> Pilihkan Pembimbing </button>
                                                        </a>";
                                                    
                                                        echo "
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


<div class='modal fade' id='pilihpem' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
<?php

$gurujur = mysql_query("SELECT a.nip_guru, nama_guru FROM guru a INNER JOIN hb_guru_jurusan b ON a.nip_guru = b.nip_guru WHERE id_jurusan=$_SESSION[jurusan]");

                                    

?>
        <div class='modal-dialog'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                    <h4 class='modal-title' id='myModalLabel'>Register Perusahaan</h4> </div>
                <div class='modal-body'>
                    <form class='form-horizontal form-label-left' method='POST' action='proses_kapprog.php?a=pilihpem' enctype='multipart/form-data'>
                        
                        <label class='control-label col-md-3 col-sm-3 col-xs-12' for='name'>Pembimbing : <span class='required'></span> </label>
                        <div class="col-lg-8"><?php
                                    $name = "";
                                    echo "<input type='hidden' id='nis' name='nis'>";
                                    echo "<select required class='form-control m-bot15' name='pembimbing'>
                                            <option value=''> * Pilih Pembimbing * </option>";
                                                while($a = mysql_fetch_array($gurujur)){
                                     echo " <option value='$a[nip_guru]'> $a[nama_guru] </option>";
                                                }
                                    echo "</select>";?>
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


        <!--body wrapper end-->

<?php       include "footer.php";
    }else{
        header('location:tahun_ajaran.php');
    }
}else{
    header('location:../login.php');
}

?>
