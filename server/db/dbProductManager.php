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
 		$query = "UPDATE `product` SET isDeleted = 1 WHERE idProduct=?";
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
	
	public function editProduct($idProduct, $price, $quantity) {
		$query = "UPDATE `product` SET quantity=?, price=? WHERE idProduct=?";
		return execute_query($this->db, $query, array($quantity, $price, $idProduct));
	}

	public function getCurrentQuantity($idProduct) {
		$query = "SELECT quantity FROM `product` WHERE idProduct=?";
		$results = execute_query($this->db, $query, array($idProduct));
		return count($results) > 0 ? $results[0]["quantity"] : 0;
 	}

	public function decreaseQuantity($idProduct, $quantity) {
		$currentQuantity = $this->getCurrentQuantity($idProduct);
		if($currentQuantity >= $quantity) {
			$query = "UPDATE `product` SET quantity=? WHERE idProduct=?";
			return execute_query($this->db, $query, array($currentQuantity - $quantity, $idProduct));
		}
		return false;
	}

	public function getProductIdAuthor($idProduct) {
		$query = "SELECT idAuthor FROM `product` WHERE idProduct=?";
		return execute_query($this->db, $query, array($idProduct));
 	}

	public function getProductAuthor($idProduct) {
		$query = "SELECT artName FROM `product`, `author` WHERE idProduct=? AND product.idAuthor=author.idAuthor";
		return execute_query($this->db, $query, array($idProduct));
 	}
	
	/* todo: move some bits to frontend? */
	 public function getProducts($idAuthor=-1, $name="", $type="") {
		$query = "SELECT a.name, artName, p.type, p.quantity, p.price, p.idProduct
					FROM product p, album a, author au
					WHERE p.idAlbum = a.idAlbum
					/*AND p.isDeleted = 0 */
					AND a.idAuthor = au.idAuthor";
		$params = array();
		if ($idAuthor > 0) {
			$query .= " AND au.idAuthor = ?";
			$params[] = $idAuthor;
		}
		if ($name != "") {
			$query .= " AND a.name LIKE ?";
			$params[] = $name;
		}
		if ($type != "") {
			$query .= " AND p.type = ?";
			$params[] = $type;
		}
		$results = execute_query($this->db, $query, $params);
		$data = array();
		foreach($results as $r) {
			$row = $r;
			$row["type"] = $row["type"] == 0 ? "CD" : "Vinile";
			$data[] = $row;
		}
		return $data;
	}
}

$dbProductMgr = new DBProductMgr($db);
?>
