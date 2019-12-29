<?php

session_start();

if(!isset($_SESSION['id'])){
	
	header("Location: register.php");
		
	exit;
}

include_once("settings.php");

$sql = "select color, name from colorsTaken where game = '".$_SESSION['hash']."';";

$result = $conn->query($sql);

$takenColors = array($_SESSION['ownColor']);

while($row = $result->fetch_assoc()){
	
	$takenColors[$row['color']] = $row['name'];
}

$allColors = array("Red", "Green", "Blue", "Yellow");

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
		if($_SESSION['ownColor'] == $color){
			
			echo "<div class='text'>You</div>";
			
		} else {
			
			echo "<div class='text'>".$color." : ".$takenColors[$color]."</div>";
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
?>