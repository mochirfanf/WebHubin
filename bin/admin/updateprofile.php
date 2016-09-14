<?php

include "../koneksidb.php";

$d=mysql_fetch_array(mysql_query("SELECT * FROM hb_pengelola_hubin WHERE nip=$_SESSION[nip]"));

if($_SESSION['level']=='admin'){ 

echo "
<html>
<head><title> LOGIN </title></head>
<body>
	<fieldset>
		<legend> Update Profile  </legend>
			<form method='POST' action='proses_admin.php?a=update' enctype='multipart/form-data'>
				<input type='hidden' value='$d[nip]' name='nipp'>

				NIP : <input type='text' name='nip' value='$d[nip]' readonly ><br><br>
				Username : <input type='text' name='username' value='$d[username]' ><br><br>
				Nama : <input type='text' name='nama' value='$d[nama]'><br><br>
				Jabatan : <input type='text' name='jabatan' value='$d[jabatan]'><br><br>
				Jenis Kelamin : <input type='radio' name='jk' value='L' "; if($d['jenis_kelamin'] == "L"){ echo "checked";} echo" > Laki - Laki 
				<input type='radio' name='jk' value='P' "; if($d['jenis_kelamin'] == "P"){ echo "checked";} echo" > Perempuan <br><br>
				Tempat Lahir : <input type='text' name='tempat_lahir' value='$d[tempat_lahir]'><br><br>
				Tanggal Lahir : <input type='date' name='tanggal_lahir' value='$d[tanggal_lahir]'><br><br>
				Alamat : <input type='text' name='alamat' value='$d[alamat]'><br><br>
				Agama : <input type='text' name='agama' value='$d[agama]'><br><br>
				E-mail : <input type='text' name='email' value='$d[email]'><br><br>
				Nomor Telepon : <input type='text' name='nomor' value='$d[no_telepon]'><br><br>
				Golongan Darah : <input type='radio' name='gol' value='A' "; if($d['gol_darah'] == "A"){ echo "checked";} echo"> A 
				<input type='radio' name='gol' value='B' "; if($d['gol_darah'] == "B"){ echo "checked";} echo"> B 
				<input type='radio' name='gol' value='O' "; if($d['gol_darah'] == "O"){ echo "checked";} echo"> O 
				<input type='radio' name='gol' value='AB' "; if($d['gol_darah'] == "AB"){ echo "checked";} echo"> AB <br><br>
				Status : <input type='radio' name='status' value='Menikah' "; if($d['status'] == "Menikah"){ echo "checked";} echo"> Menikah 
				<input type='radio' name='status' value='Belum Menikah' "; if($d['status'] == "Belum Menikah"){ echo "checked";} echo"> Belum Menikah <br><br>  
				Motto Hidup : <input type='text' name='motto' value='$d[motto_hidup]'><br><br>
				Foto : <input name='foto' type='File' accept='image/*'>

				<input type='submit' value='MASUK' name='MASUK'>
			</form>
	</fieldset>	<br>
	<a href='homepage.php'><input type='Submit' value=' KEMBALI '></a>
</body>
</html>
";

		

}else{
	header('location:../login.php');
}

?>
