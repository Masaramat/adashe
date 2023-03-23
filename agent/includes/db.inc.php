<?php
$link = mysqli_connect('localhost', 'root', 'SudoP@ssw0rd');
if (!$link){
	$error = 'Unable to connect to the database server.';
	include 'error.html.php';
	exit();
}
if (!mysqli_set_charset($link, 'utf8')){
	$output = 'Unable to set database connection encoding.';
	include 'output.html.php';
	exit();
}
if (!mysqli_select_db($link, 'adashe')){
	$error = 'Unable to locate the ng cares database.';
	include 'error.html.php';
	exit();
}
?>