<?php

session_start();

if(!isset($_SESSION['id'])){
	
	header("Location: welcome.php");
		
	exit;
}

include_once("settings.php");

$sql = "select reason from game_result where game = '".test_input($_GET['game'])."';";

$result = $conn->query($sql);

while($row = $result->fetch_assoc()){
	
	//echo $row['reason'];
	
}

$sql = "select sentence, enddded from game where hash = '".test_input($_GET['game'])."';";

$result2 = $conn->query($sql) or die($conn->error);

$row2 = $result2->fetch_assoc();

?>
<html>
	<head>
	
		<link href='https://fonts.googleapis.com/css?family=Aclonica' rel='stylesheet'>
		
		<link rel="stylesheet" type="text/css" href="../css/default.css">
		
	</head>
	<body>
	<center>

		<div class="outer">
			<div class="middle">
				<div class="inner center">
				
					<h2>This was:</h2>
					<h2><? echo $row2['sentence']; ?></h2>
<?
	if($row2['ended'] == 'N'){
?>		
	<p>The game is still in progress...<br/>
	This is the partial result:</p>	
<?		
	} else {
		
		
	}
?>				
				
				</div>
			</div>
		</div>
	</center>
	
	</body>
</html>
