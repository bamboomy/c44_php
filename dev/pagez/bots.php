<?

include_once("settings.php");

?>
<html>
	<head>
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

/* unvisited link */
a:link {
  color: grey;
  text-decoration: none;
}

/* visited link */
a:visited {
  color: black;
  text-decoration: none;
}

/* mouse over link */
a:hover {
  color: darkblue;
  text-decoration: none;
}

/* selected link */
a:active {
  color: #0000FF;
  text-decoration: none;
}

</style>

	</head>
<body>

	<center>

	<div class="outer">
		<div class="middle">
			<div class="inner center">
<?

	echo "<h1><a href='https://chess4four.org".$profilePath."/tomcat/bots/?id=".md5(microtime() . rand(0, 1000))."'>";
	echo "Try it (free)</a></h1>";

?>
				or
				
				<h1><a href="welcome.php">Use it (also free)</a></h1>

			</div>
		</div>
	</div>

	</center>

</body>
</html>