<?php

session_start();

include_once("settings.php");

$_SESSION['java_hash'] = md5($_SERVER['REMOTE_ADDR'] . microtime() . $_SESSION['hash'] . $_SESSION['id']);

$sql = "insert into colors_taken (game, color, name, java_hash) ";
$sql .= " values ('".$_SESSION['hash']."', '".test_input($_GET['color'])."', '".$_SESSION['name']."', '".$_SESSION['java_hash']."');";

$conn->query($sql) or die($conn->error);

$_SESSION['color'] = test_input($_GET['color']);

?>