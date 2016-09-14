<?php

include "../koneksidb.php";

if($_SESSION['level']=='admin'){ 
	if ($_SESSION['tahun_ajaran']!='') {
        $title="Informasi Berita";
        $active ="";
        $active12 = "active";

        $data = mysql_query( "SELECT * from hb_berita");
        $data2 = mysql_query( "SELECT * from hb_berita");
		include "leftside.php"; ?>
		        
        <!--body wrapper start-->
        <div class="wrapper">
            <div class="row">
                <div class="col-sm-12">
                    <section class="panel">
                    <header class="panel-heading">
                        <big>Input Berita</big>
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
                                                <form method="POST" action="proses_admin.php?a=inputberita"  enctype='multipart/form-data' class="form-horizontal" role="form">
                                                   <input type="hidden" name="hits_berita" value="1">
                                                   <?php
                                                   $c = mysql_fetch_array(mysql_query("SELECT * FROM hb_pengelola_hubin WHERE username='$_SESSION[username]'"));               
                                                   echo " <input type='hidden' name='sumber' value='$c[nama]'>";             
                                                   ?>
                                                   <input type="hidden" class="form-control" name="tgl_berita" value="<?php echo date("Y/m/d");?>" >
                                                     
                                                    <div class="form-group">
                                                        <label class="col-lg-2 col-sm-2 control-label">Kategori</label>
                                                        <div class="col-lg-10">
                                                        <select name="kategori" class="form-control m-bot15">
                                                            <option value="loker">Lowongan Kerja</option>
                                                            <option value="prakerin">Prakerin</option>
                                                            <option value="umum">Umum</option>
                                                        </select>
                                                        </div>
                                                    </div>
                                                     <div class="form-group">
                                                        <label class="col-lg-2 col-sm-2 control-label">judul_berita</label>
                                                        <div class="col-lg-10">
                                                            <input type="text" class="form-control" name="judul_berita" placeholder="Judul Berita">
                                                        </div>
                                                    </div>
                                                     <div class="form-group">
                                                        <label class="col-lg-2 col-sm-2 control-label">Isi Berita</label>
                                                        <div class="col-lg-10">
                                                           <textarea name="isi_berita" class="form-control ckeditor" rows="6"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-lg-2 col-sm-2 control-label">Keterangan</label>
                                                        <div class="col-lg-10">
                                                            <textarea name="keterangan" class="form-control" rows="3"></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="form-group last">
                                                    <label class="control-label col-md-3">Upload Thumbnail</label>
                                                    <div class="col-md-9">
                                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                                            <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                                            <img src="../images/default.png" alt="" />
                                                            </div>
                                                            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                                            <div>
                                                                   <span class="btn btn-default btn-file">
                                                                   <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>
                                                                   <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                                                   <input name="thumbnail" type="file" class="default" />
                                                                   </span>
                                                                <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remove</a>
                                                            </div>
                                                        </div>
                                                        <br/>
                                                        
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
                             while ($g = mysql_fetch_array($data2)) {
                                
                                ?>
                                <div  style="text-transform:none" aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="<?php echo "edit$g[id_berita]"; ?>" class="modal fade">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                                <h5><big>Edit</big></h5>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="<?php echo "proses_admin.php?a=editberita&id=$g[id_berita]"; ?>"  enctype='multipart/form-data' class="form-horizontal" role="form">
                                                    <input type="hidden" name="hits_berita" value="<?php echo "$g[hits_berita]"; ?>">
                                                   <?php
                                                   $c = mysql_fetch_array(mysql_query("SELECT * FROM hb_pengelola_hubin WHERE username='$_SESSION[username]'"));               
                                                   echo " <input type='hidden' name='sumber' value='$c[nama]'>";             
                                                   ?>
                                                   <input type="hidden" class="form-control" name="tgl_berita" value="<?php echo "$g[tgl_berita]"; ?>" >
                                                     
                                                    <div class="form-group">
                                                        <label class="col-lg-2 col-sm-2 control-label">Kategori</label>
                                                        <div class="col-lg-10">
                                                        <select name="kategori" class="form-control m-bot15">
                                                            <option value="loker" <?php if ($g['kategori'] == 'loker'){ echo "selected=selected"; } ?>>Lowongan Kerja</option>
                                                            <option value="prakerin" <?php if ($g['kategori'] == 'prakerin'){ echo "selected=selected"; } ?>>Prakerin</option>
                                                            <option value="umum" <?php if ($g['kategori'] == 'umum'){ echo "selected=selected"; } ?>>Umum</option>
                                                        </select>
                                                        </div>
                                                    </div>
                                                     <div class="form-group">
                                                        <label class="col-lg-2 col-sm-2 control-label">judul_berita</label>
                                                        <div class="col-lg-10">
                                                            <input type="text" class="form-control" name="judul_berita" value="<?php echo "$g[judul_berita]"; ?>">
                                                        </div>
                                                    </div>
                                                     <div class="form-group">
                                                        <label class="col-lg-2 col-sm-2 control-label">Isi Berita</label>
                                                        <div class="col-lg-10">
                                                           <textarea name="isi_berita" class="form-control ckeditor" rows="6"><?php echo "$g[isi_berita]"; ?></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-lg-2 col-sm-2 control-label">Keterangan</label>
                                                        <div class="col-lg-10">
                                                            <textarea name="keterangan" class="form-control" rows="3"><?php echo "$g[keterangan]"; ?></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="form-group last">
                                                    <label class="control-label col-md-3">Upload Thumbnail</label>
                                                    <div class="col-md-9">
                                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                                            <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                                            <?php if(isset($g['foto_berita'])) { ?>
                                                            <img src="../images/uploads/<?php echo "$g[foto_berita]"; ?>"/>
                                                            <?php  } else {
                                                            echo "<img src='default.png'/>";

                                                            }?>
                                                            </div>
                                                            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                                            <div>
                                                                   <span class="btn btn-default btn-file">
                                                                   <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>
                                                                   <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                                                   <input name="thumbnail" type="file" class="default" />
                                                                   </span>
                                                                <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remove</a>
                                                            </div>
                                                        </div>
                                                        <br/>
                                                        
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
                     </span>
                    </header>
                   
                    <div class="panel-body">
                    <div class="adv-table">
                    <table  class="display table table-bordered table-striped" id="dynamic-table">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal Input</th>
                        <th>Kategori</th>
                        <th>Judul Berita</th>
                        <th>Hits Berita</th>
                        <th>Sumber</th>
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
                                        <td> $d[tgl_berita] </td>
                                        <td> $d[kategori]</td>
                                        <td> $d[judul_berita]</td>
                                        <td> $d[hits_berita]</td>
                                        <td> $d[sumber]</td>
                                        <td class='center'>                                         
                                            <a href='#edit$d[id_berita]' data-toggle='modal'>
                                                <button class='btn btn-sm btn-danger' type='button'><i class='fa fa-trash-o'></i> Edit </button>
                                            </a>
                                            <a href='#myModalH$d[id_berita]' data-toggle='modal'>
                                                <button class='btn btn-sm btn-danger' type='button'><i class='fa fa-trash-o'></i> Hapus </button>
                                            </a>
                                        </td>
                                            
                                            <div  style='text-transform:none' aria-hidden='true' aria-labelledby='myModalLabel' role='dialog' tabindex='-1' id='myModalM$d[id_berita]' class='modal fade'>
                                                <div class='modal-dialog'>
                                                    <div class='modal-content'>
                                                        <div class='modal-header'>
                                                            <button aria-hidden='true' data-dismiss='modal' class='close' type='button'>×</button>
                                                            <h5>Konfirmasi</h5>
                                                        </div>
                                                        <div class='modal-body'>
                                                            Apakah DU $d[judul_berita] Telah Menolak Perizinan Prakerin?
                                                        </div>
                                                       <div class='modal-footer'>
                                                            <button type='button' class='btn btn-default' data-dismiss='modal'>Kembali</button>
                                                            <a href='proses_admin.php?a=menolak&id=$d[id_berita]'>
                                                            <input type='submit' value='Ya' name='Ganti'class='btn btn-success'></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div  style='text-transform:none' aria-hidden='true' aria-labelledby='myModalLabel' role='dialog' tabindex='-1' id='myModalH$d[id_berita]' class='modal fade'>
                                                <div class='modal-dialog'>
                                                    <div class='modal-content'>
                                                        <div class='modal-header'>
                                                            <button aria-hidden='true' data-dismiss='modal' class='close' type='button'>×</button>
                                                            <h5>Konfirmasi</h5>
                                                        </div>
                                                        <div class='modal-body'>
                                                            Hapus Berita $d[judul_berita]?
                                                        </div>
                                                       <div class='modal-footer'>
                                                            <button type='button' class='btn btn-default' data-dismiss='modal'>Kembali</button>
                                                            <a href='proses_admin.php?a=hapusberita&id=$d[id_berita]'>
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