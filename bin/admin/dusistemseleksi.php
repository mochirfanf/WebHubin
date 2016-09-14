<?php

include "../koneksidb.php";

if($_SESSION['level']=='admin'){ 
    if ($_SESSION['tahun_ajaran']!='') {
        $title="DU Sistem Seleksi";
        $active ="";
        $active17 = "active";
        $navactive ="nav-active";

        $data = mysql_query( "SELECT * FROM hb_du WHERE seleksi_du ='Ya'");
        $data2 = mysql_query( "SELECT * FROM hb_du WHERE seleksi_du ='Ya'");

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


        include "leftside.php"; ?>
                
        <!--body wrapper start-->
        <div class="wrapper">
            <div class="row">
                <div class="col-sm-12">
                    <section class="panel">
                    <header class="panel-heading">
                        <label><big>DU Yang Menggunakan Sistem Seleksi</big></label>
                        <span class="pull-right">
                         <a href="#myModal" data-toggle="modal" class="btn btn-xs btn-danger">NEW</a>
                         <!-- Modal -->
                                <div  style="text-transform:none" aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                                <h5><big>Tambah Baru</big></h5>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="proses_admin.php?a=tambahseleksi"  enctype='multipart/form-data' class="form-horizontal" role="form">
                                                    <div class="form-group">
                                                        <label class="col-lg-3 col-sm-3 control-label">Nama DU</label>
                                                        <div class="col-lg-8">
                                                            <?php

                                                             echo "<select class='form-control m-bot15' name='id_du'>
                                                                      <option value=''> Pilih Tempat Prakerin </option>";
                                                                          $du = mysql_query( "SELECT * FROM hb_du WHERE status_du='Menerima' AND seleksi_du='Tidak' ORDER BY nama_du ASC");
                                                                        while($z = mysql_fetch_array($du)){
                                                                            
                                                                              echo "<option value='$z[id_du]'> $z[nama_du] </option>";
                                                                            
                                                                        }
                                                                     echo "
                                                                  </select>";
                                                              ?>
                                                        </div>
                                                    </div>
                                                
                                            </div>
                                           <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                                                <input type='submit' value='Tambahkan' name='Tambahkan'class='btn btn-success'>  </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        <!-- modal -->
                        <!-- Modal -->
                         <?php
                             while ($t = mysql_fetch_array($data2)) {
                                
                                ?>
                                <div style="text-transform:none" aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="<?php echo "atur$t[id_du]"; ?>" class="modal fade">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                                <h5><big>Tambah Keterangan</big></h5>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="<?php echo "proses_admin.php?a=ketseleksi&id=$t[id_du]"; ?>" enctype='multipart/form-data' class="form-horizontal" role="form">
                                                    <div class="form-group">
                                                        <label class="col-lg-4 col-sm-4 control-label">Tempat Seleksi</label>
                                                        <div class="col-lg-8">
                                                            <input type="text" class="form-control" name="tempat" placeholder="Tempat Seleksi">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-lg-4 col-sm-4 control-label">Tanggal Seleksi</label>
                                                        <div class="col-lg-8">
                                                            <input type="date" class="form-control" name="tanggal" placeholder="Alamat">
                                                        </div>
                                                    </div>
                                            </div>
                                           <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                                                <input type='submit' value='Tambahkan' name='Tambahkan'class='btn btn-success'>  </form>
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
                        <th>Nama Dunia Usaha</th>
                        <th>Email</th>
                        <th>Tempat Seleksi</th>
                        <th>Tanggal Seleksi</th>
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
                                        <td> $d[nama_du] </td>
                                        <td> $d[email]</td>
                                        <td> $d[seleksi_tempat]</td>
                                        <td>";
                                        if ($d["seleksi_tanggal"] == 0000-00-00) {
                                           echo "-";
                                        }else{
                                            $tanggal = tanggal($d["seleksi_tanggal"]);
                                            echo "$tanggal";
                                        }
                                        
                                 echo " </td>
                                        <td> 
                                            <a href='#atur$d[id_du]' data-toggle='modal'>
                                                <button class='btn btn-sm btn-primary' type='button'><i class='fa fa-trash-o'></i> Atur </button>
                                            </a>
                                            <a href='#edit$d[id_du]' data-toggle='modal'>
                                                <button class='btn btn-sm btn-primary' type='button'><i class='fa fa-trash-o'></i> Ganti Sistem Seleksi </button>
                                            </a>
                                        </td>
                                        <div  style='text-transform:none' aria-hidden='true' aria-labelledby='myModalLabel' role='dialog' tabindex='-1' id='edit$d[id_du]' class='modal fade'>
                                            <div class='modal-dialog'>
                                                <div class='modal-content'>
                                                    <div class='modal-header'>
                                                        <button aria-hidden='true' data-dismiss='modal' class='close' type='button'>×</button>
                                                        <h5>Konfirmasi</h5>
                                                    </div>
                                                    <div class='modal-body'>
                                                        Ganti Menjadi 'Tidak Menggunakan Sistem Seleksi' ? 
                                                    </div>
                                                    <div class='modal-footer'>
                                                        <button type='button' class='btn btn-default' data-dismiss='modal'>Kembali</button>
                                                        <a href='proses_admin.php?a=gantisistem&id=$d[id_du]'>
                                                            <input type='submit' value='Ganti' name='Ganti' class='btn btn-success'>
                                                        </a>
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

<?php       include "footer.php";
    }else{
        header('location:tahun_ajaran.php');
    }
}else{
    header('location:../login.php');
}

?>