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
 		$query = "SELECT name, password FROM `customer` WHERE username=?";
 		$stmt = $this->db->prepare($query);
 		$stmt->bind_param("s", $username);
 		$stmt->execute();
 		$result = $stmt->get_result();
 		return $result->fetch_all(MYSQLI_ASSOC);
 	}

 	public function register($name, $surname, $email, $username, $password) {
		
 		$query = "INSERT INTO `customer` (`name`, `surname`, `email`, `username`, `password`, `idCard`) VALUES (?, ?, ?, ?, ?, NULL)";
 		$stmt = $this->db->prepare($query);
 		$stmt->bind_param("sssss", $name, $surname, $email, $username, $password);
 		$stmt->execute();
 		if($stmt->error) {
 			return false;
 		}
 		return true;
 	}

	public function getUserInfo($username) {
		$query = "SELECT idCustomer, name, surname, email, username FROM customer WHERE username=?";
		$stmt = $this->db->prepare($query);
		$stmt->bind_param("s", $username);
		$stmt->execute();
 		$result = $stmt->get_result();
 		return $result->fetch_all(MYSQLI_ASSOC);
 	}


	public function addCardToUser($username, $cardNumber, $circuit, $expiryDate) {

		$query = "INSERT INTO `creditCard` (`cardNumber`, `circuit`, `expiryDate`, `isDeleted`, `idCustomer`) VALUES (?, ?, ?, ?, ?)";
		
		$stmt = $this->db->prepare($query);
		$idCustomer = $this->getUserInfo($username)[0]["idCustomer"];
		$isDeleted = 0;
		$stmt->bind_param("sssii", $cardNumber, $circuit, $expiryDate, $isDeleted, $idCustomer);
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