<?php

session_start();

if(!isset($_SESSION['id'])){
	
	header("Location: welcome.php");
		
	exit;
}

include_once("settings.php");

$sql = "insert into votes (game, javaHash, value) values ('".$_SESSION['hash']."', '".$_SESSION['java_hash']."', '".test_input($_GET['value'])."');";

$result = $conn->query($sql) or die($conn->error);

echo "succezzzz :)";

?>