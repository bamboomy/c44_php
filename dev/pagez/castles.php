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

h2{

	margin-top: 20px;
}

</style>

<script>

<? echo "var name = '".$_SESSION['name']."';"; ?>

function changeText(color){

	if(color == "green"){
	
		$('#greenName').html(name);
	
	}
}

function resetText(color){

	if(color == "green"){
		
		$('#greenName').html('unclaimed');
	}
}

</script>
	
	</head>
	<body>
	
		<center>

			<!--div class="outer">
				<div class="middle">
					<div class="inner center"-->
					
						<div class="container-fluid">
						
							<div class="row">
						
								<div class="col-md-12">
						
									<h2>Choose your color:</h2>
									
								</div>
							</div>
							
							<div class="row align-items-center h-100">
							
								<div class="col-md-3">
						
						<!--table>
							<tr>
								<td-->
									<figure>

										<div id="Green" onmouseover="changeText('green')" 
											onmouseout="resetText('green')"></div>
										
										<figcaption> Green: <span id="greenName">unclaimed</span> </figcaption>
									</figure>

								</div>
								<div class="col-md-3">
								
								<!--/td>
								<td-->
									<figure>
										
										<div id="Blue"></div>

										<figcaption> Blue: unclaimed </figcaption>
									</figure>

								</div>
								<div class="col-md-3">

								<!--/td>
								<td-->
									<figure>
									
										<div id="Red"></div>

										<figcaption> Red: unclaimed </figcaption>
									</figure>

								</div>
								<div class="col-md-3">

								<!--/td>
								<td-->
									<figure>
									
										<div id="Yellow"></div>

										<figcaption> Yellow: unclaimed </figcaption>
									</figure>

								</div>
							</div>
						</div>

								<!--/td>
							</tr>
						</table>
					</div>
				</div>
			</div-->

		</center>
	
	</body>
</html>