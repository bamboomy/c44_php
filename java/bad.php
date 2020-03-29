<?

// Create connection
include_once("../pagez/settings.php");

$sql="insert into feedback (javaHash, type, text) VALUES ('".test_input($_GET['user'])."', 'bad',  '".test_input($_POST['bad'])."');";

if ($conn->query($sql) !== TRUE) {
	
	echo "fail";
	
	die;
}

echo "ok";

?>