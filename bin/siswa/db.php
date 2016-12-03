<?php 

function formatDate($date){
	return date('d M, g:i a', strtotime($date));
}
?>