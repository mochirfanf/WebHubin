<?php
$dbhost ='localhost';
$dbuser ='c2hubindea987';
$dbpass ='hubindea987';
$dbname ='c2hubin';
$db_dsn = "mysql:dbname=$dbname;host=$dbhost";
try {
  $db = new PDO($db_dsn, $dbuser, $dbpass);
} catch (PDOException $e) {
  echo 'Connection failed: '.$e->getMessage();
}
?>