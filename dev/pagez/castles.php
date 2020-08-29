<?php

session_start();

if(!isset($_SESSION['id'])){
	
	header("Location: welcome.php");
		
	exit;
}

include_once("settings.php");

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

.inner {
  margin-left: auto;
  margin-right: auto;
  width: 1200px;
}

figcaption{

	text-align: center;
}

table{

	margin: auto;
}

figure{

	margin-left: 0px;
	margin-right: 0px;
}

#Green {
   background-image: url('../imgz/green_castle_unclaimed.png');
   height: 170px;
   width: 300px;
}

#Green:hover {
   background-image: url('../imgz/green_castle_taken.png');
}

#Blue {
   background-image: url('../imgz/blue_castle_unclaimed.png');
   height: 170px;
   width: 300px;
}

#Blue:hover {
   background-image: url('../imgz/blue_castle_taken.png');
}

#Red {
   background-image: url('../imgz/red_castle_unclaimed.png');
   height: 170px;
   width: 300px;
}

#Red:hover {
   background-image: url('../imgz/red_castle_taken.png');
}

#Yellow {
   background-image: url('../imgz/yellow_castle_unclaimed.png');
   height: 170px;
   width: 300px;
}

#Yellow:hover {
   background-image: url('../imgz/yellow_castle_taken.png');
}

h3{
	
	margin-top: 15px;
}

</style>

<script>

<? echo "var name = '".$_SESSION['name']."';"; ?>

function changeText(color){

	if(color == "green"){
	
		$('#greenName').html(name);
	
	} else if(color == "blue"){
	
		$('#blueName').html(name);
	
	} else if(color == "red"){
	
		$('#redName').html(name);
	
	} else if(color == "yellow"){
	
		$('#yellowName').html(name);
	}
}

function resetText(color){

	if(color == "green"){
		
		$('#greenName').html('unclaimed');

	} else if(color == "blue"){
	
		$('#blueName').html('unclaimed');
	
	} else if(color == "red"){
	
		$('#redName').html('unclaimed');
	
	} else if(color == "yellow"){
	
		$('#yellowName').html('unclaimed');
	}
}

function claim(color){

	$.ajax({
		type : "GET",
		url : "claim.php?color="+color,
		async : false,
		success : function(text) {
			
			alert(text);
			
			//fill();
		}
	});
}

</script>
	
	</head>
	<body>
	
		<center>

			<div class="container-fluid">
			
				<div class="row align-items-center h-25">
			
					<div class="col-md-12">
			
						<h3>We're creating game:</h3>
						
						<h3>"Some game"</h3>
			
						<h3>Choose your color:</h3>
						
					</div>
				</div>
				
				<div class="row align-items-center h-50">
				
					<div class="col-md-3">

						<figure>

							<div id="Green" onmouseover="changeText('green')" 
								onclick="claim('Green')" 
								onmouseout="resetText('green')"></div>
							
							<figcaption> Green: <span id="greenName">unclaimed</span> </figcaption>
						</figure>

					</div>
					<div class="col-md-3">

						<figure>
							
							<div id="Blue" onmouseover="changeText('blue')" 
								onmouseout="resetText('blue')"></div>

							<figcaption> Blue: <span id="blueName">unclaimed</span> </figcaption>
						</figure>

					</div>
					<div class="col-md-3">

						<figure>
						
							<div id="Red" onmouseover="changeText('red')" 
								onmouseout="resetText('red')"></div>

							<figcaption> Red: <span id="redName">unclaimed</span> </figcaption>
						</figure>

					</div>
					<div class="col-md-3">

						<figure>
						
							<div id="Yellow" onmouseover="changeText('yellow')" 
								onmouseout="resetText('yellow')"></div>

							<figcaption> Yellow: <span id="yellowName">unclaimed</span> </figcaption>
						</figure>

					</div>
				</div>
				
				<div class="row align-items-center h-25">
			
					<div class="col-md-12">
			
						<p>test</p>
						
					</div>
				</div>
				
			</div>

		</center>
	
	</body>
</html>