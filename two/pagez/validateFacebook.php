<?php

session_start();

if(!isset($_SESSION['token']) || $_SESSION['token'] != $_GET['ownToken']){
	
	header("Location: welcome.php");
		
	exit;
}

include_once("settings.php");

$sql = "select ip from sessions where token='".$_SESSION['token']."';";

$result = $conn->query($sql);

require_once __DIR__ . '/../../vendor/autoload.php'; // change path as needed

$fb = new Facebook\Facebook([
  'app_id' => '469961633832839',
  'app_secret' => '1c3ccae9fb1b7c8938b388fd4b51d836',
  'default_graph_version' => 'v5.0',
  ]);

include_once("settings.php");

$accessToken = $_GET['token'];

try {
  $response = $fb->get('/me?fields=id,first_name', $accessToken);
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

if($me->getProperty('id') != $_GET['id']){
	
	header("Location: error.php");
		
	exit;
}

include_once("settings.php");

$_SESSION['fbId'] = $me->getProperty('id');

$_SESSION['firstName'] = $me->getProperty('first_name');

$sql = "select id, name from gebruiker where fbId='" . $_SESSION['fbId'] . "';";

$result = $conn->query($sql);

if ($result->num_rows == 0) {
	
	header("Location: cookie.php");
	
	exit;
}

$row = $result->fetch_assoc();

$_SESSION['id'] = $row['id'];

$_SESSION['name'] = $row['name'];

$sql = "update gebruiker set lastLogin = now() where id='" . $_SESSION['id'] . "';";

$result = $conn->query($sql);

if(isset($_SESSION['chat'])){
	
	header("Location: claim.php?color=Chatter");
		
	exit;
}

if(isset($_SESSION['invited'])){
	
	header("Location: fetchSentence.php");
		
	exit;
}


?>
<html>
<head>

	<link href='https://fonts.googleapis.com/css?family=Aclonica' rel='stylesheet'>

	<link rel="stylesheet" type="text/css" href="../css/default.css">

</head>
<body>

	<div class="outer">
		<div class="middle">
			<div class="inner center">

				<? echo "<h2>Welcome back ".$row['name']."!</h2>" ?>
				
				<a href="lobby.php">Let's see what great games await us...</a>

			</div>
		</div>
	</div>

</body>
</html>