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
        $idCard = $this->db->insert_id;
		if ($isDefault == "true") {
			/**
			 * User is setting this card as default.
			 */
			$this->setDefaultCard($idCard, $idCustomer);
		} 
		return true;
 	}

	public function setDefaultCard($idCard, $idCustomer) {
		/* Remove default  */
		if ($this->checkCardOwner($idCard, $idCustomer)) {
			$query = "UPDATE `customer` SET idCard = ? WHERE idCustomer = ?";
			execute_query($this->db, $query, array($idCard, $idCustomer));
			return true;
		}
	}

	public function isDefaultCard($idCard, $idCustomer) {
		$query = "SELECT idCard FROM customer WHERE idCustomer=?";
		$result = execute_query($this->db, $query, array($idCustomer));
		return $result[0]['idCard'] == $idCard;
	}

	public function deleteCard($idCard) {
		$query = "SELECT `idCard` FROM creditCard WHERE idCustomer = ?";
		//$cards = execute_query($this->db, $query, array(get_token_data()->userId));

		if ($this->checkCardOwner($idCard, get_token_data()->userId)) {
			$query = "UPDATE `creditCard` SET `isDeleted` = 1 WHERE `idCard` = ?";
			execute_query($this->db, $query, array($idCard));
			return true;
		} else {
			return false;
		}

		// foreach ($cards as $card) {
		// 	if ($card['idCard'] == $idCard) {
		// 		$query = "UPDATE `creditCard` SET `isDeleted`=1 WHERE idCard=?";
		// 		execute_query($this->db, $query, array($idCard));
		// 		return true;
		// 	}
		// }
		// return false;
	}

	/**
	 * Check if the card is owned by the customer.
	 * 
	 * @param  int $idCard
	 * @param  int $idCustomer
	 * @return bool
	 */
	public function checkCardOwner($idCard, $idCustomer) {
		$query = "SELECT idCard FROM creditCard WHERE idCard=? AND idCustomer=?";
		$result = execute_query($this->db, $query, array($idCard, $idCustomer));
		return count($result) > 0;
	}

}
 $dbCardMgr = new DBCardMgr($db);
?>
