<?php

session_start();

if(!isset($_SESSION['id'])){
	
	header("Location: welcome.php");
		
	exit;
}

include_once("settings.php");

$sql = "SELECT COUNT(DISTINCT color) from colors_taken where game = '".test_input($_SESSION['hash'])."';";

echo $sql."<br/>";

$result = $conn->query($sql) or die($conn->error);

$row = $result->fetch_row();

echo $row[0];

?>  