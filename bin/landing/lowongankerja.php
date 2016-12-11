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
echo $get_total_rows[0];
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
    <link href="../fonts/css/font-awesome.min.css" rel="stylesheet" type="text/css">
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
                        <a href="#">LOWONGAN KERJA</a>
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
                                    <a href="?q=rekayasa perangkat lunak"><i class='fa fa-caret-right'></i>RPL</a>
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

</html>
