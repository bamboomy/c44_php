<?php

session_start();

if(!isset($_SESSION['id'])){
	
	header("Location: welcome.php");
		
	exit;
}

include_once("settings.php");

if($_POST['facebook'] = "true"){
	
	$facebook = "Y";

} else {
	
	$facebook = "N";
}

if($_POST['publicly'] = "true"){
	
	$publicly = "Y";

} else {
	
	$publicly = "N";
}

$sql = "insert into review (userId, text, facebook, publicly) values ('".$_SESSION['id']."', '".test_input($_POST['w3review'])."', '".$facebook."', '".$publicly."');";

$result = $conn->query($sql) or die($conn->error);

header("Location: welcome.php");

?>

Succezz :)