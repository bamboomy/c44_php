<?

session_start();

$_SESSION['json'] = $_POST['json'];

echo $_SESSION['json'];

//header("Location: two.php");

exit;


?>