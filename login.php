<?php 

require_once("dbconnector.php");

if(isset($_POST['txtEmail']) && isset($_POST['txtPassword'])) {


	$user = $dbh->login($_POST['txtEmail']);
	$username = $user[0]["name"];
	$password = $user[0]["password"];

	if ($user[0] && password_verify($_POST['txtPassword'], $password)) {
		print ("Benvenuto ".$username);
	}
	else {
		echo "Utente non autorizzato";
	}
}
?>