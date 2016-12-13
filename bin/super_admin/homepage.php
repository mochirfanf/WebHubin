<?php

include "../koneksidb.php";

if($_SESSION['level']=='super_admin'){ 
        $title="Homepage Super Admin";
        $active = "active";
		include "leftside.php"; ?>
		 <!-- page heading start-->
        <div class="page-heading">
             <h3>
                Dashboard Super Admin
            </h3>
        </div>
        <!-- page heading end-->

        <!--body wrapper start-->
        <div class="wrapper">
            <fieldset>
                <legend> Beranda </legend> 
                <a href="inputadmin.php"><input type="Submit" value=" INPUT ADMIN "></a>
                <a href='gantipassword.php'><input type='Submit' value='GANTI PASSWORD'></a>
                <a href='lihatadmin.php'><input type='Submit' value='LIHAT ADMIN'></a>
                <a href="../proses.php?a=logout"><input type="Submit" value=" KELUAR "></a>
            </fieldset> 
        </div>
        <!--body wrapper end-->

<?php		include "footer.php";
	
}else{
	header('location:../login.php');
}

?>