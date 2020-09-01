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
	</head>
	<body>
		<center>

			<div class="container-fluid">
			
				<div class="row align-items-center h-100">

					<div class="col-md-12">

						<form action="/../pagez/.php">

							<h2>Do you want to chat anonymously or do you want to log in?</h2>

							<input type="radio" id="anonymously" name="gender" value="anonymously">
							<label for="anonymously">Anonymously</label><br>
							<input type="radio" id="log_in" name="gender" value="log_in">
							<label for="log_in">Log in</label><br>

							<input type="submit" value="Let's chat!">
						</form>

					</div>

				</div>
			</div>
		</center>
	</body>
</html>
