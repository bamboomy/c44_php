<?php

session_start();

if(!isset($_SESSION['id'])){
	
	header("Location: welcome.php");
		
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
	
if ($result->num_rows >= 4) {
	
	$sql = "update game set started='Y' where hash='".$_SESSION['hash']."';";

	$conn->query($sql);

	echo "<a href='https://chess4four.org".$profilePath."/tomcat/hello/".$row2['java_hash']."'>Let's boogy</a>";
	
	die;
}

$greenHash = md5(microtime() . $_SESSION['hash'] . rand(0, 1000));
$blueHash = md5(microtime() . $_SESSION['hash'] . rand(0, 1000));
$redHash = md5(microtime() . $_SESSION['hash'] . rand(0, 1000));
$yellowHash = md5(microtime() . $_SESSION['hash'] . rand(0, 1000));

$_SESSION['colorValues'] = array( 

	$greenHash => 'Green' , 
	$blueHash => 'Blue', 
	$redHash => 'Red', 
	$yellowHash => 'Yellow',
	
	'Green' => $greenHash, 
	'Blue' => $blueHash, 
	'Red' => $redHash, 
	'Yellow' => $yellowHash 
);

$remainingColors = array("Green", "Blue", "Red", "Yellow");

$takenColors = array($_SESSION['ownColor']);

while($row = $result->fetch_assoc()){
	
	$takenColors[$row['color']] = $row['name'];
	
	if (($key = array_search($row['color'], $remainingColors)) !== false) {
		unset($remainingColors[$key]);
	}	
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
			
			echo "<a href='readyRoom.php?game=".$_SESSION['hash']."&color=".$_SESSION['colorValues'][$color]."'><img src='../imgz/".$color.".png' class='image'></a>";
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
		<button class="left" onclick="voteRandom();">Vote random</a><button class="right" onclick="voteDubious();">Vote dubious</button><br/>
<?

		if($resultRandom->num_rows != 0){
			
			if($resultRandom->num_rows >= 2){
				
				$java_hash = md5($_SERVER['REMOTE_ADDR'] . microtime() . $_SESSION['hash']);

				$sql = "insert into colors_taken (game, color, name, java_hash) ";
				$sql .= " values ('".$_SESSION['hash']."', '".array_shift($remainingColors)."', 'Random85247', '".$java_hash."');";

				$result = $conn->query($sql);
			}

			echo "<span class='left spaced'>".$resultRandom->num_rows." votes</span>";
		}

		if($resultDubious->num_rows != 0){

			if($resultDubious->num_rows >= 2){
				
				$java_hash = md5($_SERVER['REMOTE_ADDR'] . microtime() . $_SESSION['hash']);

				$sql = "insert into colors_taken (game, color, name, java_hash) ";
				$sql .= " values ('".$_SESSION['hash']."', '".array_shift($remainingColors)."', 'Dubious85247', '".$java_hash."');";

				$result = $conn->query($sql);
			}

			echo "<span class='right spaced'>".$resultDubious->num_rows." votes</span>";
		}
	}
?>
	</div>
<?
}
?>