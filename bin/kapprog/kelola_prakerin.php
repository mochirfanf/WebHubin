<?php

include "../koneksidb.php";

if($_SESSION['level']=='kapprog'){ 
    if ($_SESSION['tahun_ajaran']!='') {
        $title="Kelola Penempatan Prakerin";
        $active ="";
        $active2 = "active";


        $j    = mysql_fetch_array(mysql_query("SELECT * FROM hb_du,hb_du_penerima,hb_guru_jurusan,jurusan WHERE hb_du.id_du = hb_du_penerima.id_du AND hb_guru_jurusan.id_jurusan = jurusan.id_jurusan AND nip_guru = '$_SESSION[username]' AND tahun_ajaran ='$_SESSION[tahun_ajaran]'")) ;
        
        $data = mysql_query( "select * from hb_prakerin,siswa WHERE hb_prakerin.nis = siswa.nis AND id_jurusan = $j[id_jurusan]");
        $data2 = mysql_query( "select * from hb_prakerin,siswa WHERE hb_prakerin.nis = siswa.nis AND id_jurusan = $j[id_jurusan]");

        include "leftside.php"; ?>
                
        <!--body wrapper start-->
        <div class="wrapper">
            <div class="row">
                <div class="col-sm-12">
                    <section class="panel">
                    <header class="panel-heading">
                        <big>Kelola Penempatan Prakerin</big>
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
                                                <form method="POST" action="proses_kapprog.php?a=inputkelolaprakerin"  enctype='multipart/form-data' class="form-horizontal" role="form">
                                                    <div class="form-group">
                                                        <label class="col-lg-4 col-sm-4 control-label">Nama Siswa</label>
                                                        <div class="col-lg-8">
                                                            <?php

                                                            echo "<select class='form-control m-bot15' name='nis'>
                                                                      <option value=''> Pilih Siswa </option>";
                                                              $siswa = mysql_query("SELECT nama,nis FROM siswa WHERE id_jurusan=$j[id_jurusan]");
                                                              while($de = mysql_fetch_array($siswa)){
                                                                $data3 = mysql_query( "SELECT * from hb_prakerin WHERE nis = $de[nis]");
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
                                                        <label class="col-lg-4 col-sm-4 control-label">Saran Pembimbing</label>
                                                        <div class="col-lg-8">
                                                            <?php

                                                             echo "<select class='form-control m-bot15' name='saran_pembimbing'>
                                                                      <option value=''> Pilih Saran Pembimbing Siswa </option>";
                                                                          $guru = mysql_query( "SELECT * FROM guru, hb_guru_jurusan WHERE guru.nip_guru = hb_guru_jurusan.nip_guru");
                                                                        while($y = mysql_fetch_array($guru)){
                                                             echo " <option value='$y[nip_guru]'> $y[nama] </option>";
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
                        <?php
                             while ($t = mysql_fetch_array($data2)) {
                                
                                ?>
                                <div  style="text-transform:none" aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="<?php echo "edit$t[id_prakerin]"; ?>" class="modal fade">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                                <h5><big>Kelola Prakerin</big></h5>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="<?php echo "proses_kapprog.php?a=updatekelolaprakerin&id=$t[id_prakerin]"; ?>"  enctype='multipart/form-data' class="form-horizontal" role="form">
                                                    <div class="form-group">
                                                        <label class="col-lg-4 col-sm-4 control-label">Nama Siswa </label>
                                                        <div class="col-lg-8">
                                                            <?php

                                                             echo "<select readonly class='form-control m-bot15' name='nis'>
                                                                      <option value=''> Pilih Siswa </option>";
                                                                          $siswa = mysql_query("SELECT nama,nis FROM siswa WHERE id_jurusan=$j[id_jurusan]");
                                                                        while($d = mysql_fetch_array($siswa)){
                                                             echo " <option value='$d[nis]'";  if($t['nis']==$d['nis']){echo"selected";} echo "> $d[nama] </option>";
                                                                        }
                                                                     echo "
                                                                  </select>";
                                                              ?>
                                                        </div>
                                                    </div>
                                                     <div class="form-group">
                                                        <label class="col-lg-4 col-sm-4 control-label">Tempat Prakerin</label>
                                                        <div class="col-lg-8">
                                                            <?php

                                                             echo "<select class='form-control m-bot15' name='id_du'>
                                                                      <option value=''> Pilih Tempat Prakerin </option>";
                                                                          $du = mysql_query( "SELECT * from hb_du,hb_du_penerima WHERE hb_du.id_du = hb_du_penerima.id_du AND id_jurusan = '$j[id_jurusan]' AND status_du='Menerima'");
                                                                        while($z = mysql_fetch_array($du)){
                                                             echo " <option value='$z[id_du]'"; if($t['id_du']==$z['id_du']){echo"selected";} if($z['sisa_kuota_penerimaan']==0){echo"disabled";} echo " > $z[nama_du]</option>";
                                                                        }
                                                                     echo "
                                                                  </select>
                                                                  <input type='hidden' name='iddulama' value='$t[id_du]'>";
                                                              ?>
                                                        </div>
                                                    </div>
                                                     <div class="form-group">
                                                        <label class="col-lg-4 col-sm-4 control-label">Saran Pembimbing</label>
                                                        <div class="col-lg-8">
                                                            <?php

                                                             echo "<select class='form-control m-bot15' name='saran_pembimbing'>
                                                                      <option value=''> Pilih Saran Pembimbing Siswa </option>";
                                                                          $guru = mysql_query( "SELECT * FROM guru, hb_guru_jurusan WHERE guru.nip_guru = hb_guru_jurusan.nip_guru");
                                                                        while($y = mysql_fetch_array($guru)){
                                                             echo " <option value='$y[nip_guru]' "; if($t['nip_guru']==$y['nip_guru']){echo"selected";} echo "> $y[nama] </option>";
                                                                        }
                                                                     echo "
                                                                  </select>";
                                                              ?>
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
                        <th>Kelas</th>
                        <th>Tempat Prakerin</th>
                        <th>Pembimbing</th>
                        <th>Status Verifikasi</th>
                        <th>Edit</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $no =0;
                            while ($d = mysql_fetch_array($data)) {
                                $no = $no+1;
                                $d2 = mysql_fetch_array(mysql_query("SELECT nama FROM guru WHERE nip_guru ='$d[nip_guru]'"));
                                $d3 = mysql_fetch_array(mysql_query("SELECT nama,kelas FROM siswa WHERE nis ='$d[nis]'"));
                                $d4 = mysql_fetch_array(mysql_query("SELECT nama_du FROM hb_du WHERE id_du ='$d[id_du]'"));
                                echo "
                                    <tr class='gradeA'>
                                        <td> $no </td>
                                        <td> $d3[nama] </td>
                                        <td> $d3[kelas] </td>
                                        <td> $d4[nama_du]</td>
                                        <td> $d2[nama]</td>
                                        <td> $d[status_verifikasi]</td>
                                        <td class='center'>";        
                                            if ($d["status_verifikasi"] == 'Menunggu Verifikasi') {
                                            echo "<a href='#edit$d[id_prakerin]' data-toggle='modal'>
                                                    <button class='btn btn-sm btn-danger' type='button'><i class='fa fa-pencil'></i> Edit </button>
                                                  </a>
                                                  <a href='#hapus$d[id_prakerin]' data-toggle='modal'>
                                                      <button class='btn btn-sm btn-primary' type='button'><i class='fa fa-trash-o'></i> Hapus </button>
                                                  </a>";
                                            }elseif ($d["status_verifikasi"] == 'Terverifikasi') {
                                              echo "<a href='#edit$d[id_prakerin]' data-toggle='modal'>
                                                    <button disabled class='btn btn-sm btn-danger' type='button'><i class='fa fa-pencil'></i> Edit </button>
                                                  </a>
                                                  <a href='#hapus$d[id_prakerin]' data-toggle='modal'>
                                                      <button disabled class='btn btn-sm btn-primary' type='button'><i class='fa fa-trash-o'></i> Hapus </button>
                                                  </a>";
                                            }
                                            
                                  echo "</td>
                                        <div  style='text-transform:none' aria-hidden='true' aria-labelledby='myModalLabel' role='dialog' tabindex='-1' id='hapus$d[id_prakerin]' class='modal fade'>
                                                <div class='modal-dialog'>
                                                    <div class='modal-content'>
                                                        <div class='modal-header'>
                                                            <button aria-hidden='true' data-dismiss='modal' class='close' type='button'>×</button>
                                                            <h5>Konfirmasi</h5>
                                                        </div>
                                                        <div class='modal-body'>
                                                            Hapus Siswa $d3[nama] ?
                                                        </div>
                                                       <div class='modal-footer'>
                                                            <button type='button' class='btn btn-default' data-dismiss='modal'>Kembali</button>
                                                            <a href='proses_kapprog.php?a=hapusprakerin&id=$d[id_prakerin]'>
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