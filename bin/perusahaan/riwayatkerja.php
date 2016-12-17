<?php

include "../koneksidb.php";

if($_SESSION['level']=='perusahaan'){
        $title="Lamaran Aktif";
        $active ="";
        $active54 = "active";
        $navactive6 ="nav-active";

        $data = mysql_query( "SELECT * from hb_du_permintaan_kerja WHERE id_du='$_SESSION[id_du]' AND status_permintaan='Ditutup' ORDER BY id_du_kerja DESC")or die(mysql_error());

        include "leftside.php"; ?>

        <!--body wrapper start-->
        <div class="wrapper">
            <div class="row">
                <div class="col-sm-12">
                    <section class="panel">
                    <header class="panel-heading">
                        <big>Riwayat Permintaan</big>
                         <span class="pull-right">

                         </span>
                    </header>

                    <div class="panel-body">
                    <div class="adv-table">
                    <table  class="display table table-bordered table-striped" id="dynamic-table">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>CP</th>
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
                                        <td> $d[judul] </td>
                                        <td> $d[cp]</td>
                                        <td> $d[status_permintaan]</td>
                                        <td class='center'>
                                            <a href='detail_riwayat.php?id=$d[id_du_kerja]'>
                                                <button class='btn btn-sm btn-primary' type='button'><i class='fa fa-check'></i> Detail Pekerjaan </button>
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
        <!--body wrapper end-->

<?php       include "footer.php";
    
}else{
    header('location:../login.php');
}

?>
