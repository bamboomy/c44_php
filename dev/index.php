<?

session_start();

include_once("pagez/settings.php");

$page = "logo";

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
		<style>
		#logo {
			position:absolute; 
			left:0; right:0;
			top:0; bottom:0;
			margin:auto;
		}
		</style>
	</head>
<body>

	<center>
		<a href="pagez/bots.php"><img id="logo" src="imgz/logo.png" /></a><br/>
		<h3 style="position:absolute; bottom: 10px; margin:auto;">Version 0.2.0</h3>
	</center>

</body>
</html>