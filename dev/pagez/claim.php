<?php

session_start();

if(!isset($_SESSION['id'])){
	
	header("Location: welcome.php");
		
	exit;
}

include_once("settings.php");

$color = $_GET['color'];

$java_hash = md5($_SERVER['REMOTE_ADDR'] . microtime() . $_SESSION['hash'] . $_SESSION['id']);

$sql = "insert into colors_taken (game, color, name, java_hash) ";
$sql .= " values ('".$_SESSION['hash']."', '".$_SESSION['ownColor']."', '".$_SESSION['name']."', '".$java_hash."');";

$conn->query($sql) or die($conn->error);

$sql = "insert into chatDirty (javaHash) ";
$sql .= " values ('".$java_hash."');";

$conn->query($sql) or die($conn->error);

?>