<?php

session_start();
 
setcookie("hash", md5($_GET['hash']."centerparks555"), time() + 60*60*24*30, "/");
 
header("Location: https://engine.chess4four.org/dev/two/tomcat/hello/".$_GET['hash']);
 
?>