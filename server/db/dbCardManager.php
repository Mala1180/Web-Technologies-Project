<?php
require_once("db/dbconnector.php");

class DBCardMgr {
 	private $db;
 	
 	public function __construct($dbConnection) {
 		$this->db = $dbConnection;

 		if($this->db->connect_error) {
 			die("Connessione al database fallita.");
 		}
 	}

    public function getCard($idCustomer) {
        $query = "SELECT idCard AS id, cardNumber AS number, holder, circuit, expiryDate
				  FROM creditCard
				  WHERE idCustomer = ?
				  AND isDeleted = 0";
		return execute_query($this->db, $query, array($idCustomer));
    }

    public function getCardId($idCustomer, $cardNumber) {
        $query = "SELECT idCard FROM creditCard WHERE idCustomer=? AND cardNumber=?";
		return execute_query($this->db, $query, array($idCustomer, $cardNumber));
    }

	public function addCard($idCustomer, $holder, $cardNumber, $circuit, $expiryDate, $cvv, $isDefault) {
		$query = "INSERT INTO `creditCard` (`holder`, `cardNumber`, `circuit`, `expiryDate`, `cvv`, `isDeleted`, `idCustomer`)
				  VALUES (?, ?, ?, ?, ?, ?, ?)";
		$isDeleted = 0;
		execute_query($this->db, $query, array($holder, $cardNumber, $circuit, $expiryDate, $cvv, $isDeleted, $idCustomer));
		var_dump($isDefault);
        if ($isDefault == "true") {
			/**
			 * User is setting this card as default.
			 */
			$this->setDefaultCard($idCustomer, $holder, $cardNumber, $circuit, $cvv, $expiryDate);
		} 
		return true;
 	}

	public function setDefaultCard($idCustomer, $holder, $cardNumber, $circuit, $cvv, $expiryDate) {
		/* Remove default  */
		$query = "SELECT idCard FROM creditCard WHERE holder=? AND cardNumber=? AND circuit=? AND cvv=? AND expiryDate=? AND idCustomer=?";
		$idCard = execute_query($this->db, $query, array($holder, $cardNumber, $circuit, $cvv, $expiryDate, $idCustomer))[0];
		$idCard = intval($idCard['idCard']);
		$query = "UPDATE `customer` SET idCard=? WHERE idCustomer=?";
		return execute_query($this->db, $query, array($idCard, $idCustomer));
	}
}
 $dbCardMgr = new DBCardMgr($db);
?>
