<?php

session_start();

unset($_SESSION['java_hash']);

unset($_SESSION['color']);

header("Location: castles_one.php");

?>
