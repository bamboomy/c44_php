<?php

session_start();

include_once("settings.php");

$sql = "insert into 42player (gameHash, color, first, sideKick) ";
$sql .= " values ('".test_input($_SESSION['game']);."', '".test_input($_GET['color']);."', 'N', '".test_input($_GET['sideKick']);."');";

$conn->query($sql) or die($conn->error);

?>
