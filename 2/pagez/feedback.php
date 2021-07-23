<?

// Create connection
include_once("settings.php");

// Check connection
if ($conn->connect_error) {

	header("Location: errorPage.php");

	die;
} 

$sql="insert into feedback (good, bad) VALUES ('".test_input($_POST['good'])."', '".test_input($_POST['bad'])."');";

if ($conn->query($sql) !== TRUE) {
	
	echo "fail";
	
	die;
}

?>