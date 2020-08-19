<?php

session_start();

if(!isset($_SESSION['id'])){
	
	header("Location: welcome.php");
		
	exit;
}

include_once("settings.php");

$sql = "select reason from game_result where game = '".test_input($_GET['game'])."';";

$result = $conn->query($sql);

while($row = $result->fetch_assoc()){
	
	echo $row['reason'];
	
}

?>