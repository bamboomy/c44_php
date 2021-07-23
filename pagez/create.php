<?php

session_start();

if(!isset($_SESSION['id'])){
	
	header("Location: welcome.php");
		
	exit;
}

include_once("settings.php");

$four = array("Alfa", "Beta", "Gamma", "Delta", "Jota", "Mu", "Pi", "Rho", "Sigma", "Tau", "Phi", "Chi", "Psi", "Omega");

$_SESSION['sentence'] = '"Game ' . $four[rand(0, count($four) - 1)] . '-';

$_SESSION['sentence'] .= rand(1000, 7000) . '.' . rand(50, 600) . '"';

$failCounter = 0;

$sql = "select id from game where sentence = '".$_SESSION['sentence']."';";

$result = $conn->query($sql);

if ($result->num_rows != 0) {
	
	$fail = true;
	
	while($fail){
		
		$_SESSION['sentence'] = '"Game ' . $four[rand(0, count($four) - 1)] . '-';

		$_SESSION['sentence'] .= rand(1000, 7000) . '.' . rand(50, 600) . '"';

		$sql = "select id from game where sentence = '".$_SESSION['sentence']."';";

		$result = $conn->query($sql);
		
		$fail = $result->num_rows != 0;
		
		$failCounter++;
	}
}

$_SESSION['hash'] = md5(microtime() . $_SESSION['sentence'] . $failCounter);

$sql = "insert into game (sentence, hash, fail) ";
$sql .= " values ('".$_SESSION['sentence']."', '".$_SESSION['hash']."', '".$failCounter."');";

$result = $conn->query($sql);

header("Location: color.php");
?>