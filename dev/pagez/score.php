<?php

session_start();

if(!isset($_SESSION['id'])){
	
	header("Location: welcome.php");
		
	exit;
}

include_once("settings.php");

$sql = "select reason, player from game_result where game = '".test_input($_GET['game'])."';";

$result = $conn->query($sql);

$sql = "select sentence, ended from game where hash = '".test_input($_GET['game'])."';";

$result2 = $conn->query($sql) or die($conn->error);

$row2 = $result2->fetch_assoc();

?>
<html>
	<head>
	
		<link href='https://fonts.googleapis.com/css?family=Aclonica' rel='stylesheet'>
		
		<link rel="stylesheet" type="text/css" href="../css/default.css">
		
		<script src="../js/jquery-3.4.1.min.js"></script>

<style>

	#reload{
		
		border-style: solid;
		max-width: 300px;
		top: 10px;
		left: 10px;
		padding: 5px;
	}

</style>		

<script>

	function checkFinished() {
		
		$.ajax({
			type : "GET",
<?			echo "url : 'https://chess4four.org".$profilePath."/pagez/numberOfFinished.php?game=".test_input($_GET['game'])."',"; ?>
			async : false,
			success : function(text) {
				
				alert(text);
			}
		});
	}

	function again() {

		setTimeout(function() {

			checkFinished();

			again();

		}, 1000);
	}

	again();

</script>
		
	</head>
	<body>
	
<div id="reload">

	<p>
		The game also ended for someone else...<br/>
		Do you want to <a href="#">reload</a><br/>
		to have the latest news?
	</p>

</div>	
	
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

<ol>

<?

while($row = $result->fetch_assoc()){
	
	$sql = "select color, name from colors_taken where java_hash = '".test_input($row['player'])."';";

	$result3 = $conn->query($sql) or die($conn->error);
	
	$row3 = $result3->fetch_assoc();
	
	echo "<li>".$row3['color'].": ".$row3['name'].": ".$row['reason']."</li>";
	
}
?>				

</ol>

				</div>
			</div>
		</div>
	</center>
	
	</body>
</html>
