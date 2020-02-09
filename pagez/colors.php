<?php

session_start();

if(!isset($_SESSION['id'])){
	
	header("Location: register.php");
		
	exit;
}

include_once("settings.php");

$sql = "select color from colors_taken where game = '".$_SESSION['hash']."';";

$result = $conn->query($sql);

if ($result->num_rows == 4) {
	
	$sql = "select java_hash from colors_taken where game = '".$_SESSION['hash']."' and color = '".$_SESSION['ownColor']."';";
	
	$result = $conn->query($sql);
	
	$row = $result->fetch_assoc();
	
	echo "<a href='https://chess4four.io/tomcat/?id=".$row['java_hash']."'>Let's boogy</a>";
	
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

	if($counter == 3){
?>
	<div id="third">
		Do you want to have a robot 3rd player?<br/>
		<br/>
		This can be either:<br/>
		<br/>
		A random player ((s)he doesn't know much)?<br/>
		<br/>
		Or a dubious player?<br/>
		<br/>
		(A dubious player is controlled by the other players,<br/>
		<br/>
		each one turn...)<br/>
		<br/>
		Or you can wait for a 4th player...<br/>
		<br/>
		<a class="left" onclick="voteRandom();">Vote random</a><a class="right">Vote dubious</a>
	</div>
<?
	}

?>