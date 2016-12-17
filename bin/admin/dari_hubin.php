<?php

include "../koneksidb.php";

if($_SESSION['level']=='admin'){
	if ($_SESSION['tahun_ajaran']!='') {
        $title="Permohonan Perizinan Prakerin";
        $active = "";
        $active3 = "active";
        $navactive1 ="nav-active";


        $data2 = mysql_query("SELECT * FROM hb_du_umum,hb_du_permintaan WHERE permintaan_hubin='Ya' AND hb_du_permintaan.tahun_ajaran = '$_SESSION[tahun_ajaran]' AND hb_du_umum.id_du = hb_du_permintaan.id_du");

        $data3 = mysql_query("SELECT * FROM hb_du_umum,hb_du_permintaan WHERE permintaan_hubin='Ya' AND hb_du_permintaan.tahun_ajaran = '$_SESSION[tahun_ajaran]' AND hb_du_umum.id_du = hb_du_permintaan.id_du");

		include "leftside.php"; ?>

        <!--body wrapper start-->

        <div class="wrapper">
            <div class="row">
                <div class="col-sm-12">
                    <section class="panel">
                    <header class="panel-heading">
                        <big>Permintaan Perizinan Prakerin</big>
                         <span class="pull-right">
                         <a href="#myModal" data-toggle="modal" class="btn btn-xs btn-danger">NEW</a>
                         <!-- Modal -->
                        <!-- modal -->
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
                                                <form method="POST" action="proses_admin.php?a=editperizinan<?php echo "&id=$t[id_du]";?>"  enctype='multipart/form-data' class="form-horizontal" role="form">
                                                    <div class="form-group">
                                                        <label class="col-lg-3 col-sm-3 control-label">Nama DU</label>
                                                        <div class="col-lg-9">
                                                            <input type="text" class="form-control" name="nama_du" required=""value='<?php echo $dl['nama_du']?>' placeholder="Nama Dunia Usaha" >
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-lg-3 col-sm-3 control-label">Email</label>
                                                        <div class="col-lg-9">
                                                            <input type="email" required="" value='<?php echo $dl['email_du']?>'  class="form-control" name="email_du" placeholder="Email">
                                                        </div>
                                                    </div>
                                                     <div class="form-group">
                                                        <label class="col-lg-3 col-sm-3 control-label">Alamat</label>
                                                        <div class="col-lg-9">
                                                            <textarea cols="3" class='form-control col-md-7 col-xs-13' name='alamat' required='required' placeholder='Alamat' type='number'>  <?php echo $dl['alamat']?> </textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-lg-3 col-sm-3 control-label">Provinsi</label>
                                                        <div class="col-lg-9">
                                                            <select name="prop" class='form-control prop2' required="">
                                                                <option value="">Pilih Provinsi</option>
                                                                <?php
                                                                  include 'koneksi.php';
                                                                  $query=$db->prepare("SELECT id_prov,nama FROM provinsi ORDER BY nama");
                                                                  $query->execute();
                                                                  while ($data=$query->fetchObject()){
                                                                  echo '<option value="'.$data->id_prov.'"';

                                                                    $x = mysql_fetch_array( mysql_query("SELECT id_prov FROM hb_du_umum WHERE hb_du_umum.id_du='$dl[id_du]'"));

                                                                    if( $x["id_prov"] == $data->id_prov){
                                                                        echo "selected";
                                                                    }
                                                                  echo '>'.$data->nama.'</option>';
                                                                  }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-lg-3 col-sm-3 control-label">Kota/Kabupaten</label>
                                                        <div class="col-lg-9">
                                                            <select name="kota" onchange="ajaxkec2(this.value)" class='form-control kota2' required="">
                                                                <?php
                                                                    $ko = mysql_fetch_array( mysql_query("SELECT id_kab FROM hb_du_umum WHERE id_du='$dl[id_du]'"));
                                                                    $ta = mysql_fetch_array( mysql_query("SELECT * FROM kabupaten WHERE id_kab='$ko[id_kab]'"));
                                                                ?>
                                                                <option value="<?php echo "$ko[id_kab]";?>"><?php echo "$ta[nama]";?></option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-lg-3 col-sm-3 control-label">Kecamatan</label>
                                                        <div class="col-lg-9">
                                                            <select name="kec" onchange="ajaxkel2(this.value)" class='form-control kec2' required="">
                                                                <?php
                                                                    $ke = mysql_fetch_array( mysql_query("SELECT id_kec FROM hb_du_umum WHERE id_du='$dl[id_du]'"));
                                                                    $ca = mysql_fetch_array( mysql_query("SELECT * FROM kecamatan WHERE id_kec='$ke[id_kec]'"));
                                                                ?>
                                                                <option value="<?php echo "$ke[id_kec]";?>"><?php echo "$ca[nama]";?></option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-lg-3 col-sm-3 control-label">Kelurahan/Desa</label>
                                                        <div class="col-lg-9">
                                                            <select name="kel" onchange="showCoordinate2();" class='form-control kel2' required="">
                                                                <?php
                                                                    $kelu = mysql_fetch_array( mysql_query("SELECT id_kel FROM hb_du_umum WHERE id_du='$dl[id_du]'"));
                                                                    $rahan = mysql_fetch_array( mysql_query("SELECT nama FROM kelurahan WHERE id_kel='$kelu[id_kel]'"));
                                                                ?>
                                                                <option value="<?php echo "$kelu[id_kel]";?>"><?php echo "$rahan[nama]";?></option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-lg-3 col-sm-3 control-label">Kode Pos</label>
                                                        <div class="col-lg-9">
                                                            <input type="number" value='<?php echo $dl['no_kodepos']?>' class="form-control"  name="kodepos" placeholder="Kodepos" required="">
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
                        <th>Nama DU/DI</th>
                        <th>Alamat </th>
                        <th>Email</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                            $no =0;
                            while( $d = mysql_fetch_array($data2)) {
                                $kel = mysql_fetch_array(mysql_query("SELECT nama FROM kelurahan WHERE id_kel='$d[id_kel]'"));
                                $kec = mysql_fetch_array(mysql_query("SELECT nama FROM kecamatan WHERE id_kec='$d[id_kec]'"));
                                $kab = mysql_fetch_array(mysql_query("SELECT nama FROM kabupaten WHERE id_kab='$d[id_kab]'"));
                                $prov = mysql_fetch_array(mysql_query("SELECT nama FROM provinsi WHERE id_prov='$d[id_prov]'"));
                                $no = $no+1;
                                echo "
                                    <tr class='gradeA'>
                                        <td> $no </td>
                                        <td> $d[nama_du] </td>
                                        <td> $d[alamat]
                                             <br> Kelurahan : $kel[nama]
                                             <br> Kecamatan : $kec[nama]
                                             <br> Kab/Kota : $kab[nama]
                                             <br> Provinsi : $prov[nama]
                                             <br> Kode Pos : $d[no_kodepos]
                                        </td>
                                        <td> $d[email_du]</td>
                                        <td> $d[keterangan_permintaan]</td>
                                        <td class='center'>
                                             <a href='#edit$d[id_du]' data-toggle='modal'>
                                                <button class='btn btn-sm btn-info' type='button'><i class='fa fa-pencil'></i> Edit </button>
                                            </a>
                                            <a href='#hapus$d[id_du]' data-toggle='modal'>
                                                <button class='btn btn-sm btn-danger' type='button'><i class='fa fa-trash-o'></i> Hapus </button>
                                            </a>
                                        </td>
                                            <div style='text-transform:none' aria-hidden='true' aria-labelledby='myModalLabel' role='dialog' tabindex='-1' id='hapus$d[id_du]' class='modal fade'>
                                                <div class='modal-dialog'>
                                                    <div class='modal-content'>
                                                        <div class='modal-header'>
                                                            <button aria-hidden='true' data-dismiss='modal' class='close' type='button'>×</button>
                                                            <h5>Konfirmasi!</h5>
                                                        </div>
                                                        <div class='modal-body'>
                                                            Anda yakin ingin menghapus? (Nama DU : $d[nama_du])?
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
                                <label> <br>
                                    &nbsp; &nbsp; ** Pastikan DU/DI yang akan ditambahkan adalah data <b><i>BARU</i></b>.<br><br>
                                </label>
                    </div>
                    </section>
                </div>
            </div>

        </div>
        <!--body wrapper end-->


<?php		include "footer.php";?>

                                <div  style="text-transform:none" aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                                <h5><big>Tambah Permintaan Perizinan Prakerin</big></h5>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="proses_admin.php?a=inputperizinan"  enctype='multipart/form-data' class="form-horizontal" role="form">
                                                    <div class="form-group">
                                                        <label class="col-lg-3 col-sm-3 control-label">Nama DU</label>
                                                        <div class="col-lg-9">
                                                            <input type="text" class="form-control" name="nama_du" placeholder="Nama Dunia Usaha" required="">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-lg-3 col-sm-3 control-label">Email</label>
                                                        <div class="col-lg-9">
                                                            <input type="email" class="form-control" name="email_du" placeholder="Email" required="">
                                                        </div>
                                                    </div>
                                                     <div class="form-group">
                                                        <label class="col-lg-3 col-sm-3 control-label">Alamat</label>
                                                        <div class="col-lg-9">
                                                            <textarea cols="3" class='form-control col-md-7 col-xs-13' name='alamat' required='required' placeholder='Alamat' type='number'> </textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-lg-3 col-sm-3 control-label">Provinsi</label>
                                                        <div class="col-lg-9">
                                                            <select name="prop" id="prop" onclick="ajaxkota(this.value)" class='form-control' required="">
                                                                <option value="">Pilih Provinsi</option>
                                                                <?php
                                                                  include 'koneksi.php';
                                                                  $query=$db->prepare("SELECT id_prov,nama FROM provinsi ORDER BY nama");
                                                                  $query->execute();
                                                                  while ($data=$query->fetchObject()){
                                                                  echo '<option value="'.$data->id_prov.'">'.$data->nama.'</option>';
                                                                  }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-lg-3 col-sm-3 control-label">Kota/Kabupaten</label>
                                                        <div class="col-lg-9">
                                                            <select name="kota" id="kota" onchange="ajaxkec(this.value)" class='form-control' required="">
                                                                <option value="">Pilih Kota/Kabupaten</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-lg-3 col-sm-3 control-label">Kecamatan</label>
                                                        <div class="col-lg-9">
                                                            <select name="kec" id="kec" onchange="ajaxkel(this.value)" class='form-control' required="">
                                                                <option value="">Pilih Kecamatan</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-lg-3 col-sm-3 control-label">Kelurahan/Desa</label>
                                                        <div class="col-lg-9">
                                                            <select name="kel" id="kel" onchange="showCoordinate();" class='form-control' required="">
                                                                <option value="">Pilih Kelurahan/Desa</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-lg-3 col-sm-3 control-label">Kode Pos</label>
                                                        <div class="col-lg-9">
                                                            <input type="number" class="form-control" name="kodepos" placeholder="Kodepos" required="">
                                                        </div>
                                                    </div>
                                                     <div class="form-group">
                                                        <label class="col-lg-3 col-sm-3 control-label">Tambah Keterangan</label>
                                                        <div class="col-lg-9">
                                                            <textarea cols="3" class='form-control col-md-7 col-xs-13' name='keterangan' required='required' placeholder='Alamat' type='number'> </textarea>
                                                        </div>
                                                    </div>
                                            </div>
                                           <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                                                <input type='submit' value='Tambahkan' name='Tambahkan'class='btn btn-success'>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
<?php
	}else{
		header('location:tahun_ajaran.php');
	}
}else{
	header('location:../login.php');
}

?>
