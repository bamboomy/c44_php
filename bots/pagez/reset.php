<?php

session_start();

unset($_SESSION['java_hash']);

unset($_SESSION['color']);

unset($_SESSION['bot']);

unset($_SESSION['botColor']);

$colors = array("Green" => "Green", "Blue" => "Blue", "Red" => "Red", "Yellow" => "Yellow");

header("Location: castles_one.php");

?>
