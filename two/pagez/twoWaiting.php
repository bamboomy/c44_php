<?php

session_start();

// todo : move
//setcookie("hash", md5($_SESSION['java_hash']."centerparks555"), time() + 60*60*24*30, "/");

include_once("settings.php");

$ownColor = $_SESSION[$color[$_GET['color']]];

if(!isset($_SESSION['generated'])){

    $gameHash = md5( time() . rand());
    
    $_SESSION['gameHash'] = $gameHash;

    $sql = "insert into game42 (hash) ";
    $sql .= " values ('".$gameHash."');";

    $result = $conn->query($sql);

    $sql = "insert into 42player (gameHash, color, first, sideKick) ";
    $sql .= " values ('".$gameHash."', '".$ownColor."', 'Y', 'N');";

    $result = $conn->query($sql);
    
    $_SESSION['generated'] = "set";
}

$sql = "select state from game42 where hash = '".$_SESSION['gameHash']."' and state <> 'begun';";

$result = $conn->query($sql);

if ($result->num_rows != 1) {

    die("no game found");
}

$row = $result->fetch_assoc();

if($ownColor == 'green'){

    $greenName = "You";

} else {

    $greenName = "unclaimed";
}

if($ownColor == 'blue'){

    $blueName = "You";

} else {

    $blueName = "unclaimed";
}

if($ownColor == 'red'){

    $redName = "You";

} else {

    $redName = "unclaimed";
}

if($ownColor == 'yellow'){

    $yellowName = "You";

} else {

    $yellowName = "unclaimed";
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

if($ownColor == 'green'){

    echo "background-image: url('../imgz/green_castle_taken.png');";

} else {

    echo "background-image: url('../imgz/green_castle_unclaimed.png');";
}

?>

    height: 170px;
    width: 300px;
}

#Blue {

<?

if($ownColor == 'blue'){

    echo "background-image: url('../imgz/blue_castle_taken.png');";

} else {

    echo "background-image: url('../imgz/blue_castle_unclaimed.png');";
}

?>

    height: 170px;
    width: 300px;
}

#Red {

<?

if($ownColor == 'red'){

    echo "background-image: url('../imgz/red_castle_taken.png');";

} else {

    echo "background-image: url('../imgz/red_castle_unclaimed.png');";
}

?>

    height: 170px;
    width: 300px;
}

#Yellow {

<?

if($ownColor == 'yellow'){

    echo "background-image: url('../imgz/yellow_castle_taken.png');";

} else {

    echo "background-image: url('../imgz/yellow_castle_unclaimed.png');";
}

?>

    height: 170px;
    width: 300px;
}

/*
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
*/

h3{
	
	margin-top: 15px;
}

</style>

<script>

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

						<h3>Choose your color:</h3>
						
					</div>
				</div>
				
				<div class="row align-items-center h-50">
				
					<div class="col-md-3">

						<figure>
							<div id="Green"></div>
<?

echo "<figcaption> Green: ".$greenName."</figcaption>";

?>
						</figure>

					</div>
					<div class="col-md-3">

						<figure>
                            <div id="Blue"></div>
							
<?
							
echo "<figcaption> Blue: ".$blueName."</figcaption>";

?>

							<figcaption> Blue: <span id="blueName">unclaimed</span> </figcaption>
						</figure>

					</div>
					<div class="col-md-3">

						<figure>
                            <div id="Red"></div>
<?
							
echo "<figcaption> Red: ".$blueName."</figcaption>";

?>

							<figcaption> Red: <span id="redName">unclaimed</span> </figcaption>
						</figure>

					</div>
					<div class="col-md-3">

						<figure>
						
							<div id="Yellow"></div>

<?
							
echo "<figcaption> Yellow: ".$yellowName."</figcaption>";

?>
						</figure>

					</div>
				</div>
				
				<div class="row align-items-center h-25">
			
					<div class="col-md-12">
<?
    if($row['state'] == 'new'){
?>
						<h5>You can share this link:
						<? echo "<input id='myInput' type='text' value='https://engine.chess4four.org/two/pagez/twoDecide.php?game=".$_SESSION['gameHash']."' />";
						echo "<input type='button' onclick='copy();' value='copy' />"; ?>
						</h5>
<?
    }
?>
					</div>
				</div>
				
			</div>

		</center>
	
	</body>
</html>
