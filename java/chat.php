<?php

session_start();

header("Access-Control-Allow-Origin: http://chess4four.io:8080");
header("Access-Control-Allow-Credentials: true");

if(!isset($_SESSION['id'])){
	
	header("Location: register.php");
		
	exit;
}

echo $_POST['text'] . "=>" . $_GET['board'] ;

?>