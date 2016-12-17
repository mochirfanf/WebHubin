<?php 

function formatDate($date){
	return date('d m, g:i a', strtotime($date));
}
?>