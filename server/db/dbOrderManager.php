<?php
require_once("db/dbconnector.php");

class DBOrderMgr
 {
 	private $db;
 	
 	public function __construct($dbConnection) {
 		$this->db = $dbConnection;

 		if($this->db->connect_error) {
 			die("Connessione al database fallita.");
 		}
 	}

 	public function addOrder($state, $orderDate, $shippingDate, $deliveryDate, $idCustomer) {
		$query = "INSERT INTO `customerOrder` (`state`, `orderDate`, `shippingDate`, `deliveryDate`, `idCustomer`) VALUES (?, ?, ?, ?, ?)";
		$stmt = $this->db->prepare($query);
 		$stmt->bind_param("isssi", $state, $orderDate, $shippingDate, $deliveryDate, $idCustomer);
 		$stmt->execute();
		if($stmt->error) {
			return false;
		}
		return true;
 	}

    public function setShippingDate($idOrder, $shippingDate) {
        $query = "UPDATE `customerOrder` SET shippingDate=? WHERE idOrder=?";
		$stmt = $this->db->prepare($query);
 		$stmt->bind_param("si", $shippingDate, $idOrder);
 		$stmt->execute();
		if($stmt->error) {
			return false;
		}
		return true;
 	}

     public function setDeliveryDate($idOrder, $deliveryDate) {
        $query = "UPDATE `customerOrder` SET deliveryDate=? WHERE idOrder=?";
		$stmt = $this->db->prepare($query);
 		$stmt->bind_param("si", $deliveryDate, $idOrder);
 		$stmt->execute();
		if($stmt->error) {
			return false;
		}
		return true;
 	}

     public function changeState($idOrder, $state) {
        $query = "UPDATE `customerOrder` SET state=? WHERE idOrder=?";
		$stmt = $this->db->prepare($query);
 		$stmt->bind_param("ii", $state, $idOrder);
 		$stmt->execute();
		if($stmt->error) {
			return false;
		}
		return true;
 	}

 	public function getCustomerId($idOrder) {
        $query = "SELECT idCustomer FROM `customerOrder` WHERE idOrder=?";
 		$stmt = $this->db->prepare($query);
 		$stmt->bind_param("i", $idOrder);
 		$stmt->execute();
         $result = $stmt->get_result();
         return $result->fetch_all(MYSQLI_ASSOC);
 	}

     public function getCustomerInfos($idOrder) {
		$query = "SELECT idCustomer, name, surname, email, username FROM `customerOrder`, `customer` WHERE customerOrder.idCustomer=customer.idCustomer AND idOrder=?";
		$stmt = $this->db->prepare($query);
		$stmt->bind_param("i", $idOrder);
		$stmt->execute();
		$result = $stmt->get_result();
		return $result->fetch_all(MYSQLI_ASSOC);
 	}
}

 $dbOrderMgr = new DBOrderMgr($db);
?>
