<?php

session_start();

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

</style>

<script>

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
				<br/>
<form action="safeFacebook.php" method="post">

<? 

$four = array("Ma", "Ze", "Di", "Ka", "Fo", "Zi", "Lo", "Je", "Ri", "A", "E", "O");

$one = array("nen", "maf", "kit", "jep", "pof", "hez", "nid", "ber", "set", "kif", "lod", "kag", "nif");

$two = array("ozo", "afi", "elo", "ira", "ogo", "eti", "afo", "eka", "azo", "ito", "afe", "oli");

for($i=0; $i<20; $i++){
	
	$name[$i] = $four[rand(0, count($four) - 1)] . $one[rand(0, count($one) - 1)] . $two[rand(0, count($two) - 1)];
}

//TODO: filter on existing names

for($i=0; $i<5; $i++){
	
	echo "<div class='left'><input type='radio' name='name' value='".$name[$i]."'>".$name[$i]."</div>";
}
?>
				<div class='left'><input type='radio' name='name' value='own'>I want to choose my own name:&nbsp;<input type="text" name="ownName" /></div>
		<div class='left'><input type="submit" value="I will be named like this forever!"></div>
		<input type="hidden" name="token" value="token">
</form> 	
			</div>
			</div>
	</div>

</body>
</html>