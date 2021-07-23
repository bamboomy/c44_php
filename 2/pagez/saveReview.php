<?php

session_start();

if(!isset($_SESSION['id'])){
	
	header("Location: welcome.php");
		
	exit;
}

include_once("settings.php");

if(isset($_POST['facebook'])){
	
	$facebook = "Y";

} else {
	
	$facebook = "N";
}

if(isset($_POST['publicly'])){
	
	$publicly = "Y";

} else {
	
	$publicly = "N";
}

$sql = "insert into review (userId, text, facebook, publicly) values ('".$_SESSION['id']."', '".test_input($_POST['w3review'])."', '".$facebook."', '".$publicly."');";

$result = $conn->query($sql) or die($conn->error);

header("Location: score.php?game=".$_POST['game']);

?>