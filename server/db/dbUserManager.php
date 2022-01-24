<?php
require_once("db/dbconnector.php");
require_once('../vendor/autoload.php');
require_once('mail.php');

// require '../vendor/phpmailer/phpmailer/src/Exception.php';
// require '../vendor/phpmailer/phpmailer/src/PHPMailer.php';
// require '../vendor/phpmailer/phpmailer/src/SMTP.php';
// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;

class DBUserMgr {
	private $db;
 	
 	public function __construct($dbConnection) {
 		$this->db = $dbConnection;

 		if($this->db->connect_error) {
 			die("Connessione al database fallita.");
 		}
 	}

 	public function login($username, $password, $type) {
		$query = "";
		if ($type == "cliente") {
			$query = "SELECT password FROM `customer` WHERE username=?";
		} else if ($type == "artista") {
			$query = "SELECT password FROM `author` WHERE username=?";
		}
		$result = execute_query($this->db, $query, array($username));
		return count($result) && password_verify($password, $result[0]["password"]);
 	}

	public function addPasswordChangeReq($mail, $type) {
		$query = "";
		$idUser = -1;
		$done = 0;
		if ($type == "cliente" || $type == "artista") {
			if ($type == "cliente") {
				$query = "SELECT idCustomer FROM `customer` WHERE email=?";
				$idUser = execute_query($this->db, $query, array($mail))[0]["idCustomer"];
			} else if ($type == "artista") {
				$query = "SELECT idAuthor FROM `author` WHERE email=?";
				$idUser = execute_query($this->db, $query, array($mail))[0]["idAuthor"];
			}			
			if($idUser > 0) {
				$tmpCode = uniqid();
				$query = "SELECT `idRecovery` FROM password_recovery WHERE idUser=? AND type=? AND done=?";
				$exist = execute_query($this->db, $query, array($idUser, $type, $done));
				if(count($exist) > 0) {
					//c'è gia una richiesta aperta.
					return false;
				}
				$query = "INSERT INTO `password_recovery` (`idUser`, `type`, `code`, `done`) VALUES (?, ?, ?, ?)";
				if(execute_query($this->db, $query, array($idUser, $type, $tmpCode, $done))) {
					$link = "https://link.it?code=".$tmpCode;
					sendMail($mail, "Recupero password", "Clicca sul seguente link per generare una nuova password ".$link);
					return true;
				}
			}
		}
		return false;
 	}

	public function changePassword($code, $newPassword) {
		//read id, type from code record
		//if exist set to 1 the done attribute on password_recover
		//and update the customer or author password
		$query = "";
		$query = "SELECT idUser, type FROM `password_recovery` WHERE code=? AND done=0";
		$result = execute_query($this->db, $query, array($code));
		$done = 1;
		if(count($result) > 0) {
			$idUser = $result[0]["idUser"];
			$type = $result[0]["type"];
			$query = "UPDATE `password_recovery` SET done=? WHERE idUser=? AND type=?";
			$result = execute_query($this->db, $query, array($done, $idUser, $type));
			switch ($type) {
				case "cliente":
				$query = "UPDATE `customer` SET password=? WHERE idCustomer=?";
				$result = execute_query($this->db, $query, array(password_hash($newPassword, PASSWORD_BCRYPT), $idUser));
				break;
				case "artista":
				$query = "UPDATE `author` SET password=? WHERE idAuthor=?";
				$result = execute_query($this->db, $query, array(password_hash($newPassword, PASSWORD_BCRYPT), $idUser));
				break;
			}
		}
		return $result;
 	}

 	public function registerCustomer($name, $surname, $email, $username, $password) {
		$query = "INSERT INTO `customer` (`name`, `surname`, `email`, `username`, `password`, `idCard`) VALUES (?, ?, ?, ?, ?, NULL)";
		return execute_query($this->db, $query, array($name, $surname, $email, $username, password_hash($password, PASSWORD_BCRYPT)));
 	}

	public function registerAuthor($artName, $email, $username, $password) {
		$query = "INSERT INTO `author` (`artName`, `email`, `username`, `password`) VALUES (?, ?, ?, ?)";
		return execute_query($this->db, $query, array($artName, $email, $username, password_hash($password, PASSWORD_BCRYPT)));
	}

	/* TODO: we have to manage cases with no results...*/ 
    public function getUserInfo($id, $type) {
		$query = "";
		switch ($type) {
			case "cliente":
				$query = "SELECT name, surname, email, username FROM `customer` WHERE idCustomer=?";
				break;
			case "artista":
				$query = "SELECT artName, email, username FROM `author` WHERE idAuthor=?";
				break;
			default:
				break;
		}
		return execute_query($this->db, $query, array($id));
 	}

	public function getUserInfoForToken($username, $type) {
		if($type == "cliente") {
			$query = "SELECT idCustomer, name, surname FROM customer WHERE username=?";
		}
		else if ($type == "artista") {
			$query = "SELECT idAuthor, artName FROM author WHERE username=?";
		}
		return execute_query($this->db, $query, array($username))[0];
 	}
    
	public function updateUserInfo($id, $type, $name, $surname, $username, $email) {
		$query = "";
		switch ($type) {
			case "cliente":
				$query = "UPDATE `customer` SET name=?, surname=?, email=?, username=? WHERE idCustomer=?";
				$params = array($name, $surname, $email, $username, $id);
				break;
			case "artista":
				$query = "UPDATE `author` SET artName=?, email=?, username=? WHERE idAuthor=?";
				$params = array($name, $email, $username, $id);
				break;
			default:
				break;
		}
		return execute_query($this->db, $query, $params);
 	}
	
}

$dbUserMgr = new DBUserMgr($db);

?>