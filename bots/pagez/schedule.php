<?php

session_start();

include_once("settings.php");

if(!isset($_SESSION['id'])){
	
	header("Location: welcome.php");
		
	exit;
}

?>

<html>
<head>

	<link href='https://fonts.googleapis.com/css?family=Aclonica' rel='stylesheet'>

	<link rel="stylesheet" type="text/css" href="../css/default.css">
	<link rel="stylesheet" type="text/css" href="../css/picker.min.css">
	
	<script src='../js/picker.min.js'></script>
	
<style>

</style>	
	
<script src='../js/jquery-3.4.1.min.js'></script>

<script>

$(document).ready(function() {
	var input = document.getElementById('input');
	var picker = new Picker(input, {
	  format: 'YYYY/MM/DD HH:mm',
	});
});

</script>

</head>
<body>

<center>
<div class="outer">
  <div class="middle">
    <div class="inner center">
		<? echo "<h2>Hey ".$_SESSION['name'].",</h2>" ?>
		<h3>Pick a time:</h3>
		<br/>
		<input type="text" id="input">
	</div>
  </div>
</div>
</center>
</body>
</html>