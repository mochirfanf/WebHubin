<?php

include "../koneksidb.php";

if($_SESSION['level']=='admin'){
	if ($_SESSION['tahun_ajaran']!='') {
        $title="Permohonan Perizinan Prakerin";
        $active ="";
        $active5 = "active";
        $navactive1 ="nav-active";

        $data = mysql_query("SELECT * from hb_du_umum, hb_du_permintaan WHERE status_penerimaan='Proses' AND hb_du_umum.id_du = hb_du_permintaan.id_du");
        $data2 = mysql_query("SELECT * from hb_du_umum, hb_du_permintaan WHERE status_penerimaan='Proses' AND hb_du_umum.id_du = hb_du_permintaan.id_du");
        $data3 = mysql_query("SELECT * from hb_du_umum, hb_du_permintaan WHERE status_penerimaan='Proses' AND hb_du_umum.id_du = hb_du_permintaan.id_du");

		include "leftside.php"; ?>

        <!--body wrapper start-->
        <div class="wrapper">
            <div class="row">
                <div class="col-sm-12">
                    <section class="panel">
                    <header class="panel-heading">
                        <big>Tindak Lanjut Penerima Prakerin</big>
                         <span class="pull-right">
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
                                                        <label class="col-lg-4 col-sm-4 control-label">Penanggung Jawab :</label>
                                                        <div class="col-lg-8">
                                                            <input type="text" value="<?php echo "$t[nama_penanggung_jawab]"; ?>" class="form-control" name="nama_pj" placeholder="Nama Penanggung Jawab">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-lg-4 col-sm-4 control-label">Contact Person :</label>
                                                        <div class="col-lg-8">
                                                            <input type="text" value="<?php echo "$t[contact_person]"; ?>" class="form-control" name="cp" placeholder="Contact Person">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-lg-4 col-sm-4 control-label">Mulai Pelaksanaan :</label>
                                                        <div class="col-lg-8">
                                                            <input type="date" class="form-control" name="mulai" placeholder="Alamat">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-lg-4 col-sm-4 control-label">Berakhir Pelaksanaan :</label>
                                                        <div class="col-lg-8">
                                                            <input type="date" class="form-control" name="berakhir" placeholder="Kota ">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Jenis Seleksi :</label>
                                                        <div class="col-lg-8 flat-green">
                                                            <?php
                                                                echo "<select class='form-control m-bot15' name='seleksi'>
                                                                            <option value='Ya' "; if($t["seleksi_du"]=="Ya"){echo "selected";} echo "> Ya </option>
                                                                            <option value='Tidak'"; if($t["seleksi_du"]=="Tidak"){echo "selected";} echo "> Tidak </option>
                                                                      </select>";
                                                            ?>
                                                        </div>
                                                    </div>
                                                     <div class="form-group">
                                                        <label class="col-lg-4 col-sm-4 control-label">Jurusan :</label>

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
                        <th>Alamat </th>
                        <th>Email </th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                            $no =0;
                            while ($d = mysql_fetch_array($data)) {
                                $no = $no+1;
                                $kel = mysql_fetch_array(mysql_query("SELECT nama FROM kelurahan WHERE id_kel='$d[id_kel]'"));
                                $kec = mysql_fetch_array(mysql_query("SELECT nama FROM kecamatan WHERE id_kec='$d[id_kec]'"));
                                $kab = mysql_fetch_array(mysql_query("SELECT nama FROM kabupaten WHERE id_kab='$d[id_kab]'"));
                                $prov = mysql_fetch_array(mysql_query("SELECT nama FROM provinsi WHERE id_prov='$d[id_prov]'"));
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
                                        <td class='center'>
                                            <div class='btn-group'>
                                                <button class='btn btn-sm btn-primary' type='button'> <i class='fa fa-fighter-jet'></i> $d[status_du]</button>
                                                <button data-toggle='dropdown' class='btn btn-sm btn-primary dropdown-toggle' type='button'>
                                                    <span class='caret'></span>
                                                    <span class='sr-only'>Toggle Dropdown</span>
                                                </button>
                                                <ul role='menu' class='dropdown-menu'>
                                                    <li><a href='#myModalT$d[id_du]' data-toggle='modal'>&nbsp;&nbsp;&nbsp;Menerima</a></li>
                                                    <li><a href='#myModalM$d[id_du]' data-toggle='modal'>Menolak</a></li>
                                                </ul>
                                            </div>
                                            <a href='#myModalH$d[id_du]' data-toggle='modal'>
                                                <button class='btn btn-sm btn-danger' type='button'><i class='fa fa-trash-o'></i> Batalkan </button>
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
                                                            Kembalikan ke Permintaa Prakerin? ($d[nama_du])
                                                        </div>
                                                       <div class='modal-footer'>
                                                            <button type='button' class='btn btn-default' data-dismiss='modal'>Kembali</button>
                                                            <a href='proses_admin.php?a=kembali_kepermintaan&id=$d[id_du]'>
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
