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
        <div class="container topnav ">
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
                        <a href="#about">BERANDA</a>
                    </li>
                    <li>
                        <a href="company.php">LAMARAN SAYA</a>
                    </li>
                    <li>
                        <a href="#contact">ABOUT</a>
                    </li>
                    <li>
                        <a href="login.php">LOGIN</a>
                    </li>
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

                        $data = mysql_query("SELECT *, GROUP_CONCAT(nama_jurusan) as juru FROM hb_du_permintaan_kerja INNER JOIN hb_du_umum ON hb_du_permintaan_kerja.id_du = hb_du_umum.id_du INNER JOIN hb_du_jumlah_permintaan_du_kerja ON hb_du_jumlah_permintaan_du_kerja.id_du_kerja=hb_du_permintaan_kerja.id_du_kerja INNER JOIN jurusan ON jurusan.id_jurusan = hb_du_jumlah_permintaan_du_kerja.id_jurusan WHERE hb_du_permintaan_kerja.id_du_kerja=$_GET[id]");
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
                        <div class="col col-sm-8">
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
                        <div class="col col-sm-8">
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
                                        echo "<a href='lowongankerja.php?q=$d2[kode_skill]' style='text-decoration:none'><span class='skills'>".$d2['kode_skill'].'</span></a>';
                                        }

                                    echo "<br><br>";
                                    
                                }
                                    ?>
                            
                            </h4>

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
                                    $tul = "Lamaran Terkirim";
                                }else{
                                    $isi = "";
                                    $ahref= "#apply";
                                    $tul= "Lamar Pekerjaan";
                                }
                                ?>
                        <div class="col col-sm-4">
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
                                    <a href="lowongankerja.php?q=rekayasa perangkat lunak"><i class='fa fa-caret-right'></i>RPL</a>
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
