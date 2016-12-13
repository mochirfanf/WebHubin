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
    $iden = mysql_fetch_array(mysql_query("SELECT * FROM siswa WHERE nis='$_SESSION[username]'"));
    if($iden['foto']==''){
        $poto = '../images/uploads/img.png';
    }else{
        $poto = '../images/uploads/'.$iden['foto'];
    }
?>
        <!--logo and iconic logo start-->
        <div class="logo">
            <div class='crc' style="background-image:url('<?php echo $poto;?>')")></div>
            <div class='leftcrc'><?php echo $iden['nama_siswa']?><br><br>
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
                <li class="<?php echo "$active1"; ?> "><a href="identitas.php"><i class="fa fa-user"></i> <span> Edit Profile </span></a></li>

                <li class="menu-list <?php echo "$navactive2"; ?>"><a href=""><i class="fa fa-building-o"></i> <span> Sistem Seleksi </span></a>
                    <ul class="sub-menu-list">
                        <li class="<?php echo "$active4"; ?> "><a href="dusistemseleksi.php"> Tempat Prakerin Sistem Seleksi </a></li>
                        <li class="<?php echo "$active6"; ?> "><a href="#.php"> Ikuti Seleksi </a></li>
                    </ul>
                </li>

                <li class="menu-list <?php echo "$navactive"; ?>"><a href=""><i class="fa fa-building-o"></i> <span> Tempat Prakerin</span></a>
                    <ul class="sub-menu-list">
                        <li class="<?php echo "$active2"; ?> "><a href="dumenerima.php"> Lihat Tempat Prakerin</a></li>
                        <li class="<?php echo "$active3"; ?> "><a href="pilih_tempat_prakerin.php"> Pilih Tempat Prakerin </a></li>
                    </ul>
                </li>


                <li class="menu-list <?php echo "$navactive78"; ?>"><a href=""><i class="fa fa-building-o"></i> <span> Kegiatan Prakerin</span></a>
                    <ul class="sub-menu-list">
                        <li class="<?php echo "$active31"; ?> "><a href="kegiatanprakerin.php"> Program Kegiatan Prakerin </a></li>
                        <li class="<?php echo "$active89"; ?> "><a href="bimbingan.php"> Bimbingan disini </a></li>
                        <li class="<?php echo "$active90"; ?> "><a href="bimbingan2.php"> List Bimbingan Tatap Muka </a></li>
                    </ul>
                </li>


                <li class="menu-list <?php echo "$navactive22"; ?>"><a href=""><i class="fa fa-building-o"></i> <span> Lowongan Pekerjaan</span></a>
                    <ul class="sub-menu-list">
                        <li class="<?php echo "$active19"; ?> "><a href="../landing/lowongankerja.php"> Pilih Tempat Kerja </a></li>
                    </ul>
                </li>


                <li class="menu-list <?php echo "$navactive3"; ?>"><a href=""><i class="fa fa-building-o"></i> <span> Update Riwayat Kegiatan </span></a>
                    <ul class="sub-menu-list">
                        <li class="<?php echo "$active7"; ?> "><a href="tambah_kegiatan.php"> Tambah Kegiatan </a></li>
                        <li class="<?php echo "$active8"; ?> "><a href="riwayat_kegiatan.php"> Riwayat Kegiatan </a></li>
                    </ul>
                </li>

<!-- 
                <li class="menu-list <?php echo "$navactive3"; ?>"><a href=""><i class="fa fa-building-o"></i> <span> Pemilihan Tempat Prakerin</span></a>
                    <ul class="sub-menu-list">
                        <li class="<?php echo "$active7"; ?> "><a href="#.php"> Pilih Tempat Prakerin  </a></li>
                        <li class="<?php echo "$active8"; ?> "><a href="#.php"> Tanggapan Hubin  </a></li>
                    </ul>
                </li> -->

                <li class="<?php echo "$active10"; ?> "><a href="../proses.php?a=logout"><i class="fa fa-building-o"></i> <span>Logout </span></a></li>

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


