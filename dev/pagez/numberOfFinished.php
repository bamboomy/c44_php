<?php

session_start();

if(!isset($_SESSION['id'])){
	
	header("Location: welcome.php");
		
	exit;
}

include_once("settings.php");

$sql = "select count(1) from game_result where game = '".test_input($_SESSION['hash'])."';";

$result = $conn->query($sql) or die($conn->error);

$row = $result->fetch_row();

echo '#: ', $row[0];

?>