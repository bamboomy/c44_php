<?php

session_start();

if(!isset($_SESSION['id'])){
	
	header("Location: welcome.php");
		
	exit;
}

include_once("settings.php");

$sql = "select reason, player from game_result where game = '".test_input($_GET['game'])."';";

$result = $conn->query($sql);

$sql = "select sentence, ended from game where hash = '".test_input($_GET['game'])."';";

$result2 = $conn->query($sql) or die($conn->error);

$row2 = $result2->fetch_assoc();

$sql = "select count(1) from game_result where game = '".test_input($_SESSION['hash'])."';";

$result4 = $conn->query($sql) or die($conn->error);

$row4 = $result4->fetch_row();

$base = $row4[0];

$sql = "SELECT * FROM sterren s where id = (select max(id) from sterren where userId='".$_SESSION['id']."')";

$result5 = $conn->query($sql) or die($conn->error);

$starz = 0;

if($result5->num_rows != 0){

	$row5 = $result5->fetch_assoc();
	
	$starz = $row5['starz'];
}

$sql = "SELECT text, id FROM improvementz where userId='".$_SESSION['id']."' and deleted = 'N'";

$result6 = $conn->query($sql) or die($conn->error);

$sql = "SELECT text, facebook, publicly FROM review where userId='".$_SESSION['id']."' and id = (select max(id) from review where userId='".$_SESSION['id']."')";

$result7 = $conn->query($sql) or die($conn->error);

$row7 = $result7->fetch_assoc();

?>
<html>
	<head>

		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

		<!-- Popper JS -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

		<!-- Latest compiled JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	
		<link href='https://fonts.googleapis.com/css?family=Aclonica' rel='stylesheet'>
		
		<link rel="stylesheet" type="text/css" href="../css/default.css">

<style>

	#reload{
		
		border-style: solid;
		max-width: 300px;
		top: 10px;
		left: 10px;
		padding: 5px;
	}
	
	.star {
	   background-image: url('../imgz/star_gray.png');
	   height: 70px;
	   width: 70px;
	   background-repeat: no-repeat;
	   display: inline-block;
	}

	.star.selected {
	   background-image: url('../imgz/star_green.png');
	}
</style>		

<script>

	var shown = false;
	
	function checkFinished() {
		
		$.ajax({
			type : "GET",
<?			echo "url : 'https://chess4four.org".$profilePath."/pagez/numberOfFinished.php?game=".test_input($_GET['game'])."',"; ?>
			async : false,
			success : function(text) {
				
<?				echo "if(text != ".$base."){"; ?>

					$("#reload").show(1000);
					
					shown = true;
				}
			}
		});
	}

	function again() {

		setTimeout(function() {

			checkFinished();

			if(!shown){
				
				again();
			}

		}, 1000);
	}

	again();

	function retrieveStars(){

		for (i = 0; i <= 5; i++) {
			
			$("#star_"+i).removeClass("selected");
		}

<? echo "var nr = " . $starz . ";"; ?>
		
		for (i = 0; i <= nr; i++) {
			
			$("#star_"+i).addClass("selected");
		}
	}

	function addImprovement(){

		$("#improvements").append( "<input type='text' class='improvement' onkeydown='checkLastImprovement();' /><br/><br/>" );
	}

	$( document ).ready(function() {
		
		if(document.cookie.includes("myReviewModalShown=shown")){
			
			$('#reviewModal').modal('show');
		}

		if(document.cookie.includes("mySurveyModalShown=shown")){
			
			$('#surveyModal').modal('show');
		}

<?

if($starz == 0){

?>
			//later...
			//showModal();
			
		showSurveyModal();
<?

	$sql = "insert into sterren (userId, starz) ";
	$sql .= " values ('".$_SESSION['id']."', '2');";

	$result = $conn->query($sql) or die($conn->error);
}

?>
		
		$( "div[id^='star']" ).mouseenter(
		
			function() {

				for (i = 0; i <= 5; i++) {
					
					$("#star_"+i).removeClass("selected");
				}
				
				var nr = $( this ).attr('id').split("_")[1];
				
				for (i = 0; i <= nr; i++) {
					
					$("#star_"+i).addClass("selected");
				}
			}
		);

		$( "div[id^='star']" ).mouseleave(retrieveStars);
		
		$( "div[id^='star']" ).click(
		
			function() {
		
				var nr = $( this ).attr('id').split("_")[1];

				$.ajax({
					type : "GET",
		<?			echo "url : 'https://chess4four.org".$profilePath."/pagez/saveStar.php?stars='+nr,"; ?>
					async : false,
					success : function(text) {
						
						location.reload();
					}
				});
			}
		);
		
		retrieveStars();

	});	

	function checkLastImprovement(){
		
		if ($(".improvement").last().val() != ""){

			addImprovement();
		}
	}
	
	function save(){
		
		$(".improvement").each(function( index ) {

			if($( this ).val() != ""){

				$.ajax({
					type : "POST",
					xhrFields : {
						withCredentials : true
					},
	<?					
					echo "url : 'https://chess4four.org".$profilePath."/pagez/saveImprovement.php',";
	?>					
					data : {
						text : $( this ).val()
					},
					success : function(text) {

					}
				});
				
			}else{
				
				setTimeout(function() {

					$("#myForm").submit();

				}, 1000);
			}
		});
	}
	
	function remove(id){
		
		$.ajax({
			type : "GET",
<?			echo "url : 'https://chess4four.org".$profilePath."/pagez/remove.php?id='+id,"; ?>
			async : false,
			success : function(text) {
				
				location.reload();
			}
		});
	}
	
	function showModal() {
		
		document.cookie = "myReviewModalShown=shown";

		$('#reviewModal').modal('show');	
	}
	
	function hideModal(){
		
		document.cookie = "myReviewModalShown=";

		$('#reviewModal').modal('hide');	
	}

	function showSurveyModal() {
		
		document.cookie = "mySurveyModalShown=shown";

		$('#surveyModal').modal('show');	
	}
	
	function hideSurveyModal(){
		
		document.cookie = "mySurveyModalShown=";

		$('#surveyModal').modal('hide');	
	}
	

</script>
		
	</head>
	<body>
	
<div id="reload" style="display: none; z-index: 2;">

	<p>
		The game also ended for someone else...<br/>
		Do you want to <a href="#" onclick="location.reload();">reload</a><br/>
		to have the latest news?
	</p>

</div>	

	<!-- The Review Modal -->
	<div class="modal" id="reviewModal">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">

				<!-- Modal Header -->
				<div class="modal-header">
					<? echo "<h4 class='modal-title'>".$_SESSION['name']."'s review:</h4>"; ?>
				</div>

				<!-- Modal body -->
				<div class="modal-body">

					<center>
				
						<div id="star_1" class="star"></div>
						<div id="star_2" class="star"></div>
						<div id="star_3" class="star"></div>
						<div id="star_4" class="star"></div>
						<div id="star_5" class="star"></div>

					<form id="myForm" action="saveReview.php" method="post">

<?						echo "<textarea id='w3review' name='w3review' rows='4' cols='25'>".$row7['text']."</textarea><br/>"; ?>

					</center>
<?
if($row7['facebook'] == "Y"){
	
	echo "<input type='checkbox' checked = 'checked' id='facebook' name='facebook' value='true'>"; 

} else {

	echo "<input type='checkbox' id='facebook' name='facebook' value='true'>"; 
}
?>
						<label for="facebook" style="font-size: smaller;"> This review may be posted on Facebook.</label><br>
<?
if($row7['publicly'] == "Y"){
	
	echo "<input type='checkbox' checked = 'checked' id='publicly' name='publicly' value='true'>"; 

} else {

	echo "<input type='checkbox' id='publicly' name='publicly' value='true'>"; 
}
?>
						<label for="publicly" style="font-size: smaller;"> This review may be viewed publicly.</label><br>	

<?						echo "<input type='hidden' name='game' value='".$_GET['game']."' />"; ?>

						Possible improvements:<br/>
						<p style="font-size: smaller;">
<?
						$counter = 0;
				
						while($row6 = $result6->fetch_assoc()){
							
							echo "<br/><span style='width: auto;'>".$row6['text'];
							echo "<img src='../imgz/red_cross.png' style='position: absolute; right: 10px;' onclick='remove(".$row6['id'].")'/>";
							echo "</span>";
							
							$counter++;
						}
?>					
						</p>
						<div id="improvements">
							<input type="text" class="improvement" onkeydown="checkLastImprovement();" /><br/><br/>
						</div>
						
						<button type="button" onclick="save();">Save</button>
						
						<button type="button" onclick="hideModal();" style="right: 10px; position: absolute;">Close</button>

					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="modal" id="surveyModal">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">

				<!-- Modal Header -->
				<div class="modal-header">
					<? echo "<h4 class='modal-title'>".$_SESSION['name'].", can we ask one thing?</h4>"; ?>
				</div>

				<!-- Modal body -->
				<div class="modal-body">

					<center>
						We really would like your opinion about the game...<br/>
						<br/>
						If you could fill in <a href="https://docs.google.com/forms/d/1S10QqCMnAdwW5mLfupXJ7xTwT8B7OIiOIvzq1uPQL2k">this survey</a>
						, that would be really great!<br/>
						<br/>						
						It's anonymous, takes 5 min of your life and would mean the world to us!<br/>
						<br/>				
						<br/>
						We realize there are problems, bugs, issues and improvements to be made,<br/>
						but we need your help in either finding problems we didn't knew about<br/>
						or, otherwise, address the most urgent problems first.<br/>
						<br/>
						This is the first time the app gets tested by it's real users,<br/>
						(that means you)<br/>
						<br/>
						...so we are really greatfull that you want to try it out<br/>
						in this experimental phase of the creative process.<br/>
						<br/>
						If you'd prefer not, it's not a problem,<br/>
						<br/>
						In any case: thanks for have tested out the game!<br/>
						<br/>
						The Chess4four Team.
					</center>
					
					<button type="button" onclick="hideSurveyModal();" style="right: 10px; bottom: 20px; position: absolute;">Close</button>
				
				</div>
			</div>
		</div>
	</div>

	<center>

		<div class="outer">
			<div class="middle">
				<div class="inner center">
				
					<h2>This was:</h2>
					<h2><? echo $row2['sentence']; ?></h2>
<?
	if($row2['ended'] == 'N'){
?>		
	<p>The game is still in progress...<br/>
	This is the partial result:</p>	
<?		
	} else {
?>		
	<p>The game ended,<br/>
	these are the results:</p>	
<?		
	}
?>

<ol>

<?

function array_depth(array $array) {
    $max_depth = 1;

    foreach ($array as $value) {
        if (is_array($value)) {
            $depth = array_depth($value) + 1;

            if ($depth > $max_depth) {
                $max_depth = $depth;
            }
        }
    }

    return $max_depth;
}

function sortArrayByArray(array $array, array $orderArray) {
	
    $ordered = array();
    
	foreach ($orderArray as $key) {
		
        if (array_key_exists($key, $array)) {
			
			$ordered[$key] = $array[$key];
        }
    }
	
    return $ordered;
}

$positions = array("winner", "pat", "mate", "resign");

$players = array();

while($row = $result->fetch_assoc()){
	
	$sql = "select color, name from colors_taken where java_hash = '".test_input($row['player'])."';";

	$result3 = $conn->query($sql) or die($conn->error);
	
	$row3 = $result3->fetch_assoc();

	if (array_key_exists($row['reason'], $players)) {
		
		if(array_depth($players[$row['reason']]) == 1){
			
			$temp = array($players[$row['reason']]);
			
		} else {
			
			$temp = $players[$row['reason']];
		}
		
		$temp[] = array($row3['color'], str_replace("Random85247", "Bot", str_replace("Dubious85247", "Dubious", $row3['name'])));
		
		$players[$row['reason']] = $temp;

	} else {
		
		$players[$row['reason']] = array($row3['color'], str_replace("Random85247", "Bot", str_replace("Dubious85247", "Dubious", $row3['name'])));
	}
}

$ordered = sortArrayByArray($players, $positions);

foreach ($ordered as $key => $value) {
	
	if(array_depth($value) == 1){
		
		echo "<li>".$value[0].": ".$value[1].": ".$key."</li>";
		
	} else {
		
		foreach ($value as $element){
			
			echo "<li>".$element[0].": ".$element[1].": ".$key."</li>";
		}
	}
}
?>				

</ol>

				</div>
			</div>
		</div>
	</center>

	<div style="margin: 10px; position: fixed; right: 20px; bottom: 0px; z-index: 1">
		<p><a href="#" onclick="showModal();">Edit review.</a></p>
	</div>

	<div style="margin: 10px; position: fixed; left: 20px; bottom: 0px; z-index: 1">
		<p><a href="create.php">Start new game.</a></p>
	</div>
		
	</body>
</html>
