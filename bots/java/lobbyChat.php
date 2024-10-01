<?php

session_start();

include_once("../pagez/settings.php");

header("Access-Control-Allow-Origin: http://chess4four.org:".$port);
header("Access-Control-Allow-Credentials: true");

if(!isset($_SESSION['id'])){
	
	header("Location: register.php");
		
	exit;
}

$sql = "insert into chat (game, text) ";
$sql .= " values ('".test_input($_GET['board'])."', '".test_input($_POST['text'])."');";

$result = $conn->query($sql);

echo "success";

?>