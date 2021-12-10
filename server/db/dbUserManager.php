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

 	public function login($username) {
		$query = "SELECT name, password FROM `customer` WHERE username=?";
		return execute_query($this->db, $query, array($username));
 	}

 	public function register($name, $surname, $email, $username, $password) {
		$query = "INSERT INTO `customer` (`name`, `surname`, `email`, `username`, `password`, `idCard`) VALUES (?, ?, ?, ?, ?, NULL)";
		return execute_query($this->db, $query, array($name, $surname, $email, $username, $password));
 	}

	/* TODO: we have to manage cases with no results...*/ 
    public function getUserInfo($username) {
		$query = "SELECT idCustomer, name, surname, email, username FROM customer WHERE username=?";
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