<?php

include "../koneksidb.php";

if($_SESSION['level']=='siswa'){
    $title="Permohonan Perizinan Prakerin";
    $active = "";
    $active7 = "active";
    $navactive3 ="nav-active";

    include "leftside.php"; ?>
    
    <!--body wrapper start-->
    <div class="wrapper">
        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading"> <big> Tambah Kegiatan </big> </header>
                    <div class="panel-body">
                        <form class="form-horizontal form-label-left" method="POST" action="<?php echo "proses_siswa.php?a=tambah_kegiatan"; ?>" enctype="multipart/form-data">
                            <div class="form-group">
                                <br>
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"> Kegiatan Sekarang : </label>
                                <div  class="col-lg-6">
                                    <select required name="nama_kegiatan" id="nama_kegiatan" onclick="ajaxkota(this.value)" class='form-control'>
                                        <option value="">Pilih Kegiatan</option>
                                        <option value="Prakerin">Prakerin</option>
                                        <option value="Magang">Magang</option>
                                        <option value="Kerja">Kerja</option>
                                        <option value="Kuliah">Kuliah</option>
                                    </select>
                                </div>
                            </div>
                            <div class='item form-group'>
                                <br>
                                <label class='control-label col-md-3 col-sm-3 col-xs-12' for='name'>Keterangan Nama Tempat : <span class='required'></span> </label>
                                <div class='col-md-6 col-sm-6 col-xs-12' >
                                    <input class='form-control col-md-6 col-xs-12' name='nama_tempat'  placeholder='Nama Tempat' type='text' required> </div>
                            </div>

                            <div class="form-group">
                                <br>
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"> Status Kegiatan : </label>
                                <div  class="col-lg-6">
                                    <select required name="status_kegiatan" id="status_kegiatan" onclick="ajaxkota(this.value)" class='form-control'>
                                        <option value=""> Pilih Status Kegiatan </option>
                                        <option value="Berlangsung"> Berlangsung</option>
                                        <option value="Selesai"> Selesai </option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <br>
                                <label class="control-label col-md-3"> Tanggal Mulai Kegiatan : </label>
                                <div class="col-md-6">
                                    <div class="input-group input-large custom-date-range" data-date="2016/10/10" data-date-format="yyyy/mm/dd">
                                        <input type="text" class="form-control dpd1" data-date-format="yyyy/mm/dd" name="tglawal" placeholder="Tanggal Awal Kegiatan" required>
                                        <span class="input-group-addon"> - </span>
                                        <input type="text" class="form-control dpd2" data-date-format="yyyy/mm/dd" name="tglakhir"  placeholder="Tanggal Selesai Kegiatan" >
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <br>
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"> Alamat Tempat :</label>
                                <div class="col-lg-6 flat-green">
                                    <textarea class="form-control" name="alamat" rows="5" > </textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-offset-8 col-lg-10">
                                    <br>
                                        <button  type='submit' name='Tambahkan' value="Tambahkan" class="btn btn-primary"> Submit </button>
                                    <br><br><br>
                                </div>
                            </div>
                        </form>
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
