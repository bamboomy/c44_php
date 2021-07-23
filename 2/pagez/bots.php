<?

include_once("settings.php");

$page = "bots";

$sql = "select counter from visits where page='".$page."';";

$result = $conn->query($sql);

if ($result->num_rows != 0) {
	
	$row = $result->fetch_assoc();
	
	$sql = "update visits set counter = '".($row['counter'] + 1)."', updated = now() where page = '".$page."';";
	
} else {
	
	$sql = "insert into visits (page, counter) values ('".$page."', '1');";
}

$conn->query($sql) or die($conn->error);

?>
<html>
	<head>
	
		<link href='https://fonts.googleapis.com/css?family=Aclonica' rel='stylesheet'>
		<style>
			body {
				font-family: 'Aclonica';font-size: 22px;
			}
		</style>
		
		<link rel="stylesheet" type="text/css" href="../css/default.css">

	</head>
<body>

	<center>

	<div class="outer">
		<div class="middle">
			<div class="inner center">
<?

	echo "<h1><a href='https://chess4four.org/prod/bots/tomcat/bots/?id=".md5(microtime() . rand(0, 1000))."'>";
	echo "Try it!</a></h1>";

?>
				<h1><a href="welcome.php">Play it!</a></h1>

			</div>
		</div>
	</div>

	</center>

</body>
</html>