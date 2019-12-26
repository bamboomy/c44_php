<?

session_start();

$_SESSION['hash'] = $_GET['game'];

$_SESSION['invited'] = true;

header("Location: auth.php");

?>