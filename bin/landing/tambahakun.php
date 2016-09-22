<?php

include "../koneksidb.php";

if(!empty($_GET['kode'])){ ?>

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

<?php


}else{
	header('location:../landing/index.php');
}
