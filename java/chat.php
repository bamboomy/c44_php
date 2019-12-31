<?php

session_start();

header("Access-Control-Allow-Origin: http://chess4four.io:8080");

var_dump($_SESSION);

/*
if(!isset($_SESSION['id'])){
	
	header("Location: register.php");
		
	exit;
}
*/

echo $_POST['text'];

?>