<?php

session_start();

$_SESSION['user'] = $_POST['password'];

header("Location: lobby.php");

?>
