<?php 

function formatDate($date){
	return date('g:i a', strtotime($date));
}
?>