<?php

session_start();

$_SESSION['user'] = $_POST['password'];

if(isset($_SESSION['invited'])){
	
	header("Location: color.php");	
	
} else {
	
	header("Location: lobby.php");	
}

?>
