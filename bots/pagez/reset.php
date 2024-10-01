<?php

session_start();

unset($_SESSION['java_hash']);

header("Location: castles_one.php");

?>
