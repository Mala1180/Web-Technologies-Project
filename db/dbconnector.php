<?php 

	require_once("database.php");
	
	$servername = "localhost";
	$database = "UniboVinyl";
	$username = "prova";
	$password = "prova";
	$port = 3306;

	$dbh = new DatabaseHelper($servername, $username, $password, $database, $port);
 ?>