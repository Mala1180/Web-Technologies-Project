<?php
	require_once("functions.php");
	/*
	 *	TODO: move to a config file!
	 */
	header('Content-Type: application/json; charset=utf-8');
	$servername = "localhost";
	$database = "UniboVinyl";
	$username = "root";
	$password = "root";
	$port = 3306;

	$db = new mysqli($servername, $username, $password, $database, $port);
 ?>