<?php
require_once("db/dbconnector.php");

class DBAuthorMgr
 {
 	private $db;
 	
 	public function __construct($dbConnection) {
 		$this->db = $dbConnection;

 		if($this->db->connect_error) {
 			die("Connessione al database fallita.");
 		}
 	}

 	public function addAuthor($artName) {
		$query = "INSERT INTO `author` (`artName`) VALUES (?)";
		$stmt = $this->db->prepare($query);
 		$stmt->bind_param("s", $artName);
 		$stmt->execute();
		if($stmt->error) {
			return false;
		}
		return true;
 	}

 	public function removeAuthor($idAuthor) {
 		$query = "DELETE FROM `author` WHERE idAuthor=?";
 		$stmt = $this->db->prepare($query);
 		$stmt->bind_param("i", $idAuthor);
 		$stmt->execute();
 		if($stmt->error) {
 			return false;
 		}
 		return true;
 	}

     public function getAuthorName($idAuthor) {
		$query = "SELECT artName FROM `author` WHERE idAuthor=?";
		$stmt = $this->db->prepare($query);
		$stmt->bind_param("i", $idAuthor);
		$stmt->execute();
		$result = $stmt->get_result();
		return $result->fetch_all(MYSQLI_ASSOC);
 	}
}

 $dbAuthorMgr = new DBAuthorMgr($db);
?>
