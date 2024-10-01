<?php

session_start();

unset($_SESSION['java_hash']);

unset($_SESSION['color']);

unset($_SESSION['bot']);

header("Location: castles_one.php");

?>
