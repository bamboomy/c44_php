<?

session_start();

echo $_SESSION['colorValues'][$_GET['hash']];

?>