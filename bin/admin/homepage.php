<?php

include "../koneksidb.php";

if($_SESSION['level']=='admin'){ 
	if ($_SESSION['tahun_ajaran']!='') {
        $title="Homepage Admin";
        $active = "active";
		include "leftside.php"; ?>
		 <!-- page heading start-->
        <div class="page-heading">
             <h3>
                Dashboard
            </h3>
        </div>
        <!-- page heading end-->

        <!--body wrapper start-->
        <div class="wrapper">
            <fieldset>
                <legend> Hai Admin </legend> 
                <a href='updateprofile.php'><input type='Submit' value='UPDATE PROFILE'></a>
                <a href='gantipassword.php'><input type='Submit' value='GANTI PASSWORD'></a>
                <a href='inputperizinan.php'><input type='Submit' value='INPUT PERIZINAN'></a>
                <a href='../proses.php?a=logout'><input type='Submit' value='KELUAR'></a>
            </fieldset> 
        </div>
        <!--body wrapper end-->

<?php		include "footer.php";
	}else{
		header('location:tahun_ajaran.php');
	}
}else{
	header('location:../login.php');
}

?>