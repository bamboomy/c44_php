<?php

session_start();

if(isset($_SESSION['invited'])){

	include_once("settings.php");

	$sql = "select sentence from game where hash = '".test_input($_SESSION['hash'])."';";

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


</style>

<script>

setTimeout(function(){
   window.location.reload(1);
}, 1000);

</script>

</head>
<body>
<center>
<div class="outer">
  <div class="middle">
    <div class="inner">
		<h1>Hey <? echo $_SESSION['user']; ?>,</h1>
		<h3>We're creating game:</h3>
		<h3><? echo $_SESSION['sentence']; ?></h3>
		<h3>Choose your color:</h3>
		<br/>
		
			<div class="container">
			  <img src="../imgz/grey.png" alt="Avatar" class="image">
			  <div class="overlay">
				<div class="text">Already taken</div>
			  </div>
			<div class="overlay_orig">
				<div class="text">Red</div>
			  </div>			
			  </div>		
			<div class="container">
			  <? echo "<a href='readyRoom.php?game=".$_SESSION['hash']."&color=yellow'><img src='../imgz/yellow.png' class='image'></a>"; ?>
			</div>					
			<div class="container">
			  <img src="../imgz/green.png" alt="Avatar" class="image">
			</div>		
			<div class="container">
			  <img src="../imgz/grey.png" alt="Avatar" class="image">
			  <div class="overlay">
				<div class="text">Already taken</div>
			  </div>
			<div class="overlay_orig">
				<div class="text">Blue</div>
			  </div>			
			</div>					
	</div>
  </div>
</div>
</center>
</body>
</html>