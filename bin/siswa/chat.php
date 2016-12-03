

  <?php 
	include 'db.php';
	include '../koneksidb.php';
	
	$qr = mysql_fetch_array(mysql_query("SELECT saran_pembimbing FROM hb_prakerin WHERE nis='$_SESSION[username]'"));;

	$query = "SELECT * FROM hb_bimbingan WHERE pengirim='$_SESSION[username]' OR penerima='$_SESSION[username]' OR pengirim='$qr[saran_pembimbing]' OR penerima='$qr[saran_pembimbing]' ORDER BY id_chat ASC";
	$run = mysql_query($query)or die(mysql_error());
	while($row = mysql_fetch_array($run)) :
		if($row['pengirim']==$_SESSION['username']){
			$ll = "right";
			$rr = "#71d573";
		}else{
			$ll = "left";
			$rr = "#81bac5";
		}
		?>
			<div id="chat_data" style='padding: 20px'>
				<span class='col-md-7' style='background-color:<?php echo $rr?>;color:#fff;padding: 10px;border-radius: 10px;margin: 5px;float:<?php echo $ll?>'>
					<span class='col-md-12' style='float:left;''><?php echo $row['pesan']; ?></span>
					<span class='col-md-3' style="float:right;font-size: 9pt"><?php echo formatDate($row['tanggal']); ?></span>
				</span>
			</div>
			<?php endwhile;?>