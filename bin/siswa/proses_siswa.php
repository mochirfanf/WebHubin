<?php
	
	include "../koneksidb.php";

	function anti_injection($param){
		$filter = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($param,ENT_QUOTES))));
		return $filter;
	}

if($_SESSION['level']=='siswa'){ 
	if (!empty($_GET ["a"])) {
		switch ($_GET ["a"]){
			
			
		}
	
	}	
}else{
	header('location:../login.php');
}

?>


