<?

session_start();

if(!isset($_SESSION['fbId'])){
	
	header("Location: welcome.php");
		
	exit;
}

include_once("settings.php");

$sql = "select name from gebruikers where name='".test_input($_GET['name'])."';";

$result = $conn->query($sql);

if ($result->num_rows == 0) {
	
	echo "ok";
	
} else {
	
	echo "nok";
}

?>