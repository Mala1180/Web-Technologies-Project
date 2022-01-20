<?php
require_once("db/dbconnector.php");

class DBAuthorMgr {
 	private $db;
 	
 	public function __construct($dbConnection) {
 		$this->db = $dbConnection;

 		if($this->db->connect_error) {
 			die("Connessione al database fallita.");
 		}
 	}

 	public function addToCart($idProduct, $idCustomer, $quantity) {
		$query = "INSERT INTO `cartEntry` (`idProduct`, `idCustomer`, `quantity`) VALUES (?, ?, ?)";
		return execute_query($this->db, $query, array($idProduct, $idCustomer, $quantity));
 	}

 	public function removeFromChart($idProduct, $idCustomer) {
 		$query = "DELETE FROM `cartEntry` WHERE idProduct=? AND idCustomer=?";
		return execute_query($this->db, $query, array($idProduct, $idCustomer));
 	}

    public function modifyQuantityProduct($idProduct, $idCustomer, $quantity) {
        $query = "UPDATE `cartEntry` SET quantity=? WHERE idProduct=? AND idCustomer=?";
		return execute_query($this->db, $query, array($quantity, $idProduct, $idCustomer));
 	}
}

 $dbAuthorMgr = new DBAuthorMgr($db);
?>
