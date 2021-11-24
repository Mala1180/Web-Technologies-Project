<?php 

	require_once("database.php");
	
	$servername = "localhost";
	$database = "myunivinyl";
	$username = "prova";
	$password = "prova";
	$port = 3306;

	$dbh = new DatabaseHelper($servername, $username, $password, $database, $port);
 ?>