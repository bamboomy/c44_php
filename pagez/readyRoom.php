<?php

session_start();

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
</head>
<body>
<center>
<div class="outer">
  <div class="middle">
    <div class="inner">
		<h1>Hey <? echo $_SESSION['user']; ?>,</h1>
		<h3>We're waiting on the other players for game:</h3>
		<h3><? echo $_SESSION['sentence']; ?></h3>
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
			  <img src="../imgz/grey.png" alt="Avatar" class="image">&nbsp;You
			  <div class="overlay">
				<div class="text">Already taken</div>
			  </div>
			<div class="overlay_orig">
				<div class="text">Yellow</div>
			  </div>			
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