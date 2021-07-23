<?

include_once("settings.php");

$page = "cookie";

$sql = "select counter from visits where page='".$page."';";

$result = $conn->query($sql);

if ($result->num_rows != 0) {
	
	$row = $result->fetch_assoc();
	
	$sql = "update visits set counter = '".($row['counter'] + 1)."', updated = now() where page = '".$page."';";
	
} else {
	
	$sql = "insert into visits (page, counter) values ('".$page."', '1');";
}

$result = $conn->query($sql);

?>

<html>
	<head>
		<style>
		#logo2 {
			position:absolute; 
			left:0; right:0;
			top:0; bottom:0;
			margin:auto;
		}
		</style>
	</head>
<body>

	<center>
	
		<h1>(Surprise!!!) (Also we) use <a href="https://en.wikipedia.org/wiki/HTTP_cookie">cookies</a>...</h1>

		<img id="logo" src="../imgz/cookie.jpg" />
		
		<p>The site doesn't work without, so please be so kind to:
		<a href="disclaimer.php"><h3>accept</h3></a>
		...to continue using this site...<br/>
		<br/>
		Thanks a bunch!<br/>
		<br/>
		The Chess4Four Team<br/>
		</p>
		
	</center>

</body>
</html>