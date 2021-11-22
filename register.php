<?php

require_once("dbconnector.php");

	if(isset($_POST['txtName']) && isset($_POST['txtEmail']) && isset($_POST['txtPassword'])) {
		$dbh->register($_POST['txtName'], $_POST['txtSurname'], $_POST['birthDate'], $_POST['txtEmail'], password_hash($_POST['txtPassword'], PASSWORD_BCRYPT));
	}
?>