<?php

include "../koneksidb.php";

if($_SESSION['level']=='kapprog'){ 
    if ($_SESSION['tahun_ajaran']!='') {
        $title="Daftar Siswa yang Dimonitoring";
        $active ="";
        $active84 = "active";
        $ac = "active";
        $data = mysql_query( "SELECT * FROM hb_bimbingan_tatap WHERE nis = $_GET[id]");
       
        include "leftside.php"; ?>
                
        <!--body wrapper start-->
        <div class="wrapper">
            <div class="row">
                <div class="col-sm-12">
                    <section class="panel">
                    <header class="panel-heading">
                        <big>Daftar Siswa yang Dimonitoring</big>
                         
                    </header>
                   
                    <div class="panel-body">
                    <div class="adv-table">
                    <table  class="display table table-bordered table-striped" id="dynamic-table">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Materi</th>                        
                        <th>Tanggal Bimbingan</th> 
                        <th>Status</th>
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
                                        <td> <a href='#verifikasibimbingan' data-toggle='modal' data-id='$d[id_bimbingan_tatap]'>
                                                            <button class='btn btn-sm btn-primary' type='button'><i class='fa fa-edit'></i> Verifikasi Bimbingan </button>
                                                        </a></td>
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


            <div class='modal fade' id='verifikasibimbingan' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
<?php

                                    

?>
        <div class='modal-dialog'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                    <h4 class='modal-title' id='myModalLabel'>Verifikasi Bimbingan</h4> </div>
                <div class='modal-body'>
                    <form class='form-horizontal form-label-left' method='POST' action='proses_kapprog.php?a=verifikasibimbingan' enctype='multipart/form-data'>
                        
                                    <div class='col-md-12'>
                                        <b>Verifikasi ?</b>
                                    </div><?php
                                    echo "<input type='hidden' id='id' name='id'>";
                                    echo "<input type='hidden' name='nis' value='$_GET[id]'>";
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

        <!--body wrapper end-->

<?php       include "footer.php";
    }else{
        header('location:tahun_ajaran.php');
    }
}else{
    header('location:../login.php');
}

?>