<?php 
include $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.inc.php';


try {
	$host       = "mariadb";
	$username   = "root";
	$pwd   = "rootpwd";
	$dsn        = "mysql:host=$host;charset=UTF8"; 
	// adding options as parameter eliminates need to set error mode manually
	$options    = array(
	                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
	              );
	$pdo = new PDO($dsn, $username, $pwd, $options);
	$sql = file_get_contents('data/blog_db.sql');
	$result = $pdo->query($sql);
	echo "Database installed successfully, remove install script from file system";
} catch (Exception $e) {
	errorMsg('Error Installing database tables', $e);
}


 ?>