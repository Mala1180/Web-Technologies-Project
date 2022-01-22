<?php
require_once("db/dbconnector.php");

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

 	public function registerCustomer($name, $surname, $email, $username, $password) {
		$query = "INSERT INTO `customer` (`name`, `surname`, `email`, `username`, `password`, `idCard`) VALUES (?, ?, ?, ?, ?, NULL)";
		return execute_query($this->db, $query, array($name, $surname, $email, $username, password_hash($password, PASSWORD_BCRYPT)));
 	}

	public function registerAuthor($artName, $email, $username, $password) {
		$query = "INSERT INTO `author` (`artName`, `email`, `username`, `password`) VALUES (?, ?, ?, ?)";
		return execute_query($this->db, $query, array($artName, $email, $username, password_hash($password, PASSWORD_BCRYPT)));
	}

	/* TODO: we have to manage cases with no results...*/ 
    public function getUserInfo($username) {
		$query = "SELECT idCustomer, name, surname, email, username FROM customer WHERE username=?";
		return execute_query($this->db, $query, array($username));
 	}

	 public function getUserInfoForToken($username, $type) {
		 if($type == "cliente") {
			$query = "SELECT idCustomer, name, surname FROM customer WHERE username=?";
		 }
		 else if ($type == "artista"){
			$query = "SELECT idAuthor, artName FROM author WHERE username=?";
		 }
		return execute_query($this->db, $query, array($username));
 	}

	public function addCardToUser($username, $cardNumber, $circuit, $expiryDate, $isDefault) {
		$query = "INSERT INTO `creditCard` (`cardNumber`, `circuit`, `expiryDate`, `isDeleted`, `idCustomer`) VALUES (?, ?, ?, ?, ?)";
		$idCustomer = $this->getUserInfo($username)[0]["idCustomer"];
		$isDeleted = 0;
		execute_query($this->db, $query, array($cardNumber, $circuit, $expiryDate, $isDeleted, $idCustomer));
		if($isDefault == true){
			/**
			 * User is setting this card as default.
			 */
			$this->setDefaultCard($username, $cardNumber, $circuit, $expiryDate);
		} 
		return true;
 	}

	public function setDefaultCard($username, $cardNumber, $circuit, $expiryDate) {
		/* Remove default  */
		$query = "SELECT idCard FROM creditCard WHERE cardNumber=? AND circuit=? AND expiryDate=? AND idCustomer=?";
		$idCustomer = $this->getUserInfo($username)[0]["idCustomer"];
		$idCard = execute_query($this->db, $query, array($cardNumber, $circuit, $expiryDate, $idCustomer))[0];
		$idCard = intval($idCard['idCard']);
		$query = "UPDATE `customer` SET idCard=? WHERE idCustomer=?";
		return execute_query($this->db, $query, array($idCard, $idCustomer));
	}
}

$dbUserMgr = new DBUserMgr($db);

?>