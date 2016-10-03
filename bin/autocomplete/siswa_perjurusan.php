<?php
include "../koneksidb.php";

//get search term
$searchTerm = $_GET['term'];

//get matched data from skills table
$query = mysql_query("SELECT * FROM siswa WHERE id_jurusan='$_SESSION[jurusan]' AND nama LIKE '%".$searchTerm."%' ORDER BY nama ASC");
while ($row = mysql_fetch_assoc($query)) {
    $data[] = $row['nis'];
}
//return json data
echo json_encode($data);
?>
