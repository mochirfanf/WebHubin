<?php

include "../koneksidb.php";

if($_SESSION['level']=='admin'){
	if ($_SESSION['tahun_ajaran']!='') {
        $title="Permohonan Perizinan Prakerin";
        $active ="";
        $active5 = "active";
        $navactive2 ="nav-active";

		include "leftside.php"; ?>

        <!--body wrapper start-->
        <?php 

            if(empty($_GET["id"])) {
                header("location:penerima_permintaan_prakerin.php");
            }
        ?>
        <div class="wrapper">
        <div class="row">
            <div class="col-sm-12">

                <section class="panel">
                    <header class="panel-heading"> <big>Informasi Penerimaan Siswa Untuk Prakerin </big> <span class="pull-right">

                     </span> </header>
                    <form class="form-horizontal form-label-left" method="POST" action="<?php echo "proses_admin.php?a=menerima&id=$_GET[id]"; ?>" enctype="multipart/form-data">
                        <div class="form-group">
                            <br><br>
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Permintaan Jurusan : </label>
                                <div class="input_fields_wrap col-lg-1">
                                    <button class="btn btn-danger add_field_button"><i class='fa fa-plus-square'></i></button>
                                </div>

                                <div style="margin-left: -50px;"  class="col-lg-4"><?php
                                    $name = "";
                                    echo "<select required class='form-control m-bot15' name='jurusan[]'>
                                            <option value=''> * Pilih Jurusan * </option>";
                                                $jurusan = mysql_query("SELECT * FROM jurusan");
                                                while($j = mysql_fetch_array($jurusan)){
                                     echo " <option value='$j[id_jurusan]' > $j[nama_jurusan] </option>";
                                                }
                                    echo "</select>";?>
                                </div>

                                <div style="margin-left: -25px;"  class="col-lg-2">
                                    <input type="number" class="form-control" name="jumlah[]" placeholder="Jumlah" required>
                                </div>
                        </div>
                        <div class="form-group">
                            <br>
                            <label class="control-label col-md-3">Tanggal Pelaksanaan Prakerin : </label>
                            <div class="col-md-6">
                                <div class="input-group input-large custom-date-range" data-date="2016/10/10" data-date-format="yyyy/mm/dd">
                                    <input type="text" class="form-control dpd1" data-date-format="yyyy/mm/dd" name="mulai" placeholder="Mulai Pelaksanaan Prakerin" required>
                                    <span class="input-group-addon"> - </span>
                                    <input type="text" class="form-control dpd2" data-date-format="yyyy/mm/dd" name="berakhir"  placeholder="Berakhir Pelaksanaan Prakerin" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <br>
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Penanggung Jawab :</label>
                            <div class="col-lg-6 flat-green">
                                <input type="text" class="form-control" name="nama_pj" placeholder="Nama Penanggung Jawab" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <br>
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Kontak Penanggung Jawab :</label>
                            <div class="col-lg-6 flat-green">
                                <input type="text" class="form-control" name="contact" placeholder="Kontak Penanggung Jawab" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <br>
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Jenis Seleksi :</label>
                            <div class="col-lg-6 flat-green">
                                <?php

                                    echo "<select class='form-control m-bot15' name='seleksi'>
                                                <option value='Ya'> Ya </option>
                                                <option value='Tidak'> Tidak </option>
                                          </select><br>";
                                ?>
                            </div>
                        </div>
                        <div class="form-group">
                        <div class="col-lg-offset-7 col-lg-5">
                                <a type="button" href="penerima_permintaan_prakerin.php" class="btn btn-danger"> Kembali </a>
                                <button value='Tambahkan' name='Tambahkan' type='submit' name='submit' class="btn btn-primary"> Submit </button>
                            <br><br><br>
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
