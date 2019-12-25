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
		<h1>Welcome <? echo $_SESSION['user']; ?>,</h1>
		<h3>What do you want to do?</h3>
		<br/>
		<a href="color.php">Create a game</a><br/>
		<br/>
		<a href="test.php">Join (hash1)</a><br/><br/>
		<a href="test.php">Join (hash2)</a><br/><br/>
		<a href="test.php">Join (hash3)</a><br/><br/>
		<a href="test.php">Join (hash4)</a><br/><br/>
	</div>
  </div>
</div>
</center>
</body>
</html>