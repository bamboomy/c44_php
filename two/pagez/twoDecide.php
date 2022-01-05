<?php

session_start();

// todo : move
//setcookie("hash", md5($_SESSION['java_hash']."centerparks555"), time() + 60*60*24*30, "/");

include_once("settings.php");

$_SESSION['game'] = test_input($_GET['game']);

$decided = false;

$sql = "select state from game42 where hash = '".test_input($_SESSION['game'])."';";

$result = $conn->query($sql);

$row = $result->fetch_assoc();

if($row['state'] !== "engageable"){

    $gameSQL = "UPDATE game42 SET state = 'choosing' where hash = '".$_SESSION['game']."';";

    $conn->query($gameSQL);
    
} else {

    $decided = true;
}    

$sql = "select color, first, sideKick from 42player where gameHash = '".test_input($_GET['game'])."';";

$result = $conn->query($sql);

$chooseSideKick = "N";

$remainingColor = array('green', 'blue', 'red', 'yellow');

while($row = $result->fetch_assoc()){

    if (($key = array_search($row['color'], $remainingColor)) !== false) {
        unset($remainingColor[$key]);
    }

    if($row['first'] == 'Y'){
    
        if($row['sideKick'] == 'Y'){
        
            $name[$row['color']] = "Opponent's Sidekick";
        
        } else {
        
            $name[$row['color']] = "Opponent";
        }
        
    } else {
    
        if($row['sideKick'] == 'Y'){
        
            $name[$row['color']] = "Your Sidekick";

        } else {
        
            $name[$row['color']] = "You";
            
            $chooseSideKick = "Y";
        }
    }
}

if ($result->num_rows == 3) {

    $last = array_pop($remainingColor);

    $name[$last] = "Opponent's Sidekick";
    
    $sql = "insert into 42player (gameHash, color, first, sideKick) ";
    $sql .= " values ('".test_input($_SESSION['game'])."', '".test_input($last)."', 'Y', 'Y');";

    $conn->query($sql) or die($conn->error);
    
    $gameSQL = "UPDATE game42 SET state = 'engageable' where hash = '".$_SESSION['game']."';";
    
    $conn->query($gameSQL);
	
	$four = array("A wonderfull", "Some good", "A tea spoon of", "A green", "A wooden", "A bright", "A decent", "An excellent", "A handfull of");

	$one = array("breeze", "tea", "outlet", "garden", "color", "t-shirt", "glass", "chocolate", "ashtray", "card", "letter", "globe", "bottle");

	$two = array("without", "in", "between", "amongst", "outside of", "with");

	$three = array("the dark", "elves", "Godot", "a lamp", "the unknown", "the French", "a sister", "some coffee", "a group of Elvises", "Indiana Jones");

	$sentence = '"' . $four[rand(0, count($four) - 1)] . ' ';

	$sentence .= $one[rand(0, count($one) - 1)] . '<br/>' . $two[rand(0, count($two) - 1)] . ' ' . $three[rand(0, count($three) - 1)] . '."' ;
	
	$sql = "insert into game (sentence, hash, fail) ";
	$sql .= " values ('".$sentence."', '".$_SESSION['game']."', '0');";

	$conn->query($sql);

	$sql = "select color, first, sideKick from 42player where gameHash = '".$_SESSION['game']."';";

	$result = $conn->query($sql);
	
	while($row = $result->fetch_assoc()){
			
		$dataElement['color'] = $row['color'];
		$dataElement['first'] = $row['first'];
		$dataElement['sideKick'] = $row['sideKick'];
		
		$dataArray[$row['color']] = $dataElement;
		
		unset($dataElement);
	}

	foreach ($dataArray as $dataElement) {
		
		if($dataElement['first'] == 'Y'){
			
			if($dataElement['sideKick'] == 'Y'){
				
				$firstTeam['sideKick'] = $dataElement;
				
			} else {
				
				$firstTeam['player'] = $dataElement;
			}
			
		} else {

			if($dataElement['sideKick'] == 'Y'){
				
				$secondTeam['sideKick'] = $dataElement;
				
			} else {
				
				$secondTeam['player'] = $dataElement;
			}
		}
	}

	$sql = "insert into colors_taken (color, game, java_hash, name) ";
	$sql .= " values ('".$firstTeam['player']['color']."', '".$_SESSION['game']."', '".md5( time() . rand())."', 'First Player');";

	$conn->query($sql);

	$sql = "insert into colors_taken (color, game, java_hash, name, ally_color) ";
	$sql .= " values ('".$firstTeam['sideKick']['color']."', '".$_SESSION['game']."', '".md5( time() . rand())."', 'First Aid', '".$firstTeam['player']['color']."');";

	$conn->query($sql);

	$sql = "insert into colors_taken (color, game, java_hash, name) ";
	$sql .= " values ('".$secondTeam['player']['color']."', '".$_SESSION['game']."', '".md5( time() . rand())."', 'Second Player');";

	$conn->query($sql);

	$sql = "insert into colors_taken (color, game, java_hash, name, ally_color) ";
	$sql .= " values ('".$secondTeam['sideKick']['color']."', '".$_SESSION['game']."', '".md5( time() . rand())."', 'Second Aid', '".$secondTeam['player']['color']."');";

	$conn->query($sql);

    header("Refresh:0");
}

?>

<html>
	<head>
	
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

		<!-- Latest compiled JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

		<link href='https://fonts.googleapis.com/css?family=Aclonica' rel='stylesheet'>
		
		<link rel="stylesheet" type="text/css" href="../css/default.css">

<style>

.inner {
  margin-left: auto;
  margin-right: auto;
  width: 1200px;
}

figcaption{

	text-align: center;
}

table{

	margin: auto;
}

figure{

	margin-left: 0px;
	margin-right: 0px;
}

#Green {

<?
if(isset($name['green'])){
?>
    background-image: url('../imgz/green_castle_taken.png');
<?
} else {
?>
    background-image: url('../imgz/green_castle_unclaimed.png');
<?
}
?>
   height: 170px;
   width: 300px;
}

#Blue {

<?
if(isset($name['blue'])){
?>
    background-image: url('../imgz/blue_castle_taken.png');
<?
} else {
?>
    background-image: url('../imgz/blue_castle_unclaimed.png');
<?
}
?>
    height: 170px;
    width: 300px;
}

#Red {

<?
if(isset($name['red'])){
?>
    background-image: url('../imgz/red_castle_taken.png');
<?
} else {
?>
    background-image: url('../imgz/red_castle_unclaimed.png');
<?
}
?>
   height: 170px;
   width: 300px;
}

#Yellow {

<?
if(isset($name['yellow'])){
?>
    background-image: url('../imgz/yellow_castle_taken.png');
<?
} else {
?>
    background-image: url('../imgz/yellow_castle_unclaimed.png');
<?
}
?>

    height: 170px;
    width: 300px;
}

#Green.taken {
   background-image: url('../imgz/green_castle_taken.png');
}

#Blue.taken {
   background-image: url('../imgz/blue_castle_taken.png');
}

#Red.taken {
   background-image: url('../imgz/red_castle_taken.png');
}

#Yellow.taken {
   background-image: url('../imgz/yellow_castle_taken.png');
}

#Green:hover {
   background-image: url('../imgz/green_castle_taken.png');
}

#Blue:hover {
   background-image: url('../imgz/blue_castle_taken.png');
}

#Red:hover {
   background-image: url('../imgz/red_castle_taken.png');
}

#Yellow:hover {
   background-image: url('../imgz/yellow_castle_taken.png');
}


h3{
	
	margin-top: 15px;
}

</style>

<script>

	var listen = true;

<?
if($chooseSideKick == "N"){
?>
	var name = 'You'; 
<?
} else {
?>
    var name = 'Your Sidekick'; 
<?
} 
?>						

function changeText(color){
	
	if(!listen){
		
		return;
	}

	if(color == "green"){
	
		$('#greenName').html(name);
	
	} else if(color == "blue"){
	
		$('#blueName').html(name);
	
	} else if(color == "red"){
	
		$('#redName').html(name);
	
	} else if(color == "yellow"){
	
		$('#yellowName').html(name);
	}
}

function resetText(color){

	if(!listen){
		
		return;
	}

	if(color == "green"){
		
		$('#greenName').html('unclaimed');

	} else if(color == "blue"){
	
		$('#blueName').html('unclaimed');
	
	} else if(color == "red"){
	
		$('#redName').html('unclaimed');
	
	} else if(color == "yellow"){
	
		$('#yellowName').html('unclaimed');
	}
}

function claim(color){

	if(!listen){
		
		return;
	}

	$.ajax({
		type : "GET",
<?
echo "url : 'claimTwo.php?color='+color+'&sideKick=".$chooseSideKick."',";
?>
		async : false,
		success : function(text) {
			
			location.reload();
		}
	});
}

function copy() {
  var copyText = document.getElementById("myInput");
  copyText.select();
  copyText.setSelectionRange(0, 99999)
  document.execCommand("copy");
  alert("Link copied...");
}

</script>
	
	</head>
	<body>

		<center>

			<div class="container-fluid">
			
				<div class="row align-items-center h-25">
			
					<div class="col-md-12">
<?
if($chooseSideKick == "N"){
?>
						<h3>Choose your color:</h3>
<?
} else if(!$decided) {
?>
						<h3>Choose the color of your sidekick:</h3>
<?
} else {
?>
						<h3>All is decided...</h3>
<?
} 
?>						
					</div>
				</div>
				
				<div class="row align-items-center h-50">
				
					<div class="col-md-3">

						<figure>
<?
if(isset($name['green'])){
?>
							<div id="Green"></div>
<?
    echo "<figcaption> Green: ".$name['green']." </figcaption>";

} else {

?>
							<div id="Green" onmouseover="changeText('green')" 
                                onclick="claim('green')" 
								onmouseout="resetText('green')"></div>
							<figcaption> Green: <span id="greenName">unclaimed</span> </figcaption>
<?
}
?>
						</figure>

					</div>
					<div class="col-md-3">

						<figure>
<?
if(isset($name['blue'])){
?>
							<div id="Blue"></div>
<?
    echo "<figcaption> Blue: ".$name['blue']." </figcaption>";

} else {

?>
							<div id="Blue" onmouseover="changeText('blue')" 
								onclick="claim('blue')" 
								onmouseout="resetText('blue')"></div>
							<figcaption> Blue: <span id="blueName">unclaimed</span> </figcaption>
<?
}
?>
						</figure>

					</div>
					<div class="col-md-3">

						<figure>
<?
if(isset($name['red'])){
?>
							<div id="Red"></div>
<?
    echo "<figcaption> Red: ".$name['red']." </figcaption>";

} else {

?>
							<div id="Red" onmouseover="changeText('red')" 
								onclick="claim('red')" 
								onmouseout="resetText('red')"></div>
							<figcaption> Red: <span id="redName">unclaimed</span> </figcaption>
<?
}
?>
						</figure>

					</div>
					<div class="col-md-3">

						<figure>
<?
if(isset($name['yellow'])){
?>
							<div id="Yellow"></div>
<?
    echo "<figcaption> Yellow: ".$name['yellow']." </figcaption>";

} else {

?>
							<div id="Yellow" onmouseover="changeText('yellow')" 
								onclick="claim('yellow')" 
								onmouseout="resetText('yellow')"></div>
							<figcaption> Yellow: <span id="yellowName">unclaimed</span> </figcaption>
<?
}
?>
						
						</figure>
					
					</div>
				</div>
					
				<div class="row align-items-center h-25">
					<div class="col-md-12">
<?
    if($decided){
		
		$sql = "select java_hash from colors_taken where game = '".$_SESSION['game']."' and name = 'Second Player';";

		$result = $conn->query($sql);
		
		$row = $result->fetch_assoc();

		echo "<h2><a href='https://engine.chess4four.org/dev/two/tomcat/helloTwo/".$row['java_hash']."'>Engage!!!</a></h2>";

    }
?>
					</div>
				</div>
				
			</div>

		</center>
	
	</body>
</html>
