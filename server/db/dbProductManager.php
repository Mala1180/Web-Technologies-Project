<?php
require_once("db/dbconnector.php");
require_once("db/dbNotificationManager.php");
require_once("db/dbCartManager.php");

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
		global $dbCartMgr;
		global $dbNotificationMgr;
		$query = "UPDATE `product` SET isDeleted = 1 WHERE idProduct=?";
		execute_query($this->db, $query, array($idProduct));
		$clients = $dbCartMgr->removeDeletedProduct($idProduct);
		foreach($clients as $client) {
			$dbNotificationMgr->sendNotification($client['idCustomer'], "cliente",
			"Prodotto non disponibile", 
			"Un venditore ha rimosso un prodotto presente del tuo carrello");
		}
		return true;
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
		global $dbCartMgr;
		global $dbNotificationMgr;
		$query = "UPDATE `product` SET quantity=?, price=? WHERE idProduct=?";
		execute_query($this->db, $query, array($quantity, $price, $idProduct));
		$clients = $dbCartMgr->normalizeProductQuantity($idProduct);
		foreach($clients as $client) {
			$dbNotificationMgr->sendNotification($client['idCustomer'], "cliente",
			"Modifica disponibilità prodotto", 
			"Un venditore ha modificato la quantità disponibile di un prodotto presente del tuo carrello");
		}
		return true;
	}

	public function getCurrentQuantity($idProduct) {
		$query = "SELECT quantity FROM `product` WHERE idProduct=?";
		$results = execute_query($this->db, $query, array($idProduct));
		return count($results) > 0 ? $results[0]["quantity"] : 0;
 	}

	public function decreaseQuantity($idProduct, $quantity) {
		global $dbNotificationMgr;
		global $dbCartMgr;
		$currentQuantity = $this->getCurrentQuantity($idProduct);
		if($currentQuantity >= $quantity) {
			if ($currentQuantity == $quantity) {
				$idAuthor = $this->getProductAuthor($idProduct);
				$dbNotificationMgr->sendNotification($idAuthor, "artista", "Prodotto esaurito", "Controlla la lista prodotti, uno o più prodotti sono terminati");
			}
			
			$query = "UPDATE `product` SET quantity=? WHERE idProduct=?";
			execute_query($this->db, $query, array($currentQuantity - $quantity, $idProduct));
			$clients = $dbCartMgr->normalizeProductQuantity($idProduct);
			foreach($clients as $client) {
				$dbNotificationMgr->sendNotification($client['idCustomer'], "cliente",
				"Modifica disponibilità prodotto", 
				"La disponibilità di un prodotto presente nel tuo carrello è cambiata");
			}
			return true;
		}
		return false;
	}

	public function getProductIdAuthor($idProduct) {
		$query = "SELECT idAuthor FROM `product`, `author` WHERE idProduct=?";
		return execute_query($this->db, $query, array($idProduct));
 	}

	public function getProductAuthor($idProduct) {
		$query = "SELECT idAuthor FROM product p, album a WHERE p.idAlbum=a.idAlbum AND p.idProduct=?";
		$res = execute_query($this->db, $query, array($idProduct));
		return count($res) > 0 ? $res[0]["idAuthor"] : count($res);
 	}
	
	/* todo: move some bits to frontend? */
	 public function getProducts($idAuthor=-1, $name="", $type="") {
		$query = "SELECT a.name, artName, p.type, p.quantity, p.price, p.idProduct
					FROM product p, album a, author au
					WHERE p.idAlbum = a.idAlbum
					AND p.isDeleted = 0
					AND a.idAuthor = au.idAuthor";
		$params = array();
		if ($idAuthor > 0) {
			$query .= " AND au.idAuthor = ?";
			$params[] = $idAuthor;
		}
		if ($name != "") {
			$query .= " AND a.name LIKE ?";
			$params[] = "%".$name."%";
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
