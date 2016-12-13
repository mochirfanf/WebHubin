<?php

include "koneksidb.php";

	if(!empty($_SESSION['username'])){

			if($_SESSION['level']=='super_admin'){
				header('location:bin/super_admin/index.php');
			}
			if($_SESSION['level']=='admin'){
				header('location:bin/admin/index.php');
			}
			if($_SESSION['level']=='kapprog'){
				header('location:bin/kapprog/index.php');
			}
      		if($_SESSION['level']=='perusahaan'){
				header('location:bin/perusahaan/index.php');
			}
      		if($_SESSION['level']=='siswa'){
				header('location:bin/siswa/index.php');
			}
      		if($_SESSION['level']=='guru'){
				header('location:bin/guru/index.php');
			}
	}else{
		?>
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
		<link href='css/login.css' rel='stylesheet' type='text/css' />

		<!--SCRIPTS-->
		<script type='text/javascript' src='js/jquery-1.10.2.min.js'></script>
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
		<form name='login-form' class='login-form' method="POST" action="proses.php?a=login">

			<!--HEADER-->
		    <div class='header'>
		    <!--TITLE--><h1>Login Form</h1><!--END TITLE-->
		    <!--DESCRIPTION--><span> HUBIN SMK NEGERI 1 CIMAHI</span><!--END DESCRIPTION-->
		    </div>
		    <!--END HEADER-->

			<!--CONTENT-->
		    <div class='content'>
			<!--USERNAME--><input name='username' type='text' class='input username' placeholder='Username' onfocus='this.value=''' /><!--END USERNAME-->
		    <!--PASSWORD--><input name='password' type='password' class='input password' placeholder='Password' onfocus='this.value=''' /><!--END PASSWORD-->
		    </div>
		    <!--END CONTENT-->

		    <!--FOOTER-->
		    <div class='footer'>
		    <!--LOGIN BUTTON--><input type='submit' name='MASUK' value='MASUK' class='button' /><!--END LOGIN BUTTON-->

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
	}

?>
