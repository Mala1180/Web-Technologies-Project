<?php
require_once("db/dbconnector.php");
require_once("dbProductManager.php");

class DBCartMgr {
 	private $db;
 	
 	public function __construct($dbConnection) {
 		$this->db = $dbConnection;

 		if($this->db->connect_error) {
 			die("Connessione al database fallita.");
 		}
 	}

	private function getCurrentQuantity($idProduct, $idCustomer) {
		$query = "SELECT quantity FROM cartEntry WHERE idProduct = ? AND idCustomer = ?";
		$results = execute_query($this->db, $query, array($idProduct, $idCustomer)); 
		return count($results) > 0 ? $results[0]["quantity"] : 0;
	}

	private function updateProductQuantity($idProduct, $idCustomer, $quantity) {
		$query = "UPDATE `cartEntry` SET quantity=? WHERE idProduct=? AND idCustomer = ?";
		return execute_query($this->db, $query, array($quantity, $idProduct, $idCustomer));
	}

 	public function addToCart($idProduct, $idCustomer, $quantity) {
		global $dbProductMgr;
		$currentQuantity = $this->getCurrentQuantity($idProduct, $idCustomer);
		if ($quantity + $currentQuantity > $dbProductMgr->getCurrentQuantity($idProduct)) {
			return false;
		} else if ($currentQuantity > 0) {
			return $this->updateProductQuantity($idProduct, $idCustomer, $currentQuantity + $quantity);
		}
		$query = "INSERT INTO `cartEntry` (`idProduct`, `idCustomer`, `quantity`) VALUES (?, ?, ?)";
		return execute_query($this->db, $query, array($idProduct, $idCustomer, $quantity));
 	}

	private function getProductIdFromCartEntry($idCartEntry) {
		$query = "SELECT idProduct FROM cartEntry WHERE idCartEntry = ? ";
		$results = execute_query($this->db, $query, array($idCartEntry));
		return count($results) > 0 ? $results[0]["idProduct"] : -1;
	}

 	public function removeCartEntry($idCartEntry) {
 		$query = "DELETE FROM `cartEntry` WHERE idCartEntry=?";
		return execute_query($this->db, $query, array($idCartEntry));
 	}

	public function editProductQuantity($idCartEntry, $quantity) {
		global $dbProductMgr;
		$query = "UPDATE `cartEntry` SET quantity=? WHERE idCartEntry=?";
		if($quantity > $dbProductMgr->getCurrentQuantity($this->getProductIdFromCartEntry($idCartEntry))) {
			return false;
		}
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
