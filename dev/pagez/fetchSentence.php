<?php

session_start();

if(!isset($_SESSION['id'])){
	
	header("Location: welcome.php");
		
	exit;
}

include_once("settings.php");


$sql = "select sentence, private, started from game where hash = '".test_input($_SESSION['hash'])."';";

$result = $conn->query($sql) or die($conn->error);

if ($result->num_rows != 1) {
	
	echo "the site is broken";
	
	die;
}

$row = $result->fetch_assoc();

$_SESSION['sentence'] = $row['sentence'];

header("Location: castles.php");

?>