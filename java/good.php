<?

// Create connection
include_once("settings.php");

if(!isset($_SESSION['id'])){
	
	header("Location: welcome.php");
		
	exit;
}

$sql="insert into feedback (javaHash, type, text) VALUES ('".test_input($_GET['user'])."', 'good',  '".test_input($_POST['good'])."');";

if ($conn->query($sql) !== TRUE) {
	
	echo "fail";
	
	die;
}

?>