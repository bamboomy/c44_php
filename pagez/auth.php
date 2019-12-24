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
<form action="login.php" method="post">
		Username:&nbsp
		<input type="text" name="password" />
		<input type="submit" value="Log in">
		<input type="hidden" name="token" value="token">
</form> 	
	</div>
  </div>
</div>
</center>
</body>
</html>