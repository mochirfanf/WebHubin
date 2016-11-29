<?php

include "../koneksidb.php";
if ($_SESSION['tahun_ajaran']!='') {
	header("location:homepage.php");
}
if($_SESSION['level']=='admin'){ 
	$title= "Tahun Ajaran";
	include "leftside.php";
	?>
		
	    <div class="wrapper">
	            <div class='row'>
	                <div class='col-md-6'>
	                    <div class='row'>
	                        <div class='col-md-12'>
	                                <div class='panel-body'>
	                                    <!-- Modal -->
	                                    <div aria-hidden='true' aria-labelledby='myModalLabel' role='dialog' tabindex='-1' id='myModal' class='modal fade'>
	                                        <div class='modal-dialog'>
	                                            <div class='modal-content'>
	                                                <div class='modal-header'>
	                                                    <h4 class='modal-title'> Kelola Prakerin Angkatan? </h4>
	                                                </div>
	                                                <div class='modal-body'>
	                                                  <form method='POST' action='proses_admin.php?a=settahun_ajaran' enctype='multipart/form-data'>
	    
	                                                     <?php

	                                                     echo "<select class='form-control m-bot15' name='tahun_ajaran'>
	                                                              <option value=''> Pilih Angkatan </option>";
	                                                                  $tahun_ajaran = mysql_query("SELECT tahun_ajaran,angkatan FROM tahun_ajaran");
	                                                                while($d = mysql_fetch_array($tahun_ajaran)){
	                                                     echo " <option value='$d[tahun_ajaran]'> Angkatan $d[angkatan] </option>";
	                                                                }
	                                                             echo "
	                                                          </select>";
	                                                      ?>

	                                                  </div>
	                                                  <div class='modal-footer'>
	                                                      <input type='submit' value='Oke' name='Oke'class='btn btn-success'>  
	                                                  </div> 
	                                                </form> 
	                                            </div>
	                                        </div>
	                                    </div>
	                                    <!-- modal -->
	                                </div>
	                          </div>
	                    </div>
	                </div>
	            </div>
	     </div>

	<!-- Placed js at the end of the document so the pages load faster -->
	<script src='../js/jquery-1.10.2.min.js'></script>
	<script src='../js/jquery-ui-1.9.2.custom.min.js'></script>
	<script src='../js/jquery-migrate-1.2.1.min.js'></script>
	<script src='../js/bootstrap.min.js'></script>
	<script src='../js/modernizr.min.js'></script>
	<script src='../js/jquery.nicescroll.js'></script>

	<!--gritter script-->
	<script type='text/javascript' src='../js/gritter/js/jquery.gritter.js'></script>
	<script src='../js/gritter/js/gritter-init.js' type='text/javascript'></script>

	<!--common scripts for all pages-->
	<script src='../js/scripts.js'></script>

	<script type="text/javascript">
	    $(window).load(function(){
	        $("#myModal").modal({
	            backdrop: 'static',
	            keyboard: false
	        });
	});
	    
	</script>

	</body>
	</html>


<?php 

	
}else{
	header('location:../login.php');
}

?>