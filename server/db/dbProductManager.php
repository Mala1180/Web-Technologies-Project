<?php
require_once("db/dbconnector.php");

class DBProductMgr {
 	private $db;
 	
 	public function __construct($dbConnection) {
 		$this->db = $dbConnection;

 		if($this->db->connect_error) {
 			die("Connessione al database fallita.");
 		}
 	}

 	public function addProduct($quantity, $price, $description, $type, $idAlbum) {
		$query = "INSERT INTO `product` (`quantity`, `price`, `description`, `type`, `idAlbum`) VALUES (?, ?, ?, ?, ?)";
		return execute_query($this->db, $query, array($quantity, $price, $description, $type, $idAlbum));
 	}

 	public function removeProduct($idProduct) {
 		$query = "DELETE FROM `product` WHERE idProduct=?";
		return execute_query($this->db, $query, array($idProduct));
 	}

    public function getProduct($idProduct) {
		$query = "SELECT * FROM `product` WHERE idProduct=?";
		return execute_query($this->db, $query, array($idProduct));
 	}

	public function modifyProduct($idProduct, $quantity, $price, $description, $type, $idAuthor, $idAlbum) {
		$query = "UPDATE `product` SET quantity=?, price=?, description=?, type=?, idAuthor=?, idAlbum=? WHERE idProduct=?";
		return execute_query($this->db, $query, array($quantity, $price, $description, $type, $idAuthor, $idAlbum, $idProduct));
 	}

	public function getCurrentQuantity($idProduct) {
		$query = "SELECT quantity FROM `product` WHERE idProduct=?";
		$results = execute_query($this->db, $query, array($idProduct));
		return count($results) > 0 ? $results[0]["quantity"] : 0;
 	}

	public function decreaseQuantity($idProduct, $quantity) {
		$currentQuantity = $this->getCurrentQuantity($idProduct)[0]["quantity"];
		if($currentQuantity >= $quantity) {
			$query = "UPDATE `product` SET quantity=? WHERE idProduct=?";
			return execute_query($this->db, $query, array($currentQuantity - $quantity, $idProduct));
		}
		return false;
	}

	// public function changeOrderQuantity($idOrder) {

	// 	$query = "SELECT idProduct, quantity FROM orderDetail WHERE idOrder=?";
	// 	// $currentQuantity = $this->getCurrentQuantity($idProduct)[0]["quantity"];
	// 	// if($currentQuantity >= $quantity) {
	// 	// 	$query = "UPDATE `product` SET quantity=? WHERE idProduct=?";
	// 	// }
	// 	return execute_query($this->db, $query, array($idOrder));
	// }

	public function getProductIdAuthor($idProduct) {
		$query = "SELECT idAuthor FROM `product` WHERE idProduct=?";
		return execute_query($this->db, $query, array($idProduct));
 	}

	public function getProductAuthor($idProduct) {
		$query = "SELECT artName FROM `product`, `author` WHERE idProduct=? AND product.idAuthor=author.idAuthor";
		return execute_query($this->db, $query, array($idProduct));
 	}
	
	public function getProducts() {
		$query = "SELECT * FROM product";
		return execute_query($this->db, $query);
	}
}

$dbProductMgr = new DBProductMgr($db);
?>
