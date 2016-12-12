<footer id="footer">
    <div class="footer-top wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
        <div class="container text-center">
            <div class="footer-logo">
                <a href="index.html"><img class="img-responsive" src="bin/landing/images/logo.png" alt=""></a>
            </div>
            <div class="social-icons">
                <ul>
                    <li><a class="envelope" href="#"><i class="fa fa-envelope"></i></a></li>
                    <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                    <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <p>&copy; 2015 | Hubin SMK Negeri 1 Cimahi.</p>
                </div>
                <div class="col-sm-6">
                    <p class="pull-right">Develop by <a href="#">Dea Emalia</a></p>
                </div>
            </div>
        </div>
    </div>
</footer>
<script type="text/javascript" src="bin/landing/js/jquery.js"></script>
<script type="text/javascript" src="bin/landing/js/bootstrap.min.js"></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
<script type="text/javascript" src="bin/landing/js/jquery.inview.min.js"></script>
<script type="text/javascript" src="bin/landing/js/wow.min.js"></script>
<script type="text/javascript" src="bin/landing/js/mousescroll.js"></script>
<script type="text/javascript" src="bin/landing/js/smoothscroll.js"></script>
<script type="text/javascript" src="bin/landing/js/jquery.countTo.js"></script>
<script type="text/javascript" src="bin/landing/js/lightbox.min.js"></script>
<script type="text/javascript" src="bin/landing/js/main.js"></script>
<script type="text/javascript" src="bin/landing/js/ajax_daerah.js"></script>
<!--SCRIPTS-->
<!--Slider-in icons-->
<script type='text/javascript'>
    $(document).ready(function () {
        $('.username').focus(function () {
            $('.user-icon').css('left', '-48px');
        });
        $('.username').blur(function () {
            $('.user-icon').css('left', '0px');
        });
        $('.password').focus(function () {
            $('.pass-icon').css('left', '-48px');
        });
        $('.password').blur(function () {
            $('.pass-icon').css('left', '0px');
        });
    });
</script>

     <script>

    $('#detail').on('show.bs.modal', function (event) {

      var button = $(event.relatedTarget); // Button that triggered the modal
      var recipient = button.data('id'); // Extract info from data-* attributes
      var modal = $(this);
        $.ajax({
            type: 'POST',
            url: 'detailpekerjaan.php',
            data: 'id='+recipient,
            dataType: 'json',
            success: function(result) {
                modal.find("#id").val(recipient);
                modal.find("#namadu").text(result['nama_du']);
                var data = result['jur'];
                var arr = data.split(',');
                modal.find("#jurusan").html(arr[0]+"<br>"+arr[1]);
                modal.find("#penanggung").text(result['penanggung_jawab']);
                modal.find("#cp").text(result['cp']);
                modal.find("#jenis_seleksi").text(result['seleksi']);
                modal.find("#tempat").text(result['tempat_seleksi']);
                modal.find("#tanggal").text(result['tanggal_seleksi']);
                modal.find("#gaji").text(result['gaji']);
                modal.find("#lain").text(result['lainnya']);

            }
        })
     

    });

    

    </script>
    
</body>

</html>