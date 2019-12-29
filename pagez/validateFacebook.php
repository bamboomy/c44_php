<?php

session_start();

require_once __DIR__ . '/../vendor/autoload.php'; // change path as needed

$fb = new Facebook\Facebook([
  'app_id' => '469961633832839',
  'app_secret' => '1c3ccae9fb1b7c8938b388fd4b51d836',
  'default_graph_version' => 'v5.0',
  ]);

include_once("settings.php");

//$helper = $fb->getJavaScriptHelper();

$accessToken = $_GET['token'];

try {
  //$accessToken = $helper->getAccessToken();
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

$sql = "select id from gebruiker where fbId='" . $_SESSION['fbId'] . "';";

$result = $conn->query($sql);

if ($result->num_rows == 0) {
	
	header("Location: facebookRegister.php");
		
	exit;
}

?>