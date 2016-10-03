<?php

include "../koneksidb.php";

if($_SESSION['level']=='admin'){
	if ($_SESSION['tahun_ajaran']!='') {
        $title="Permohonan Perizinan Prakerin";
        $active ="";
        $active1 = "active";
        $navactive1 ="nav-active";

        $data = mysql_query( "SELECT * from hb_du WHERE status_du='Proses'");
        $data2 = mysql_query( "SELECT * from hb_du WHERE status_du='Proses'");
        $data3 = mysql_query( "SELECT * from hb_du WHERE status_du='Proses'");

		include "leftside.php"; ?>

        <!--body wrapper start-->
        <div class="wrapper">
            <div class="row">
                <div class="col-sm-12">
                    <section class="panel">
                    <header class="panel-heading">
                        <big>Permohonan Perizinan Prakerin</big>
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
                                                <form method="POST" action="proses_admin.php?a=inputperizinan"  enctype='multipart/form-data' class="form-horizontal" role="form">
                                                    <div class="form-group">
                                                        <label class="col-lg-2 col-sm-2 control-label">Nama DU</label>
                                                        <div class="col-lg-10">
                                                            <input type="text" class="form-control" name="nama_du" placeholder="Nama Dunia Usaha">
                                                        </div>
                                                    </div>
                                                     <div class="form-group">
                                                        <label class="col-lg-2 col-sm-2 control-label">Alamat</label>
                                                        <div class="col-lg-10">
                                                            <input type="text" class="form-control" name="alamat" placeholder="Alamat">
                                                        </div>
                                                    </div>
                                                     <div class="form-group">
                                                        <label class="col-lg-2 col-sm-2 control-label">Kota</label>
                                                        <div class="col-lg-10">
                                                            <input type="text" class="form-control" name="kota" placeholder="Kota ">
                                                        </div>
                                                    </div>
                                                     <div class="form-group">
                                                        <label class="col-lg-2 col-sm-2 control-label">Email</label>
                                                        <div class="col-lg-10">
                                                            <input type="email" class="form-control" name="email" placeholder="Email">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-lg-2 col-sm-2 control-label">Keterangan</label>
                                                        <div class="col-lg-10">
                                                            <input class="form-control" name="keterangan" placeholder="Keterangan">
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
                             while ($g = mysql_fetch_array($data3)) {

                                ?>
                                <div  style="text-transform:none" aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="<?php echo "edit$g[id_du]"; ?>" class="modal fade">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                                <h5><big>Edit</big></h5>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="<?php echo "proses_admin.php?a=editperizinan&id=$g[id_du]"; ?>"  enctype='multipart/form-data' class="form-horizontal" role="form">
                                                    <div class="form-group">
                                                        <label class="col-lg-2 col-sm-2 control-label">Nama DU</label>
                                                        <div class="col-lg-10">
                                                            <input type="text" value="<?php echo "$g[nama_du]"; ?>" class="form-control" name="nama_du" placeholder="Nama Dunia Usaha">
                                                        </div>
                                                    </div>
                                                     <div class="form-group">
                                                        <label class="col-lg-2 col-sm-2 control-label">Alamat</label>
                                                        <div class="col-lg-10">
                                                            <input type="text" value="<?php echo "$g[alamat]"; ?>"class="form-control" name="alamat" placeholder="Alamat">
                                                        </div>
                                                    </div>
                                                     <div class="form-group">
                                                        <label class="col-lg-2 col-sm-2 control-label">Kota</label>
                                                        <div class="col-lg-10">
                                                            <input type="text" value="<?php echo "$g[kota]"; ?>"class="form-control" name="kota" placeholder="Kota ">
                                                        </div>
                                                    </div>
                                                     <div class="form-group">
                                                        <label class="col-lg-2 col-sm-2 control-label">Email</label>
                                                        <div class="col-lg-10">
                                                            <input type="email" value="<?php echo "$g[email]"; ?>"class="form-control" name="email" placeholder="Email">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-lg-2 col-sm-2 control-label">Keterangan</label>
                                                        <div class="col-lg-10">
                                                            <input class="form-control" value="<?php echo "$g[keterangan_du]"; ?>" name="keterangan" placeholder="Keterangan">
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
                                <?php } ?>
                        <!-- modal -->
                        <!-- Modal -->
                         <?php
                             while ($t = mysql_fetch_array($data2)) {

                                ?>
                                <div style="text-transform:none" aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="<?php echo "myModalT$t[id_du]"; ?>" class="modal fade">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                                <h5><big>Tambah Keterangan</big></h5>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="<?php echo "proses_admin.php?a=menerima&id=$t[id_du]"; ?>" enctype='multipart/form-data' class="form-horizontal" role="form">
                                                    <div class="form-group">
                                                        <label class="col-lg-4 col-sm-4 control-label">Nama Penanggung Jawab</label>
                                                        <div class="col-lg-8">
                                                            <input type="text" class="form-control" name="nama_pj" placeholder="Nama Penanggung Jawab">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-lg-4 col-sm-4 control-label">Mulai Pelaksanaan</label>
                                                        <div class="col-lg-8">
                                                            <input type="date" class="form-control" name="mulai" placeholder="Alamat">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-lg-4 col-sm-4 control-label">Berakhir Pelaksanaan</label>
                                                        <div class="col-lg-8">
                                                            <input type="date" class="form-control" name="berakhir" placeholder="Kota ">
                                                        </div>
                                                    </div>
                                                     <div class="form-group">
                                                        <label class="col-lg-4 col-sm-4 control-label">Jurusan</label>

                                                        <div class="input_fields_wrap col-lg-1">
                                                            <button class="btn  btn-danger add_field_button"><i class='fa fa-plus-square'></i></button>
                                                        </div>

                                                        <div class="col-lg-4">
                                                            <?php
                                                            $name = "";
                                                             echo "<select class='form-control m-bot15' name='jurusan[]'>
                                                                      <option value=''> * Pilih Jurusan * </option>";
                                                                        $jurusan = mysql_query("SELECT * FROM jurusan");
                                                                        while($j = mysql_fetch_array($jurusan)){
                                                             echo " <option value='$j[id_jurusan]'> $j[nama_jurusan] </option>";
                                                                        }
                                                                     echo "
                                                                  </select>";
                                                            ?>

                                                        </div>
                                                        <div class="col-lg-3">
                                                            <input type="text" class="form-control" name="jumlah[]" placeholder="Jumlah ">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class=" col-lg-offset-4 flat-green">
                                                            <div class="col-lg-1">
                                                                <input name="seleksi" value="Ya" type="checkbox">
                                                            </div><label> &nbsp; Menggunakan Seleksi</label>
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
                        <th>Alamat</th>
                        <th>Kota</th>
                        <th>Email</th>
                        <th>Keterangan</th>
                        <th>Status</th>
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
                                        <td> $d[alamat]</td>
                                        <td> $d[kota]</td>
                                        <td> $d[email]</td>
                                        <td> $d[keterangan_du]</td>
                                        <td class='center'>
                                            <div class='btn-group'>
                                                <button class='btn btn-sm btn-primary' type='button'>";

                                                if($d["du_siswa"] == 'Yes'){
                                                    echo "DU Siswa";
                                                }else{
                                                    echo " Proses ";
                                                }

                                            echo"</button>
                                                <button data-toggle='dropdown' class='btn btn-sm btn-primary dropdown-toggle' type='button'>
                                                    <span class='caret'></span>
                                                    <span class='sr-only'>Toggle Dropdown</span>
                                                </button>
                                                <ul role='menu' class='dropdown-menu'>
                                                    <li><a href='#myModalT$d[id_du]' data-toggle='modal'>&nbsp;&nbsp;&nbsp;Menerima</a></li>
                                                    <li><a href='#myModalM$d[id_du]' data-toggle='modal'>Menolak</a></li>
                                                </ul>
                                            </div>
                                            <a href='#edit$d[id_du]' data-toggle='modal'>
                                                <button class='btn btn-sm btn-danger' type='button'><i class='fa fa-trash-o'></i> Edit </button>
                                            </a>
                                            <a href='#myModalH$d[id_du]' data-toggle='modal'>
                                                <button class='btn btn-sm btn-danger' type='button'><i class='fa fa-trash-o'></i> Hapus </button>
                                            </a>
                                        </td>

                                            <div  style='text-transform:none' aria-hidden='true' aria-labelledby='myModalLabel' role='dialog' tabindex='-1' id='myModalM$d[id_du]' class='modal fade'>
                                                <div class='modal-dialog'>
                                                    <div class='modal-content'>
                                                        <div class='modal-header'>
                                                            <button aria-hidden='true' data-dismiss='modal' class='close' type='button'>×</button>
                                                            <h5>Konfirmasi</h5>
                                                        </div>
                                                        <div class='modal-body'>
                                                            Apakah DU $d[nama_du] Telah Menolak Perizinan Prakerin?
                                                        </div>
                                                       <div class='modal-footer'>
                                                            <button type='button' class='btn btn-default' data-dismiss='modal'>Kembali</button>
                                                            <a href='proses_admin.php?a=menolak&id=$d[id_du]'>
                                                            <input type='submit' value='Ya' name='Ganti'class='btn btn-success'></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div  style='text-transform:none' aria-hidden='true' aria-labelledby='myModalLabel' role='dialog' tabindex='-1' id='myModalH$d[id_du]' class='modal fade'>
                                                <div class='modal-dialog'>
                                                    <div class='modal-content'>
                                                        <div class='modal-header'>
                                                            <button aria-hidden='true' data-dismiss='modal' class='close' type='button'>×</button>
                                                            <h5>Konfirmasi</h5>
                                                        </div>
                                                        <div class='modal-body'>
                                                            Hapus DU $d[nama_du]?
                                                        </div>
                                                       <div class='modal-footer'>
                                                            <button type='button' class='btn btn-default' data-dismiss='modal'>Kembali</button>
                                                            <a href='proses_admin.php?a=hapusdu&id=$d[id_du]'>
                                                            <input type='submit' value='Hapus' name='Ganti'class='btn btn-success'></a>
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

<?php		include "footer.php";
	}else{
		header('location:tahun_ajaran.php');
	}
}else{
	header('location:../login.php');
}

?>
