<?php		
			
			include "../koneksidb.php";
			$rpl =  "select * from hb_du,hb_du_penerima WHERE hb_du.id_du = hb_du_penerima.id_du AND id_jurusan = 1 AND status_du='Menerima'";
			$no = 1;?>
<html>
	<head>
		<link href="../css/bootstrap.css" rel="stylesheet">
	</head>
	<body>
		<div class='span8  offset2'>
			<h2 style='text-align: center'> Dunia Usaha Yang Menerima Prakerin untuk Jurusan RPL</h2>
			<hr>
			<table border="1" style=" margin:0 auto" class="table table-condensed table-hover">
				<thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Dunia Usaha</th>
                        <th>Alamat</th>
                        <th>Kota</th>
                        <th>Email</th>
                    </tr>
                 </thead>
				<tbody>
                                            <?php 

                                                $semua = mysql_query( "select * from hb_du,hb_du_penerima WHERE hb_du.id_du = hb_du_penerima.id_du AND id_jurusan = 1 AND status_du='Menerima'");
                                                $no =0;
                                                while ($d = mysql_fetch_array($semua)) {
                                                    $no = $no+1;
                                                    echo "
                                                        <tr class='gradeA'>
                                                            <td> $no </td>
                                                            <td> $d[nama_du] </td>
                                                            <td> $d[alamat]</td>
                                                            <td> $d[kota]</td>
                                                            <td> $d[email]</td>
                                                        </tr>
                                                        ";
                                                }
                                            ?>
                                        </tbody>
			</table>
			<p align='center'>
		<a href="umr2013_cetak.php" cls='btn' onClick="window.print();return false"> <i class='icon-print'></i>Cetak </a>
			</p>
		</div>
	</body>
</html>
