<?

session_start();

$_SESSION['json'] = addslashes($_POST['json']);

header("Location: two.php");

exit;


?>