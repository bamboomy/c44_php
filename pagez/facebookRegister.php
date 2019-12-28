<?php

session_start();

include_once("settings.php");

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

.left{

		text-align: left;
}

</style>

<script>

  function statusChangeCallback(response) {  // Called with the results from FB.getLoginStatus().
    if (response.status === 'connected') {   // Logged into your webpage and Facebook.
      testAPI();  
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

 
  function testAPI() {                      // Testing Graph API after login.  See statusChangeCallback() for when this call is made.
    FB.api('/me', function(response) {
		//<? echo "window.location.assign('facebookSuccess.php?token=".$token."&id=' + response.id);"; ?>
    });
  }
  

</script>


	</head>
<body>

	<div class="outer">
		<div class="middle">
			<div class="inner center">

				<h2>Hey <span id='name'></span>,</h2>
				
				Seems you are new around here...<br/>
				<br/>
				Care to choose your destiny? (oops, I mean name?):<br/>
				<br/>
<? 

$four = array("Ma", "Ze", "Di", "Ka", "Fo", "Zi", "Lo", "Je", "Ri", "A", "E", "O");

$one = array("nen", "maf", "kit", "jep", "pof", "hez", "nid", "ber", "set", "kif", "lod", "kag", "nif");

$two = array("ozo", "afi", "elo", "ira", "ogo", "eti", "afo", "eka", "azo", "ito", "afe", "oli");

for($i=0; $i<20; $i++){
	
	$name[$i] = $four[rand(0, count($four) - 1)] . $one[rand(0, count($one) - 1)] . $two[rand(0, count($two) - 1)];
}

//TODO: filter on existing names

for($i=0; $i<5; $i++){
	
	echo "<div class='left'><input type='radio' name='name' value='".$name[$i]."'>".$name[$i]."</div>";
}
?>
			</div>
			</div>
	</div>

</body>
</html>