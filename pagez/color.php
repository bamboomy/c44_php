<?php

session_start();

$one = array("A breeze", "Some tea", "An outlet");

$two = array("without", "in");

$three = array("the dark", "elves");

$sentence = $one[rand(0, count($one))] . ' ' . $two[rand(0, count($two))] . ' ' . $three[rand(0, count($three))] 

echo rand(0, count($one));

echo rand(0, count($two));

echo rand(0, count($three));

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

.container:hover .overlay {
  opacity: 1;
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
		<h3>We're creating game:</h3>
		<h3><? echo $sentence; ?>.</h3>
		<h3>Choose your color:</h3>
		<br/>
		
			<div class="container">
			  <img src="../imgz/grey.png" alt="Avatar" class="image">
			  <div class="overlay">
				<div class="text">Already taken</div>
			  </div>
			</div>		
			<div class="container">
			  <img src="../imgz/yellow.png" alt="Avatar" class="image">
			</div>					
			<div class="container">
			  <img src="../imgz/green.png" alt="Avatar" class="image">
			</div>		
			<div class="container">
			  <img src="../imgz/grey.png" alt="Avatar" class="image">
			  <div class="overlay">
				<div class="text">Already taken</div>
			  </div>
			</div>					
	</div>
  </div>
</div>
</center>
</body>
</html>