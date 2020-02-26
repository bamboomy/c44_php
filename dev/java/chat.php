<?php

session_start();

header("Access-Control-Allow-Origin: http://chess4four.io:8080");
header("Access-Control-Allow-Credentials: true");

include_once("../pagez/settings.php");

if(!isset($_SESSION['id'])){
	
	header("Location: register.php");
		
	exit;
}

$sql = "select name, game from colors_taken where java_hash = '".test_input($_GET['board'])."';";

$result = $conn->query($sql);

$row = $result->fetch_assoc();

$sql = "insert into chat (game, text) ";
$sql .= " values ('".$row['game']."', '".$row['name'].": ".  test_input($_POST['text'])."');";

$result = $conn->query($sql);

$sql = "select java_hash from colors_taken where game = '".$row['game']."';";

$result = $conn->query($sql);

while($row = $result->fetch_assoc()){
	
	$sql = "update chatDirty set cleaned = 'false' where javaHash = '".$row['java_hash']."';";

	$result2 = $conn->query($sql);
}

echo "success";

?>