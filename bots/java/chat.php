<?php

session_start();

include_once("../pagez/settings.php");

header("Access-Control-Allow-Origin: http://chess4four.org:".$port);
header("Access-Control-Allow-Credentials: true");

if(!isset($_SESSION['id']) && !isset($_SESSION['bypass'])){
	
	header("Location: register.php");
		
	exit;
}

$sql = "select name, game, color from colors_taken where java_hash = '".test_input($_GET['board'])."';";

$result = $conn->query($sql);

$row = $result->fetch_assoc();

$color = "";

if($row['color'] == "Blue"){
	
	$color = "blue";
	
}else if($row['color'] == "Yellow"){
	
	$color = "orange";
	
}else if($row['color'] == "Green"){
	
	$color = "green";
	
}else if($row['color'] == "Red"){
	
	$color = "red";

}else if($row['color'] == "Chatter"){
	
	$color = "gray";
}	

if(!isset($_POST['text']) && isset($_GET['board'])){
	
	$sql = "insert into chat (game, text) ";
	$sql .= " values ('".$row['game']."', '<span style=\'color:".$color."\'>".$row['name']." has entered the chat...</span>');";

} else {
	
	$sql = "insert into chat (game, text) ";
	$sql .= " values ('".$row['game']."', '<span style=\'color:".$color."\'>".$row['name']."</span>: ".  test_input($_POST['text'])."');";
}

$result = $conn->query($sql);

$sql = "select java_hash from colors_taken where game = '".$row['game']."';";

$result = $conn->query($sql);

while($row = $result->fetch_assoc()){
	
	$sql = "update chatDirty set cleaned = 'false' where javaHash = '".$row['java_hash']."';";

	$result2 = $conn->query($sql);
}

echo "success";

?>