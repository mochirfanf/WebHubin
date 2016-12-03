<?php
echo "<form method='post' action='coba.php'>";
echo "<select name='jur[]'><option value='1'>gfhdshagjhj</option><option value='2'>ghj</option></select><br>";
echo "<select name='jur[]'><option value='4'>ghfchgjbkj</option><option value='3'>ghj</option></select>";
echo "<input type='submit' value='a' name='a'>";
echo "<p id='mo[]'>1</p><br><br><p id='mo[]'>2</p>";

if(isset($_POST['a'])){
	foreach ($_POST['jur'] as $key) {
		echo $key;
	}
	
}
?>
<script src="../js/jquery-1.10.2.min.js"></script>
<script>
$( "select" ).change(function() {
	var indeks = $( "select" ).index(this);
    if(indeks==1){
    	$( "#mo" ).index(0).text("aa");
    }
});
</script>