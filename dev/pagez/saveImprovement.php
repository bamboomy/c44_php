<?php

session_start();

if(!isset($_SESSION['id'])){
	
	header("Location: welcome.php");
		
	exit;
}

include_once("settings.php");

$sql = "insert into improvementz (userId, text) ";
$sql .= " values ('".$_SESSION['id']."', '".test_input($_POST['text'])."');";

$result = $conn->query($sql) or die($conn->error);

?>

Succezz :)