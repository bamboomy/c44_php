<?

session_start();

$_SESSION['colorValues'] = array( 'firsthash' => 'green' , 'firsthash2' => 'yellow', 'firsthash3' => 'blue');

echo "<a href='test2.php?hash=".'firsthash'."'>test</a>"

?>