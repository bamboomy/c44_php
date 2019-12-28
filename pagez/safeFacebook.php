<? 

session_start();

include_once("settings.php");

$sql = "insert into gebruiker (name, fbId) values (";

if($_POST['name'] == 'own'){
	
	$sql .= $_POST['ownName'];
	
} else {
	
	$sql .= $_POST['name'];
}

$sql .= ", )";

?>