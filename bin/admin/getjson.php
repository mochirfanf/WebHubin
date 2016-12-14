<?php
	//$mysqli = mysqli_connect("localhost","root","","db_irs");
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
	$json_url = "sdrcstudio.com/sims/datamaster/create_json.php?getJSON=siswa&un=hubin&pw=25319ad5c917ceea49824d9b394a711a9e759d31&secret=e8014fb9ec96cb44c889d3ea704268ee&siswa=c67c666dc2917591b434079f4793b509dadc2c4f ";
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

	foreach ($decode['Siswa'] as $key) {
		/*
		$query = "INSERT INTO siswa
			(nis,namasiswa,tahun_masuk,tahun_keluar,jurusan,idkelas,jk,tmplahir,tgllahir,alamat,status)
			VALUE('$key[nis]','$key[namasiswa]'')";

		$q = mysqli_query($mysqli,$query);
		*/
	}
?>