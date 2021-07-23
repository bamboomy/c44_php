<?php

session_start();

if(!isset($_SESSION['id'])){
	
	header("Location: welcome.php");
		
	exit;
}

include_once("settings.php");

$sql = "SELECT COUNT(1) from votes where game = '".$_SESSION['hash']."';";

$result = $conn->query($sql) or die($conn->error);

$row = $result->fetch_row();

echo $row[0];

?>  