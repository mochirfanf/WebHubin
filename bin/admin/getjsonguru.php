<?php
	include "../koneksidb.php";
	/*
	[INX]
	FOR TABLE SISWA [INX] = siswa
	FOR TABLE GURU [INX] = guru
	FOR TABLE TU [INX] = tu

	[TABLE]
	FOR TABLE SISWA [TABLE] = siswa
	FOR TABLE GURU [TABLE] = guru
	FOR TABLE TU [TABLE] = tu

	p.s. Don't forget to remove "[]"

	$json_url = "http://localhost:8080/API/create_json.php?getJSON=[TABLE]&un=[YOUR_USERNAME]&pw=[YOUR_PASSWORD]&secret=[YOUR_SECRET_TOKEN]&[INX]=[YOUR_INX_TOKEN]";
	*/
	$json_strings="";
	$json_url = "sdrcstudio.com/sims/datamaster/create_json.php?getJSON=guru&un=hubin&pw=hubinsmk&secret=e8014fb9ec96cb44c889d3ea704268ee&guru=7749e7f27235d8015301a91d0f3fb4e655c819d4";

	/*$json_url = "http://sdrcstudio.com/api/create_json.php?getJSON=siswa&secret=acc4e8e0e7207b3dc0f3bbdb&siswa=183ba06facf9702fb8ed67b2d05accc294892471";*/
	
	$ch = curl_init($json_url);
	$option = array(
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_HTTPHEADER => array('Content-type: application/json'),
		CURLOPT_POSTFIELDS => $json_strings
	);
	curl_setopt_array($ch, $option);
	$result = curl_exec($ch);

	$decode = json_decode($result, true);
	
	echo "<pre>";
	print_r($decode);
	echo "</pre>";



	foreach ($decode['Guru'] as $key) {
		/*$q = mysql_fetch_array(mysql_query("SELECT id_jurusan FROM jurusan WHERE singkatan='$key[jurusan]'"));
		$thn = $key['tahun_masuk'];
		$thn_msk = $thn.'-'.($thn+1);
		$query = "INSERT INTO siswa
			(nis,id_jurusan,nama_siswa,kelas,tahun_ajaran,jenis_kelamin,tempat_lahir,tanggal_lahir,alamat_siswa)
			VALUE('$key[nis]','$q[id_jurusan]','$key[namasiswa]','$key[idkelas]','$thn_msk','$key[jk]','$key[tmplahir]','$key[tgllahir]','$key[alamat]')";

		mysql_query($query);
		
		$query2 = "INSERT INTO hb_login_operator
			(nip_nis,password)
			VALUE('$key[nis]','$key[password]')";

		mysql_query($query2)or die(mysql_error());
*/
	}
?>