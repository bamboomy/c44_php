<?php

session_start();

if(!isset($_SESSION['id'])){
	
	header("Location: welcome.php");
		
	exit;
}

include_once("settings.php");

$_SESSION['java_hash'] = md5($_SERVER['REMOTE_ADDR'] . microtime() . $_SESSION['hash'] . $_SESSION['id']);

$sql = "insert into colors_taken (game, color, name, java_hash) ";
$sql .= " values ('".$_SESSION['hash']."', '".test_input($_GET['color'])."', '".$_SESSION['name']."', '".$_SESSION['java_hash']."');";

$conn->query($sql) or die($conn->error);

$sql = "insert into chatDirty (javaHash) ";
$sql .= " values ('".$_SESSION['java_hash']."');";

$conn->query($sql) or die($conn->error);

if(isset($_SESSION['chat'])){
	
	setcookie("hash", md5($_SESSION['java_hash']."centerparks555"), time() + 60*60*24*30, "/");

	header("Location: ".$profilePath."/tomcat/hello/".$_SESSION['java_hash']);
		
	exit;
}

?>