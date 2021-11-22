<?php 

	require_once("database.php");
	
	$servername = "192.168.64.2";
	$database = "myunivinyl";
	$username = "prova";
	$password = "prova";
	$port = 3306;

	$dbh = new DatabaseHelper($servername, $username, $password, $database, $port);
 ?>