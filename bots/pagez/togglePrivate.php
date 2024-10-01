<?php

session_start();

if(!isset($_SESSION['id'])){
	
	header("Location: welcome.php");
		
	exit;
}

include_once("settings.php");

$sql = "select private from game where hash = '".test_input($_SESSION['hash'])."';";

$result = $conn->query($sql);

if ($result->num_rows != 1) {
	
	echo "the site is broken";
	
	die;
}

$row = $result->fetch_assoc();
	
$value = '';	
	
if($row['private'] == 'N'){

	$value = 'Y';

}else{

	$value = 'N';
}

$sql = "update game set private='".$value."' where hash = '".test_input($_SESSION['hash'])."';";

$result = $conn->query($sql);

?>