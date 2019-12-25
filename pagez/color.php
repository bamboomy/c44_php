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
</style>
</head>
<body>
<center>
<div class="outer">
  <div class="middle">
    <div class="inner">
		<h1>Hey <? echo $_SESSION['user']; ?>,</h1>
		<h3>Choose your color:</h3>
		<br/>
		<img src="../imgz/yellow.png" alt="Smiley face" height="42" width="42">
		<img src="../imgz/red.png" alt="Smiley face" height="42" width="42"><br/>
		<img src="../imgz/green.png" alt="Smiley face" height="42" width="42">
		<img src="../imgz/blue.png" alt="Smiley face" height="42" width="42"><br/>
	</div>
  </div>
</div>
</center>
</body>
</html>