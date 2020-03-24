<?

// Create connection
include_once("settings.php");

$sql="insert into feedback (javaHash, type, text) VALUES ('".test_input($_GET['user'])."', 'good',  '".test_input($_POST['good'])."');";

if ($conn->query($sql) !== TRUE) {
	
	echo "fail";
	
	die;
}

?>