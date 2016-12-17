<!DOCTYPE html>
<html lang="en">
<?php
include "../koneksidb.php";
?>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>LOKER HUBIN</title>

       <!-- Bootstrap Core CSS -->
    <link href="css2/styles.css" rel="stylesheet">
    <link href="css2/bootstrap-job.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css2/landing-page.css" rel="stylesheet">

    <link href="css2/overwrite.css" rel="stylesheet">
    <link href="css2/custom.css" rel="stylesheet">


    <!-- Custom Fonts -->
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container topnav " style='padding: 0'>
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand topnav" href="index.php">LOKER HUBIN</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right topcapnav">
                    <li>
                        <a href="index.php">HOME</a>
                    </li>
                    <li class='ac'>
                        <a href="lowongankerja.php">LOWONGAN KERJA</a>
                    </li>
                    <?php if(isset($_SESSION['level'])){
                        if($_SESSION['level']=='siswa'){
                        ?>
                    <li >
                        <a href="lamaransaya.php">LAMARAN SAYA</a>
                    </li>
                    <?php 
                }
                    }
                    ?>
                    <?php if(isset($_SESSION['level'])){
                        ?>
                    <li>
                        <a href="<?php echo '../'.$_SESSION['level'].'/homepage.php';?>">DASHBOARD</a>
                    </li>
                    <?php 

                    }?>
                    <?php if(!isset($_SESSION['level'])){
                        ?>
                    <li>
                        <a href='' data-toggle="modal" data-target="#login">LOGIN</a>
                    </li>
                    <?php 

                    }else{?>
                    <li>
                        <a href='../proses.php?a=logout'">LOGOUT</a>
                    </li>
                    <?php
                }
                ?>

                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
<!-- Begin Body -->
<div class="container">
    <div class="row fmargin"> 
<?php

                        $data = mysql_query("SELECT *, GROUP_CONCAT(nama_jurusan) as juru FROM hb_du_permintaan_kerja INNER JOIN hb_du_umum ON hb_du_permintaan_kerja.id_du = hb_du_umum.id_du INNER JOIN hb_du_jumlah_permintaan_du_kerja ON hb_du_jumlah_permintaan_du_kerja.id_du_kerja=hb_du_permintaan_kerja.id_du_kerja INNER JOIN jurusan ON jurusan.id_jurusan = hb_du_jumlah_permintaan_du_kerja.id_jurusan WHERE hb_du_permintaan_kerja.id_du_kerja=$_GET[id]")or die(mysql_error());
                        $d = mysql_fetch_array($data);
                            ?>
            <div class="col col-sm-9">
                <br><br>
                <div class="panel forpanel farr">
                    <div class="row bty">
                        <div class="col col-sm-9 ">
                        <strong><h2 class='jobs-nm-text' style="text-align: left;"><?php echo $d['judul']?></h2></strong>
                        
                        </div> 
                        <div class='col-md-3'>
                            <h4 class='company-nm-text' style="color: #77ACA2"><?php echo $d['nama_du']?></h4>
                        </div>
                    </div>

                    <br>
                    <div class="row">
                        <div class="col col-md-10">
                            <?php echo $d['lainnya']?>


                            <br><br>
                            <h5>
                            <table class='tpp'>
                                <tr>
                                    <td>Contact Person </td><td>&nbsp;&nbsp;&nbsp;:&nbsp;</td><td><?php echo " $d[penanggung_jawab] ( $d[cp] )";?></td>
                                </tr>
                                <tr>
                                    <td>Gaji </td><td>&nbsp;&nbsp;&nbsp;:&nbsp;</td><td><?php echo " $d[gaji]";?></td>
                                </tr>
                                <tr>
                                    <td>Lokasi </td><td>&nbsp;&nbsp;&nbsp;:&nbsp;</td><td><?php echo " $d[lokasi]";?></td>
                                </tr>
                            </table>
                            </h5>
                            <br>
                            <div class="row">
                        <div class="col col-md-12">
                            <?php echo substr($d['lainnya'],0,200).'...';
                            $dl = mysql_query("SELECT * FROM hb_du_jumlah_permintaan_du_kerja INNER JOIN jurusan ON jurusan.id_jurusan = hb_du_jumlah_permintaan_du_kerja.id_jurusan WHERE id_du_kerja = '$d[id_du_kerja]'")or die(mysql_error());
                                    
                            ?>
                            <br><br>

                            <h4 class='keyskills-nm-text'>
                            <?php
                                    while($dd = mysql_fetch_array($dl)){
                                    echo "<i class='fa fa-caret-right'></i> $dd[nama_jurusan]&emsp;";
                                    $dt = mysql_query("SELECT * FROM hb_detail_skill WHERE id_du_kerja = '$d[id_du_kerja]' AND id_jurusan=$dd[id_jurusan]");
                                    while($d2 = mysql_fetch_array($dt)){
                                        echo "<a href='lowongan-kerja?q=$d2[kode_skill]' style='text-decoration:none'><span class='skills'>".$d2['kode_skill'].'</span></a>';
                                        }

                                    echo "<br><br>";
                                    
                                }
                                    ?>
                            
                            </h4>

                        </div> 
                        <div class='col-md-12'>
                            <h5>Pelamar :</h5><br>
                            <ul class='pendaf'>
                            <?php
                                $pl = mysql_query("SELECT * FROM hb_lamar_kerja INNER JOIN siswa ON hb_lamar_kerja.nis = siswa.nis WHERE id_du_kerja = '$d[id_du_kerja]'");
                                    while($dm = mysql_fetch_array($pl)){
                            ?>
                                    <li><b><img style="background-image: url('<?php echo '../images/uploads/'.$dm['foto'];?>');background-size: cover;" class='up'></b><a href="#"><i><?php echo substr($dm['nama_siswa'],0,15)?></i></a></li>
                                    <?php

                                }
                                ?>
                                </ul>
                            </div>

                    </div>
                            <br>

                        </div> 
                        <?php
                        if(isset($_SESSION['level'])){
                            if($_SESSION['level']=='siswa'){
                        $adaatau = mysql_query("SELECT * FROM hb_lamar_kerja WHERE id_du_kerja=$d[id_du_kerja] AND nis = $_SESSION[username]");
                                $ada = mysql_fetch_array($adaatau);
                                if(!empty($ada)){
                                    $isi = "disabled";
                                    $ahref= "";
                                    $tul = "TERKIRIM";
                                }else{
                                    $isi = "";
                                    $ahref= "#apply";
                                    $tul= "LAMAR";
                                }
                                ?>
                        <div class="col col-md-2"><br><br>
                            <button data-target='<?php echo $ahref;?>' class='btn btn-info' data-toggle='modal' data-id='<?php echo $d['id_du_kerja']?>' <?php echo $isi;?>><?php echo $tul;?></button>
                            
                        </div>   
                        <?php
                    }
                    }
                        ?>
                    </div>
                    <br><br>
                    <hr>

            </div>

        </div> 

        <div class="col col-sm-3">
                <br>
                <div id="sidebar">
                    <ul class="nav nav-stacked">
                        <div class="mprofiles plus">
                        </div>
                        
                        <div class="profile-usermenu plus">
                            
                            <ul class="nav notnav fornav">
                                 <li class='ats'>
                                    <form class="form-horizontal form-label-left" method="POST" action="proses_landing.php?a=search" enctype="multipart/form-data" >
                                    <input type="text" name="src" class="form-control" placeholder="Cari"><br><input value='Cari' type="submit" class='col-md-12 btn btn-info'><br><br>
                                </li>
                                <li class="your">
                                    <a href="lowongankerja.php"><i class='fa fa-caret-right'></i>SEMUA</a>
                                </li>
                                 <li class="your">
                                    <a href="lowongankerja.php?q=rekayasa perangkat lunak"><i class='fa fa-caret-right'></i>RPL</a>
                                </li>
                                <li class="your">
                                    <a href="lowongankerja.php?q=teknik komputer dan jaringan"><i class='fa fa-caret-right'></i>TKJ</a>
                                </li>
                                <li class="your">
                                    <a href="lowongankerja.php?q=teknik otomasi industri"><i class='fa fa-caret-right'></i>TOI</a>
                                </li>
                                <li class="your">
                                    <a href="lowongankerja.php?q=teknik elektronika komunikasi"><i class='fa fa-caret-right'></i>TEK</a>
                                </li>
                                <li class="your">
                                    <a href="lowongankerja.php?q=teknik elektronika industri"><i class='fa fa-caret-right'></i>TEI</a>
                                </li>
                                <li class="your">
                                    <a href="lowongankerja.php?q=teknik pendingin"><i class='fa fa-caret-right'></i>TP</a>
                                </li>
                                <li class="your">
                                    <a href="lowongankerja.php?q=kontrol proses"><i class='fa fa-caret-right'></i>KP</a>
                                </li>
                                <li class="your">
                                    <a href="lowongankerja.php?q=kontrol mekanik"><i class='fa fa-caret-right'></i>KM</a>
                                </li>
                                <li class="your">
                                    <a href="lowongankerja.php?q=Teknik Produksi & Penyiaran Program Pertelevisian"><i class='fa fa-caret-right'></i>TP4</a>
                                </li>
                            </ul>
                            </form>
                        </div>

                    </ul>
                </div>
            </div> 


    </div>
</div>
        <div class='modal fade' id='apply' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
<?php

                                    

?>
        <div class='modal-dialog'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                    <h4 class='modal-title' id='myModalLabel'>Lamaran Pekerjaan</h4> </div>
                <div class='modal-body'>
                    <form class='form-horizontal form-label-left' method='POST' action='../siswa/proses_siswa.php?a=lamarkerja&lan=ya' enctype='multipart/form-data'>
                        <div class='item form-group'>
                                <label class='control-label col-md-3 col-sm-3 col-xs-12' for='name'>Portofolio : <span class='required'></span> </label>
                                <div class='col-md-7 col-sm-9 col-xs-12' style='margin-bottom:20px;'>
                                <textarea class='form-control col-md-12 col-xs-12' id='portofolio' name='portofolio' required></textarea>
                                 </div>
                            </div>

                            <div class='item form-group'>
                                <label class='control-label col-md-3 col-sm-3 col-xs-12' for='name'>Lampiran : <span class='required'></span> </label>
                                <div class='col-md-7 col-sm-9 col-xs-12' style='margin-bottom:20px;'>
                                <input type='file' class='form-control col-md-12 col-xs-12' id='lampiran' name='lampiran'></textarea>
                                 </div>
                            </div>
                            <?php
                                    $name = "";
                                    echo "<input type='hidden' id='id' name='id'>";
                                    ?>
                </div>
                <div class='modal-footer'>
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
    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p class="copyright text-muted small">Copyright &copy; Loker Hubin 2016. All Rights Reserved</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
        <script>
$('#lampiran').bind('change', function() {

  //this.files[0].size gets the size of your file.
  if(this.files[0].size>5000000){
        alert("File harus kurang dari 5Mb !");
        $('#lampiran').val("");
    }
});


</script>
<script>

    $('#apply').on('show.bs.modal', function (event) {

        var button = $(event.relatedTarget); // Button that triggered the modal

        var recipient = button.data('id'); // Extract info from data-* attributes

      

        var modal = $(this);

        modal.find("#id").val(recipient);


    });

    </script>
</body>

</html>
