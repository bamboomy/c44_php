<?php

session_start();

if(!isset($_SESSION['id'])){
	
	header("Location: welcome.php");
		
	exit;
}

include_once("settings.php");

$sql = "insert into sterren (userId, starz) ";
$sql .= " values ('".$_SESSION['id']."', '".test_input($_GET['stars'])."');";

$result = $conn->query($sql) or die($conn->error);

?>

Succezz :)