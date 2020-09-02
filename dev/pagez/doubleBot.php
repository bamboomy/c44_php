<?php

session_start();

if(!isset($_SESSION['id'])){
	
	header("Location: welcome.php");
		
	exit;
}

include_once("settings.php");

$_SESSION['doubleBot'] = true;

header("Location: castles.php");

?>