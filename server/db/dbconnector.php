<?php
	/*
	 *	TODO: move to a config file!
	 */
	header('Content-Type: application/json; charset=utf-8');
	$servername = "192.168.64.2";
	$database = "UniboVinyl";
	$username = "prova";
	$password = "prova";
	$port = 3306;

	$db = new mysqli($servername, $username, $password, $dbname, $port);
 ?>