<?php
	define("HOST_ACCESS_URL", "localhost");
	define("HOST_ACCESS_USERNAME", "root");
	define("HOST_ACCESS_PASSWORD", "");
	define("HOST_ACCESS_DATABASE", "scheduler");

	$host_access_url = HOST_ACCESS_URL;
	$host_access_username = HOST_ACCESS_USERNAME;
	$host_access_password = HOST_ACCESS_PASSWORD;
	$host_access_database = HOST_ACCESS_DATABASE;
	
	try {
		$connection = new PDO("mysql:host=$host_access_url; dbname=$host_access_database", $host_access_username, $host_access_password);
		$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $er){
		echo "Error in database connection.";
	}
?>