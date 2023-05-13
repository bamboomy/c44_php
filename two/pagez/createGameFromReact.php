<?

session_start();

$_SESSION['json'] = test_input($_POST['json']);

echo $_SESSION['json'];

//header("Location: two.php");

exit;


?>