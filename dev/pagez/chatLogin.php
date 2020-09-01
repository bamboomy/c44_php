<?

session_start();

include_once("settings.php");

if($_GET['game'] == 'mode'){
	
	header("Location: welcome.php");
}

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

<!--
<style>
.outer {
	display: table;
	
	position: absolute;
	top: 0;
	left: 0;
	height: 100%;
	width: 100%;
}

.middle {
	display: table-cell;
	vertical-align: middle;
}

.inner {
  margin-left: auto;
  margin-right: auto;
  width: 400px;
}

.center {
  margin: 0 auto;
  text-align: center;
}

.left{

		text-align: left;
}

.right {
	
	text-align: right;
}

</style>

<script>

</script>
-->

	</head>
<body>

	<div class="outer">
		<div class="middle">
			<div class="inner center">

				<h2>Hellow there,</h2>
				
				You need to be <a href="welcome.php">logged in</a> to be able to participate in a game...

			</div>
		</div>
	</div>

</body>
</html>