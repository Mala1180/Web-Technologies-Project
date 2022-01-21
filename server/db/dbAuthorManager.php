<?php
require_once("db/dbconnector.php");

class DBAuthorMgr {
 	private $db;
 	
 	public function __construct($dbConnection) {
 		$this->db = $dbConnection;

 		if($this->db->connect_error) {
 			die("Connessione al database fallita.");
 		}
 	}

 	public function addAuthor($artName) {
		$query = "INSERT INTO `author` (`artName`) VALUES (?)";
		return execute_query($this->db, $query, array($artName));
 	}

 	public function removeAuthor($idAuthor) {
 		$query = "DELETE FROM `author` WHERE idAuthor=?";
		return execute_query($this->db, $query, array($idAuthor));
 	}

    public function getAuthorName($idAuthor) {
		$query = "SELECT artName FROM `author` WHERE idAuthor=?";
		return execute_query($this->db, $query, array($idAuthor));
 	}
}

 $dbAuthorMgr = new DBAuthorMgr($db);
?>
