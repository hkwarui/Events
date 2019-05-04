<?php

	define('DBhost', 'localhost');
	define('DBuser', 'root');
	define('DBPass', '');
	define('DBname', 'ams');
	
	try {
		
		$DBcon = new PDO("mysql:host=".DBhost.";dbname=".DBname,DBuser,DBPass);
		
	} catch(PDOException $e){
		
		die($e->getMessage());
	}



$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ams";
$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

?>