<?php
require_once("db/dbconnector.php");

class DBCartMgr {
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

 	public function removeCartEntry($idCartEntry) {
 		$query = "DELETE FROM `cartEntry` WHERE idCartEntry=?";
		return execute_query($this->db, $query, array($idCartEntry));
 	}

	public function editProductQuantity($idCartEntry, $quantity) {
		$query = "UPDATE `cartEntry` SET quantity=? WHERE idCartEntry=?";
		return execute_query($this->db, $query, array($quantity, $idCartEntry));
	}

	public function getCart($idCustomer) {
		$query = "SELECT idCartEntry, ce.idProduct, ce.quantity, price, p.type, name, artName, imgPath 
					FROM product p, album a, cartEntry ce, author au
					WHERE ce.idProduct = p.idProduct
					AND p.idAlbum = a.idAlbum
					AND a.idAuthor = au.idAuthor
					AND ce.idCustomer = ?";
		return execute_query($this->db, $query, array($idCustomer));
	}
}

 $dbCartMgr = new DBCartMgr($db);
?>
