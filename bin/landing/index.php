<?php
include "header.php";
?>
    <!--.preloader-->
    <div class="preloader"> <i class="fa fa-circle-o-notch fa-spin"></i></div>
    <!--/.preloader-->
    <header id="home">
        <div id="home-slider" class="carousel slide carousel-fade" data-ride="carousel">
            <div class="carousel-inner">
                <div class="item active" style="background-image: url(images/slider/1.jpg)">
                  <div class="caption">
                    <h1 style="margin-bottom: 20px; margin-top: 75px; font-size: 50px;" class="animated fadeInLeftBig">Selamat Datang <font style="text-transform:lowercase" > di </font> <span style="color:#1DD8A5">HUBIN</span></h1>
                    <p style="color: #fff; text-transform: capitalize;" class="animated fadeInRightBig"><font style="font-weight:400; color: #37ae8e;">HUBUNGAN INDUSTRI</font> SMKN 1 CIMAHI</p>
                    <?php
                        if(isset($_SESSION['level'])){
                            ?>
                            <a data-scroll class="btn btn-start animated fadeInUpBig" href='<?php echo'../'. $_SESSION['level'].'/index.php';?>'>Dashboard</a>
                            <?php
                        }
                        else{
                    ?>
                    <a data-scroll class="btn btn-start animated fadeInUpBig" data-toggle="modal" data-target="#login">Login</a>
                    <a data-scroll class="btn btn-start animated fadeInUpBig"  data-toggle="modal" data-target="#register">Lakukan Kerjasama</a>
                    <?php
                }
                ?>
                  </div>
                </div>
                <div class="item" style="background-image: url(images/slider/2.jpg)">
                  <div class="caption">
                    <h1 style="color:#1FF3B9; margin-top: 20px; font-size: 40px;" class="animated fadeInLeftBig">Membantu <font style="text-transform:lowercase" > dan </font> Mempermudah</h1>
                    <h1 style=" color:#fff; margin-top:-20px; font-size: 40px; margin-bottom:60px; " class="animated fadeInRightBig"> Praktek Kerja Industri </h1>
                    <p style="color: #fff; text-transform: capitalize;" class="animated fadeInLeftBig"><font style="font-weight:400; color: #1EF2B8;">HUBUNGAN INDUSTRI</font> SMKN 1 CIMAHI</p>

                    <?php
                        if(isset($_SESSION['level'])){
                            ?>
                            <a data-scroll class="btn btn-start animated fadeInUpBig" href='<?php echo'../'. $_SESSION['level'].'/index.php';?>'>Dashboard</a>
                            <?php
                        }
                        else{
                    ?>
                    <a data-scroll class="btn btn-start animated fadeInUpBig" data-toggle="modal" data-target="#login">Login</a>
                    <a data-scroll class="btn btn-start animated fadeInUpBig"  data-toggle="modal" data-target="#register">Lakukan Kerjasama</a>
                    <?php
                }
                ?>
                  </div>
                </div>
                <div class="item" style="background-image: url(images/slider/3.jpg)">
                  <div class="caption">
                    <h1 class="animated fadeInLeftBig">SESUATU YANG <span style="color:#1DD8A5">BARU</span></h1>
                    <p style="color: #fff; text-transform: capitalize;" class="animated fadeInRightBig"><font style="font-weight:400; color: #1EF2B8;">HUBUNGAN INDUSTRI</font> SMKN 1 CIMAHI</p>
                    <?php
                        if(isset($_SESSION['level'])){
                            ?>
                            <a data-scroll class="btn btn-start animated fadeInUpBig" href='<?php echo'../'. $_SESSION['level'].'/index.php';?>'>Dashboard</a>
                            <?php
                        }
                        else{
                    ?>
                    <a data-scroll class="btn btn-start animated fadeInUpBig" data-toggle="modal" data-target="#login">Login</a>
                    <a data-scroll class="btn btn-start animated fadeInUpBig"  data-toggle="modal" data-target="#register">Lakukan Kerjasama</a>
                    <?php
                }
                ?>
                  </div>
                </div>
            </div> <a class="left-control" href="#home-slider" data-slide="prev"><i class="fa fa-angle-left"></i></a> <a class="right-control" href="#home-slider" data-slide="next"><i class="fa fa-angle-right"></i></a> <a id="tohash" href="#services"><i class="fa fa-angle-down"></i></a> </div>
        <!--/#home-slider-->
        <div class="main-nav">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                    <a class="navbar-brand" href="index.html">
                        <h1><img class="img-responsive" src="images/logo.png" alt="logo"> </h1> </a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="scroll active"><a href="#home">Home</a></li>
                        <li class="scroll"><a href="#prakerin">Prakerin</a></li>
                        <li class="scroll"><a href="#lowongankerja">Lowongan Kerja</a></li>
                        <li class="scroll"><a href="#kontak-kami">Kontak Kami</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!--/#main-nav-->
    </header>
    <!--/#home-->
    <!-- Modal -->

    <div class='modal fade' id='register' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
        <div class='modal-dialog'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                    <h4 class='modal-title' id='myModalLabel'>Register Perusahaan</h4> </div>
                <div class='modal-body'>
                    <form class='form-horizontal form-label-left' method='POST' action='../proses.php?a=register' enctype='multipart/form-data'>
                        <div class='item form-group'>
                            <label class='control-label col-md-3 col-sm-3 col-xs-12' for='name'>Nama Perusahaan : <span class='required'></span> </label>
                            <div class='col-md-9 col-sm-9 col-xs-12' style='margin-bottom:20px;'>
                                <input class='form-control col-md-7 col-xs-12' name='nama'  placeholder='Nama Perusahaan' type='text' required> </div>
                        </div>
                        <div class='item form-group'>
                            <label class='control-label col-md-3 col-sm-3 col-xs-12' for='name'> Email :<span class='required'></span> </label>
                            <div class='col-md-9 col-sm-9 col-xs-12' style='margin-bottom:20px;'>
                                <input class='form-control col-md-7 col-xs-12' name='email'  placeholder='Email' type='email' required> </div>
                        </div>
                        <div class='item form-group'>
                            <label class='control-label col-md-3 col-sm-3 col-xs-12' for='name'> Alamat :<span class='required'></span> </label>
                            <div class='col-md-9 col-sm-9 col-xs-12' style='margin-bottom:20px;'>
                                <textarea class='form-control col-md-7 col-xs-12' name='alamat'  placeholder='Alamat' required></textarea>
                            </div>
                        </div>
                        <div class='item form-group'>
                            <label class='control-label col-md-3 col-sm-3 col-xs-12' for='name'> Provinsi :<span class='required'></span> </label>
                            <div class='col-md-9 col-sm-9 col-xs-12' style='margin-bottom:20px;'>
                                <select required name="prop" id="prop" onclick="ajaxkota(this.value)" class='form-control'>
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
                        <div class='item form-group'>
                            <label class='control-label col-md-3 col-sm-3 col-xs-12' for='name'> Kota/Kabupaten :<span class='required'></span> </label>
                            <div class='col-md-9 col-sm-9 col-xs-12' style='margin-bottom:20px;'>
                                <select required name="kota" id="kota" onchange="ajaxkec(this.value)" class='form-control'>
                                    <option value="">Pilih Kota/Kabupaten</option>
                                </select>
                            </div>
                        </div>
                        <div class='item form-group'>
                            <label class='control-label col-md-3 col-sm-3 col-xs-12' for='name'> Kecamatan :<span class='required'></span> </label>
                            <div class='col-md-9 col-sm-9 col-xs-12' style='margin-bottom:20px;'>
                                <select required name="kec" id="kec" onchange="ajaxkel(this.value)" class='form-control'>
                                    <option value="">Pilih Kecamatan</option>
                                </select>
                            </div>
                        </div>
                        <div class='item form-group'>
                            <label class='control-label col-md-3 col-sm-3 col-xs-12' for='name'> Kelurahan/Desa :<span class='required'></span> </label>
                            <div class='col-md-9 col-sm-9 col-xs-12' style='margin-bottom:20px;'>
                                <select required name="kel" id="kel" onchange="showCoordinate();" class='form-control'>
                                    <option value="">Pilih Kelurahan/Desa</option>
                                </select>
                            </div>
                        </div>
                        <div class='item form-group'>
                            <label class='control-label col-md-3 col-sm-3 col-xs-12' for='name'> Kode Pos :<span class='required'></span> </label>
                            <div class='col-md-9 col-sm-9 col-xs-12' style='margin-bottom:20px;'>
                                <input required class='form-control col-md-7 col-xs-12' name='kodepos' placeholder='Kode Pos' type='number'> </div>
                        </div>
                </div>
                <div class='modal-footer'>
                    <div class='form-group'>
                        <div class='col-md-4 col-md-offset-8'>
                            <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
                            <button style=' margin-top: -5px;' value='DAFTAR' id='send' type='submit' class='btn btn-success' name='DAFTAR'>Tambah</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>





    <div class='modal fade' id='login' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
        <div class='modal-dialog'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                    <h4 class='modal-title' id='myModalLabel'>Login</h4> </div>
                <div class='modal-body'>
                    <form class='form-horizontal form-label-left' method='POST' action='../proses.php?a=login' enctype='multipart/form-data'>
                        <div class='item form-group'>
                            <label class='control-label col-md-3 col-sm-3 col-xs-12' for='name'>Username : <span class='required'></span> </label>
                            <div class='col-md-9 col-sm-9 col-xs-12' style='margin-bottom:20px;'>
                                <input class='form-control col-md-7 col-xs-12' name='username'  placeholder='Username' type='text' required> </div>
                        </div>
                        <div class='item form-group'>
                            <label class='control-label col-md-3 col-sm-3 col-xs-12' for='name'> Password :<span class='required'></span> </label>
                            <div class='col-md-9 col-sm-9 col-xs-12' style='margin-bottom:20px;'>
                                <input class='form-control col-md-7 col-xs-12' name='password'  placeholder='Password' type='password' required> </div>
                        </div>
                        <div class='modal-footer'>
                    <div class='form-group'>
                        <div class='col-md-4 col-md-offset-8'>
                            <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
                            <button style=' margin-top: -5px;' value='login' id='send' type='submit' class='btn btn-success' name='login'>Login</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>



            <div class='modal fade' id='detail' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
<?php

                                    

?>
        <div class='modal-dialog'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                    <h4 class='modal-title' id='myModalLabel'>Detail Pekerjaan Kerja</h4> </div>
                <div class='modal-body'>
                    <form class='form-horizontal form-label-left' method='POST' action='' enctype='multipart/form-data'>
                        
                        <div class="col-lg-12"><?php
                                    echo "<input type='hidden' id='id' name='id'>";
                                    ?>
                                    <div class='col-md-12'>
                                        <h3 id='namadu'></h3><br>

                                <span class="form-horizontal form-label-left">
                                    <div class="form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12"> Jurusan : </label>
                                        <div class="col-lg-6 flat-green">
                                            <span id='jurusan'></span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Nama Penanggung Jawab :</label>
                                        <div style="margin-top:7px" class="col-lg-6 flat-green">
                                            <span id='penanggung'></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Kontak Penanggung Jawab :</label>
                                        <div style="margin-top:7px" class="col-lg-6 flat-green">
                                           <span id='cp'></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Jenis Seleksi :</label>
                                        <div style="margin-top:7px" class="col-lg-6 flat-green">
                                            <span id='jenis_seleksi'></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Tempat Seleksi :</label>
                                        <div style="margin-top:7px" class="col-lg-6 flat-green">
                                            <span id='tempat'></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Tanggal Seleksi :</label>
                                        <div style="margin-top:7px" class="col-lg-6 flat-green">
                                            <span id='tanggal'></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Gaji :</label>
                                        <div style="margin-top:7px" class="col-lg-6 flat-green">
                                            <span id='gaji'></span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Lainnya :</label>
                                        <div style="margin-top:7px" class="col-lg-6 flat-green">
                                            <span id='lain'></span>
                                        </div>
                                    </div>

                                    </div>
                                </div>
                </div>
                <div class='modal-footer' style='border: 0'>
                    <div class='form-group'>
                        <div class='col-md-4 col-md-offset-8'>
                            <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
                            <button style=' margin-top: -5px;' value='pilih' id='send' type='submit' class='btn btn-success' name='pilih'>Pilih</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <section id="prakerin">
        <div class="container">
            <div class="heading wow fadeInDown" data-wow-duration="2000ms" data-wow-delay="500ms">
                <div class="row">
                    <div class="text-center col-md-12">
                        
              </div>
            </div>
          </div>

            <div class="row">
              <div class='col-md-12'>
              <h2>Prakerin</h2>
              </div>
              <div class='col-md-12 bxlow'>
            </div>
            </div>
  </section>

    <section id="lowongankerja">
        <div class="container">
            <div class="heading wow fadeInDown" data-wow-duration="2000ms" data-wow-delay="500ms">
                <div class="row">
                    <div class="text-center col-md-12">
                        
              </div>
            </div>
          </div>

            <div class="row">
              <div class='col-md-12'>
              <h2>Lowongan Pekerjaan</h2>
              </div>
              <div class='col-md-12 bxlow'>
                    <?php
                        $data = mysql_query("SELECT * FROM hb_du_permintaan_kerja INNER JOIN hb_du_umum ON hb_du_permintaan_kerja.id_du = hb_du_umum.id_du WHERE status_permintaan='Sudah Terverifikasi' LIMIT 3");
                        while($d = mysql_fetch_array($data)){
                            ?>

                            <div class='col-md-12 krj'>
                                <span class='col-md-10 nmpt'><h4><?php echo $d['nama_du']?></h4></span>
                                <a href='#detail' data-toggle='modal' data-id='<?php echo $d['id_du_kerja']?>'><span class='btn btn-primary col-md-2'>Detail Pekerjaan</a>
                                </span>
                                <span class='col-md-10 det'><?php echo substr($d['lainnya'],0,50)?></span><span class='btn btn-info col-md-2'>Lamar Pekerjaan</span>
                            </div>
                            <?php
                        }
                    ?>
              </div>

              <div class='col-md-12'>
                <ul class="pagination" style='float: right;'>
                <?php
                    $jm = mysql_num_rows(mysql_query("SELECT * FROM hb_du_permintaan_kerja INNER JOIN hb_du_umum ON hb_du_permintaan_kerja.id_du = hb_du_umum.id_du WHERE status_permintaan='Sudah Terverifikasi'"));
                    $total = ceil($jm/3);
                    for($a=0;$a<$total;$a++){
                ?>
                  <li><a class="active" href="#">1</a></li>
                  <?php
                    }
                  ?>
                </ul>
              </div>
            </div>


      </div>
  </section>

    <section id="visi">
        <div class="container">
            <div class="heading wow fadeInDown" data-wow-duration="2000ms" data-wow-delay="500ms">
                <div class="row">
                    <div class="text-center col-md-12">
                        <h2>Visi Kami</h2 >
              </div>
            </div>
          </div>

            <div class="row">
              <div class="wow fadeInLeft" data-wow-duration="2000ms" data-wow-delay="500ms">
                <div id="visi-text" class="col-md-6">
                  "Menjadi lembaga diklat yang bermutu dan berbudaya, sehingga menghasilkan insan yang mandiri, kompetitif, sejahtera dan agamis serta berkemampuan yang relevan dengan kebutuhan masyarakat lokal maupun global"
                </div>
              </div>

              <div class="wow fadeInRight" data-wow-duration="2000ms" data-wow-delay="500ms">
                <div class="col-md-6">
                  <img style="float:right; margin-right: -119px;" width="500px" src="images/visi.jpg">
                </div>
              </div>
            </div>


      </div>
  </section>


  <section id="misi">
    <div class="container">
      <div class="heading wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
        <div class="row">
          <div class="text-center col-sm-8 col-sm-offset-2">
            <h2>Misi Kami</h2> </div>
                </div>
            </div>
            <div class="text-center our-services">
                <div class="row" style="margin-top:-60px;     margin-left: 130px;">
                    <div class="col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms">
                        <div class="service-icon"> <i class="fa fa-graduation-cap"></i> </div>
                        <div class="service-info">
                            <h3>Menghasilkan</h3>
                            <p class="tmisi">Menghasilkan tamatan yang cerdas, terampil, kompetitif dan mandiri.</p>
                        </div>
                    </div>
                    <div style="margin-left:-110px" class="col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="450ms">
                        <div class="service-icon"> <i class="fa fa-heart"></i> </div>
                        <div class="service-info">
                            <h3>Menjadikan</h3>
                            <p class="tmisi">Menjadikan lingkungan yang menjungjung tinggi budaya bangsa dan budi pekerti luhur.</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4 wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="650ms">
                        <div class="service-icon"> <i class="fa fa-line-chart"></i> </div>
                        <div class="service-info">
                            <h3>Menanamkan</h3>
                            <p class="tmisi">Menanamkan jiwa kewirausahaan (entrepreneurship) bagi semua lulusan.</p>
                        </div>
                    </div>
                    <div class="col-sm-4 wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="750ms">
                        <div class="service-icon"> <i class="fa fa-group"></i> </div>
                        <div class="service-info">
                            <h3>Mengembangkan</h3>
                            <p class="tmisi">Mengembangkan ilmu pengetahuan dan teknologi yang relevan dengan kebutuhan masyarakat lokal maupun global.</p>
                        </div>
                    </div>
                    <div class="col-sm-4 wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="850ms">
                        <div class="service-icon"> <i class="fa fa-thumbs-o-up"></i> </div>
                        <div class="service-info">
                            <h3>Mewujudkan</h3>
                            <p class="tmisi">Mewujudkan layanan prima terhadap semua pelanggan.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="tentang-kami">
        <div class="container">
            <div class="row">
                <div class="heading text-center col-sm-8 col-sm-offset-2 wow fadeInUp" data-wow-duration="1200ms" data-wow-delay="300ms">
                    <h2>Tentang Hubin</h2>
                    <p>Hubin SMK Negeri 1 Cimahi mempunyai Wewenang dan Tanggung Jawab untuk melakukan <b>Kontrak Kerjasama</b>, yaitu Menentukan kontrak kerjasama dengan pihak industri/dunia usaha, <b>Pelaksanaan Prakerin</b> yaitu Melaksanakan praktik kerja industri (prakerin) pada setiap program keahlian dengan baik dan <b>Karir Siswa</b> yaitu Mengusahakan tercapainya karir siswa secara optimal.</p>
                </div>
            </div>
            <div class="team-members">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="team-member wow flipInY" data-wow-duration="1000ms" data-wow-delay="300ms">
                            <div class="member-image"> <img class="img-responsive" src="images/team/1.jpg" alt=""> </div>
                            <div class="member-info">
                                <h3>Lisna</h3>
                                <h4>Administrasi &amp; Hubin</h4> </div>
                            <div class="social-icons">
                                <ul>
                                    <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="team-member wow flipInY" data-wow-duration="1000ms" data-wow-delay="500ms">
                            <div class="member-image"> <img class="img-responsive" src="images/team/2.jpg" alt=""> </div>
                            <div class="member-info">
                                <h3>Dwi</h3>
                                <h4>Lorem Ipsum</h4> </div>
                            <div class="social-icons">
                                <ul>
                                    <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="team-member wow flipInY" data-wow-duration="1000ms" data-wow-delay="800ms">
                            <div class="member-image"> <img class="img-responsive" src="images/team/3.jpg" alt=""> </div>
                            <div class="member-info">
                                <h3>Lorem Ipsum</h3>
                                <h4>Dollar si amet</h4> </div>
                            <div class="social-icons">
                                <ul>
                                    <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="team-member wow flipInY" data-wow-duration="1000ms" data-wow-delay="1100ms">
                            <div class="member-image"> <img class="img-responsive" src="images/team/4.jpg" alt=""> </div>
                            <div class="member-info">
                                <h3>Sri Gantini</h3>
                                <h4>Lorem ipsum</h4> </div>
                            <div class="social-icons">
                                <ul>
                                    <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/#team-->
    <section id="tujuan">
        <div class="container">
            <div class="heading wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
                <div class="row">
                    <div class="text-center col-sm-8 col-sm-offset-2">
                        <h2>Tujuan Prakerin</h2> </div>
                </div>
            </div>
            <div class="text-center our-services">
                <div class="row">
                    <div class="col-sm-4 wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="650ms">
                        <div class="rounded service-icon"> <i class="fa fa-suitcase"></i> </div>
                        <div class="service-info">
                            <h3>DU/DI</h3>
                            <p>Memberikan bekal wawasan tentang Dunia Usaha/ Dunia Industri (DU/ DI) kepada siswa sebagai calon tenaga kerja tingkat menegah</p>
                        </div>
                    </div>
                    <div class="col-sm-4 wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="750ms">
                        <div class="rounded service-icon"> <i class="fa fa-user-plus"></i> </div>
                        <div class="service-info">
                            <h3>Entrepreneurship</h3>
                            <p>Memberikan bekal kepada siswa untuk memperdalam dan mengembangkan ilmu yang sesuai dengan Kompetensi Keahlian dalam rangka meningkatkan kompetensi dan menumbuhkan jiwa kewirausahaan (Entrepreneurship).</p>
                        </div>
                    </div>
                    <div class="col-sm-4 wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="850ms">
                        <div class="rounded service-icon"> <i class="fa fa-book"></i> </div>
                        <div class="service-info">
                            <h3>Teori & Praktek</h3>
                            <p>Mengaplikasikan pelajaran teori dan praktek yang diberikan di sekolah dengan kenyataan yang ada di dunia usaha/dunia industri.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="berita">
        <div class="container">
            <div class="row">
                <div class="heading text-center col-sm-8 col-sm-offset-2 wow fadeInUp" data-wow-duration="1200ms" data-wow-delay="300ms">
                    <h2>Berita Hubin</h2>
                    <p>Seputar informasi tentang kegiatan dan aktivitas hubin serta berita dari berbagai media tentang informasi terkini dari berbagai sumber.</p>
                </div>
            </div>
            <div class="blog-posts">
                <div class="row">
                    <div class="col-sm-8 wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="400ms">
                        <h2>Berita Terkini</h2>
                        <?php
			$data = mysql_query( "SELECT * from hb_berita ORDER BY id_berita DESC LIMIT 3");
			while ($d = mysql_fetch_array($data)) {
			?>
                            <div class="post-thumb2"> <a href="detail_berita.php?id=<?php echo $d['id_berita'] ?>"><img class="img-responsive" src="../images/uploads/<?php echo $d['foto_berita'] ?>" alt=""></a> </div>
                            <div class="entry-header">
                                <h3><a href="detail_berita.php?id=<?php echo $d['id_berita'] ?>"><?php echo $d['judul_berita'] ?></a></h3> <span class="date"><?php echo $d['tgl_berita'] ?></span> <span class="cetagory">by <strong><?php echo $d['sumber'] ?></strong></span> </div>
                            <div class="entry-content">
                                <p>
                                    <?php
              $text = $d['isi_berita'];
				if(strlen($text) > 200)
				{
				$textdisplay = substr($text,0,50).'.. <a href="detail_berita.php?id='.$d['id_berita'].'">selengkapnya</a>';
				}
				else
				{
				$textdisplay = $text;
				}
                echo  $textdisplay; ?> </p>
                            </div>
                            <?php } ?>
                                <div class="load-more wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="500ms"> <a href="list_berita.php" class="btn-loadmore"><i class="fa fa-repeat"></i> Lihat lainnya</a> </div>
                    </div>
                    <div class="col-sm-4 wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="600ms">
                        <h2>Berita Pilihan</h2>
                        <?php
			$data2 = mysql_query( "SELECT * from hb_berita WHERE hits_berita > 1 ORDER BY id_berita DESC LIMIT 1");
			while ($d2 = mysql_fetch_array($data2)) {
			?>
                            <div class="post-thumb">
                                <div id="post-carousel" class="slide">
                                    <div class="carousel-inner">
                                        <div class="item active"> <a href="detail_berita.php?id=<?php echo $d2['id_berita'] ?>"><img class="img-responsive" src="../images/uploads/<?php echo $d2['foto_berita'] ?>" alt=""></a> </div>
                                    </div>
                                </div>
                            </div>
                            <div class="entry-header">
                                <h3><a href="detail_berita.php?id=<?php echo $d2['id_berita'] ?>"><?php echo $d2['judul_berita'] ?></a></h3> <span class="date"><?php echo $d2['tgl_berita'] ?></span> <span class="cetagory">by <strong><?php echo $d2['sumber'] ?></strong></span> </div>
                            <div class="entry-content">
                                <p>
                                    <?php
              $text2 = $d2['isi_berita'];
				if(strlen($text2) > 200)
				{
				$textdisplay2 = substr($text2,0,50).'.. <a href="detail_berita.php?id='.$d2['id_berita'].'">selengkapnya</a>';
				}
				else
				{
				$textdisplay2 = $text2;
				}
                echo  $textdisplay2; ?> </p>
                            </div>
                            <?php } ?>
                                <div class="load-more wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="500ms"> <a href="list_berita.php" class="btn-loadmore2"><i class="fa fa-repeat"></i> Lihat lainnya</a> </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/#blog-->
    <section id="kontak-kami">
        <div id="contact-us" class="parallax">
            <div class="container">
                <div class="row">
                    <div class="heading text-center col-sm-8 col-sm-offset-2 wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
                        <h2>Kontak Kami</h2>
                        <p>Silakan anda bisa mengirim pesan dengan mengisi form dibawah ini kepada kami.</p>
                    </div>
                </div>
                <div class="contact-form wow fadeIn" data-wow-duration="1000ms" data-wow-delay="600ms">
                    <div class="row">
                        <div class="col-sm-6">
                            <form id="main-contact-form" name="contact-form" method="post" action="#">
                                <div class="row  wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="text" name="name" class="form-control" placeholder="Nama" required="required"> </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control" placeholder="Email Anda" required="required"> </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="subject" class="form-control" placeholder="Judul" required="required"> </div>
                                <div class="form-group">
                                    <textarea name="message" id="message" class="form-control" rows="4" placeholder="masukan pesan anda" required="required"></textarea>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn-submit">Kirim</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-sm-6">
                            <div class="contact-info wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
                                <p>Atau Anda bisa datang langsung ke kantor kami di :</p>
                                <ul class="address">
                                    <li><i class="fa fa-map-marker"></i> <span> Alamat:</span> Jl. Mahar Martanegara No.48 Leuwigajah, Kota Cimahi 40533 </li>
                                    <li><i class="fa fa-phone"></i> <span> Telp:</span> (022) 6629683 </li>
                                    <li><i class="fa fa-envelope"></i> <span> Email:</span><a href="mailto:smkn1cmi@bdg.centrim.net.id"> smkn1cmi@bdg.centrim.net.id</a></li>
                                    <li><i class="fa fa-globe"></i> <span> Website:</span> <a href="http://hubin.smkn1-cmi.sch.id">hubin.smkn1-cmi.sch.id</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/#contact-->
    <?php
include "footer.php";
?>
