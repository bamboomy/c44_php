<?php

session_start();

if(!isset($_SESSION['id'])){
	
	header("Location: register.php");
		
	exit;
}

include_once("settings.php");

$sql = "insert into colorsTaken (game, color, name) ";
$sql .= " values ('".$_SESSION['hash']."', '".test_input($_GET['color'])."', '".$_SESSION['name']."');";

$result = $conn->query($sql);

$_SESSION['ownColor'] = test_input($_GET['color']);

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
  width: 25%;
  height: 10%;
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

<script src="../js/jquery-3.4.1.min.js"></script>

<script>
function copy() {
  var copyText = document.getElementById("myInput");
  copyText.select();
  copyText.setSelectionRange(0, 99999)
  document.execCommand("copy");
  alert("Link copied...");
}

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

</script>

</head>
<body>
<center>
<div class="outer">
  <div class="middle">
    <div class="inner">
		<h1>Hey <? echo $_SESSION['name']; ?>,</h1>
		<h3>We're waiting on the other players for game:</h3>
		<h3><? echo $_SESSION['sentence']; ?></h3>
		<h3>You can share this link:</h3>
		<? echo "<input id='myInput' type='text' value='https://chess4four.io/pagez/invite.php?game=".$_SESSION['hash']."' />";
		echo "<input type='button' onclick='copy();' value='copy' />"; ?>
		<br/>
		<br/>
		
			<div id="colors"></div>			
	</div>
  </div>
</div>
</center>
</body>
</html>