<?php

include "../koneksidb.php";

if($_SESSION['level']=='super_admin'){ ?>
<html>
<head><title> LOGIN </title></head>
<body>
	<fieldset>
		<legend> INPUT ADMIN  </legend>
			<form method="POST" action="proses_super_admin.php?a=input"  enctype='multipart/form-data'>

				NIP : <input type="text" name="nip"><br><br>
				Nama : <input type="text" name="nama"><br><br>
				Jabatan : <input type="text" name="jabatan"><br><br>

				<input type="submit" value="INSERT ADMIN" name="MASUK">
			</form>
	</fieldset>	

	<br>
	<a href="homepage.php"><input type="Submit" value=" KEMBALI "></a>
</body>

<!-- 			
				Jenis Kelamin : <input type="radio" name="jk" value="L"> Laki - Laki <input type="radio" name="jk" value="P"> Perempuan <br><br>
				Tempat Lahir : <input type="text" name="tempat_lahir"><br><br>
				Tanggal Lahir : <input type="date" name="tanggal_lahir"><br><br>
				Alamat : <input type="text" name="alamat"><br><br>
				Agama : <input type="text" name="agama"><br><br>
				E-mail : <input type="text" name="email"><br><br>
				Nomor Telepon : <input type="text" name="nomor"><br><br>
				Golongan Darah : <input type="radio" name="gol" value="A"> A <input type="radio" name="gol" value="B"> B <input type="radio" name="gol" value="O"> O <input type="radio" name="gol" value="AB"> AB <br><br>
				Status : <input type="radio" name="status" value="Menikah"> Menikah <input type="radio" name="status" value="Belum Menikah"> Belum Menikah <br><br>  
				Motto Hidup : <input type="text" name="motto"><br><br>
				Foto : <input name="foto" type="File">
					
-->
</html>

<?php 
		

}else{
	header('location:../login.php');
}

?>
