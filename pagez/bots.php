<?

include_once("settings.php");

$sql = "select counter from visits where page='bots';"

$result = $conn->query($sql);

if ($result->num_rows != 0) {
	
	$row = $result->fetch_assoc();
	
	$sql = "update visits set counter = '".($row['counter'] + 1)."' where page = 'bots';"
	
} else {
	
	$sql = "insert into visits (page, counter) values ('bots', '1');"
}

$result = $conn->query($sql);

?>
<html>
	<head>
	
<!-- Global site tag (gtag.js) - Google Ads: 968172277 -->
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-968172277"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'AW-968172277');
</script>
	
	
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
  color: orange;
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
	echo "Try it (free)<br/>(No registration required)</a></h1>";

?>
				or
				
				<h1><a href="welcome.php">Use it (also free)<br/>(Registration required)</a></h1>

			</div>
		</div>
	</div>

	</center>

</body>
</html>