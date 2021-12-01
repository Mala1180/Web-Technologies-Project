<?php

require_once('utils.php');
require_once("db/dbconnector.php");

$body = json_decode(file_get_contents('php://input'), true);
	if(isset($body['name']) && isset($body['surname']) && isset($body['email']) && isset($body['username']) && isset($body['password'])) {		
		$result = $dbh->register($body['name'], $body['surname'], $body['email'], $body['username'], password_hash($body['password'], PASSWORD_BCRYPT));
		echo $result;
	}
?>