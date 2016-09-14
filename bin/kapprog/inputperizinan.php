<?php

include "../koneksidb.php";

if($_SESSION['level']=='kapprog'){ 
	if ($_SESSION['tahun_ajaran']!='') {
        $title="Permohonan Perizinan Prakerin";
        $active = "";
        $active3 = "active";
        $navactive2 ="nav-active";

        $j    = mysql_fetch_array(mysql_query("SELECT * FROM hb_du,hb_du_penerima,hb_guru_jurusan,jurusan WHERE hb_du.id_du = hb_du_penerima.id_du AND hb_guru_jurusan.id_jurusan = jurusan.id_jurusan AND nip_guru = '$_SESSION[username]' AND tahun_ajaran ='$_SESSION[tahun_ajaran]'")) ;
        
        $data = mysql_query( "SELECT keterangan_du, id_du, hb_du.tahun_ajaran AS 'tahun_ajaran_du', nama_du, hb_du.alamat AS 'alamat_du', kota, status_du, hb_du.email AS 'email_du', permintaan_siswa, du_siswa, nis, id_jurusan, siswa.nama AS 'nama_siswa', kelas, siswa.tahun_ajaran AS 'tahun_ajaran_siswa' from hb_du,siswa WHERE status_du='du_siswa' AND hb_du.permintaan_siswa = siswa.nis AND hb_du.tahun_ajaran = '$_SESSION[tahun_ajaran]' AND siswa.tahun_ajaran = '$_SESSION[tahun_ajaran]'  AND id_jurusan=$j[id_jurusan]");
        $data2 = mysql_query( "SELECT id_du, hb_du.tahun_ajaran AS 'tahun_ajaran_du', nama_du, hb_du.alamat AS 'alamat_du', kota, status_du, hb_du.email AS 'email_du', permintaan_siswa, du_siswa, nis, id_jurusan, siswa.nama AS 'nama_siswa', kelas, siswa.tahun_ajaran AS 'tahun_ajaran_siswa' from hb_du,siswa WHERE status_du='du_siswa' AND hb_du.permintaan_siswa = siswa.nis AND hb_du.tahun_ajaran = '$_SESSION[tahun_ajaran]' AND siswa.tahun_ajaran = '$_SESSION[tahun_ajaran]'  AND id_jurusan=$j[id_jurusan]");

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
                                                <form method="POST" action="proses_kapprog.php?a=inputperizinan"  enctype='multipart/form-data' class="form-horizontal" role="form">
                                                    <div class="form-group">
                                                        <label class="col-lg-2 col-sm-2 control-label">Permintaan</label>
                                                        <div class="col-lg-10">
                                                            <?php

                                                           echo "<select class='form-control m-bot15' name='nis'>
                                                                      <option value=''> Pilih Siswa </option>";
                                                              $siswa = mysql_query("SELECT nama,nis FROM siswa WHERE id_jurusan=$j[id_jurusan]");
                                                              while($de = mysql_fetch_array($siswa)){
                                                                $data3 = mysql_query( "SELECT * from hb_du WHERE permintaan_siswa = $de[nis]");
                                                                $jumlah = mysql_fetch_row($data3);
                                                                if ($jumlah > 0) {
                                                                  continue;
                                                                }else{
                                                                  echo "<option value='$de[nis]'> $de[nama] </option>";
                                                                } 
                                                              }
                                                            echo "</select>";
                                                              ?>
                                                        </div>
                                                    </div>
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
                        <?php
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
                                                <form method="POST" action="proses_kapprog.php?a=editperizinan<?php echo "&id=$t[id_du]";?>"  enctype='multipart/form-data' class="form-horizontal" role="form">
                                                    <div class="form-group">
                                                        <label class="col-lg-2 col-sm-2 control-label">Permintaan</label>
                                                        <div class="col-lg-10">
                                                            <?php
                                                                $d = mysql_fetch_array( mysql_query("SELECT nama,nis FROM siswa WHERE id_jurusan=$j[id_jurusan]"));
?>
                                                              <input readonly type="text" class="form-control" name="nama_du" value="<?php echo "$d[nama]"; ?>" placeholder="Nama Dunia Usaha">
                                                        </div>
                                                    </div>
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
                        <th>Permintaan</th>
                        <th>Nama Dunia Usaha</th>
                        <th>Alamat</th>
                        <th>Kota</th>
                        <th>Email</th>
                        <th>Keterangan </th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $no =0;

                            while ($d = mysql_fetch_array($data)) {
                                $s = mysql_fetch_array(mysql_query("SELECT * FROM siswa WHERE nis = '$d[permintaan_siswa]'"));
                                $no = $no+1;
                                echo "
                                    <tr class='gradeA'>
                                        <td> $no </td>
                                        <td> $s[nama]</td>
                                        <td> $d[nama_du] </td>
                                        <td> $d[alamat_du]</td>
                                        <td> $d[kota]</td>
                                        <td> $d[email_du]</td>
                                        <td> $d[keterangan_du]</td>
                                        <td class='center'>                                         
                                             <a href='#edit$d[id_du]' data-toggle='modal'>
                                                <button class='btn btn-sm btn-primary' type='button'><i class='fa fa-trash-o'></i> Edit </button>
                                            </a>
                                            <a href='#hapus$d[id_du]' data-toggle='modal'>
                                                <button class='btn btn-sm btn-primary' type='button'><i class='fa fa-trash-o'></i> Hapus </button>
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
                                                            Hapus DU $d[nama_du]?
                                                        </div>
                                                       <div class='modal-footer'>
                                                            <button type='button' class='btn btn-default' data-dismiss='modal'>Kembali</button>
                                                            <a href='proses_kapprog.php?a=hapusdu&id=$d[id_du]'>
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