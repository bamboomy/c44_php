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

$conn->query($sql) or die($conn->error);

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
		
		<link href='https://fonts.googleapis.com/css?family=Aclonica' rel='stylesheet'>
		
		<link rel="stylesheet" type="text/css" href="../css/default.css">
		
	</head>
<body>

	<center>
	
		<h1>(Also) we use <a target="_blank" href="https://en.wikipedia.org/wiki/HTTP_cookie">cookies</a>...</h1>

		<img id="logo" src="../imgz/cookie.jpg" height="200" />
		
		<p>The site doesn't work without, so please be so kind to
		<a href="facebookRegister.php"><h3>approve</h3></a>
		to continue using this site.<br/>
		<br/>
		Thanks a bunch!<br/>
		<br/>
		The Chess4Four Team<br/>
		</p>
		
	</center>

</body>
</html>