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

$sql = "select count(1) from game_result where game = '".test_input($_SESSION['hash'])."';";

$result4 = $conn->query($sql) or die($conn->error);

$row4 = $result4->fetch_row();

$base = $row4[0];

?>
<html>
	<head>

		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

		<!-- Popper JS -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

		<!-- Latest compiled JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	
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

	var shown = false;
	
	function checkFinished() {
		
		$.ajax({
			type : "GET",
<?			echo "url : 'https://chess4four.org".$profilePath."/pagez/numberOfFinished.php?game=".test_input($_GET['game'])."',"; ?>
			async : false,
			success : function(text) {
				
<?				echo "if(text != ".$base."){"; ?>

					$("#reload").show(1000);
					
					shown = true;
				}
			}
		});
	}

	function again() {

		setTimeout(function() {

			checkFinished();

			if(!shown){
				
				again();
			}

		}, 1000);
	}

	again();

</script>
		
	</head>
	<body>
	
<div id="reload" style="display: none;">

	<p>
		The game also ended for someone else...<br/>
		Do you want to <a href="#" onclick="location.reload();">reload</a><br/>
		to have the latest news?
	</p>

</div>	

	<!-- The Waiting Modal -->
	<div class="modal" id="4thModal">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">

				<!-- Modal Header -->
				<div class="modal-header">
					<h4 class="modal-title">No 4th player?</h4>
				</div>

				<!-- Modal body -->
				<div class="modal-body">
				
					<p style="font-size: smaller;">You can choose between a random robot (Annoying Bot)<br/>
					who puts people in check whenever it can;<br/>
					<br/>
					or a "Dubious Player":<br/>
					<br/>
					that's a player which is controlled<br/>
					by a different human player each turn...
					</p>
					<br/><br/>
					<p style="font-size: smaller;">
					</p>
				</div>
			</div>
		</div>
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
