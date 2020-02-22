<?php

session_start();

if(!isset($_SESSION['id'])){
	
	header("Location: welcome.php");
		
	exit;
}

include_once("settings.php");

$sql = "select private from game where hash = '".test_input($_SESSION['hash'])."';";

$result = $conn->query($sql);

$row = $result->fetch_assoc();

if(isset($_SESSION['invited'])){

	$sql = "select id from colors_taken where game = '".test_input($_SESSION['hash'])."' and name='".$_SESSION['name']."';";
	
	$result = $conn->query($sql);

	if ($result->num_rows != 0) {
		
		unset($_SESSION['hash']);
		unset($_SESSION['invited']);
		
		header("Location: double.php");
		
		exit;
	}

	$sql = "select sentence, private from game where hash = '".test_input($_SESSION['hash'])."';";

	$result = $conn->query($sql);
	
	if ($result->num_rows != 1) {
		
		echo "the site is broken";
		
		die;
	}
	
	$row = $result->fetch_assoc();
	
	$_SESSION['sentence'] = $row['sentence'];
}


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
  /*whatever width you want*/
}

.container {
	position: relative;
  width: 15%;
}

.image {
  display: block;
  width: 100%;
  height: auto;
}

.overlay {
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  height: 100%;
  width: 100%;
  opacity: 0;
  transition: .5s ease;
  background-color: #008CBA;
}

.overlay_orig {
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  height: 100%;
  width: 100%;
  color: white;
}

.container:hover .overlay {
  opacity: 1;
}

.container:hover .overlay_orig {
  opacity: 0;
  transition: .5s ease;
}

.text {
  color: white;
  font-size: 15px;
  position: absolute;
  top: 50%;
  left: 50%;
  -webkit-transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
  text-align: center;
}

.center {
  margin: 0 auto;
  text-align: center;
}
</style>

<script src="../js/jquery-3.4.1.min.js"></script>

<script>

$(document).ready(function() {

<?

if($row['private'] == 'Y'){
	
	echo "document.getElementById('private').checked = true;";
}

?>

});

function again() {

	setTimeout(function(){

		var response = '';
		$.ajax({ type: "GET",   
				 url: "https://chess4four.io/pagez/colors.php",   
				 async: false,
				 success : function(text)
				 {
					 response = text;
				 }
		});

		$('#colors').html(response);
		
		again();

	}, 1000);
}

again();

function togglePrivate() {

	$.ajax({ type: "GET",   
			 url: "https://chess4four.io/pagez/togglePrivate.php",   
			 async: false,
			 success : function(text)
			 {
				 location.reload();
			 }
	});
}

</script>

</head>
<body>
<center>
<div class="outer">
  <div class="middle">
    <div class="inner">
		<h1>Hey <? echo $_SESSION['name']; ?>,</h1>
		<h3>We're creating game:</h3>
		<h3><? echo $_SESSION['sentence']; ?></h3>
		<input id="private" type="checkbox" onclick="togglePrivate();"> private game.
		<h3>Choose your color:</h3>
		<br/>
		
		<div id="colors"></div>
		
	</div>
  </div>
</div>
</center>
</body>
</html>