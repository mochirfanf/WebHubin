<?php

include "../koneksidb.php";

if($_SESSION['level']=='siswa'){
        $title="DU Sistem Seleksi";
        $active ="";
        $active8 = "active";
        $navactive3 ="nav-active";

        $data = mysql_query("SELECT * FROM hb_riwayat_siswa WHERE nis ='$_SESSION[username]'");
        $data2 = mysql_query("SELECT * FROM hb_riwayat_siswa WHERE nis ='$_SESSION[username]'");

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
                        <label><big>Riwayat Kegiatan</big></label>
                    </header>
                    <!-- Modal -->
                          <?php
                             while ($d = mysql_fetch_array($data2)) {

                                ?>
                                <div  style="text-transform:none" aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="<?php echo "edit$d[id_riwayat]"; ?>" class="modal fade">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                                <h5><big>Edit Kegiatan</big></h5>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="<?php echo "proses_siswa.php?a=editkegiatan&id=$d[id_riwayat]"; ?>"  enctype='multipart/form-data' class="form-horizontal" role="form">
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-4 col-sm-4"> Kegiatan Sekarang : </label>
                                                        <div  class="col-lg-8">
                                                            <select required name="nama_kegiatan" id="nama_kegiatan" class='form-control'>
                                                                <option value="">Pilih Kegiatan</option>
                                                                <option value="Prakerin" <?php if($d["nama_kegiatan"]=="Prakerin"){ echo "selected";} ?>>Prakerin</option>
                                                                <option value="Magang" <?php if($d["nama_kegiatan"]=="Magang"){ echo "selected";} ?>>Magang</option>
                                                                <option value="Kerja" <?php if($d["nama_kegiatan"]=="Kerja"){ echo "selected";} ?>>Kerja</option>
                                                                <option value="Kuliah"<?php if($d["nama_kegiatan"]=="Kuliah"){ echo "selected";} ?>>Kuliah</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class='item form-group'>
                                                        <br>
                                                        <label class='control-label col-lg-4 col-sm-4' for='name'>Keterangan Nama Tempat : <span class='required'></span> </label>
                                                        <div class='col-lg-8' >
                                                            <input class='form-control ' name='nama_tempat'  placeholder='Nama Tempat' type='text' value='<?php echo "$d[nama_tempat]";?>' required> </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <br>
                                                        <label class="control-label col-lg-4 col-sm-4"> Status Kegiatan : </label>
                                                        <div class="col-lg-8">
                                                            <select required name="status_kegiatan" id="status_kegiatan" onclick="ajaxkota(this.value)" class='form-control'>
                                                                <option value=""> Pilih Status Kegiatan </option>
                                                                <option value="Berlangsung"<?php if($d["status"]=="Berlangsung"){ echo "selected";} ?>> Berlangsung</option>
                                                                <option value="Selesai"<?php if($d["status"]=="Selesai"){ echo "selected";} ?>> Selesai </option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <br>
                                                        <label class="control-label col-lg-4 col-sm-4"> Tanggal Mulai Kegiatan : </label>
                                                        <div class="col-lg-8">
                                                            <div class="input-group input-large custom-date-range" data-date="2016/10/10" data-date-format="yyyy/mm/dd">
                                                                <input type="text" class="form-control dpd1" data-date-format="yyyy/mm/dd" name="tglawal" placeholder="Tanggal Awal Kegiatan" value='<?php echo "$d[tanggal_awal_riwayat]";?>' required>
                                                                <span class="input-group-addon"> - </span>
                                                                <input type="text" class="form-control dpd2" data-date-format="yyyy/mm/dd" name="tglakhir" value='<?php echo "$d[tanggal_selesai_riwayat]";?>'  placeholder="Tanggal Selesai Kegiatan" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <br>
                                                        <label class="control-label col-lg-4 col-sm-4"> Alamat Tempat :</label>
                                                        <div class="col-lg-8 flat-green">
                                                            <textarea class="form-control" name="alamat" rows="5" > <?php echo "$d[alamat_tempat]";?></textarea>
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
                    <div class="panel-body">
                    <div class="adv-table">
                    <table  class="display table table-bordered table-striped" id="dynamic-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kegiatan</th>
                                <th>Tempat</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Berakhir</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $no =0;
                                while ($d = mysql_fetch_array($data)) {
                                    $no = $no+1;

                                    $awal = tanggal($d["tanggal_awal_riwayat"]);
                                    $akhir = tanggal($d["tanggal_selesai_riwayat"]);
                                    echo "
                                        <tr class='gradeA'>
                                            <td> $no </td>
                                            <td> $d[nama_kegiatan] </td>
                                            <td> $d[nama_tempat]</td>
                                            <td> $awal</td>
                                            <td>";
                                                if ($d["tanggal_selesai_riwayat"] == "") {
                                                   echo "Belum Ditentukan";
                                                }else{
                                                    echo $akhir;
                                                }
                                     echo " </td>
                                            <td> $d[status]</td>
                                            <td> 
                                                <a href='#edit$d[id_riwayat]' data-toggle='modal'>
                                                    <button class='btn btn-sm btn-primary' type='button'><i class='fa fa-pencil'></i> Edit </button>
                                                </a>
                                                <a href='#hapus$d[id_riwayat]' data-toggle='modal'>
                                                    <button class='btn btn-sm btn-danger' type='button'><i class='fa fa-trash-o'></i> Hapus </button>
                                                </a>
                                            </td>

                                            <div  style='text-transform:none' aria-hidden='true' aria-labelledby='myModalLabel' role='dialog' tabindex='-1' id='hapus$d[id_riwayat]' class='modal fade'>
                                                <div class='modal-dialog'>
                                                    <div class='modal-content'>
                                                        <div class='modal-header'>
                                                            <button aria-hidden='true' data-dismiss='modal' class='close' type='button'>×</button>
                                                            <h5>Konfirmasi</h5>
                                                        </div>
                                                        <div class='modal-body'>
                                                           Anda yakin ingin menghapusnya?
                                                        </div>
                                                       <div class='modal-footer'>
                                                            <button type='button' class='btn btn-default' data-dismiss='modal'>Kembali</button>
                                                            <a href='proses_siswa.php?a=hapuskegiatan&id=$d[id_riwayat]'>
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

<?php       include "footer.php";
    
}else{
    header('location:../login.php');
}

?>
