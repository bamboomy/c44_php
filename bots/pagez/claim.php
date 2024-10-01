<?php

session_start();

include_once("settings.php");

$name = $_SESSION['name'];

unset($_SESSION['colors'][$_GET['color']]);

if(!empty($_SESSION['color'])){

	$name = "Friendly bot";
	
	$_SESSION['botColor'] = test_input($_GET['color']);
	
	$keys = array_keys($_SESSION['colors']);
	
	$sql = "insert into colors_taken (game, color, name, java_hash, ally_color) ";
	$sql .= " values ('".$_SESSION['hash']."', '".$_SESSION['colors'][$keys[0]]."', 'Hostile Bot wan', '".$_SESSION['java_hash']."', '".$_SESSION['colors'][$keys[1]]."');";

	$conn->query($sql) or die($conn->error);

	$sql = "insert into colors_taken (game, color, name, java_hash, ally_color) ";
	$sql .= " values ('".$_SESSION['hash']."', '".$_SESSION['colors'][$keys[1]]."', 'Hostile Bot too', '".$_SESSION['java_hash']."', '".$_SESSION['colors'][$keys[0]]."');";

	$conn->query($sql) or die($conn->error);

	$sql = "insert into colors_taken (game, color, name, java_hash, ally_color) ";
	$sql .= " values ('".$_SESSION['hash']."', '".$_SESSION['color']."', 'First Player', '".$_SESSION['java_hash']."', '".$_SESSION['botColor']."');";

	$conn->query($sql) or die($conn->error);

	$sql = "insert into colors_taken (game, color, name, java_hash, ally_color) ";
	$sql .= " values ('".$_SESSION['hash']."', '".$_SESSION['botColor']."', 'Friendly Bot', '".$_SESSION['java_hash']."', '".$_SESSION['color']."');";

	$conn->query($sql) or die($conn->error);

} else {
	
	$_SESSION['color'] = test_input($_GET['color']);
	
	$_SESSION['java_hash'] = md5($_SERVER['REMOTE_ADDR'] . microtime() . $_SESSION['hash'] . $_SESSION['id']);
}



?>