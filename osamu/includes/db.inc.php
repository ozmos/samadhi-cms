<?php 

	$host       = "mariadb";
	$username   = "root";
	$pwd   = "rootpwd";
	$dbname     = "blog_db"; 
	$dsn        = "mysql:host=$host;dbname=$dbname;charset=UTF8"; 
	// adding options as parameter eliminates need to set error mode manually
	$options    = array(
	                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
	              );
	$pdo = new PDO($dsn, $username, $pwd, $options);



?>