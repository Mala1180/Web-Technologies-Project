<?php
require_once("db/dbconnector.php");

class DBProductMgr
 {
 	private $db;
 	
 	public function __construct($dbConnection) {
 		$this->db = $dbConnection;

 		if($this->db->connect_error) {
 			die("Connessione al database fallita.");
 		}
 	}

 	public function addProduct($name, $quantity, $price, $description, $type, $idAuthor, $idAlbum) {
		$query = "INSERT INTO `product` (`name`, `quantity`, `price`, `description`, `type`, `idAuthor`, `idAlbum`) VALUES (?, ?, ?, ?, ?, ?, ?)";
		$stmt = $this->db->prepare($query);
 		$stmt->bind_param("sidsiii", $name, $quantity, $price, $description, $type, $idAuthor, $idAlbum);
 		$stmt->execute();
		if($stmt->error) {
			return false;
		}
		return true;
 	}

 	public function removeProduct($idProduct) {
 		$query = "DELETE FROM `product` WHERE idProduct=?";
 		$stmt = $this->db->prepare($query);
 		$stmt->bind_param("i", $idProduct);
 		$stmt->execute();
 		if($stmt->error) {
 			return false;
 		}
 		return true;
 	}

     public function getProduct($idProduct) {
		$query = "SELECT * FROM `product` WHERE idProduct=?";
		$stmt = $this->db->prepare($query);
		$stmt->bind_param("i", $idProduct);
		$stmt->execute();
		$result = $stmt->get_result();
		return $result->fetch_all(MYSQLI_ASSOC);
 	}


	public function modifyArticle($idProduct, $name, $quantity, $price, $description, $type, $idAuthor, $idAlbum) {
		$query = "UPDATE `product` SET name=?, quantity=?, price=?, description=?, type=?, idAuthor=?, idAlbum=? WHERE idProduct=?";
		$stmt = $this->db->prepare($query);

		$stmt->bind_param("sidsiiii", $name, $quantity, $price, $description, $type, $idAuthor, $idAlbum, $idProduct);
		$stmt->execute();
		if($stmt->error) {
			return false;
		}
		return true;
 	}

	public function getCurrentQuantity($idProduct) {
		$query = "SELECT quantity FROM `product` WHERE idProduct=?";
		$stmt = $this->db->prepare($query);
		$stmt->bind_param("i", $idProduct);
		$stmt->execute();
		$result = $stmt->get_result();
		return $result->fetch_all(MYSQLI_ASSOC);
 	}

	public function getProductIdAuthor($idProduct) {
		$query = "SELECT idAuthor FROM `product` WHERE idProduct=?";
		$stmt = $this->db->prepare($query);
		$stmt->bind_param("i", $idProduct);
		$stmt->execute();
		$result = $stmt->get_result();
		return $result->fetch_all(MYSQLI_ASSOC);
 	}

	public function getProductAuthor($idProduct) {
		$query = "SELECT artName FROM `product`, `author` WHERE idProduct=? AND product.idAuthor=author.idAuthor";
		$stmt = $this->db->prepare($query);
		$stmt->bind_param("i", $idProduct);
		$stmt->execute();
		$result = $stmt->get_result();
		return $result->fetch_all(MYSQLI_ASSOC);
 	}
}

 $dbProductMgr = new DBProductMgr($db);
?>
