<?

if(isset($_SESSION['failCounter'])){
	
	$_SESSION['failCounter']++;

} else {
	
	$_SESSION['failCounter'] = 0;
}

header("Location: test.php");

exit;

if($_SESSION['failCounter'] == 3){

	header("Location: color.php");
}

?>