<?php

include "../koneksidb.php";

if($_SESSION['level']=='kapprog'){
	if ($_SESSION['tahun_ajaran']!='') {
        $title="Homepage Kapprog";
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
                <legend> Hai Kaprog <?php echo "$_SESSION[jurusan]"; ?></legend>
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
