<?php

session_start();

include_once("../pagez/settings.php");

header("Access-Control-Allow-Origin: http://chess4four.org:".$port);
header("Access-Control-Allow-Credentials: true");

if(!isset($_SESSION['id']) && !isset($_SESSION['bypass'])){
	
	header("Location: register.php");
		
	exit;
}

$sql = "select cleaned from chatDirty where javaHash = '".test_input($_GET['board'])."';";

$result = $conn->query($sql);

$row = $result->fetch_assoc();

if($row['cleaned'] == "true"){
	
	echo "clean";
	
	die;
}

$sql = "select name, game from colors_taken where java_hash = '".test_input($_GET['board'])."';";

$result = $conn->query($sql);

$row = $result->fetch_assoc();

$sql = "select text from chat where game = '".$row['game']."';";

$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {

	echo $row['text'] . "<br/>";
}

$sql = "update chatDirty set cleaned = 'true' where javaHash = '".test_input($_GET['board'])."';";

$result = $conn->query($sql);

?>