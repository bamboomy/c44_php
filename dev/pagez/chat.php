<?php

session_start();

if(!isset($_SESSION['id'])){
	
	header("Location: welcome.php");
		
	exit;
}

include_once("settings.php");

$java_hash = md5($_SERVER['REMOTE_ADDR'] . microtime() . $_SESSION['hash'] . $_SESSION['id']);

$sql = "insert into colors_taken (game, color, name, java_hash) ";
$sql .= " values ('".$_SESSION['hash']."', 'chat', '".$_SESSION['name']."', '".$java_hash."');";

$result = $conn->query($sql);

$sql = "insert into chatDirty (javaHash) ";
$sql .= " values ('".$java_hash."');";

$result = $conn->query($sql);

header("Location: https://chess4four.org".$profilePath."/tomcat/?id=".$java_hash);

exit;

?>