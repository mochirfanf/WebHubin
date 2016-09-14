<?php
include "header.php";
?>

  <!--.preloader-->
  <div class="preloader"> <i class="fa fa-circle-o-notch fa-spin"></i></div>
  <!--/.preloader-->

  <header id="home">
    
    <div class="main-nav">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.html">
            <h1><img class="img-responsive" src="images/logo.png" alt="logo"> </h1>
          </a>                    
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav navbar-right">                 
            <li class="scroll"><a href="index.php">Home</a></li>
            <li class="scroll"><a href="index.php">Visi</a></li> 
            <li class="scroll"><a href="index.php">Misi</a></li> 
            <li class="scroll"><a href="index.php">Tentang Hubin</a></li>                     
            <li class="scroll"><a href="index.php">Tujuan Prakerin</a></li>
            <li class="scroll active"><a href="index.php">Berita</a></li>
            <li class="scroll"><a href="index.php">Kontak Kami</a></li>
            <li><a data-toggle="modal" data-target="index.php">Login</a></li>          
          </ul>
        </div>
      </div>
    </div><!--/#main-nav-->
  </header><!--/#home-->

  <section id="detail-berita">
    <div class="container">
      <div class="blog-posts">
        <div class="row">
          <div class="col-sm-12 wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="600ms">
          <h2>Detail Berita</h2>
          	<?php 
			$data2 = mysql_query( "SELECT * from hb_berita WHERE hits_berita > 1 ORDER BY id_berita DESC LIMIT 1");
			while ($d2 = mysql_fetch_array($data2)) {
			?>
			
            <div class="post-thumb">
              <div id="post-carousel"  class="slide" >
                <div class="carousel-inner">
                  <div class="item active">
                    <a href="detail_berita.php?id=<?php echo $d2['id_berita'] ?>"><img class="img-responsive" src="../admin/uploads/<?php echo $d2['foto_berita'] ?>" alt=""></a>
                  </div>
                </div>                               
              </div>                            
            </div>
            <div class="entry-header">
              <h3><a href="detail_berita.php?id=<?php echo $d2['id_berita'] ?>"><?php echo $d2['judul_berita'] ?></a></h3>
              <span class="date"><?php echo $d2['tgl_berita'] ?></span>
              <span class="cetagory">by <strong><?php echo $d2['sumber'] ?></strong></span>
            </div>
            <div class="entry-content">
              <p>
              	<?php echo  $d2['isi_berita']; ?>
              </p>
            </div>
            <?php } ?>


          </div>
             
        </div>
                     
      </div>
    </div>
  </section><!--/#blog-->

<?php
include "footer.php";
?>