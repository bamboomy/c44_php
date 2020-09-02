<?php

session_start();

if(!isset($_SESSION['id'])){
	
	header("Location: welcome.php");
		
	exit;
}

include_once("settings.php");

$java_hash = md5($_SERVER['REMOTE_ADDR'] . microtime() . $_SESSION['hash']);

$sql = "insert into colors_taken (game, color, name, java_hash) ";
$sql .= " values ('".$_SESSION['hash']."', '".array_shift($remainingColors)."', 'Random85247', '".$java_hash."');";

$result = $conn->query($sql) or die($conn->error);

$java_hash = md5($_SERVER['REMOTE_ADDR'] . microtime() . $_SESSION['hash']);

$sql = "insert into colors_taken (game, color, name, java_hash) ";
$sql .= " values ('".$_SESSION['hash']."', '".array_shift($remainingColors)."', 'Random85247', '".$java_hash."');";

$result = $conn->query($sql) or die($conn->error);

header("Location: castles.php");

?>