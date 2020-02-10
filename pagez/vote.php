<?php

session_start();

if(!isset($_SESSION['id'])){
	
	header("Location: register.php");
		
	exit;
}

include_once("settings.php");

$sql = "update votes set voted = '1' where hash = '".$_GET['hash']."'";

$result = $conn->query($sql);

echo "succezzzz :)";

?>