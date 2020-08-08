<? 

session_start();

if(!isset($_SESSION['fbId'])){
	
	header("Location: welcome.php");
		
	exit;
}

include_once("settings.php");

if($_POST['name'] == 'own'){
	
	$c44Name = test_input($_POST['ownName']);
	
} else {
	
	$c44Name = test_input($_POST['name']);
}

echo mysqli_connect_error();

$sql = "insert into gebruiker (voornaam, name, fbId, fail, timeZone) values ('".$_SESSION['firstName']."', '".$c44Name."', '".$_SESSION['fbId']."' , '".test_input($_POST['fail'])."', '".test_input($_POST['timeZone'])."');";

$result = $conn->query($sql);

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

.left{

		text-align: left;
}

.right {
	
	text-align: right;
}

</style>

<script>

</script>


	</head>
<body>

<? echo $sql; ?>

	<div class="outer">
		<div class="middle">
			<div class="inner center">

				<h2>Hey <? echo $_SESSION['firstName']; ?>,</h2>
				
				<? echo "You will be known as '".$c44Name."' from now on..."; ?><br/>
				<br/>
				May your actions be just, fierce and fair!!!<br/>
				<br/>
				<a href='welcome.php'>I shall continue</a>
				
			</div>
		</div>
	</div>

</body>
</html>