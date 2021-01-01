<?php

session_start();

if(!isset($_SESSION['id'])){
	
	header("Location: welcome.php");
		
	exit;
}

include_once("settings.php");

$sql = "select started from game where hash = '".$_SESSION['hash']."';";

$result = $conn->query($sql) or die($conn->error);

if($result->num_rows != 1){
	
	die("nope :(");
}

$row = $result->fetch_assoc();

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
<?

if($row["started"] != "Y"){

	echo "<a href='https://chess4four.org".$profilePath."/tomcat/hello/".$_SESSION['java_hash']."'>It's on!!!</a>";

} else {

	echo "This game is already started...<br/><br/>What do you want to do?<br/><br/>";

	echo "<a href='https://chess4four.org".$profilePath."/tomcat/hello/".$_SESSION['java_hash']."'>Log on.</a><br/><br/>";
	
	echo "<a href='create.php'>Start another game.</a>";
}
?>
					</div>

				</div>
			</div>
		</center>
	</body>
</html>
