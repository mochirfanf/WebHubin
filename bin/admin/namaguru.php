<?php

include "../koneksidb.php";

$rs = mysql_query("SELECT * FROM guru INNER JOIN hb_guru_jurusan ON guru.nip_guru = hb_guru_jurusan.nip_guru WHERE id_jurusan=$_GET[id]");
$output ='';
		$i = 0;
		while($row = mysql_fetch_array($rs)) {
			if($i % 5 == 0) {
				$output .= "cityOptions.push(new Option('--------------------', ''));\n";
			}
			$output .= "cityOptions.push(new Option('$row[nama_guru]', '$row[nip_guru]'));\n";
			$i++;
		}
header('Content-type: text/plain');
echo $output;
?>