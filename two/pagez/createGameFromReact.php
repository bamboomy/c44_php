<?

session_start();

$_SESSION['json'] = addslashes($_POST['json']);

echo $_SESSION['json'];

header("Location: two.php");

exit;


?>