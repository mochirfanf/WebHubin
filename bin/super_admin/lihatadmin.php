<?php

include "../koneksidb.php";

if($_SESSION['level']=='super_admin'){ 

echo "
<html>
<head><title> LOGIN </title></head>
<body>
	<fieldset>
		<legend> Ganti Password  </legend>";
		$data = mysql_query( "select * from hb_pengelola_hubin ");

	echo "<table border='1'>
			<tr> <th> NIP </th> <th> Username</th> <th> Nama </th> <th> Jabatan</th> <th> Email</th></tr>";
			while ($d = mysql_fetch_array($data)) {
				echo "
				<tr>
					<td> $d[nip]</td>
					<td> $d[username] </td>
					<td> $d[nama]</td>
					<td> $d[jabatan]</td>
					<td> $d[email]</td>
					<td> <a href='proses_super_admin.php?a=hapusadmin&nip=$d[nip]'> Hapus</a> </td>
				</tr>
				";
			}
	echo "
		</table>
	</fieldset>	<br>
	<a href='homepage.php'><input type='Submit' value=' KEMBALI '></a>
</body>
</html>
";

		

}else{
	header('location:../login.php');
}

?>
