<?php 

require_once("db/dbconnector.php");

	if(isset($_POST['txtEmail']) && isset($_POST['txtPassword'])) {
		$user = $dbh->login($_POST['txtEmail']);
		$password = $user[0]["password"];

		if ($user[0] && password_verify($_POST['txtPassword'], $password)) {
			$username = $user[0]["name"];
			require("./index.php");
		}
		else {
			require("./index.php");
		}
	}
?>