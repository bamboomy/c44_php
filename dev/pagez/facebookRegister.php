<?php

session_start();

if(!isset($_SESSION['fbId'])){
	
	header("Location: welcome.php");
		
	exit;
}

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

.left{

		text-align: left;
}

.right {
	
	text-align: right;
}

</style>

<script src="../js/jquery-3.4.1.min.js"></script>

<script>

function enableInput(){
	
	$("#input").prop( "disabled", false );
	$("#submit").prop( "disabled", false );
}

function enableSubmit(){
	
	$("#submit").prop( "disabled", false );
}

</script>


	</head>
<body>

	<div class="outer">
		<div class="middle">
			<div class="inner center">

				<h2>Hey <? echo $_SESSION['firstName']; ?>,</h2>
				
				Seems you are new around here...<br/>
				<br/>
				Care to choose your destiny? (oops, I mean name?):<br/>
				(Only this name will be shared with the other users...)<br/>
				<br/>
<form action="safeFacebook.php" method="post">

<? 

$four = array("Ma", "Ze", "Di", "Ka", "Fo", "Zi", "Lo", "Je", "Ri", "A", "E", "O");

$one = array("nen", "maf", "kit", "jep", "pof", "hez", "nid", "ber", "set", "kif", "lod", "kag", "nif");

$two = array("ozo", "afi", "elo", "ira", "ogo", "eti", "afo", "eka", "azo", "ito", "afe", "oli");

for($i=0; $i<20; $i++){
	
	$name[$i] = $four[rand(0, count($four) - 1)] . $one[rand(0, count($one) - 1)] . $two[rand(0, count($two) - 1)];
}

$taken = array();

$fail = 0;

for($i=0; $i<20; $i++){
	
	$sql = "select name from gebruiker where name='".$name[$i]."'";

	$result = $conn->query($sql);
	
	if ($result->num_rows != 0) {
		
		array_push($taken, $name[$i]);
		
		$fail++;
	}	
}

$result = array_diff($name, $taken);

$reindexed = array_values($result);

for($i=0; $i<5; $i++){
	
	echo "<div class='left'><input onclick='enableSubmit();' type='radio' name='name' value='".$reindexed[$i]."'>".$reindexed[$i]."</div>";
}
?>
				<div class='left'><input type='radio' onclick="enableInput();" name='name' value='own'>I want to choose my own name:<div class='right'><input id="input" disabled type="text" name="ownName" /></div></div>
				<br/>
<?
				echo "<input type='hidden' name='fail' value='".$fail."' />";
?>				
		<div class='right'><input disabled id="submit" type="submit" value="I will be named like this forever!"></div>
</form> 	
			</div>
			</div>
	</div>

<?

	echo $fail;

?>

</body>
</html>