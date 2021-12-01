<?php 

	require_once("database.php");
	
	$servername = "192.168.64.2";
	$database = "UniboVinyl";
	$username = "prova";
	$password = "prova";
	$port = 3306;

	$db = new mysqli($servername, $username, $password, $dbname, $port);
 ?>