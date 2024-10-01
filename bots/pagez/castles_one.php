<?php

session_start();

if(empty($_SESSION['java_hash'])){

	$_SESSION['hash'] = md5(microtime());
}

if(!empty($_SESSION['color'])){

	$_SESSION['name'] = "Friendly bot";

       }else{
		   
		   $_SESSION['name'] = "First Player";

       }


$_SESSION['sentence'] = "At centerparks";

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

#Blue {
   background-image: url('../imgz/blue_castle_unclaimed.png');
   height: 170px;
   width: 300px;
}

#Red {
   background-image: url('../imgz/red_castle_unclaimed.png');
   height: 170px;
   width: 300px;
}

#Yellow {
   background-image: url('../imgz/yellow_castle_unclaimed.png');
   height: 170px;
   width: 300px;
}

#Green.taken {
   background-image: url('../imgz/green_castle_taken.png');
}

#Blue.taken {
   background-image: url('../imgz/blue_castle_taken.png');
}

#Red.taken {
   background-image: url('../imgz/red_castle_taken.png');
}

#Yellow.taken {
   background-image: url('../imgz/yellow_castle_taken.png');
}

<?
	if(!$claimed){
?>

#Green:hover {
   background-image: url('../imgz/green_castle_taken.png');
}

#Blue:hover {
   background-image: url('../imgz/blue_castle_taken.png');
}

#Red:hover {
   background-image: url('../imgz/red_castle_taken.png');
}

#Yellow:hover {
   background-image: url('../imgz/yellow_castle_taken.png');
}

<?
	}
?>

h3{
	
	margin-top: 15px;
}

<?
	//print_r(headers_list());
?>

</style>

<script>

	var listen = true;

<? 
	if($claimed){
		
		echo "listen = false;";
	}

	echo "var name = '".$_SESSION['name']."';"; 
?>

function changeText(color){
	
	if(!listen){
		
		return;
	}

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

	if(!listen){
		
		return;
	}

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

	if(!listen){
		
		return;
	}

	$.ajax({
		type : "GET",
		url : "claim.php?color="+color,
		async : false,
		success : function(text) {
			
			location.reload();
		}
	});
}

function copy() {
  var copyText = document.getElementById("myInput");
  copyText.select();
  copyText.setSelectionRange(0, 99999)
  document.execCommand("copy");
  alert("Link copied...");
}

/*
function again() {

	setTimeout(function() {

		$.ajax({
			type : "GET",
			url : "nbOfColors.php",
			async : false,
			success : function(text) {
				
<?				echo "if(".$colors_taken."!=text){"; ?>

					location.reload();
				}
			}
		});

		$.ajax({
			type : "GET",
			url : "nbOfVotes.php",
			async : false,
			success : function(text) {
				
<?				echo "if(".$votes."!=text){"; ?>

					location.reload();
				}
			}
		});

		again();

	}, 700);
}

again();

function vote(value){
	
	$.ajax({ type: "GET",   
			 
			 url: 'vote.php?value='+value,
			 async: false,
			 success : function(text)
			 {
				 location.reload();
			 }
	});
}

<?
if($votes!=0 && $botVotes != 2 && $dubiousVotes != 2){
?>	
	$( document ).ready(function() {
		$('#4thModal').modal('show');
	});
<?
}
?>
*/

</script>
	
	</head>
	<body>
	
	<!-- The 4thModal Modal -->
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

				</div>
			</div>
		</div>
	</div>

	<!-- The noOthersModal Modal -->
	<div class="modal" id="noOthersModal">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">

				<!-- Modal Header -->
				<div class="modal-header">
					<h4 class="modal-title">Just the two of you?</h4>
				</div>

				<!-- Modal body -->
				<div class="modal-body">

					<a href="doubleBot.php" >Click here</a> to start a game with two...<br/>
					<br/>

					<button type="button" onclick="$('#noOthersModal').modal('hide');" style="right: 10px;">Close</button>

				</div>
			</div>
		</div>
	</div>

		<center>

			<div class="container-fluid">
			
				<div class="row align-items-center h-25">
			
					<div class="col-md-12">
			
						<h3>We're creating game:</h3>
						
						<? echo "<h3>".str_replace("<br/>", " ", $_SESSION['sentence'])."</h3>"; ?>
<?
if(!empty($_SESSION['color'])){
?>			
						<h3>Choose the color of your bot:</h3>
<?
       }else{
?>
						<h3>Choose your color:</h3>
<?
       }
?>

						
					</div>
				</div>
				
				<div class="row align-items-center h-50">
				
					<div class="col-md-3">

<?
	if(isset($castle['Green'])){
?>
						<figure>
							<div id="Green" class="taken"></div>
<?
							echo "<figcaption> Green: ".str_replace("Random", "Annoying Bot", str_replace("85247", "", $castle['Green']))."</figcaption>";
?>							
						</figure>
<?		
	}else{
?>		
						<figure>
<?
if($_SESSION['color'] == "Green"){
?>
							<div id="Green" class="taken"></div>
							<figcaption> Green: <span id="greenName"><? echo $_SESSION['name']?></span> </figcaption>
<?		
	}else{
?>		
							<div id="Green" onmouseover="changeText('green')" 
								onclick="claim('Green')" 
								onmouseout="resetText('green')"></div>
							<figcaption> Green: <span id="greenName">unclaimed</span> </figcaption>
<?
	}
?>
						</figure>
<?
	}
?>

					</div>
					<div class="col-md-3">

<?
	if(isset($castle['Blue'])){
?>
						<figure>
							<div id="Blue" class="taken"></div>
<?
							echo "<figcaption> Blue: ".str_replace("Random", "Annoying Bot", str_replace("85247", "", $castle['Blue']))." </figcaption>";
?>							
						</figure>
<?		
	}else{
?>		

						<figure>
							
<?
if($_SESSION['color'] == "Blue"){
?>
							<div id="Blue" class="taken"></div>
							<figcaption> Blue: <span id="blueName"><? echo $_SESSION['name']?></span> </figcaption>
<?		
	}else{
?>		
							<div id="Blue" onmouseover="changeText('blue')" 
								onclick="claim('Blue')" 
								onmouseout="resetText('blue')"></div>
							<figcaption> Blue: <span id="blueName">unclaimed</span> </figcaption>
<?
	}
?>

						</figure>
<?
	}
?>

					</div>
					<div class="col-md-3">

<?
	if(isset($castle['Red'])){
?>
						<figure>
							<div id="Red" class="taken"></div>
<?
							echo "<figcaption> Red: ".str_replace("Random", "Annoying Bot", str_replace("85247", "", $castle['Red']))." </figcaption>";
?>							
						</figure>
<?		
	}else{
?>		

						<figure>
						

<?
if($_SESSION['color'] == "Red"){
?>
							<div id="Red" class="taken"></div>
							<figcaption> Red: <span id="redName"><? echo $_SESSION['name']?></span> </figcaption>
<?		
	}else{
?>		
							<div id="Red" onmouseover="changeText('red')" 
								onclick="claim('Red')" 
								onmouseout="resetText('red')"></div>
							<figcaption> Red: <span id="redName">unclaimed</span> </figcaption>
<?
	}
?>

						</figure>
<?
	}
?>

					</div>
					<div class="col-md-3">

<?
	if(isset($castle['Yellow'])){
?>
						<figure>
							<div id="Yellow" class="taken"></div>
<?
							echo "<figcaption> Yellow: ".str_replace("Random", "Annoying Bot", str_replace("85247", "", $castle['Yellow']))." </figcaption>";
?>							
						</figure>
<?		
	}else{
?>		

						<figure>
						

<?
if($_SESSION['color'] == "Yellow"){
?>
							<div id="Yellow" class="taken"></div>
							<figcaption> Yellow: <span id="yellowName"><? echo $_SESSION['name']?></span> </figcaption>
<?		
	}else{
?>		
							<div id="Yellow" onmouseover="changeText('yellow')" 
								onclick="claim('Yellow')" 
								onmouseout="resetText('yellow')"></div>
							<figcaption> Yellow: <span id="yellowName">unclaimed</span> </figcaption>
<?
	}
?>
						</figure>
<?
	}
?>

					</div>
				</div>

			</div>

		</center>
	
	</body>
</html>