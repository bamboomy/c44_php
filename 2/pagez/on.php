<?php

session_start();

include_once("settings.php");

$page = "on_attempt";

$sql = "select counter from visits where page='".$page."';";

$result = $conn->query($sql);

if ($result->num_rows != 0) {
	
	$row = $result->fetch_assoc();
	
	$sql = "update visits set counter = '".($row['counter'] + 1)."', updated = now() where page = '".$page."';";
	
} else {
	
	$sql = "insert into visits (page, counter) values ('".$page."', '1');";
}

$conn->query($sql) or die($conn->error);

if(!isset($_SESSION['id'])){
	
	header("Location: welcome.php");
		
	exit;
}

$page = "on_success";

$sql = "select counter from visits where page='".$page."';";

$result = $conn->query($sql);

if ($result->num_rows != 0) {
	
	$row = $result->fetch_assoc();
	
	$sql = "update visits set counter = '".($row['counter'] + 1)."', updated = now() where page = '".$page."';";
	
} else {
	
	$sql = "insert into visits (page, counter) values ('".$page."', '1');";
}

$conn->query($sql) or die($conn->error);

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

if($row["started"] != "Y" || !$_SESSION['onShown']){

	echo "<a href='https://chess4four.org".$profilePath."/tomcat/hello/".$_SESSION['java_hash']."'>It's on!!!</a>";
	
} else {

	echo "This game is already started...<br/><br/>What do you want to do?<br/><br/>";

	echo "<a href='https://chess4four.org".$profilePath."/tomcat/hello/".$_SESSION['java_hash']."'>Enter game.</a><br/><br/>";
	
	echo "<a href='create.php'>Start another game.</a>";
}

$_SESSION['onShown'] = true;

?>
					</div>

				</div>
			</div>
		</center>
	</body>
</html>
