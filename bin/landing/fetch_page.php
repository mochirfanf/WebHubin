<?php
include("../koneksidb.php"); //include config file
$desk="";
//sanitize post value
$page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);

//throw HTTP error if page number is not valid
if(!is_numeric($page_number)){
	header('HTTP/1.1 500 Invalid page number!');
	exit();
}

//get current starting point of records
$position = ($page_number * $item_per_page);
$_GET['q'] = str_replace('-', ' ', $_GET['q']);
                        $data = mysql_query("SELECT *, GROUP_CONCAT(nama_jurusan) as juru, GROUP_CONCAT(kode_skill) as skill FROM hb_du_permintaan_kerja INNER JOIN hb_du_umum ON hb_du_permintaan_kerja.id_du = hb_du_umum.id_du INNER JOIN hb_du_jumlah_permintaan_du_kerja ON hb_du_jumlah_permintaan_du_kerja.id_du_kerja=hb_du_permintaan_kerja.id_du_kerja INNER JOIN jurusan ON jurusan.id_jurusan = hb_du_jumlah_permintaan_du_kerja.id_jurusan INNER JOIN hb_detail_skill ON hb_detail_skill.id_du_kerja = hb_du_permintaan_kerja.id_du_kerja GROUP BY hb_du_permintaan_kerja.id_du_kerja HAVING ( juru LIKE '%$_GET[q]%' OR judul LIKE '%$_GET[q]%' OR skill LIKE '%$_GET[q]%') AND status_permintaan!='Ditutup' LIMIT $position, $item_per_page")or die(mysql_error());
                        while($d = mysql_fetch_array($data)){
                            ?>
                    

                    <div class="row bty">
                        <div class="col col-sm-9 ">
                        <strong><h2 class='jobs-nm-text' style="text-align: left;"><?php echo $d['judul']?></h2></strong>
                        
                        </div> 
                        <div class='col-md-3'>
                            <h4 class='company-nm-text' style="color: #77ACA2"><?php echo $d['nama_du']?></h4>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col col-sm-8">
                            <?php echo substr($d['lainnya'],0,200).'...';
                            $dl = mysql_query("SELECT * FROM hb_du_jumlah_permintaan_du_kerja INNER JOIN jurusan ON jurusan.id_jurusan = hb_du_jumlah_permintaan_du_kerja.id_jurusan WHERE id_du_kerja = '$d[id_du_kerja]'")or die(mysql_error());
                                    
                            ?>
                            <br><br>

                            <h4 class='keyskills-nm-text'>
                            <?php
                                    while($dd = mysql_fetch_array($dl)){
                                    echo "<i class='fa fa-caret-right'></i> $dd[nama_jurusan]&emsp;";
                                    $dt = mysql_query("SELECT * FROM hb_detail_skill WHERE id_du_kerja = '$d[id_du_kerja]' AND id_jurusan=$dd[id_jurusan]");
                                    while($d2 = mysql_fetch_array($dt)){
                                        echo "<a href='lowongan-kerja?q=$d2[kode_skill]' style='text-decoration:none'><span class='skills'>".$d2['kode_skill'].'</span></a>';
                                        }

                                    echo "<br><br>";
                                    
                                }
                                    ?>
                            
                            </h4>

                        </div> 

                    </div>

                    <a href='detail-loker-<?php echo $d['id_du_kerja']?>' class="btn btn-default dropdown-toggle btn-jobs"  aria-haspopup="true" aria-expanded="false" style='float: right;background-color: #749593'>
                        Lebih Detail
                    </a>
                    <br><br>
                    <hr class="bb">


<?php
                        }
                    ?>