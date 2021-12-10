<?php
require_once("db/dbconnector.php");

class DBVendorMgr {
 	private $db;
 	
 	public function __construct($dbConnection) {
 		$this->db = $dbConnection;

 		if($this->db->connect_error) {
 			die("Connessione al database fallita.");
 		}
 	}

     public function getVendorInfo() {
		$query = "";
		return execute_query($this->db, $query, array());
 	}
}

$dbVendorMgr = new DBVendorMgr($db);

?>