<!DOCTYPE html>
<html lang="en">
<?php
include "../koneksidb.php";
$get_total_rows = 0;
$results = mysql_fetch_row(mysql_query("SELECT COUNT(*) as a FROM hb_du_permintaan_kerja"));
if($results){
    $get_total_rows = $results; 
}

//break total records into pages
$total_pages = ceil($get_total_rows[0]/$item_per_page); 
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
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css2/overwrite.css" rel="stylesheet">


    <!-- Custom Fonts -->
    <link href="fonts/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

    <link href="css2/custom.css" rel="stylesheet">
</head>

<body>
?>
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
            <!--
            <div class='col-md-12'>
                <div class='col-md-9 search'>
                    <input type='text' class='form-control'>
                </div>
            </div>
            -->
            <div class="col col-sm-9">
                <br>
                <?php
                    if(isset($_GET['q'])){
                        echo "<div class='col-md-12 text-right pem'>Pencarian untuk kata kunci : $_GET[q]</div>";
                        echo "<hr>";
                    }

                ?>
                <div class="panel forpanel farr">
                </div>
                <div id="load_more_button" class="btn btn-info btn-kup load_more col-md-6 col-md-offset-3 " style='margin-bottom: 10px'>
            Lebih Banyak Pekerjaan
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

$(document).ready(function() {
    var track_click = 0; //track user click on "load more" button, righ now it is 0 click
    
    var total_pages = <?php echo $total_pages; ?>;
    <?php
    if(isset($_GET['q'])){
        $q =  str_replace(' ', '-', $_GET['q']);
    }else{
        $q='';
    }
    ?>
    $('.farr').load("fetch_page.php?q=<?php echo $q;?>", {'page':track_click}, function() {track_click++;}); //initial data to load

    $(".load_more").click(function (e) { //user clicks on button
    
        $(this).hide(); //hide load more button on click
        $('.animation_image').show(); //show loading image

        if(track_click <= total_pages) //make sure user clicks are still less than total pages
        {
            //post page number and load returned data into result element
            <?php
                if(isset($_GET['q'])){
                    $q =  str_replace(' ', '-', $_GET['q']);
                }else{
                    $q='';
                }
                ?>
            $.post('fetch_page.php?q=<?php echo $q;?>',{'page': track_click}, function(data) {
            
                $(".load_more").show(); //bring back load more button
                
                $(".farr").append(data); //append data received from server
                
                //hide loading image
                $('.animation_image').hide(); //hide loading image once data is received
    
                track_click++; //user click increment on load button
            
            }).fail(function(xhr, ajaxOptions, thrownError) { 
                alert(thrownError); //alert any HTTP error
                $(".load_more").show(); //bring back load more button
                $('.animation_image').hide(); //hide loading image once data is received
            });
            
            
            if(track_click >= total_pages-1)
            {
                //reached end of the page yet? disable load button
                $(".load_more").attr("disabled", "disabled");
            }
         }
          
        });
});
</script>
</body>

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
</html>
