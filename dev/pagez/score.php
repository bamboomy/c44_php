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

$sql = "SELECT * FROM sterren s where id = (select max(id) from sterren where userId='".$_SESSION['id']."')";

$result5 = $conn->query($sql) or die($conn->error);

$starz = 0;

if($result5->num_rows != 0){

	$row5 = $result5->fetch_assoc();
	
	$starz = $row5['starz'];
}

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

<style>

	#reload{
		
		border-style: solid;
		max-width: 300px;
		top: 10px;
		left: 10px;
		padding: 5px;
	}
	
	.star {
	   background-image: url('../imgz/star_gray.png');
	   height: 70px;
	   width: 70px;
	   background-repeat: no-repeat;
	   display: inline-block;
	}

/*
	.star:hover {
	   background-image: url('../imgz/star_green.png');
	}
*/

	.star.selected {
	   background-image: url('../imgz/star_green.png');
	}
	
	.star.saved {
	   background-image: url('../imgz/star_green.png');
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

	function retrieveStars(){

		for (i = 0; i <= 5; i++) {
			
			$("#star_"+i).removeClass("selected");
		}

<? echo "var nr = " . $starz . ";"; ?>
		
		for (i = 0; i <= nr; i++) {
			
			$("#star_"+i).addClass("selected");
		}
	}

	$( document ).ready(function() {
		
		$('#reviewModal').modal('show');
		
		$( "div[id^='star']" ).mouseenter(
		
			function() {

				for (i = 0; i <= 5; i++) {
					
					$("#star_"+i).removeClass("selected");
				}
				
				var nr = $( this ).attr('id').split("_")[1];
				
				for (i = 0; i <= nr; i++) {
					
					$("#star_"+i).addClass("selected");
				}
			}
		);

		$( "div[id^='star']" ).mouseleave(
		
			retrieveStars
		);
		
		$( "div[id^='star']" ).click(
		
			function() {
		
				var nr = $( this ).attr('id').split("_")[1];

				$.ajax({
					type : "GET",
		<?			echo "url : 'https://chess4four.org".$profilePath."/pagez/saveStar.php?stars='+nr,"; ?>
					async : false,
					success : function(text) {
						
						location.reload();
					}
				});
			}
		);
		
		retrieveStars();
		
	});	

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

	<center>

	<!-- The Waiting Modal -->
	<div class="modal" id="reviewModal">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">

				<!-- Modal Header -->
				<div class="modal-header">
					<? echo "<h4 class='modal-title'>".$_SESSION['name']."'s review:</h4>"; ?>
				</div>

				<!-- Modal body -->
				<div class="modal-body">
				
					<div id="star_1" class="star"></div>
					<div id="star_2" class="star"></div>
					<div id="star_3" class="star"></div>
					<div id="star_4" class="star"></div>
					<div id="star_5" class="star"></div>
				
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
