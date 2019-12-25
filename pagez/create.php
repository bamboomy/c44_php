<?php

session_start();

include_once("settings.php");

$four = array("A wonderfull", "Some good", "A tea spoon of", "A green", "A wooden", "A bright", "A decent", "An excellent", "A handfull of");

$one = array("breeze", "tea", "outlet", "garden", "color", "t-shirt", "glass", "chocolate", "ashtray", "card", "letter", "globe", "bottle");

$two = array("without", "in", "between", "amongst", "outside of", "with");

$three = array("the dark", "elves", "Godot", "a lamp", "the unknown", "the French", "a sister", "some coffee", "a group of Elvises", "Indiana Jones");

$_SESSION['sentence'] = '"' . $four[rand(0, count($four) - 1)] . ' ';

$_SESSION['sentence'] .= $one[rand(0, count($one) - 1)] . ' ' . $two[rand(0, count($two) - 1)] . ' ' . $three[rand(0, count($three) - 1)] . '."' ;

if(isset($_SESSION['failCounter'])){
	
	$_SESSION['failCounter']++;

} else {
	
	$_SESSION['failCounter'] = 0;
}

$sql = "select id from game where sentence = '".$_SESSION['sentence']."';";

$result = $conn->query($sql);

if ($result->num_rows == 0) {
	
	echo "new";

} else {
	
	echo "taken";
}

?>