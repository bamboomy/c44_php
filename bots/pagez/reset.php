<?php

session_start();

unset($_SESSION['java_hash']);

unset($_SESSION['color']);

unset($_SESSION['bot']);

unset($_SESSION['botColor']);

header("Location: castles_one.php");

?>
