<?php

$servername = "34.242.89.176";
$username = "presence";
$password = "YetAnotherPassword";
$dbname = "presence";

// Create connection
$conn = new mysqli("54.229.199.160", "hexago", "Z33rG3h31^^", "c44");

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  $data = addslashes($data);
  return $data;
}

function addBrs($data){
	
	$words = explode(" ", $data);
	
	$counter = 0;
	
	foreach ($words as $word) {

		$result .= " " . $word;
		
		$counter+=strlen($word);
		
		if(strstr($word, PHP_EOL)) {

			$counter = 0;
		}
		
		if($counter >= 50){
			
			$result .= "<br/>";
			
			$counter = 0;
		}
	}
	
	return $result;
}

$profilePath = "/";

if(strpos("dev", getcwd()) !== false){
	
	$profilePath = "/dev";
}

?>