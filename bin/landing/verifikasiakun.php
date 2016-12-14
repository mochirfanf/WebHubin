<?php

include "../koneksidb.php";



if(!empty($_GET['kode'])){ 
	$c  = mysql_query("SELECT * FROM hb_du_umum WHERE kode='$_GET[kode]'");
    $crow = mysql_fetch_row($c);
    if($crow>0){

                    ?>
<!--
	<html>
	<head><title> Penentuan Akun </title></head>
	<body>
		<fieldset>
			<legend> Tentukan Username dan Password Anda  </legend>
				<form method="POST" action="proses_landing.php?a=input" enctype='multipart/form-data'>

					Username : <input type="text" name="username"><br><br>
					Password : <input type="password" name="password"><br><br>
					<input type="hidden" name="kode" value="<?php echo "$_GET[kode]";?>">

					<input type="submit" value="Submit" name="MASUK">
				</form>
		</fieldset>

	</body>
	</html>
-->
<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
		<html>
		<head><!--
			<style type="text/css">

				input[type="text"]:-moz-placeholder{color: red}
				input[type="text"]::-moz-placeholder{color: red}
				input[type="text"]:-ms-input-placeholder{color: red}
				input[type="text"]::-webkit-input-placeholder{color: red}

			</style> -->
		<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
		<title>Login Form</title>

		<!--STYLESHEETS-->
		<link href='../css/login.css' rel='stylesheet' type='text/css' />

		<!--SCRIPTS-->
		<script type='text/javascript' src='../js/jquery-1.10.2.min.js'></script>
		<!--Slider-in icons-->
		<script type='text/javascript'>
		$(document).ready(function() {
			$('.username').focus(function() {
				$('.user-icon').css('left','-48px');
			});
			$('.username').blur(function() {
				$('.user-icon').css('left','0px');
			});

			$('.password').focus(function() {
				$('.pass-icon').css('left','-48px');
			});
			$('.password').blur(function() {
				$('.pass-icon').css('left','0px');
			});
		});
		</script>

		</head>
		<body style=''>

		<!--WRAPPER-->
		<div id='wrapper'>

			<!--SLIDE-IN ICONS-->
		    <div class='user-icon'></div>
		    <div class='pass-icon'></div>
		    <!--END SLIDE-IN ICONS-->

		<!--LOGIN FORM-->
		<form name='login-form' class='login-form' method="POST" action="proses_landing.php?a=input">

			<!--HEADER-->
		    <div class='header'>
		    <!--TITLE--><h1>Tentukan Username dan Password</h1><!--END TITLE-->
		    <!--DESCRIPTION--><span> HUBIN SMK NEGERI 1 CIMAHI</span><!--END DESCRIPTION-->
		    </div>
		    <!--END HEADER-->

			<!--CONTENT-->
		    <div class='content'>
			<!--USERNAME--><input name='username' type='text' class='input username' placeholder='Username' onfocus='this.value=''' /><!--END USERNAME-->
		    <!--PASSWORD--><input name='password' type='password' class='input password' placeholder='Password' onfocus='this.value=''' />
		    <input type="hidden" name="kode" value="<?php echo "$_GET[kode]";?>"><!--END PASSWORD-->
		    </div>
		    <!--END CONTENT-->

		    <!--FOOTER-->
		    <div class='footer'>
		    <!--LOGIN BUTTON--><input type='submit' value="Submit" name="MASUK" class='button' /><!--END LOGIN BUTTON-->

		    </div>
		    <!--END FOOTER-->

		</form>
		<!--END LOGIN FORM-->

		</div>
		<!--END WRAPPER-->

		<!--GRADIENT--><div class='gradient'></div><!--END GRADIENT-->

		</body>
		</html>

<?php
}else{
	?>
		<script>
			
			alert("Kode tidak relevan");
			top.location = "../landing/index.php";

		</script>
	<?php
	
}

}else{
	header('location:../landing/index.php');
}
