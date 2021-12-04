<?php
require_once("db/dbconnector.php");

class DBOrderMgr {
 	private $db;
 	
 	public function __construct($dbConnection) {
 		$this->db = $dbConnection;

 		if($this->db->connect_error) {
 			die("Connessione al database fallita.");
 		}
 	}

 	public function addOrder($state, $orderDate, $shippingDate, $deliveryDate, $idCustomer) {
		$query = "INSERT INTO `customerOrder` (`state`, `orderDate`, `shippingDate`, `deliveryDate`, `idCustomer`) VALUES (?, ?, ?, ?, ?)";
		return execute_query($this->db, $query, array($state, $orderDate, $shippingDate, $deliveryDate, $idCustomer));
 	}

    public function setShippingDate($idOrder, $shippingDate) {
        $query = "UPDATE `customerOrder` SET shippingDate=? WHERE idOrder=?";
		return execute_query($this->db, $query, array($shippingDate, $idOrder));
 	}

     public function setDeliveryDate($idOrder, $deliveryDate) {
        $query = "UPDATE `customerOrder` SET deliveryDate=? WHERE idOrder=?";
		return execute_query($this->db, $query, array($deliveryDate, $idOrder));
 	}

    public function changeState($idOrder, $state) {
        $query = "UPDATE `customerOrder` SET state=? WHERE idOrder=?";
		return execute_query($this->db, $query, array($state, $idOrder));
 	}

 	public function getCustomerId($idOrder) {
		$query = "SELECT idCustomer FROM `customerOrder` WHERE idOrder=?";
        return execute_query($this->db, $query, array($idOrder));
 	}

    public function getCustomerInfos($idOrder) {
		$query = "SELECT idCustomer, name, surname, email, username FROM `customerOrder`, `customer` WHERE customerOrder.idCustomer=customer.idCustomer AND idOrder=?";
		return execute_query($this->db, $query, array($idOrder));
 	}
}

$dbOrderMgr = new DBOrderMgr($db);
?>
