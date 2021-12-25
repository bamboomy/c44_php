<?php

session_start();

setcookie("hash", md5($_SESSION['java_hash']."centerparks555"), time() + 60*60*24*30, "/");

include_once("settings.php");

$remainingColors = array("Green", "Blue", "Red", "Yellow");

foreach ($remainingColors as $color) {

	$java_hash = md5($_SERVER['REMOTE_ADDR'] . openssl_random_pseudo_bytes(5, $cstrong) . $_SESSION['hash']);
	
	$sql = "insert into colors_taken (game, color, name, java_hash) ";
	$sql .= " values ('".$_SESSION['hash']."', '".$color."', '".$color."', '".$java_hash."');";

	$result = $conn->query($sql) or die($conn->error);
}
