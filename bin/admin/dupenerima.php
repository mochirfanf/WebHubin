<?php

include "../koneksidb.php";

if($_SESSION['level']=='admin'){ 
    if ($_SESSION['tahun_ajaran']!='') {
        $title="Yang Menerima Prakerin";
        $active = "";
        $active2 = "active";
        $navactive ="nav-active";


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


        function judultabel(){
            echo "  <th>No</th>
                    <th>Nama Dunia Usaha</th>
                    <th> Jumlah Penerimaan</th>
                    <th>Sisa Kuota Penerimaan</th>
                    <th>Sistem Seleksi</th>
                    <th>Aksi</th>";
        }
        function isinya($query){
                $no =0;
                while ($d = mysql_fetch_array($query)) {
                    $mulai = tanggal($d["mulai_pelaksanaan"]);
                    $berakhir = tanggal($d["berakhir_pelaksanaan"]);
                    $no = $no+1;
                    echo "
                    <tr class='gradeA'>
                        <td> $no </td>
                        <td> $d[nama_du] </td>
                        <td> $d[jumlah_penerimaan] orang</td>
                        <td> ";
                            if ($d["sisa_kuota_penerimaan"] == 0) {
                                echo "Telah Terpenuhi";
                            }else{
                                echo "$d[sisa_kuota_penerimaan] orang";
                            }
                  echo "</td>
                        <td> $d[seleksi_du]</td>
                        <td class='center'>                                         
                            <a href='#jedit$d[id_du]-$d[id_jurusan]' data-toggle='modal'>
                                <button class='btn btn-sm btn-primary' type='button'><i class='fa fa-trash-o'></i> Edit </button>
                            </a>
                            <a href='#jhapus$d[id_du]-$d[id_jurusan]' data-toggle='modal'>
                                <button class='btn btn-sm btn-primary' type='button'><i class='fa fa-trash-o'></i> Hapus </button>
                            </a>
                        </td>
                            <div  style='text-transform:none' aria-hidden='true' aria-labelledby='myModalLabel' role='dialog' tabindex='-1' id='jhapus$d[id_du]-$d[id_jurusan]' class='modal fade'>
                                <div class='modal-dialog'>
                                    <div class='modal-content'>
                                        <div class='modal-header'>
                                            <button aria-hidden='true' data-dismiss='modal' class='close' type='button'>×</button>
                                            <h5>Konfirmasi</h5>
                                        </div>
                                        <div class='modal-body'>
                                            Hapus Penerimaan '$d[nama_du]' untuk jurusan "; 
                                            $j = mysql_fetch_array(mysql_query("SELECT * FROM jurusan WHERE id_jurusan = $d[id_jurusan]"));
                                            echo "$j[singkatan]? <br>

                                            Jika Anda Menghapusnya, Siswa yang telah mendaftar di DU ini akan terhapus!
                                        </div>
                                        <div class='modal-footer'>
                                            <button type='button' class='btn btn-default' data-dismiss='modal'>Kembali</button>
                                            <a href='proses_admin.php?a=hapuspenerimajurusan&id=$d[id_du]&id_jurusan=$d[id_jurusan]'>
                                                <input type='submit' value='Hapus' name='Ganti'class='btn btn-success'>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </tr>";
                 }
        }

        function isinyajur($query4){
               
                             while ($t = mysql_fetch_array($query4)) {
                                ?>
                                <div  style="text-transform:none" aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="<?php echo "jedit$t[id_du]-$t[id_jurusan]"; 
                                    $e = mysql_fetch_array(mysql_query("SELECT * FROM hb_du_penerima WHERE id_du = '$t[id_du]' AND id_jurusan = $t[id_jurusan]"))?>" class="modal fade">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                                <h5><big>Jumlah Penerimaan</big></h5>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="proses_admin.php?a=editjpenerima<?php echo "&id=$t[id_du]&id_jurusan=$t[id_jurusan]";?>"  enctype='multipart/form-data' class="form-horizontal" role="form">
                                                   
                                                    <div class="form-group">
                                                        
                                                        <div class="col-lg-offset-2 col-lg-8">
                                                            <input type="text" class="form-control" name="jpen" value="<?php echo "$e[jumlah_penerimaan]"; ?>" placeholder="Nama Dunia Usaha">
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
                        <header class="panel-heading custom-tab blue-tab">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a data-toggle="tab" href="#home">
                                        <i class="fa fa-home"></i>
                                    </a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#rpl">
                                        <i class="fa fa-location-arrow"></i>
                                        RPL
                                    </a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#toi">
                                        <i class="fa fa-location-arrow"></i>
                                        TOI
                                    </a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#km">
                                        <i class="fa fa-location-arrow"></i>
                                        KM
                                    </a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#kp">
                                        <i class="fa fa-location-arrow"></i>
                                        KP
                                    </a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#tek">
                                        <i class="fa fa-location-arrow"></i>
                                        TEK
                                    </a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#tei">
                                        <i class="fa fa-location-arrow"></i>
                                        TEI
                                    </a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#tkj">
                                        <i class="fa fa-location-arrow"></i>
                                        TKJ
                                    </a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#tp4">
                                        <i class="fa fa-location-arrow"></i>
                                        TP4
                                    </a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#tptu">
                                        <i class="fa fa-location-arrow"></i>
                                        TPTU
                                    </a>
                                </li>
                            </ul>
                        </header>
                        <!-- modal -->
                        <?php
                             $data2 = mysql_query( "select * from hb_du WHERE status_du='Menerima'");
                             while ($t = mysql_fetch_array($data2)) {
                                ?>
                                <div  style="text-transform:none" aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="<?php echo "edit$t[id_du]"; 
                                    $e = mysql_fetch_array(mysql_query("SELECT * FROM hb_du WHERE id_du = '$t[id_du]'"))?>" class="modal fade">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                                <h5><big>Tambah Baru</big></h5>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="proses_admin.php?a=editpenerima<?php echo "&id=$t[id_du]";?>"  enctype='multipart/form-data' class="form-horizontal" role="form">
                                                   
                                                    <div class="form-group">
                                                        <label class="col-lg-2 col-sm-2 control-label">Nama DU</label>
                                                        <div class="col-lg-10">
                                                            <input type="text" class="form-control" name="nama_du" value="<?php echo "$e[nama_du]"; ?>" placeholder="Nama Dunia Usaha">
                                                        </div>
                                                    </div>
                                                     <div class="form-group">
                                                        <label class="col-lg-2 col-sm-2 control-label">Alamat</label>
                                                        <div class="col-lg-10">
                                                            <input type="text" class="form-control" name="alamat" value="<?php echo "$e[alamat]"; ?>" placeholder="Alamat">
                                                        </div>
                                                    </div>
                                                     <div class="form-group">
                                                        <label class="col-lg-2 col-sm-2 control-label">Kota</label>
                                                        <div class="col-lg-10">
                                                            <input type="text" class="form-control" name="kota" value="<?php echo "$e[kota]"; ?>"placeholder="Kota ">
                                                        </div>
                                                    </div>
                                                     <div class="form-group">
                                                        <label class="col-lg-2 col-sm-2 control-label">Email</label>
                                                        <div class="col-lg-10">
                                                            <input type="email" class="form-control" name="email" value="<?php echo "$e[email]"; ?>" placeholder="Email">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-lg-2 col-sm-2 control-label">Keterangan</label>
                                                        <div class="col-lg-10">
                                                            <input class="form-control" value="<?php echo "$e[keterangan_du]"; ?>" name="keterangan" placeholder="Keterangan">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-lg-4 col-sm-4 control-label">Nama Penanggung Jawab</label>
                                                        <div class="col-lg-8">
                                                            <input type="text" class="form-control" value="<?php echo "$e[nama_penanggung_jawab]"; ?>" name="nama_pj" placeholder="Nama Penanggung Jawab">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-lg-4 col-sm-4 control-label">Mulai Pelaksanaan</label>
                                                        <div class="col-lg-8">
                                                            <input type="date" class="form-control" name="mulai" value="<?php echo "$e[mulai_pelaksanaan]"; ?>"placeholder="Alamat">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-lg-4 col-sm-4 control-label">Berakhir Pelaksanaan</label>
                                                        <div class="col-lg-8">
                                                            <input type="date" class="form-control" name="berakhir" value="<?php echo "$e[berakhir_pelaksanaan]"; ?>"placeholder="Kota ">
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

                        <div class="panel-body">
                            <div class="tab-content">
                                <div id="home" class="tab-pane active">
                                    <div class="panel-body">
                                        <div class="adv-table">
                                        <table  class="display table table-bordered table-striped" id="dynamic-table">
                                        <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Dunia Usaha</th>
                                            <th>Pelaksanaan</th>
                                            <th>Alamat</th>
                                            <th>Email</th>
                                            <th>Jurusan</th>
                                            <th>Aksi</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                            $query = mysql_query( "select * from hb_du WHERE status_du='Menerima'");
                                            $no =0;
                                            while ($d = mysql_fetch_array($query)) {
                                                $mulai = tanggal($d["mulai_pelaksanaan"]);
                                                $berakhir = tanggal($d["berakhir_pelaksanaan"]);
                                                $no = $no+1;
                                                echo "
                                                <tr class='gradeA'>
                                                    <td> $no </td>
                                                    <td> $d[nama_du] </td>
                                                    <td> $mulai s/d $berakhir </td>
                                                    <td> $d[alamat]</td>
                                                    <td> $d[email]</td>
                                                    <td> ";
                                                        $juru = mysql_query("SELECT DISTINCT jurusan.singkatan FROM jurusan, hb_du_penerima WHERE jurusan.id_jurusan = hb_du_penerima.id_jurusan AND id_du = $d[id_du]");
                                                        while ($jur=mysql_fetch_array($juru)) {
                                                           echo "$jur[singkatan]; ";
                                                        }
                                            echo "  </td>
                                                    <td class='center'>                                         
                                                        <a href='#edit$d[id_du]' data-toggle='modal'>
                                                            <button class='btn btn-sm btn-primary' type='button'><i class='fa fa-trash-o'></i> Lihat - Edit </button>
                                                        </a> <br> <br>
                                                        <a href='#hapus$d[id_du]' data-toggle='modal'>
                                                            <button class='btn btn-sm btn-primary' type='button'><i class='fa fa-trash-o'></i> Hapus DU </button>
                                                        </a>
                                                    </td>
                                                        <div  style='text-transform:none' aria-hidden='true' aria-labelledby='myModalLabel' role='dialog' tabindex='-1' id='hapus$d[id_du]' class='modal fade'>
                                                            <div class='modal-dialog'>
                                                                <div class='modal-content'>
                                                                    <div class='modal-header'>
                                                                        <button aria-hidden='true' data-dismiss='modal' class='close' type='button'>×</button>
                                                                        <h5>Konfirmasi</h5>
                                                                    </div>
                                                                    <div class='modal-body'>
                                                                        Anda Yakin Ingin Menghapusnya?<br><br>
                                                                        Jika Anda Menghapusnya, akan ada juga sistem yang terhapus dengan DU yang bersangkutan! Seperti siswa yang telah mendaftar untuk berprakerin di tempat ini!
                                                                    </div>
                                                                    <div class='modal-footer'>
                                                                        <button type='button' class='btn btn-default' data-dismiss='modal'>Kembali</button>
                                                                        <a href='proses_admin.php?a=hapus_penerima&id=$d[id_du]'>
                                                                            <input type='submit' value='Hapus' name='Ganti'class='btn btn-success'>
                                                                        </a>
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
                                <div id="rpl" class="tab-pane ">
                                    <div class="panel-body">
                                        <span class="pull-right">
                                            <a href="#baru1" data-toggle="modal" class="btn btn-xs btn-danger">NEW</a>
                                        </span> <br><br><br>
                                        <!-- modal -->
                
                                <div  style="text-transform:none" aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="baru1" class="modal fade">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                                <h5><big>Tambahkan DU Penerima</big></h5>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="proses_admin.php?a=tambahpenerimajur&id=1"  enctype='multipart/form-data' class="form-horizontal" role="form">
                                                   
                                                    <div class="form-group">
                                                        <label class="col-lg-4 col-sm-4 control-label">Nama DU</label>
                                                        <div class="col-lg-8">
                                                            <?php

                                                             echo "<select class='form-control m-bot15' name='id_du'>
                                                                      <option value=''> Pilih Tempat Prakerin </option>";
                                                                          $du = mysql_query( "SELECT * FROM hb_du WHERE status_du='Menerima' ORDER BY nama_du ASC");
                                                                        while($z = mysql_fetch_array($du)){
                                                                            $data3 = mysql_query( "SELECT * FROM hb_du_penerima WHERE id_jurusan = '1' AND id_du = '$z[id_du]'");
                                                                            $jumlah = mysql_fetch_row($data3);
                                                                            if ($jumlah > 0) {
                                                                              continue;
                                                                            }else{
                                                                              echo "<option value='$z[id_du]'> $z[nama_du] </option>";
                                                                            } 
                                                                        }
                                                                     echo "
                                                                  </select>";
                                                              ?>
                                                        </div>
                                                    </div>
                                                     <div class="form-group">
                                                        <label class="col-lg-4 col-sm-4 control-label">Jumlah Penerimaan</label>
                                                        <div class="col-lg-8">
                                                            <input type="text" class="form-control" name="jumlah" placeholder="Jumlah Penerimaan">
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

                                        <div class="adv-table">
                                            <!--<a href='' class='btn btn-warning'> Cetak </a> <br><br> -->
                                        <table  class="display table table-bordered table-striped" id="dynamic-table">
                                        <thead>
                                        <tr>
                                            <?php judultabel() ?>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $query = mysql_query( "SELECT * from hb_du,hb_du_penerima WHERE hb_du.id_du = hb_du_penerima.id_du AND id_jurusan = 1 AND status_du='Menerima'");
                                                $query4 = mysql_query( "SELECT * from hb_du,hb_du_penerima WHERE hb_du.id_du = hb_du_penerima.id_du AND id_jurusan = 1 AND status_du='Menerima'");
                                                isinya($query);
                                                isinyajur($query4);
                                            ?>
                                        </tbody>
                                        </table>
                                        </div>
                                    </div>
                                </div>
                                <div id="toi" class="tab-pane "> <!-- id= 7 -->
                                    <div class="panel-body">
                                        <span class="pull-right">
                                            <a href="#baru7" data-toggle="modal" class="btn btn-xs btn-danger">NEW</a>
                                        </span> <br><br><br>
                                        <!-- modal -->
                
                                <div  style="text-transform:none" aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="baru7" class="modal fade">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                                <h5><big>Tambahkan DU Penerima</big></h5>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="proses_admin.php?a=tambahpenerimajur&id=7"  enctype='multipart/form-data' class="form-horizontal" role="form">
                                                   
                                                    <div class="form-group">
                                                        <label class="col-lg-4 col-sm-4 control-label">Nama DU</label>
                                                        <div class="col-lg-8">
                                                            <?php

                                                             echo "<select class='form-control m-bot15' name='id_du'>
                                                                      <option value=''> Pilih Tempat Prakerin </option>";
                                                                          $du = mysql_query( "SELECT * FROM hb_du WHERE status_du='Menerima' ORDER BY nama_du ASC");
                                                                        while($z = mysql_fetch_array($du)){
                                                                            $data3 = mysql_query( "SELECT * FROM hb_du_penerima WHERE id_jurusan = '7' AND id_du = '$z[id_du]'");
                                                                            $jumlah = mysql_fetch_row($data3);
                                                                            if ($jumlah > 0) {
                                                                              continue;
                                                                            }else{
                                                                              echo "<option value='$z[id_du]'> $z[nama_du] </option>";
                                                                            } 
                                                                        }
                                                                     echo "
                                                                  </select>";
                                                              ?>
                                                        </div>
                                                    </div>
                                                     <div class="form-group">
                                                        <label class="col-lg-4 col-sm-4 control-label">Jumlah Penerimaan</label>
                                                        <div class="col-lg-8">
                                                            <input type="text" class="form-control" name="jumlah" placeholder="Jumlah Penerimaan">
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

                                        <div class="adv-table">
                                            <!--<a href='' class='btn btn-warning'> Cetak </a> <br><br> -->
                                        <table  class="display table table-bordered table-striped" id="dynamic-table">
                                        <thead>
                                        <tr>
                                            <?php judultabel() ?>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $query = mysql_query( "SELECT * from hb_du,hb_du_penerima WHERE hb_du.id_du = hb_du_penerima.id_du AND id_jurusan = 7 AND status_du='Menerima'");
                                                $query4 = mysql_query( "SELECT * from hb_du,hb_du_penerima WHERE hb_du.id_du = hb_du_penerima.id_du AND id_jurusan = 7 AND status_du='Menerima'");
                                                isinya($query);
                                                isinyajur($query4);
                                            ?>
                                        </tbody>
                                        </table>
                                        </div>
                                    </div>
                                </div>

                                <div id="km" class="tab-pane "> <!-- id= 2 -->
                                    <div class="panel-body">
                                        <span class="pull-right">
                                            <a href="#baru2" data-toggle="modal" class="btn btn-xs btn-danger">NEW</a>
                                        </span> <br><br><br>
                                        <!-- modal -->
                
                                <div  style="text-transform:none" aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="baru2" class="modal fade">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                                <h5><big>Tambahkan DU Penerima</big></h5>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="proses_admin.php?a=tambahpenerimajur&id=2"  enctype='multipart/form-data' class="form-horizontal" role="form">
                                                   
                                                    <div class="form-group">
                                                        <label class="col-lg-4 col-sm-4 control-label">Nama DU</label>
                                                        <div class="col-lg-8">
                                                            <?php

                                                             echo "<select class='form-control m-bot15' name='id_du'>
                                                                      <option value=''> Pilih Tempat Prakerin </option>";
                                                                          $du = mysql_query( "SELECT * FROM hb_du WHERE status_du='Menerima' ORDER BY nama_du ASC");
                                                                        while($z = mysql_fetch_array($du)){
                                                                            $data3 = mysql_query( "SELECT * FROM hb_du_penerima WHERE id_jurusan = '2' AND id_du = '$z[id_du]'");
                                                                            $jumlah = mysql_fetch_row($data3);
                                                                            if ($jumlah > 0) {
                                                                              continue;
                                                                            }else{
                                                                              echo "<option value='$z[id_du]'> $z[nama_du] </option>";
                                                                            } 
                                                                        }
                                                                     echo "
                                                                  </select>";
                                                              ?>
                                                        </div>
                                                    </div>
                                                     <div class="form-group">
                                                        <label class="col-lg-4 col-sm-4 control-label">Jumlah Penerimaan</label>
                                                        <div class="col-lg-8">
                                                            <input type="text" class="form-control" name="jumlah" placeholder="Jumlah Penerimaan">
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

                                        <div class="adv-table">
                                            <!--<a href='' class='btn btn-warning'> Cetak </a> <br><br> -->
                                        <table  class="display table table-bordered table-striped" id="dynamic-table">
                                        <thead>
                                        <tr>
                                            <?php judultabel() ?>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $query = mysql_query( "SELECT * from hb_du,hb_du_penerima WHERE hb_du.id_du = hb_du_penerima.id_du AND id_jurusan = 2 AND status_du='Menerima'");
                                                $query4 = mysql_query( "SELECT * from hb_du,hb_du_penerima WHERE hb_du.id_du = hb_du_penerima.id_du AND id_jurusan = 2 AND status_du='Menerima'");
                                                isinya($query);
                                                isinyajur($query4);
                                            ?>
                                        </tbody>
                                        </table>
                                        </div>
                                    </div>
                                </div>

                                <div id="kp" class="tab-pane "> <!-- id= 3 -->
                                    <div class="panel-body">
                                        <span class="pull-right">
                                            <a href="#baru3" data-toggle="modal" class="btn btn-xs btn-danger">NEW</a>
                                        </span> <br><br><br>
                                        <!-- modal -->
                
                                <div  style="text-transform:none" aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="baru3" class="modal fade">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                                <h5><big>Tambahkan DU Penerima</big></h5>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="proses_admin.php?a=tambahpenerimajur&id=3"  enctype='multipart/form-data' class="form-horizontal" role="form">
                                                   
                                                    <div class="form-group">
                                                        <label class="col-lg-4 col-sm-4 control-label">Nama DU</label>
                                                        <div class="col-lg-8">
                                                            <?php

                                                             echo "<select class='form-control m-bot15' name='id_du'>
                                                                      <option value=''> Pilih Tempat Prakerin </option>";
                                                                          $du = mysql_query( "SELECT * FROM hb_du WHERE status_du='Menerima' ORDER BY nama_du ASC");
                                                                        while($z = mysql_fetch_array($du)){
                                                                            $data3 = mysql_query( "SELECT * FROM hb_du_penerima WHERE id_jurusan = '3' AND id_du = '$z[id_du]'");
                                                                            $jumlah = mysql_fetch_row($data3);
                                                                            if ($jumlah > 0) {
                                                                              continue;
                                                                            }else{
                                                                              echo "<option value='$z[id_du]'> $z[nama_du] </option>";
                                                                            } 
                                                                        }
                                                                     echo "
                                                                  </select>";
                                                              ?>
                                                        </div>
                                                    </div>
                                                     <div class="form-group">
                                                        <label class="col-lg-4 col-sm-4 control-label">Jumlah Penerimaan</label>
                                                        <div class="col-lg-8">
                                                            <input type="text" class="form-control" name="jumlah" placeholder="Jumlah Penerimaan">
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

                                        <div class="adv-table">
                                            <!--<a href='' class='btn btn-warning'> Cetak </a> <br><br> -->
                                        <table  class="display table table-bordered table-striped" id="dynamic-table">
                                        <thead>
                                        <tr>
                                            <?php judultabel() ?>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $query = mysql_query( "SELECT * from hb_du,hb_du_penerima WHERE hb_du.id_du = hb_du_penerima.id_du AND id_jurusan = 3 AND status_du='Menerima'");
                                                $query4 = mysql_query( "SELECT * from hb_du,hb_du_penerima WHERE hb_du.id_du = hb_du_penerima.id_du AND id_jurusan = 3 AND status_du='Menerima'");
                                                isinya($query);
                                                isinyajur($query4);
                                            ?>
                                        </tbody>
                                        </table>
                                        </div>
                                    </div>
                                </div>

                                <div id="tek" class="tab-pane "> <!-- id= 5 -->
                                    <div class="panel-body">
                                        <span class="pull-right">
                                            <a href="#baru5" data-toggle="modal" class="btn btn-xs btn-danger">NEW</a>
                                        </span> <br><br><br>
                                        <!-- modal -->
                
                                <div  style="text-transform:none" aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="baru5" class="modal fade">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                                <h5><big>Tambahkan DU Penerima</big></h5>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="proses_admin.php?a=tambahpenerimajur&id=5"  enctype='multipart/form-data' class="form-horizontal" role="form">
                                                   
                                                    <div class="form-group">
                                                        <label class="col-lg-4 col-sm-4 control-label">Nama DU</label>
                                                        <div class="col-lg-8">
                                                            <?php

                                                             echo "<select class='form-control m-bot15' name='id_du'>
                                                                      <option value=''> Pilih Tempat Prakerin </option>";
                                                                          $du = mysql_query( "SELECT * FROM hb_du WHERE status_du='Menerima' ORDER BY nama_du ASC");
                                                                        while($z = mysql_fetch_array($du)){
                                                                            $data3 = mysql_query( "SELECT * FROM hb_du_penerima WHERE id_jurusan = '5' AND id_du = '$z[id_du]'");
                                                                            $jumlah = mysql_fetch_row($data3);
                                                                            if ($jumlah > 0) {
                                                                              continue;
                                                                            }else{
                                                                              echo "<option value='$z[id_du]'> $z[nama_du] </option>";
                                                                            } 
                                                                        }
                                                                     echo "
                                                                  </select>";
                                                              ?>
                                                        </div>
                                                    </div>
                                                     <div class="form-group">
                                                        <label class="col-lg-4 col-sm-4 control-label">Jumlah Penerimaan</label>
                                                        <div class="col-lg-8">
                                                            <input type="text" class="form-control" name="jumlah" placeholder="Jumlah Penerimaan">
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

                                        <div class="adv-table">
                                            <!--<a href='' class='btn btn-warning'> Cetak </a> <br><br> -->
                                        <table  class="display table table-bordered table-striped" id="dynamic-table">
                                        <thead>
                                        <tr>
                                            <?php judultabel() ?>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $query = mysql_query( "SELECT * from hb_du,hb_du_penerima WHERE hb_du.id_du = hb_du_penerima.id_du AND id_jurusan = 5 AND status_du='Menerima'");
                                                $query4 = mysql_query( "SELECT * from hb_du,hb_du_penerima WHERE hb_du.id_du = hb_du_penerima.id_du AND id_jurusan = 5 AND status_du='Menerima'");
                                                isinya($query);
                                                isinyajur($query4);
                                            ?>
                                        </tbody>
                                        </table>
                                        </div>
                                    </div>
                                </div>

                                <div id="tei" class="tab-pane "> <!-- id= 4 -->
                                    <div class="panel-body">
                                        <span class="pull-right">
                                            <a href="#baru4" data-toggle="modal" class="btn btn-xs btn-danger">NEW</a>
                                        </span> <br><br><br>
                                        <!-- modal -->
                
                                <div  style="text-transform:none" aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="baru4" class="modal fade">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                                <h5><big>Tambahkan DU Penerima</big></h5>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="proses_admin.php?a=tambahpenerimajur&id=4"  enctype='multipart/form-data' class="form-horizontal" role="form">
                                                   
                                                    <div class="form-group">
                                                        <label class="col-lg-4 col-sm-4 control-label">Nama DU</label>
                                                        <div class="col-lg-8">
                                                            <?php

                                                             echo "<select class='form-control m-bot15' name='id_du'>
                                                                      <option value=''> Pilih Tempat Prakerin </option>";
                                                                          $du = mysql_query( "SELECT * FROM hb_du WHERE status_du='Menerima' ORDER BY nama_du ASC");
                                                                        while($z = mysql_fetch_array($du)){
                                                                            $data3 = mysql_query( "SELECT * FROM hb_du_penerima WHERE id_jurusan = '4' AND id_du = '$z[id_du]'");
                                                                            $jumlah = mysql_fetch_row($data3);
                                                                            if ($jumlah > 0) {
                                                                              continue;
                                                                            }else{
                                                                              echo "<option value='$z[id_du]'> $z[nama_du] </option>";
                                                                            } 
                                                                        }
                                                                     echo "
                                                                  </select>";
                                                              ?>
                                                        </div>
                                                    </div>
                                                     <div class="form-group">
                                                        <label class="col-lg-4 col-sm-4 control-label">Jumlah Penerimaan</label>
                                                        <div class="col-lg-8">
                                                            <input type="text" class="form-control" name="jumlah" placeholder="Jumlah Penerimaan">
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

                                        <div class="adv-table">
                                            <!--<a href='' class='btn btn-warning'> Cetak </a> <br><br> -->
                                        <table  class="display table table-bordered table-striped" id="dynamic-table">
                                        <thead>
                                        <tr>
                                            <?php judultabel() ?>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $query = mysql_query( "SELECT * from hb_du,hb_du_penerima WHERE hb_du.id_du = hb_du_penerima.id_du AND id_jurusan = 4 AND status_du='Menerima'");
                                                $query4 = mysql_query( "SELECT * from hb_du,hb_du_penerima WHERE hb_du.id_du = hb_du_penerima.id_du AND id_jurusan = 4 AND status_du='Menerima'");
                                                isinya($query);
                                                isinyajur($query4);
                                            ?>
                                        </tbody>
                                        </table>
                                        </div>
                                    </div>
                                </div>
                                <div id="tkj" class="tab-pane "> <!-- id= 6 -->
                                    <div class="panel-body">
                                        <span class="pull-right">
                                            <a href="#baru6" data-toggle="modal" class="btn btn-xs btn-danger">NEW</a>
                                        </span> <br><br><br>
                                        <!-- modal -->
                
                                <div  style="text-transform:none" aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="baru6" class="modal fade">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                                <h5><big>Tambahkan DU Penerima</big></h5>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="proses_admin.php?a=tambahpenerimajur&id=6"  enctype='multipart/form-data' class="form-horizontal" role="form">
                                                   
                                                    <div class="form-group">
                                                        <label class="col-lg-4 col-sm-4 control-label">Nama DU</label>
                                                        <div class="col-lg-8">
                                                            <?php

                                                             echo "<select class='form-control m-bot15' name='id_du'>
                                                                      <option value=''> Pilih Tempat Prakerin </option>";
                                                                          $du = mysql_query( "SELECT * FROM hb_du WHERE status_du='Menerima' ORDER BY nama_du ASC");
                                                                        while($z = mysql_fetch_array($du)){
                                                                            $data3 = mysql_query( "SELECT * FROM hb_du_penerima WHERE id_jurusan = '6' AND id_du = '$z[id_du]'");
                                                                            $jumlah = mysql_fetch_row($data3);
                                                                            if ($jumlah > 0) {
                                                                              continue;
                                                                            }else{
                                                                              echo "<option value='$z[id_du]'> $z[nama_du] </option>";
                                                                            } 
                                                                        }
                                                                     echo "
                                                                  </select>";
                                                              ?>
                                                        </div>
                                                    </div>
                                                     <div class="form-group">
                                                        <label class="col-lg-4 col-sm-4 control-label">Jumlah Penerimaan</label>
                                                        <div class="col-lg-8">
                                                            <input type="text" class="form-control" name="jumlah" placeholder="Jumlah Penerimaan">
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

                                        <div class="adv-table">
                                            <!--<a href='' class='btn btn-warning'> Cetak </a> <br><br> -->
                                        <table  class="display table table-bordered table-striped" id="dynamic-table">
                                        <thead>
                                        <tr>
                                            <?php judultabel() ?>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $query = mysql_query( "SELECT * from hb_du,hb_du_penerima WHERE hb_du.id_du = hb_du_penerima.id_du AND id_jurusan = 6 AND status_du='Menerima'");
                                                $query4 = mysql_query( "SELECT * from hb_du,hb_du_penerima WHERE hb_du.id_du = hb_du_penerima.id_du AND id_jurusan = 6 AND status_du='Menerima'");
                                                isinya($query);
                                                isinyajur($query4);
                                            ?>
                                        </tbody>
                                        </table>
                                        </div>
                                    </div>
                                </div>

                                <div id="tp4" class="tab-pane "> <!-- id= 8 -->
                                    <div class="panel-body">
                                        <span class="pull-right">
                                            <a href="#baru8" data-toggle="modal" class="btn btn-xs btn-danger">NEW</a>
                                        </span> <br><br><br>
                                        <!-- modal -->
                
                                <div  style="text-transform:none" aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="baru8" class="modal fade">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                                <h5><big>Tambahkan DU Penerima</big></h5>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="proses_admin.php?a=tambahpenerimajur&id=8"  enctype='multipart/form-data' class="form-horizontal" role="form">
                                                   
                                                    <div class="form-group">
                                                        <label class="col-lg-4 col-sm-4 control-label">Nama DU</label>
                                                        <div class="col-lg-8">
                                                            <?php

                                                             echo "<select class='form-control m-bot15' name='id_du'>
                                                                      <option value=''> Pilih Tempat Prakerin </option>";
                                                                          $du = mysql_query( "SELECT * FROM hb_du WHERE status_du='Menerima' ORDER BY nama_du ASC");
                                                                        while($z = mysql_fetch_array($du)){
                                                                            $data3 = mysql_query( "SELECT * FROM hb_du_penerima WHERE id_jurusan = '8' AND id_du = '$z[id_du]'");
                                                                            $jumlah = mysql_fetch_row($data3);
                                                                            if ($jumlah > 0) {
                                                                              continue;
                                                                            }else{
                                                                              echo "<option value='$z[id_du]'> $z[nama_du] </option>";
                                                                            } 
                                                                        }
                                                                     echo "
                                                                  </select>";
                                                              ?>
                                                        </div>
                                                    </div>
                                                     <div class="form-group">
                                                        <label class="col-lg-4 col-sm-4 control-label">Jumlah Penerimaan</label>
                                                        <div class="col-lg-8">
                                                            <input type="text" class="form-control" name="jumlah" placeholder="Jumlah Penerimaan">
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

                                        <div class="adv-table">
                                            <!--<a href='' class='btn btn-warning'> Cetak </a> <br><br> -->
                                        <table  class="display table table-bordered table-striped" id="dynamic-table">
                                        <thead>
                                        <tr>
                                            <?php judultabel() ?>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $query = mysql_query( "SELECT * from hb_du,hb_du_penerima WHERE hb_du.id_du = hb_du_penerima.id_du AND id_jurusan = 8 AND status_du='Menerima'");
                                                $query4 = mysql_query( "SELECT * from hb_du,hb_du_penerima WHERE hb_du.id_du = hb_du_penerima.id_du AND id_jurusan = 8 AND status_du='Menerima'");
                                                isinya($query);
                                                isinyajur($query4);
                                            ?>
                                        </tbody>
                                        </table>
                                        </div>
                                    </div>
                                </div>

                                <div id="tptu" class="tab-pane "> <!-- id= 9 -->
                                    <div class="panel-body">
                                        <span class="pull-right">
                                            <a href="#baru9" data-toggle="modal" class="btn btn-xs btn-danger">NEW</a>
                                        </span> <br><br><br>
                                        <!-- modal -->
                
                                <div  style="text-transform:none" aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="baru9" class="modal fade">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                                <h5><big>Tambahkan DU Penerima</big></h5>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="proses_admin.php?a=tambahpenerimajur&id=9"  enctype='multipart/form-data' class="form-horizontal" role="form">
                                                   
                                                    <div class="form-group">
                                                        <label class="col-lg-4 col-sm-4 control-label">Nama DU</label>
                                                        <div class="col-lg-8">
                                                            <?php

                                                             echo "<select class='form-control m-bot15' name='id_du'>
                                                                      <option value=''> Pilih Tempat Prakerin </option>";
                                                                          $du = mysql_query( "SELECT * FROM hb_du WHERE status_du='Menerima' ORDER BY nama_du ASC");
                                                                        while($z = mysql_fetch_array($du)){
                                                                            $data3 = mysql_query( "SELECT * FROM hb_du_penerima WHERE id_jurusan = '9' AND id_du = '$z[id_du]'");
                                                                            $jumlah = mysql_fetch_row($data3);
                                                                            if ($jumlah > 0) {
                                                                              continue;
                                                                            }else{
                                                                              echo "<option value='$z[id_du]'> $z[nama_du] </option>";
                                                                            } 
                                                                        }
                                                                     echo "
                                                                  </select>";
                                                              ?>
                                                        </div>
                                                    </div>
                                                     <div class="form-group">
                                                        <label class="col-lg-4 col-sm-4 control-label">Jumlah Penerimaan</label>
                                                        <div class="col-lg-8">
                                                            <input type="text" class="form-control" name="jumlah" placeholder="Jumlah Penerimaan">
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

                                        <div class="adv-table">
                                            <!--<a href='' class='btn btn-warning'> Cetak </a> <br><br> -->
                                        <table  class="display table table-bordered table-striped" id="dynamic-table">
                                        <thead>
                                        <tr>
                                            <?php judultabel() ?>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $query = mysql_query( "SELECT * from hb_du,hb_du_penerima WHERE hb_du.id_du = hb_du_penerima.id_du AND id_jurusan = 9 AND status_du='Menerima'");
                                                $query4 = mysql_query( "SELECT * from hb_du,hb_du_penerima WHERE hb_du.id_du = hb_du_penerima.id_du AND id_jurusan = 9 AND status_du='Menerima'");
                                                isinya($query);
                                                isinyajur($query4);
                                            ?>
                                        </tbody>
                                        </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    
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