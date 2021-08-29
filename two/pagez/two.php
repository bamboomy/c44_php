<?php

session_start();

$seconds = 60000 * 60 *24 *7;

header('Cache-Control: max-age=' . $seconds);

// todo : move
//setcookie("hash", md5($_SESSION['java_hash']."centerparks555"), time() + 60*60*24*30, "/");

include_once("settings.php");

$greenMD5 = md5( time() . rand());
$blueMD5 = md5( time() . rand());
$redMD5 = md5( time() . rand());
$yellowMD5 = md5( time() . rand());

$_SESSION[$greenMD5] = 'green';
$_SESSION[$blueMD5] = 'blue';
$_SESSION[$redMD5] = 'red';
$_SESSION[$yellowMD5] = 'yellow';

unset($_SESSION['generated']);

?>

<html>
	<head>
	
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

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


h3{
	
	margin-top: 15px;
}

</style>

<script>

	var listen = true;
	
	var name = 'You'; 

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

</script>
	
	</head>
	<body>

		<center>

			<div class="container-fluid">
			
				<div class="row align-items-center h-25">
			
					<div class="col-md-12">

						<h3>Choose your color:</h3>
						
					</div>
				</div>
				
				<div class="row align-items-center h-50">
				
					<div class="col-md-3">

						<figure>
							<div id="Green" onmouseover="changeText('green')" 
<?  echo "onclick=\"window.location.assign('twoWaiting.php?color=".$greenMD5."')\""; ?>
								onmouseout="resetText('green')"></div>
							
							<figcaption> Green: <span id="greenName">unclaimed</span> </figcaption>
						</figure>

					</div>
					<div class="col-md-3">

						<figure>
							
							<div id="Blue" onmouseover="changeText('blue')" 
<?  echo "onclick=\"window.location.assign('twoWaiting.php?color=".$blueMD5."')\""; ?>
								onmouseout="resetText('blue')"></div>

							<figcaption> Blue: <span id="blueName">unclaimed</span> </figcaption>
						</figure>

					</div>
					<div class="col-md-3">

						<figure>
						
							<div id="Red" onmouseover="changeText('red')" 
<?  echo "onclick=\"window.location.assign('twoWaiting.php?color=".$redMD5."')\""; ?>
								onmouseout="resetText('red')"></div>

							<figcaption> Red: <span id="redName">unclaimed</span> </figcaption>
						</figure>

					</div>
					<div class="col-md-3">

						<figure>
						
							<div id="Yellow" onmouseover="changeText('yellow')" 
<?  echo "onclick=\"window.location.assign('twoWaiting.php?color=".$yellowMD5."')\""; ?>
								onmouseout="resetText('yellow')"></div>

							<figcaption> Yellow: <span id="yellowName">unclaimed</span> </figcaption>
						</figure>

					</div>
				</div>
				
			</div>

		</center>
	
	</body>
</html>
