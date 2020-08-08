<?php

session_start();

include_once("settings.php");

if(!isset($_SESSION['id'])){
	
	header("Location: welcome.php");
		
	exit;
}

unset($_SESSION['ownColor']);

$chatHash = md5(microtime() . $_SESSION['hash'] . rand(0, 1000));

?>

<html>
<head>

	<link href='https://fonts.googleapis.com/css?family=Aclonica' rel='stylesheet'>
	<style>
		body {
			font-family: 'Aclonica';font-size: 22px;
		}
	</style>

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

.center {
  margin: 0 auto;
  text-align: center;
}

#chat {
	position: absolute;
	bottom: 20px;
	right: 20px;
	width: 300px;
	height: 300px;
	border: 1px solid;
	padding: 10px;
	z-index: 1;
}

.bottom {
	position: absolute;
	bottom: 10px;
	right: 10px;
	width: 90%;
}

.fill {
	width: 75%;
}

#chatText {
	overflow-y: auto;
	height: 80%;
}

/* unvisited link */
a:link {
  color: grey;
  text-decoration: none;
}

/* visited link */
a:visited {
  color: black;
  text-decoration: none;
}

/* mouse over link */
a:hover {
  color: orange;
  text-decoration: none;
}

/* selected link */
a:active {
  color: #0000FF;
  text-decoration: none;
}


</style>

<?
	echo "<script src='https://chess4four.org/".$javaPath."/../js/jquery-3.4.1.min.js'></script>";
?>

<script>

	function fillChat() {

		$
				.ajax({
					type : "get",
					xhrFields : {
						withCredentials : true
					},
<?					
					echo "url : 'https://chess4four.org/".$javaPath."/lobbyChatText.php?board=lobby',";
?>					
					success : function(text) {

						if (text != "clean") {

							$('#chatText').html(text);

							var objDiv = document.getElementById("chatText");
							objDiv.scrollTop = objDiv.scrollHeight;
						}
					}
				});
	}

	function sendMessage() {
		
<?
		echo "var chat = '".$_SESSION['name']." :' + $('#chatField".$chatHash."').val();\n\n";
		
		echo "$('#chatField".$chatHash."').val('');\n\n";
?>				 

		$
				.ajax({
					type : "POST",
					xhrFields : {
						withCredentials : true
					},
<?					
					echo "url : 'https://chess4four.org/".$javaPath."/lobbyChat.php?board=lobby',";
?>					
					data : {
						text : chat
					},
					success : function(text) {

						fillChat();
					}
				});
	}

	function showChat() {

		setTimeout(function() {

			fillChat();

			showChat();

		}, 1000);
	}

	showChat();

	$(document).ready(function() {
		
<?
		echo "$('#chatField".$chatHash."').on('keydown', function(e) {";
?>				 
			if (e.which == 13) {

				sendMessage();
			}
		});

	});


</script>

</head>
<body>

	<div id="chat">

		<div style="text-align: center; font-size: larger;">Chat</div>
		<div id="chatText"></div>

		<div class="bottom">
<?
				echo "<input id='chatField".$chatHash."'";
?>				 
					type="text" class="fill" autocomplete="false" /><input type="button" value="Send"
					onclick="sendMessage();" />
		</div>

	</div>


<center>
<div class="outer">
  <div class="middle">
    <div class="inner center">
		<? echo "<h2>Hey " . $_SESSION['firstName'] . " (".$_SESSION['name']."),</h2>" ?>
		<h3>What do you want to do?</h3>
		<br/>
		<a href="create.php">Create a game</a><br/>
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