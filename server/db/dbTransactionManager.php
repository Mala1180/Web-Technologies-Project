<?php
require_once("db/dbconnector.php");

class DBTransactionMgr {
 	private $db;
 	
 	public function __construct($dbConnection) {
 		$this->db = $dbConnection;

 		if($this->db->connect_error) {
 			die("Connessione al database fallita.");
 		}
 	}

 	public function addTransaction($idOrder, $transactionDate, $idCard) {
		$query = "INSERT INTO `transaction` (`idOrder`, `transactionDate`, `idCard`) VALUES (?, ?, ?)";
		return execute_query($this->db, $query, array($idOrder, $transactionDate, $idCard));
 	}

 	public function otherTransaction($idProduct) {
 		$query = "DELETE FROM `product` WHERE idProduct=?";
		return execute_query($this->db, $query, array($idProduct));
 	}

}

$dbTransactionMgr = new DBTransactionMgr($db);
?>
