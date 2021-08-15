<?

include_once("settings.php");

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

	echo "<h1><a href='https://chess4four.org".$profilePath."/tomcat/bots/?id=".md5(microtime() . rand(0, 1000))."'>";
	echo "Try it!</a></h1>";

?>
				<h1><a href="welcome.php">Play it!</a></h1>
				<h1><a href="welcome.php">Rules</a></h1>
				<h1><a href="two.php">Play with two.</a></h1>

			</div>
		</div>
	</div>

	</center>

</body>
</html>