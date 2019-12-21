<?php

session_start();

require_once __DIR__ . '/../vendor/autoload.php'; // change path as needed

$fb = new Facebook\Facebook([
  'app_id' => '469961633832839',
  'app_secret' => '1c3ccae9fb1b7c8938b388fd4b51d836',
  'default_graph_version' => 'v2.9',
  ]);

include_once("settings.php");

$helper = $fb->getJavaScriptHelper();

try {
  $accessToken = $helper->getAccessToken();
  $response = $fb->get('/me?fields=first_name', $accessToken);
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

if (! isset($accessToken)) {
  echo 'No cookie set or no OAuth data could be obtained from cookie.';
  exit;
}

$me = $response->getGraphUser();


// Check connection
if ($conn->connect_error) {

?>
error 1.
<?
	die;
} 

	$sql = "SELECT name, id FROM user where fbId='".$me->getProperty('id')."'";
	$result = $conn->query($sql);

	if ($result->num_rows == 0) {
?>
<html>
	<head>
		<script type="text/javascript" src="../js/jquery-3.2.1.min.js"></script>
		<link rel="stylesheet" href="../frameworkz/bootstrap-4.0.0-alpha.6-dist/css/bootstrap.min.css">
		<script src="../frameworkz/bootstrap-4.0.0-alpha.6-dist/js/bootstrap.min.js"></script>
		<script type="text/javascript">
			$(window).on('load',function(){
				$('#rejectModal').modal('show');
			});
		</script>
		  <style>
		.jumbotron { 
			background-color: #a4ca39; /* Orange */
			color: #000000;
		}
		
		.navbar {
			margin-bottom: 0;
			background-color: #a4ca39;
			z-index: 9999;
			border: 0;
			font-size: 12px !important;
			line-height: 1.42857143 !important;
			letter-spacing: 4px;
			border-radius: 0;
		}

		.navbar li a, .navbar .navbar-brand {
			color: #000 !important;
		}

		.navbar-nav li a:hover, .navbar-nav li.active a {
			color: #a4ca39 !important;
			background-color: #000 !important;
		}

		.navbar-default .navbar-toggle {
			border-color: transparent;
			color: #000 !important;
		}
		
		img {
			padding: 50px 25px;
		}
		
		.modal-dialog {
			position: absolute;
			top: 50px;
			right: 100px;
			bottom: 0;
			left: 0;
			z-index: 10040;
			overflow: auto;
			overflow-y: auto;
		}
		
		button{
			
			margin: 10px;
			
		}
		
		.red{
			color: red;
		}
		
	</style>
	</head>
	<body>
	<center>
<div id="rejectModal" class="modal fade" role="dialog">
	<div class="modal-dialog">

	<!-- Modal content-->
		<div class="modal-content">
			<form action="chooseName.php" method="post">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Welcome :-)</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-sm-2"></div>
						<div class="col-sm-8">
							<p>
								Hey, <?php echo $me->getProperty('first_name')?>, <br/>
								<br/>
								welcome to HexaGo,<br/>
								<br/>
								You might want to choose an alias;<br/>
								(unless you're fine with all of the other players knowing your real name)<br/>
								<br/>
								You can choose one here: <br/>
								<div class="row">
									<div class="col-sm-2"></div>
									<div class="col-sm-4">
										<input type="text" name="userName" id='userName'/>
									</div>
									<div class="col-sm-4">
										<input type='hidden' name="userId" id='userId' value='<?php echo $me->getProperty('id')?>' />
										<button class="btn btn-default pull-right" type="submit">Submit</button>
									</div>
									<div class="col-sm-2"></div>
								</div>
							</p>
						</div>
						<div class="col-sm-2"></div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>	
	</center>
	</body>
</html>
<?

	}else if ($result->num_rows == 1) {
		
		$row = $result->fetch_assoc();
		
		$_SESSION['hexaGoId'] = $row["id"];
		$_SESSION['name'] = $row["name"];
		
		header("Location: lobby.php");
		
		exit;

	}else{
?>
	<script>
		alert("This acturally shouldn't happen, let us check whether hell froze over...");
	</script>
<?
	}
?>