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

 	public function addOrder($orderDate, $idCustomer) {
		$query = "INSERT INTO `customerOrder` (`state`, `orderDate`, `idCustomer`) VALUES (?, ?, ?)";
		execute_query($this->db, $query, array("effettuato", $orderDate,  $idCustomer));
		return $this->db->insert_id;
 	}

	public function getOrders() {
		$query = "SELECT idOrder, state, orderDate, shippingDate, deliveryDate FROM `customerOrder`";
		return execute_query($this->db, $query);
 	}
	
	public function getCustomerOrders($idCustomer) {
		$query = "SELECT idOrder AS id, state, orderDate, shippingDate, deliveryDate FROM `customerOrder` WHERE idCustomer = ?";
		return execute_query($this->db, $query, array($idCustomer));
 	}
	
	public function addOrderDetail($idProduct, $idOrder, $quantity, $subprice) {
		$query = "INSERT INTO `orderDetail` (`idProduct`, `idOrder`, `quantity`, `subprice`) VALUES (?, ?, ?, ?)";
		return execute_query($this->db, $query, array($idProduct, $idOrder, $quantity, $subprice));
 	}

	public function getOrderDetails($idOrder) {
		$query = "SELECT idProduct, quantity FROM orderDetail WHERE idOrder=?";
		return execute_query($this->db, $query, array($idOrder));
 	}

	public function setDate($idOrder, $type, $date) {
		if($type == "spedito") {
			$query = "UPDATE `customerOrder` SET shippingDate=? WHERE idOrder=?";
		} else if ($type == "consegnato"){
			$query = "UPDATE `customerOrder` SET deliveryDate=? WHERE idOrder=?";
		}
		return execute_query($this->db, $query, array($date, $idOrder));
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
