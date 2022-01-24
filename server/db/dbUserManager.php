<?php
require_once("db/dbconnector.php");
include_once('phpmailer.php');

class DBUserMgr {
 	private $db;
 	
 	public function __construct($dbConnection) {
 		$this->db = $dbConnection;

 		if($this->db->connect_error) {
 			die("Connessione al database fallita.");
 		}
 	}

 	public function login($username, $password, $type) {
		$query = "";
		if ($type == "cliente") {
			$query = "SELECT password FROM `customer` WHERE username=?";
		} else if ($type == "artista") {
			$query = "SELECT password FROM `author` WHERE username=?";
		}
		$result = execute_query($this->db, $query, array($username));
		return count($result) && password_verify($password, $result[0]["password"]);
 	}

	public function addPasswordChangeReq($mail, $type) {
		$query = "";
		$idUser=-1;
		$done = 0;
		if($type="cliente" || $type=="artista") {
			if ($type == "cliente") {
				$query = "SELECT idCustomer FROM `customer` WHERE email=?";
				$idUser = execute_query($this->db, $query, array($mail))[0]["idCustomer"];
			} else if ($type == "artista") {
				$query = "SELECT idAuthor FROM `author` WHERE email=?";
				$idUser = execute_query($this->db, $query, array($mail))[0]["idAuthor"];
			}			
			if($idUser > 0) {
				$tmpCode = "codicerandom";
				$query = "SELECT `idRecovery` FROM password_recovery WHERE idUser=? AND type=? AND done=?";
				$exist = execute_query($this->db, $query, array($idUser, $type, $done));
				if(count($exist) > 0) {
					//c'è gia una richiesta aperta.
					return false;
				}
				$query = "INSERT INTO `password_recovery` (`idUser`, `type`, `code`, `done`) VALUES (?, ?, ?, ?)";
				if(execute_query($this->db, $query, array($idUser, $type, $tmpCode, $done))){
					//albi1600@gmail.com
					//;
					//composer require phpmailer/phpmailer
					// $mail = new PHPMailer();
					// $mail->From = $email_rif;
					// $mail->FromName = $cliente;
					// $mail->Subject = $subject;
					// ////////// COSTRUISCE IL CORPO DELLA MAIL //////////
					// $body="<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">
					// \n<html>\n<head>\n<meta content=\"text/html;charset=ISO-8859-15\" http-
					// equiv=\"Content-Type\">\n<title>" .
					// "Registrazione su mio sito</title>\n</head>\n<body>\n" .
					// "<div style=\"border: 2px solid silver; padding: 2px; font-
					// family: Arial, Verdana; font-size: 12px; width: 500px;\">\n" .
					// " <div style=\"border: 1px solid #3FA9DE; padding: 2px;\">
					// \n" .
					// " <div style=\"border: 2px solid silver; padding: 2px;
					// \">" .
					// " <div style=\"text-align: center; padding-bottom: 5px;
					// \">" .
					// " <img style=\"margin-top: 5px; border: 1px solid silver;
					// \" src=\"http://www.sito.eu/it/images_web/logo_mail.jpg\" alt=\"MIO
					// SITO\">\n" .
					// " </div>" .
					// " <div>\n" .
					// " testo del messaggio\n" .
					// " </div>" .
					// " </div>\n" .
					// " </div>\n" .
					// "</div>\n" .
					// "</body>\n</html>";
					// $mail->Body = $body;
					// $mail->AltBody = strip_tags($body2);
					// $mail->Sender = $email_rif;
					// $mail->AddReplyTo($email_rif,$email_rif);
					// $mail->IsSMTP(); // telling the class to use SMTP
					// $mail->Host = $smtp_rif; // SMTP server
					// $mail->SMTPAuth = true; // turn on SMTP authentication
					// $mail->Username = $smtp_user; // SMTP username
					// $mail->Password = $smtp_pwd; // SMTP password
					// $mail->AddAddress($to);
					// @$mail->Send();
					// $mail->SmtpClose();
					// unset($mail);

					return true;
				}
			}
		}
		return false;
 	}

	 

	public function getMailFromCode($idUser, $type) {
		$query = "";
		$query = "SELECT code FROM `password_recovery` WHERE idUser=? AND type=?";
		$result = execute_query($this->db, $query, array($idUser, $type));
		if(count($result) > 0){

		}
		return count($result) > 0 ? $result[0]["code"] : "";
 	}

 	public function registerCustomer($name, $surname, $email, $username, $password) {
		$query = "INSERT INTO `customer` (`name`, `surname`, `email`, `username`, `password`, `idCard`) VALUES (?, ?, ?, ?, ?, NULL)";
		return execute_query($this->db, $query, array($name, $surname, $email, $username, password_hash($password, PASSWORD_BCRYPT)));
 	}

	public function registerAuthor($artName, $email, $username, $password) {
		$query = "INSERT INTO `author` (`artName`, `email`, `username`, `password`) VALUES (?, ?, ?, ?)";
		return execute_query($this->db, $query, array($artName, $email, $username, password_hash($password, PASSWORD_BCRYPT)));
	}

	/* TODO: we have to manage cases with no results...*/ 
    public function getUserInfo($username) {
		$query = "SELECT idCustomer, name, surname, email, username FROM customer WHERE username=?";
		return execute_query($this->db, $query, array($username));
 	}

	 public function getUserInfoForToken($username, $type) {
		 if($type == "cliente") {
			$query = "SELECT idCustomer, name, surname FROM customer WHERE username=?";
		 }
		 else if ($type == "artista"){
			$query = "SELECT idAuthor, artName FROM author WHERE username=?";
		 }
		return execute_query($this->db, $query, array($username));
 	}
}

$dbUserMgr = new DBUserMgr($db);

?>