<?

session_start();

$_SESSION['json'] = $_POST['json'];

header("Location: two.php");

exit;


?>