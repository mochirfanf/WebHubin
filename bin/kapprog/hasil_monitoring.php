<?php

include "../koneksidb.php";

if($_SESSION['level']=='kapprog'){ 
    if ($_SESSION['tahun_ajaran']!='') {
        $title ="Hasil Monitoring";
        $active ="";
        $active7 = "active";
        $navactive1 ="nav-active";

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


        $j    = mysql_fetch_array(mysql_query("SELECT * FROM hb_du,hb_du_penerima,hb_guru_jurusan,jurusan WHERE hb_du.id_du = hb_du_penerima.id_du AND hb_guru_jurusan.id_jurusan = jurusan.id_jurusan AND nip_guru = '$_SESSION[username]' AND tahun_ajaran ='$_SESSION[tahun_ajaran]'")) ;
        
        $data = mysql_query( "SELECT * FROM hb_monitoring WHERE nip_guru = $_SESSION[username]");
        $data2 = mysql_query( "SELECT * FROM hb_monitoring WHERE nip_guru = $_SESSION[username]");

        include "leftside.php"; ?>
                
        <!--body wrapper start-->
        <div class="wrapper">
            <div class="row">
                <div class="col-sm-12">
                    <section class="panel">
                    <header class="panel-heading">
                        <big> Hasil Monitoring </big>
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
                                                <form method="POST" action="proses_kapprog.php?a=inputmonitoring"  enctype='multipart/form-data' class="form-horizontal" role="form">
                                                    
                                                    <div class="form-group">
                                                        <label class="col-lg-4 col-sm-4 control-label">Nama Siswa</label>
                                                        <div class="col-lg-8">
                                                            <?php

                                                            echo "<select class='form-control m-bot15' name='nis'>
                                                                      <option value=''> Pilih Siswa </option>";
                                                              $siswa = mysql_query("SELECT nis FROM hb_prakerin WHERE nip_guru = $_SESSION[username] AND status_verifikasi = 'Terverifikasi' ");
                                                              while($de = mysql_fetch_array($siswa)){
                                                                $data3 = mysql_query( "SELECT * FROM hb_monitoring WHERE nis = $de[nis]");

                                                                $jumlah = mysql_fetch_row($data3);
                                                                if ($jumlah > 0) {
                                                                  continue;
                                                                }else{
                                                                  $o = mysql_fetch_array(mysql_query("SELECT nama,nis FROM siswa WHERE nis='$de[nis]'"));
                                                                  echo "<option value='$de[nis]'> $o[nama] </option>";
                                                                } 
                                                              }
                                                            echo "</select>";
                                                              ?>
                                                        </div>
                                                    </div>
                                                     <div class="form-group">
                                                        <label class="col-lg-4 col-sm-4 control-label">Tempat Prakerin</label>
                                                        <div class="col-lg-8">
                                                            <?php

                                                             echo "<select class='form-control m-bot15' name='id_du'>
                                                                      <option value=''> Pilih Tempat Prakerin </option>";
                                                                          $du = mysql_query( "SELECT * FROM hb_du,hb_du_penerima WHERE hb_du.id_du = hb_du_penerima.id_du AND sisa_kuota_penerimaan != 0 AND id_jurusan = '$j[id_jurusan]' AND status_du='Menerima'");
                                                                        while($z = mysql_fetch_array($du)){
                                                             echo " <option value='$z[id_du]'> $z[nama_du] </option>";
                                                                        }
                                                                     echo "
                                                                  </select>";
                                                              ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-lg-4 col-sm-4 control-label">Tanggal Monitoring</label>
                                                        <div class="col-lg-8">
                                                            <input class='form-control' type="date" name="tgl_monitoring">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-lg-4 col-sm-4 control-label">Kegiatan Siswa</label>
                                                        <div class="col-lg-8">
                                                            <textarea class='form-control' name="kegiatan"> Kegiatan Siswa </textarea>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-lg-4 col-sm-4 control-label">Masalah Yang Ditemukan</label>
                                                        <div class="col-lg-8">
                                                            <textarea class='form-control' name="masalah"> Masalah yang Ditemukan </textarea>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-lg-4 col-sm-4 control-label">Saran</label>
                                                        <div class="col-lg-8">
                                                            <textarea class='form-control' name="saran"> Saran </textarea>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-lg-4 col-sm-4 control-label"> Nilai</label>
                                                        <div class="col-lg-8">
                                                            <input class='form-control' type="text" name="nilai" placeholder="Nilai">
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
                                <div  style="text-transform:none" aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="<?php echo "edit$t[id_monitoring]"; ?>" class="modal fade">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                                <h5><big>Kelola Prakerin</big></h5>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="<?php echo "proses_kapprog.php?a=updatemonitoring&id=$t[id_monitoring]"; ?>"  enctype='multipart/form-data' class="form-horizontal" role="form">
                                                    <div class="form-group">
                                                        <label class="col-lg-4 col-sm-4 control-label">Nama Siswa</label>
                                                        <div class="col-lg-8">
                                                           <?php

                                                             echo "<select readonly class='form-control m-bot15' name='nis'>
                                                                      <option value=''> Pilih Siswa </option>";
                                                                          $siswa = mysql_query("SELECT nis FROM hb_monitoring WHERE nip_guru = $_SESSION[username]");
                                                                        while($d = mysql_fetch_array($siswa)){
                                                                          $o = mysql_fetch_array(mysql_query("SELECT nama,nis FROM siswa WHERE nis='$d[nis]'"));
                                                             echo " <option value='$o[nis]'";  if($t['nis']==$d['nis']){echo"selected";} echo "> $o[nama] </option>";
                                                                        }
                                                                     echo "
                                                                  </select>";
                                                          ?>
                                                            
                                                        </div>
                                                    </div>
                                                     <div class="form-group">
                                                        <label class="col-lg-4 col-sm-4 control-label">Tempat Prakerin</label>
                                                        <div class="col-lg-8">
                                                            <input readonly class='form-control' type="text" name="id_du" placeholder="Tempat Prakerin" value="<?php 
                                                            $d3 = mysql_fetch_array(mysql_query("SELECT nama_du FROM hb_du WHERE id_du ='$t[id_du]'"));
                                                            echo "$d3[nama_du]";?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-lg-4 col-sm-4 control-label">Tanggal Monitoring</label>
                                                        <div class="col-lg-8">
                                                            <input class='form-control' type="date" name="tgl_monitoring" value="<?php echo "$t[tgl_monitoring]"; ?>">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-lg-4 col-sm-4 control-label">Kegiatan Siswa</label>
                                                        <div class="col-lg-8">
                                                            <textarea class='form-control' name="kegiatan"> <?php echo "$t[kegiatan_siswa]"; ?> </textarea>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-lg-4 col-sm-4 control-label">Masalah Yang Ditemukan</label>
                                                        <div class="col-lg-8">
                                                            <textarea class='form-control' name="masalah"> <?php echo "$t[masalah_yg_ditemukan]"; ?> </textarea>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-lg-4 col-sm-4 control-label">Saran</label>
                                                        <div class="col-lg-8">
                                                            <textarea class='form-control' name="saran"> <?php echo "$t[saran]"; ?> </textarea>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-lg-4 col-sm-4 control-label"> Nilai</label>
                                                        <div class="col-lg-8">
                                                            <input class='form-control' type="text" name="nilai" placeholder="Nilai" value="<?php echo "$t[nilai]"; ?>">
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
                        <th>Nama Siswa</th>
                        <th>Tempat Prakerin</th>                        
                        <th>Tanggal Monitoring</th>
                        <th>Kegiatah Siswa</th>
                        <th>Masalah yang Ditemukan</th>
                        <th>Saran</th>
                        <th>Nilai</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $no =0;
                            while ($d = mysql_fetch_array($data)) {
                                $no = $no+1;
                                $tmonitor = tanggal($d["tgl_monitoring"]);
                                $d2 = mysql_fetch_array(mysql_query("SELECT nama FROM siswa WHERE nis ='$d[nis]'"));
                                $d3 = mysql_fetch_array(mysql_query("SELECT nama_du FROM hb_du WHERE id_du ='$d[id_du]'"));
                                echo "
                                    <tr class='gradeA'>
                                        <td> $no </td>
                                        <td> $d2[nama] </td>
                                        <td> $d3[nama_du]</td>
                                        <td> $tmonitor</td>
                                        <td> $d[kegiatan_siswa]</td>
                                        <td> $d[masalah_yg_ditemukan]</td>
                                        <td> $d[saran]</td>
                                        <td> $d[nilai]</td>
                                        <td class='center'>        
                                            <a href='#edit$d[id_monitoring]' data-toggle='modal'>
                                                <button class='btn btn-sm btn-danger' type='button'><i class='fa fa-pencil'></i> Edit </button>
                                            </a>
                                             <a href='#hapus$d[id_monitoring]' data-toggle='modal'>
                                                <button class='btn btn-sm btn-primary' type='button'><i class='fa fa-trash-o'></i> Hapus </button>
                                            </a>
                                        </td>
                                        <div  style='text-transform:none' aria-hidden='true' aria-labelledby='myModalLabel' role='dialog' tabindex='-1' id='hapus$d[id_monitoring]' class='modal fade'>
                                                <div class='modal-dialog'>
                                                    <div class='modal-content'>
                                                        <div class='modal-header'>
                                                            <button aria-hidden='true' data-dismiss='modal' class='close' type='button'>×</button>
                                                            <h5>Konfirmasi</h5>
                                                        </div>
                                                        <div class='modal-body'>
                                                            Anda Yakin Untuk Menghapusnya ?
                                                        </div>
                                                       <div class='modal-footer'>
                                                            <button type='button' class='btn btn-default' data-dismiss='modal'>Kembali</button>
                                                            <a href='proses_kapprog.php?a=hapusmonitoring&id=$d[id_monitoring]'>
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
        header('location:tahun_ajaran.php');
    }
}else{
    header('location:../login.php');
}

?>