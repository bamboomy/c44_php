<?php

session_start();

if(!isset($_SESSION['fbId'])){
	
	header("Location: welcome.php");
		
	exit;
}

include_once("settings.php");

?>
<html>
<head>

	<link href='https://fonts.googleapis.com/css?family=Aclonica' rel='stylesheet'>
	
	<link rel="stylesheet" type="text/css" href="../css/default.css">

<script src="../js/jquery-3.4.1.min.js"></script>

<script>

function enableInput(){
	
	$("#input").prop( "disabled", false );
	
	checkEnableSubmit();
}

function enableChoice(){
	
	checkEnableSubmit();
	
	$("#input").prop( "disabled", true );
}

function checkEnableSubmit(){
	
	if($("#vehicle1").prop('checked')){
		
		$("#send").prop( "disabled", false );
		
	} else {
		
		$("#send").prop( "disabled", true );
	}
}

function checkName(){
	
	if(!$("#input").prop( "disabled")){
		
		if (!$("#input").val().match(/^[0-9a-zA-Z]+$/)){
			
			alert("Name must only contain numbers or letters...");
			
			return false;
		}
		
		if ($("#input").val().length < 3 || $("#input").val().length > 30){
			
			alert("Name must at least contain 3 characters (and maximally 30).");
			
			return false;
		}

		$.ajax({
			type : "GET",
			url : "checkName.php?name=" + $("#input").val(),
			async : false,
			success : function(text) {
				
				if(text == "ok"){
					
					document.getElementById("myForm").submit();
					
				} else {
					
					alert("This name already seems to be taken...");
					
					return false;
				}
			}
		});
		
	} else {
		
		document.getElementById("myForm").submit();
	}
	
	return false;
}

</script>


	</head>
<body>

	<div class="outer">
		<div class="middle">
			<div class="inner">

				<h2>Hey <? echo $_SESSION['firstName']; ?>,</h2>
				
				Seems you are new around here...<br/>
				<br/>
				Care to choose your destiny?<br/>
				(oops, I mean name?):<br/>
				(Only this name will be shared with the other users...)<br/>
				<br/>
<form id='myForm' action="safeFacebook.php" method="post">

<? 

$four = array("Ma", "Ze", "Di", "Ka", "Fo", "Zi", "Lo", "Je", "Ri", "A", "E", "O");

$one = array("nen", "maf", "kit", "jep", "pof", "hez", "nid", "ber", "set", "kif", "lod", "kag", "nif");

$two = array("ozo", "afi", "elo", "ira", "ogo", "eti", "afo", "eka", "azo", "ito", "afe", "oli");

for($i=0; $i<20; $i++){
	
	$name[$i] = $four[rand(0, count($four) - 1)] . $one[rand(0, count($one) - 1)] . $two[rand(0, count($two) - 1)];
}

$taken = array();

$fail = 0;

for($i=0; $i<20; $i++){
	
	$sql = "select name from gebruiker where name='".$name[$i]."'";

	$result = $conn->query($sql);
	
	if ($result->num_rows != 0) {
		
		array_push($taken, $name[$i]);
		
		$fail++;
	}	
}

$result = array_diff($name, $taken);

$reindexed = array_values($result);

for($i=0; $i<5; $i++){
	
	echo "<div class='left'><input onclick='enableChoice();' type='radio' name='name' value='".$reindexed[$i]."'>".$reindexed[$i]."</div>";
}
?>
				<div class='left'><input type='radio' onclick="enableInput();" name='name' value='own'>I want to choose my own name:<div class='right'><input id="input" disabled type="text" name="ownName" /></div></div>
				<br/>
<?
				echo "<input type='hidden' name='fail' value='".$fail."' />";
?>				

<br/><br/>

<input type="checkbox" id="vehicle1" name="vehicle1" value="Bike" onclick="checkEnableSubmit();">
<label for="vehicle1"> I have read and agree to the <a target="_blank" href="disclaimer.php">disclaimer</a>.</label><br/>

<br/><br/>

		<div class='right'><input disabled id="send" type="submit" onclick='return checkName();' value="All of this is super true!"></div>
</form> 	
			</div>
			</div>
	</div>

</body>
</html>