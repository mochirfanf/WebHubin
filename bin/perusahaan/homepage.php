<?php

include "../koneksidb.php";

if($_SESSION['level']=='perusahaan'){

        $title="Homepage Perusahaan";
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
                <legend> Hai DU/DI </legend>
                <a href='../../proses-logout'><input type='Submit' value='KELUAR'></a>
            </fieldset>
        </div>
        <!--body wrapper end-->

<?php		include "footer.php";

}else{
	header('location:../login.php');
}

?>
