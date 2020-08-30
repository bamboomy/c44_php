<?php

session_start();

if(!isset($_SESSION['id'])){
	
	header("Location: welcome.php");
		
	exit;
}

include_once("settings.php");

$sql = "SELECT id, created, name from colors_taken where game = '".test_input($_SESSION['hash'])."' ";

$sql .= "and color='".test_input($_GET['color'])."' ORDER BY created ASC;";

$result = $conn->query($sql) or die($conn->error);

$row = $result->fetch_assoc();

while($row = $result->fetch_assoc()){
	
	if($_SESSION['name'] == row['name']){
	
		$sql = "DELETE FROM colors_taken WHERE id='".$row['id']."';";

		$conn->query($sql) or die($conn->error);
	}
}

?>  

<script>

	alert('Some players choose the same color\n(apparently it actually does happen)\nthis is corrected now, we can proceed...');
	
	window.location.assign("castles.php");

</script>