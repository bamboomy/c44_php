<?php

session_start();

if(!isset($_SESSION['id'])){
	
	header("Location: register.php");
		
	exit;
}

include_once("settings.php");

$sql = "select color from colors_taken where game = '".$_SESSION['hash']."';";

$result = $conn->query($sql);

$sql = "select java_hash from colors_taken where game = '".$_SESSION['hash']."' and color = '".$_SESSION['ownColor']."';";

$result2 = $conn->query($sql);

$row2 = $result2->fetch_assoc();

$sql = "select value from votes where javaHash = '".$row2['java_hash']."' and voted = '1';";

$result3 = $conn->query($sql);

$row3 = $result3->fetch_assoc();
	
if ($result->num_rows == 4) {

	echo "<a href='https://chess4four.io/tomcat/?id=".$row2['java_hash']."'>Let's boogy</a>";
	
	die;
}

$takenColors = array($_SESSION['ownColor']);

while($row = $result->fetch_assoc()){
	
	$takenColors[$row['color']] = $row['name'];
}

$allColors = array("Green", "Blue", "Red", "Yellow");

$counter = 0;

foreach ($allColors as $color){ 

	if(array_key_exists($color, $takenColors)){
?>
			<div class="container">
				<img src="../imgz/grey.png" alt="Avatar" class="image">
				<div class="overlay">
					<div class="text">Already taken</div>
				</div>
				<div class="overlay_orig">
<?
		$counter++;

		if($_SESSION['ownColor'] == $color){
			
			echo "<div class='text'>".$color.": You</div>";
			
		} else {
			
			echo "<div class='text'>".$color.": ".$takenColors[$color]."</div>";
		}
?>
				</div>			
			</div>		
<?		
	} else {
?>
			<div class="container">
<?
		if(isset($_SESSION['ownColor'])){
			
			echo "<img src='../imgz/".$color.".png' class='image'>";
			
		} else {
			
			echo "<a href='readyRoom.php?game=".$_SESSION['hash']."&color=".$color."'><img src='../imgz/".$color.".png' class='image'></a>";
		}
?>
			</div>		
<?	
	}
} 

if(isset($_SESSION['ownColor']) && $counter == 3){
?>
	<div id="third">
		Do you want to have a robot 3rd player?<br/>
		<br/>
		This can be either:<br/>
		<br/>
		A random player (it doesn't know much)?<br/>
		<br/>
		Or a dubious player?<br/>
		<br/>
		(A dubious player is controlled by the other players,<br/>
		each turn someone else...)<br/>
		<br/>
		Or you can wait for a 4th player...<br/>
		<br/>
<?
	$sql = "select value from votes where gameHash = '".$_SESSION['hash']."' and voted = '1' and value = 'R';";

	$resultRandom = $conn->query($sql);

	$sql = "select value from votes where gameHash = '".$_SESSION['hash']."' and voted = '1' and value = 'D';";

	$resultDubious = $conn->query($sql);

	if ($result3->num_rows == 1) {

		if($row3['value'] == 'R'){
			
			echo "You voted 'Random'.";
				
		} else {
		
			echo "You voted 'Dubious'.";
		}

	} else {
?>
		<button class="left" onclick="voteRandom();">Vote random</a><button class="right" onclick="voteDubious();">Vote dubious</button><br/><br/>
<?

		if($resultRandom->num_rows != 0){

			echo "<span class='left'>".$resultRandom->num_rows." votes</span>";
		}

		if($resultDubious->num_rows != 0){

			echo "<span class='right'>".$resultDubious->num_rows." votes</span>";
		}
	}
?>
	</div>
<?
}
?>