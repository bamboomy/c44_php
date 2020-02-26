<?php

session_start();

if(!isset($_SESSION['id'])){
	
	header("Location: welcome.php");
		
	exit;
}

include_once("settings.php");

$color = $_SESSION['colorValues'][$_GET['color']];

$java_hash = md5($_SERVER['REMOTE_ADDR'] . microtime() . $_SESSION['hash'] . test_input($color));

$sql = "insert into colors_taken (game, color, name, java_hash) ";
$sql .= " values ('".$_SESSION['hash']."', '".test_input($color)."', '".$_SESSION['name']."', '".$java_hash."');";

$result = $conn->query($sql);

$sql = "insert into chatDirty (javaHash) ";
$sql .= " values ('".$java_hash."');";

$result = $conn->query($sql);

$_SESSION['ownColor'] = test_input($color);

$RHash = md5($java_hash . "R" . microtime());

$DHash = md5($java_hash . "D" . microtime());

$sql = "insert into votes (value, hash, gameHash, javaHash) ";
$sql .= " values ('R', '".$RHash."', '".$_SESSION['hash']."', '".$java_hash."'), ('D', '".$DHash."', '".$_SESSION['hash']."', '".$java_hash."');";

$result = $conn->query($sql);

$sql = "select private from game where hash = '".test_input($_SESSION['hash'])."';";

$result = $conn->query($sql);

$row = $result->fetch_assoc();


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
  width: 17%;
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

#third {

	position: absolute;
	
	bottom: 20px;
	right: 20px;
	
	width: 300px;
	height: 300px;
	
	border: 1px solid;
	
	padding: 10px;
}

.left {
	
	position: absolute;
	
	left: 10px;
}

.right {
	
	position: absolute;
	
	right: 10px;
}

.spaced {
	
	padding: 10px;
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
				 url: "colors.php",   
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

function voteRandom(){
	
	$.ajax({ type: "GET",   
<?
			 echo "url: 'vote.php?hash=".$RHash."',";
?>
			 async: false,
			 success : function(text)
			 {
				 alert("You voted...");
			 }
	});
}

function voteDubious(){
	
	$.ajax({ type: "GET",   
<?
			 echo "url: 'vote.php?hash=".$DHash."',";
?>
			 async: false,
			 success : function(text)
			 {
				alert("You voted...");
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
		<h3>We're waiting on the other players for game:</h3>
		<h3><? echo $_SESSION['sentence']; ?></h3>
<?

if($row['private'] == 'Y'){
	
	echo "This is a private game.";

} else {
	
	echo "This is a public game.";
}

echo getcwd();

?>
		<h3>You can share this link:</h3>
		<? echo "<input id='myInput' type='text' value='https://chess4four.io".$profilePath."/pagez/invite.php?game=".$_SESSION['hash']."' />";
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