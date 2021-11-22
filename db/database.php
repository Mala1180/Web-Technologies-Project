<?php 

// require "vendor/autoload.php";
// use \Firebase\JWT\JWT;
 class DatabaseHelper
 {
 	private $db;
 	
 	public function __construct($servername, $username, $password, $dbname, $port) {
 		$this->db = new mysqli($servername, $username, $password, $dbname, $port);

 		if($this->db->connect_error) {
 			die("Connessione al database fallita.");
 		}
 	}

 	public function login($username) {
 		$query = "SELECT name, password FROM `user` WHERE email=?";
 		$stmt = $this->db->prepare($query);
 		$stmt->bind_param("s", $username);
 		$stmt->execute();
 		$result = $stmt->get_result();
 		return $result->fetch_all(MYSQLI_ASSOC);
 	}

 	public function register($name, $surname, $birthDate, $email, $password) {
 		$query = "INSERT INTO `user` (`name`, `surname`, `birthDate`, `email`, `password`) VALUES (?, ?, ?, ?, ?)";
 		$stmt = $this->db->prepare($query);
 		$stmt->bind_param("sssss", $name, $surname, $birthDate, $email, $password);
 		$stmt->execute();
 		if($stmt->error) {
 		return false;
 		}
 		return true;
 	}

 	/*Please don't remove this metafunction, thanks.*/
 	public function funzione($parameter = "default") {
 		$query = "SQL FORMAT";
 		$stmt = $this->db->prepare($query);
 		$stmt->bind_param("i", $n);
 		$stmt->execute();
 		$result = $stmt->get_result();
 		if($stmt->error){
 			die("Errore.");
 		}
 		return $result->fetch_all(MYSQLI_ASSOC);
 	}
 } 
?>