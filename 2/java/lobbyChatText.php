<?php

session_start();

header("Access-Control-Allow-Origin: http://chess4four.org:".$port);
header("Access-Control-Allow-Credentials: true");

include_once("../pagez/settings.php");

$sql = "select text from chat where game = '".test_input($_GET['board'])."';";

$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {

	echo $row['text'] . "<br/>";
}

?>