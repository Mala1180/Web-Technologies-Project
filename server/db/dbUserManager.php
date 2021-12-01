<?php

require_once("db/dbconnector.php");

class DBUserMgr
 {
 	private $db;
 	
 	public function __construct($dbConnection) {
 		$this->db = $dbConnection;

 		if($this->db->connect_error) {
 			die("Connessione al database fallita.");
 		}
 	}

 	public function login($username) {
 		$query = "SELECT name, password FROM `customer` WHERE username=?";
 		$stmt = $this->db->prepare($query);
 		$stmt->bind_param("s", $username);
 		$stmt->execute();
 		$result = $stmt->get_result();
 		return $result->fetch_all(MYSQLI_ASSOC);
 	}

 	public function register($name, $surname, $email, $username, $password) {
		
 		$query = "INSERT INTO `customer` (`name`, `surname`, `email`, `username`, `password`, `idCard`) VALUES (?, ?, ?, ?, ?, NULL)";
 		$stmt = $this->db->prepare($query);
 		$stmt->bind_param("sssss", $name, $surname, $email, $username, $password);
 		$stmt->execute();
 		if($stmt->error) {
 			return false;
 		}
 		return true;
 	}

     public function getUserInfo($username) {
		$query = "SELECT idCustomer, name, surname, email, username FROM customer WHERE username=?";
		$stmt = $this->db->prepare($query);
		$stmt->bind_param("s", $username);
		$stmt->execute();
 		$result = $stmt->get_result();
 		return $result->fetch_all(MYSQLI_ASSOC);
 	}


	public function addCardToUser($username, $cardNumber, $circuit, $expiryDate, $isDefault) {
		$query = "INSERT INTO `creditCard` (`cardNumber`, `circuit`, `expiryDate`, `isDeleted`, `idCustomer`) VALUES (?, ?, ?, ?, ?)";	
		$stmt = $this->db->prepare($query);
		$idCustomer = $this->getUserInfo($username)[0]["idCustomer"];
		$isDeleted = 0;
		$stmt->bind_param("sssii", $cardNumber, $circuit, $expiryDate, $isDeleted, $idCustomer);
		$stmt->execute();
		if($stmt->error) {
			return false;
		}
		
		if($isDefault == 1){
			//la voglio impostare anche come predefinita.
			$this->setDefaultCard($username, $cardNumber, $circuit, $expiryDate);
		} 
		return true;
 	}

	public function setDefaultCard($username, $cardNumber, $circuit, $expiryDate) {
		
		$query = "SELECT idCard FROM creditCard WHERE cardNumber=? AND circuit=? AND expiryDate=? AND idCustomer=?";
		$stmt = $this->db->prepare($query);
		$idCustomer = $this->getUserInfo($username)[0]["idCustomer"];
		$stmt->bind_param("sssi", $cardNumber, $circuit, $expiryDate, $idCustomer);
		$stmt->execute();
 		$result = $stmt->get_result();
		$idCard = $result->fetch_array();
		$idCard = intval($idCard['idCard']);

		$query = "UPDATE `customer` SET idCard=? WHERE idCustomer=?";
		$stmt = $this->db->prepare($query);
		$stmt->bind_param("ii", $idCard, $idCustomer);
		$stmt->execute();
		if($stmt->error) {
			return false;
		}
		return true;
	}
 }

?>