<?php

session_start();

include_once("settings.php");

$_SESSION['token'] = md5($_SERVER['REMOTE_ADDR'].microtime());

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
}

.center {
  margin: 0 auto;
  text-align: center;
}

</style>

<script>

  function statusChangeCallback(response) {  // Called with the results from FB.getLoginStatus().
    if (response.status === 'connected') {   // Logged into your webpage and Facebook.
      testAPI(response.authResponse.accessToken);  
    } 
  }


  function checkLoginState() {               // Called when a person is finished with the Login Button.
    FB.getLoginStatus(function(response) {   // See the onlogin handler
      statusChangeCallback(response);
    });
  }


  window.fbAsyncInit = function() {
    FB.init({
      appId      : '469961633832839',
      cookie     : true,                     // Enable cookies to allow the server to access the session.
      xfbml      : true,                     // Parse social plugins on this webpage.
      version    : 'v5.0'           // Use this Graph API version for this call.
    });


    FB.getLoginStatus(function(response) {   // Called after the JS SDK has been initialized.
      statusChangeCallback(response);        // Returns the login status.
    });
  };

  
  (function(d, s, id) {                      // Load the SDK asynchronously
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

 
  function testAPI(token) {                      // Testing Graph API after login.  See statusChangeCallback() for when this call is made.
    FB.api('/me', function(response) {
		<? echo "window.location.assign('validateFacebook.php?token='+token+'&id=' + response.id + '&ownToken=".$_SESSION['token']."');"; ?>
    });	
  }
  
</script>


	</head>
<body>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v5.0&appId=469961633832839&autoLogAppEvents=1"></script>

	<div class="outer">
		<div class="middle">
			<div class="inner center">

				<div class="fb-login-button" data-width="" data-size="large" data-button-type="continue_with" data-auto-logout-link="false" 
					data-use-continue-as="false" data-onlogin="statusChangeCallback"></div>

			</div>
		</div>
	</div>

</body>
</html>