<?php

include "../koneksidb.php";
?>

<?php
if($_SESSION['level']=='siswa'){ 
        $title="Daftar Siswa yang Dimonitoring";
        $active ="";
        $active99 = "active";

        include "leftside2.php";
        ?>
        <!--body wrapper start-->
        <div class="wrapper">
            <div class="row">
                <div class="col-sm-12">
                    <section class="panel">
                    <header class="panel-heading">
                        <big>Bimbingan</big><span style='float: right;'><a href='#pembimbing' data-toggle='modal'><span class='btn btn-primary'>Detail Pembimbing</span></a></span>
                         
                    </header>
                   
                    <div class="panel-body">
                        <div class='col-md-12' id='cb' style='height: 320px;overflow-y: auto'>
                        
                            <div id="chat"></div>
                        </div>
                        <div class='col-md-12' style='height: 100px'>

                        <form method="post" action="bimbingan.php">
                        <div class='col-md-12' style='padding: 10px; text-right'>
                        <textarea class='col-md-12 form-control' name="msg" placeholder="Enter Message"></textarea>
                            </div>
                            <div class='col-md-12'>
                            <input type="submit" class='col-md-2 btn btn-info text-right' style='margin:5px;float: right;' name="submit" value="Kirim"/>
                            </div>
                        </form>
                        </div>
                    </div>
                    </section>
                </div>
            </div>
        </div>
        <!--body wrapper end-->

                <div class='modal fade' id='pembimbing' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
<?php

                                    

?>
        <div class='modal-dialog'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                    <h4 class='modal-title' id='myModalLabel'>Pembimbing</h4> </div>
                    <?php

                    $f = mysql_fetch_array(mysql_query("SELECT saran_pembimbing FROM hb_prakerin WHERE nis='$_SESSION[username]'"))or die(mysql_error());
                    $dl= mysql_fetch_array(mysql_query("SELECT * FROM guru WHERE nip_guru='$f[saran_pembimbing]'"))or die(mysql_error());

                    ?>
                <div class='modal-body'>
                    <form class='form-horizontal form-label-left' method='POST' action='proses_siswa.php?a=lamarkerja' enctype='multipart/form-data'>
                        <div class='col-md-12'>
                            <div class='col-md-3'>
                                <img id='poto' class='img-responsive' src='../images/uploads/132.png' >
                            </div>
                            <div class='col-md-8 img-responsive'>
                                <strong><h4 id='namasiswa'><?php echo $dl['nama_guru']?></h4></strong>
                                
                                <table>
                                    <tr>
                                        <td>No Telepon</td><td>&emsp;:&emsp;</td><td><span id='jur'><?php echo $dl['no_telepon']?></span></td>
                                    </tr>
                                    <tr>
                                        <td>Email</td><td>&emsp;:&emsp;</td><td><span id='ttl'><?php echo $dl['email_guru']?></span></td>
                                    </tr>
                                    <tr>
                                        <td>Alamat</td><td>&emsp;:&emsp;</td><td><span id='jk'><?php echo $dl['alamat_guru']?></span></td>
                                    </tr>
                                    <tr>
                                        <td>Agama</td><td>&emsp;:&emsp;</td><td><span id='agama'><?php echo $dl['agama']?></span></td>
                                    </tr>
                                </table>
                            </div>
                        </div><?php
                                    $name = "";
                                    echo "<input type='hidden' id='id' name='id'>";
                                    ?>
                </div>
                <div class='modal-footer'  style='border: 0'>
                    <div class='form-group'>
                        <div class='col-md-4 col-md-offset-8'>
                            <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
                            <button style=' margin-top: -5px;' value='pilih' id='send' type='submit' class='btn btn-success' name='pilih'>Pilih</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


       <?php 
        if(isset($_POST['submit'])){ 
        
        $msg = $_POST['msg'];
        $tgl = date('Y-m-d H:i:s');
        $query = "INSERT INTO hb_bimbingan (pengirim,penerima,pesan,tanggal) values ('$_SESSION[username]','$id','$msg','$tgl')";
        
        mysql_query($query);
        
        }
        
        include "footer2.php";
}else{
    header('location:../login.php');
}

?>