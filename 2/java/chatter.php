<?

session_start();

include_once("../pagez/settings.php");

$_SESSION['hash'] = test_input($_GET['game']);

$_SESSION['chat'] = true;

unset($_SESSION['ownColor']);

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

						<form action="../pagez/chatLogin.php">

							<h3>Do you want to chat anonymously<br/>or do you want to log in?</h3>
							
							<br/><br/>

							<input type="radio" id="anonymously" name="mode" value="anonymously">
							<label for="anonymously">Anonymously</label><br>
							<input type="radio" id="log_in" name="mode" value="log_in">
							<label for="log_in">Log in</label><br>

							<input type="submit" value="Let's chat!">
						</form>

					</div>

				</div>
			</div>
		</center>
	</body>
</html>
