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

		$stmt = $this->db->prepare("SELECT MAX(idCustomer) AS oldId FROM customer");
		$stmt->execute();

		$newId = $stmt->get_result();
		$newId = $newId->fetch_object();
		$newId = $newId -> oldId;

		//se db vuoto. 
		if($newId == NULL){ $newId = 1;}
		else {$newId = $newId + 1;}
		
 		$query = "INSERT INTO `customer` (`idCustomer`, `name`, `surname`, `email`, `username`, `password`, `idCard`) VALUES (?, ?, ?, ?, ?, ?, NULL)";
 		$stmt = $this->db->prepare($query);
 		$stmt->bind_param("isssss", $newId, $name, $surname, $email, $username, $password);
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
		$stmt = $this->db->prepare("SELECT MAX(idCard) AS oldId FROM creditCard");
		$stmt->execute();

		$newId = $stmt->get_result();
		$newId = $newId->fetch_object();
		$newId = $newId -> oldId;

		//se db vuoto. 
		if($newId == NULL){ $newId = 1;}
		else {$newId = $newId + 1;}

		//$query = "INSERT INTO `creditCard` (`idCard`, `cardNumber`, `circuit`, `expiryDate`, `isDeleted`, `idCustomer`) VALUES (?, ?, ?, ?, ?, ?)";
		
		$query = "SELECT * FROM creditCard";

		$stmt = $this->db->prepare($query);
		$idCustomer = $this->getUserInfo($username)[0]["idCustomer"];
		//$stmt->bind_param("isssii", $newId, $cardNumber, $circuit, $expiryDate, 0, $idCustomer);
		$stmt->execute();
		$result = $stmt->get_result();
 		return var_dump($result->fetch_all(MYSQLI_ASSOC));
		// if($stmt->error) {
		// 	return false;
		// }
		// return true;
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