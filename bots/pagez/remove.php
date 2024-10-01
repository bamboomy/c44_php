<?php

session_start();

if(!isset($_SESSION['id'])){
	
	header("Location: welcome.php");
		
	exit;
}

include_once("settings.php");

$sql = "update improvementz set deleted = 'Y' where id = '".test_input($_GET['id'])."' and userId = '".$_SESSION['id']."';";

$result = $conn->query($sql) or die($conn->error);

?>

Succezz :)