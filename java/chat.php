<?php

session_start();

header("Access-Control-Allow-Origin: *");

if(!isset($_SESSION['id'])){
	
	header("Location: register.php");
		
	exit;
}

echo $_POST['text'];

?>