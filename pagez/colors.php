<?php

session_start();

include_once("settings.php");

$sql = "select color from colors_taken where game = '".$_SESSION['hash']."';";

$result = $conn->query($sql);

$takenColors = array($_SESSION['ownColor']);

while($row = $result->fetch_assoc()){
	
	array_push($takenColors, $row['color']);
}

$allColors = array("Red", "Green", "Blue", "Yellow");

foreach ($allColors as $color){ 

	if(in_array($color, $takenColors)){
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
			
			echo "<div class='text'>".$color."</div>";
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