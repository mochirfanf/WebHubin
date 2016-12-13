
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="ThemeBucket">
  <link rel="shortcut icon" href="#" type="image/png">

  <title><?php echo " $title ";  ?></title>

  <!--dynamic table-->
  <link href="../js/advanced-datatable/css/demo_page.css" rel="stylesheet" />
  <link href="../js/advanced-datatable/css/demo_table.css" rel="stylesheet" />
  <link rel="stylesheet" href="../js/data-tables/DT_bootstrap.css" />

  <!--gritter css-->
  <link rel='stylesheet' type='text/css' href='../js/gritter/css/jquery.gritter.css' />

  <!--icheck-->
  <link href="../js/iCheck/skins/flat/green.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/jquery-ui_auto_complete.css">
  <!--file upload-->
  <link rel="stylesheet" type="text/css" href="../css/bootstrap-fileupload.min.css" />
 
  <!--pickers css-->
  <link rel="stylesheet" type="text/css" href="../css/datepicker-custom.css" />
  <link rel="stylesheet" type="text/css" href="../css/timepicker.css" />
  <link rel="stylesheet" type="text/css" href="../css/colorpicker.css" />
  <link rel="stylesheet" type="text/css" href="../js/bootstrap-daterangepicker/daterangepicker-bs3.css" />
  <link rel="stylesheet" type="text/css" href="../css/datetimepicker-custom.css" />


  <link href="../css/style.css" rel="stylesheet">
  <link href="../css/style-responsive.css" rel="stylesheet">
</head>

<body class="sticky-header">

<section>
    <!-- left side start-->
    <div class="baru left-side sticky-left-side">

<?php 
    include_once("../koneksidb.php");
    $iden = mysql_fetch_array(mysql_query("SELECT * FROM guru WHERE nip_guru='$_SESSION[username]'"));

?>
        <!--logo and iconic logo start-->
        <div class="logo">
            <div class='crc'></div>
            <div class='leftcrc'><?php echo $iden['nama_guru']?><br><br>
                <div class='text-center'>
                    <div class='levell'><?php echo strtoupper($_SESSION['level'])?></div>
                </div>
            </div>
        </div>

        <div class="logo-icon text-center">
            <a href=""><img src="../images/logo_icon.png" alt=""></a>
        </div>
        <!--logo and iconic logo end-->


        <div class="left-side-inner">

            <!-- visible to small devices only -->
            <div class="visible-xs hidden-sm hidden-md hidden-lg">
                <div class="media logged-user">
                    <img alt="" src="../images/admin/deae.jpg" class="media-object">
                    <div class="media-body">
                        <h4><a href="#">Dea Emalia</a></h4>
                        <span>"Bismillah..."</span>
                    </div>
                </div>

                <h5 class="left-nav-title">Account Information</h5>
                <ul class="nav nav-pills nav-stacked custom-nav">
                    <li><a href="#"><i class="fa fa-user"></i> <span>Profile</span></a></li>
                    <li><a href="#"><i class="fa fa-cog"></i> <span>Settings</span></a></li>
                    <li><a href="#"><i class="fa fa-sign-out"></i> <span>Sign Out</span></a></li>
                </ul>
            </div>

            <!--sidebar nav start-->
            <ul class="nav nav-pills nav-stacked custom-nav">
            <li><a href="../landing/index.php"><i class="fa fa-home"></i> <span>Beranda</span></a></li>
                <li class="<?php echo "$active"; ?> "><a href="homepage.php"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>

                <li class="menu-list <?php echo "$navactive1"; ?>"><a href=""><i class="fa fa-building-o"></i> <span> Data DU / DI </span></a>
                    <ul class="sub-menu-list">
                        <li class="<?php echo "$active1"; ?> "><a href="dari_perusahaan.php"> Dari Perusahaan (DU / DI) </a></li>
                        <li class="<?php echo "$active2"; ?> "><a href="dari_kapprog.php"> Dari Kapprog</a></li>
                        <li class="<?php echo "$active3"; ?> "><a href="dari_hubin.php"> Dari Hubin </a></li>
                        <li class="<?php echo "$active4"; ?> "><a href="semua_du.php"> Semua DU / DI </a></li>
                    </ul>
                </li>

                <li class="menu-list <?php echo "$navactive2"; ?>"><a href=""><i class="fa fa-building-o"></i> <span> Jawaban DU / DI </span></a>
                    <ul class="sub-menu-list">
                        <li class="<?php echo "$active5"; ?> "><a href="penerima_permintaan_prakerin.php"> Tambahkan Jawaban DU / DI </a></li>
                        <li class="<?php echo "$active6"; ?> "><a href="jawaban_dari_kapprog.php"> Informasi Jawaban DU / DI <br> dari Kapprog </a></li>
                        <li class="<?php echo "$active7"; ?> "><a href="dumenerima.php"> DU / DI yang Menerima Prakerin </a></li>
                        <li class="<?php echo "$active8"; ?> "><a href="dumenolak.php"> DU / DI yang Menolak Prakerin </a></li></li>
                    </ul>
                </li>

                <li class="menu-list <?php echo "$navactive5"; ?>"><a href=""><i class="fa fa-building-o"></i> <span>Permintaan Prakerin</span></a>
                    <ul class="sub-menu-list">
                        <li class="<?php echo "$active9"; ?> "><a href="permintaan_perusahaan.php"> Permintaan Prakerin dari Perusahaan </a></li>
                        <li class="<?php echo "$active10"; ?> "><a href="permintaan_perusahaan_ditolak.php"> Perusahaan yang Ditolak </a></li>
                        <li class="<?php echo "$active11"; ?> "><a href="dusistemseleksi.php"> Permintaan dengan Menggunakan Sistem Seleksi </a>
                    </ul>
                </li>

                <li class="menu-list <?php echo "$navactive6"; ?>"><a href=""><i class="fa fa-building-o"></i> <span>Penerima Prakerin</span></a>
                    <ul class="sub-menu-list">
                        <li class="<?php echo "$active12"; ?> "><a href="dupenerima.php"> DU / DI Penerima Prakerin dari Hubin </a></li>
                        <li class="<?php echo "$active13"; ?> "><a href="dupenerimaperusahaan.php"> DU / DI Penerima Prakerin dari Perusahaan </a></li>
                        <li class="<?php echo "$active14"; ?> "><a href="informasi_penerima_kapprog.php"> Informasi dari Kapprog </a></li>
                        <li class="<?php echo "$active15"; ?> "><a href="informasi_semua_penerima.php"> Rekap Penerima Prakerin </a></li>
                    </ul>
                </li>

                <li class="menu-list <?php echo "$navactive29"; ?>"><a href=""><i class="fa fa-building-o"></i> <span>Permintaan Kerja</span></a>
                    <ul class="sub-menu-list">
                        <li class="<?php echo "$active27"; ?> "><a href="permintaan_kerja.php"> Permintaan Kerja yang Belum di Verifikasi </a></li>
                        <li class="<?php echo "$active28"; ?> "><a href="permintaankerjaditerima.php"> Permintaan Kerja yang di Terima </a></li>
                        <li class="<?php echo "$active29"; ?> "><a href="permintaankerjaditolak.php"> Permintaan Kerja yang di Tolak </a></li>
                        
                    </ul>
                </li>

                <li class="menu-list <?php echo "$navactive9"; ?>"><a href=""><i class="fa fa-puzzle-piece"></i> <span>Verifikasi Prakerin Siswa </span></a>
                    <ul class="sub-menu-list">
                        <li class="<?php echo "$active16"; ?> "><a href="verifikasi_siswa.php?jurusan=RPL"> RPL </a></li>
                        <li class="<?php echo "$active17"; ?> "><a href="verifikasi_siswa.php?jurusan=KM"> KM </a></li>
                        <li class="<?php echo "$active18"; ?> "><a href="verifikasi_siswa.php?jurusan=KP"> KP </a></li>
                        <li class="<?php echo "$active19"; ?> "><a href="verifikasi_siswa.php?jurusan=TEI"> TEI </a></li>
                        <li class="<?php echo "$active20"; ?> "><a href="verifikasi_siswa.php?jurusan=TEK"> TEK </a></li>
                        <li class="<?php echo "$active21"; ?> "><a href="verifikasi_siswa.php?jurusan=TKJ"> TKJ </a></li>
                        <li class="<?php echo "$active22"; ?> "><a href="verifikasi_siswa.php?jurusan=TOI"> TOI </a></li>
                        <li class="<?php echo "$active23"; ?> "><a href="verifikasi_siswa.php?jurusan=TP4"> TP4 </a></li>
                        <li class="<?php echo "$active24"; ?> "><a href="verifikasi_siswa.php?jurusan=TPTU"> TPTU </a></li>
                    </ul>
                </li>

                <li class="menu-list <?php echo "$navactive8"; ?>"><a href=""><i class="fa fa-puzzle-piece"></i> <span>Rekapitulasi Prakerin</span></a>
                    <ul class="sub-menu-list">
                        <li class="<?php echo "$active9"; ?> "><a href="rekapitulasikapprog.php"> Rekapitulasi Kapprog</a></li>
                        <li class="<?php echo "$active10"; ?> "><a href="hasilrekapitulasi.php"> Hasil Rekapitulasi </a></li>
                        <li class="<?php echo "$active11"; ?> "><a href=""> Surat Pengantar Prakerin</a></li>
                    </ul>
                </li>

                <li class="menu-list <?php echo "$navactive3"; ?>"><a href=""><i class="fa fa-building-o"></i> <span>Hasil Akhir DU/DI </span></a>
                    <ul class="sub-menu-list">
                        <li class="<?php echo "$active15"; ?> "><a href="dupenerima.php"> Penerima Prakerin  </a></li>
                        <li class="<?php echo "$active16"; ?> "><a href="tidak_menerima_prakerin.php"> Tidak Menerima Prakerin </a></li>
                        <li class="<?php echo "$active17"; ?> "><a href=""> Kerjasama Langsung </a></li>
                        <li class="<?php echo "$active18"; ?> "><a href=""> Kerjasama Tidak Langsung </a></li>
                    </ul>
                </li>

                <li class="menu-list <?php echo "$navactive7"; ?>"><a href=""><i class="fa fa-cogs"></i> <span>Monitoring</span></a>
                    <ul class="sub-menu-list">
                        <li class="<?php echo "$active12"; ?> "><a href="pilihguru.php"> Daftar Petugas Prakerin</a></li>
                        <li class="<?php echo "$active13"; ?> "><a href=""> Buat Surat Tugas Monitoring</a></li>
                        <li class="<?php echo "$active14"; ?> "><a href=""> Hasil Monitoring</a></li>
                    </ul>
                </li>

                <li class="menu-list <?php echo "$navactive11"; ?>"><a href=""><i class="fa fa-users"></i> <span>Penelusuran Tamatan</span></a>
                    <ul class="sub-menu-list">
                        <li class="<?php echo "$active15"; ?> "><a href="penelusuran_tamatan_tk4.php"> Tingkat IV </a></li>
                        <li class="<?php echo "$active16"; ?> "><a href="penelusuran_tamatan.php"> Semua Angkatan </a></li>
                    </ul>
                </li>

                <li class="menu-list <?php echo "$navactive10"; ?>"><a href=""><i class="fa fa-bar-chart-o"></i> <span> Presentase / Grafik </span></a>
                    <ul class="sub-menu-list">
                          <li class="<?php echo "$active11"; ?> "><a href=""> Grafik Prakerin</a></li>
                    </ul>
                </li>

                <li class="<?php echo "$active18"; ?> "><a href="inputberita.php"><i class="fa fa-sign-in"></i> <span> Buat Informasi / Berita </span></a></li>

                <li class="<?php echo "$active19"; ?> "><a href=""><i class="fa fa-sign-in"></i> <span> Pemberitahuan </span></a></li>

                <li class="<?php echo "$active20"; ?> "><a href=""><i class="fa fa-sign-in"></i> <span>Lain - Lain </span></a></li>

            </ul>
            <!--sidebar nav end-->

        </div>
    </div>
    <!-- left side end-->

    <!-- main content start-->
    <div class="main-content" >

        <!-- header section start-->
        <div class="header-section">

        <!--toggle button start-->
        <a class="toggle-btn"><i class="fa fa-bars"></i></a>
        <!--toggle button end-->

        <!--notification menu start -->
        <div class="menu-right">
            <ul class="notification-menu">
                <li>
                    <a href="#" class="btn btn-default dropdown-toggle info-number" data-toggle="dropdown">
                        <i class="fa fa-envelope-o"></i>
                        <span class="badge">3</span> <!-- iNI BUAT BERAPA - BERAPA NYA -->
                    </a>
                    <div class="dropdown-menu dropdown-menu-head pull-right">
                        <h5 class="title"> 3 Pesan Masuk </h5>
                        <ul class="dropdown-list normal-list">
                            <li class="new">
                                <a href="">
                                    <span class="thumb"><img src="../images/admin/deae.jpg" alt="" /></span>
                                        <span class="desc">
                                          <span class="name"> Dea Emalia <span class="badge badge-success">new</span></span>
                                          <span class="msg">hi ...</span>
                                        </span>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <span class="thumb"><img src="images/photos/user2.png" alt="" /></span>
                                        <span class="desc">
                                          <span class="name">Agus Suratna</span>
                                          <span class="msg">Hai pa ...</span>
                                        </span>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <span class="thumb"><img src="images/photos/user3.png" alt="" /></span>
                                        <span class="desc">
                                          <span class="name">Agus Rahmawan</span>
                                          <span class="msg">Hai bapaaa! </span>
                                        </span>
                                </a>
                            </li>
                            <li class="new"><a href="">Baca Semua</a></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#" class="btn btn-default dropdown-toggle info-number" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        <span class="badge">4</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-head pull-right">
                        <h5 class="title">Notifications</h5>
                        <ul class="dropdown-list normal-list">
                            <li class="new">
                                <a href="">
                                    <span class="label label-danger"><i class="fa fa-bolt"></i></span>
                                    <span class="name">Server #1 overloaded.  </span>
                                    <em class="small">34 mins</em>
                                </a>
                            </li>
                            <li class="new">
                                <a href="">
                                    <span class="label label-danger"><i class="fa fa-bolt"></i></span>
                                    <span class="name">Server #3 overloaded.  </span>
                                    <em class="small">1 hrs</em>
                                </a>
                            </li>
                            <li class="new">
                                <a href="">
                                    <span class="label label-danger"><i class="fa fa-bolt"></i></span>
                                    <span class="name">Server #5 overloaded.  </span>
                                    <em class="small">4 hrs</em>
                                </a>
                            </li>
                            <li class="new">
                                <a href="">
                                    <span class="label label-danger"><i class="fa fa-bolt"></i></span>
                                    <span class="name">Server #31 overloaded.  </span>
                                    <em class="small">4 hrs</em>
                                </a>
                            </li>
                            <li class="new"><a href="">See All Notifications</a></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        <img src="../images/admin/deae.jpg" alt="" />
                        Dea Emalia
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-usermenu pull-right">
                        <li><a href="#"><i class="fa fa-user"></i>  Profile</a></li>
                        <li><a href="#"><i class="fa fa-cog"></i>  Settings</a></li>
                        <li><a href="#"><i class="fa fa-sign-out"></i> Log Out</a></li>
                    </ul>
                </li>

            </ul>
        </div>
        <!--notification menu end -->

        </div>
        <!-- header section end-->


