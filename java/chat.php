<?php

session_start();

if(!isset($_SESSION['id'])){
	
	header("Location: register.php");
		
	exit;
}

echo $_POST['text'];

?>