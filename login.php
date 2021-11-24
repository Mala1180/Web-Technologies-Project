<?php 

declare(strict_types=1);

require_once('utils.php');
require_once("db/dbconnector.php");
require_once('./vendor/autoload.php');

use Firebase\JWT\JWT;

	$body = json_decode(file_get_contents('php://input'), true);

	if(isset($body["username"]) && isset($body["password"])) {
		$user = $dbh->login($body["username"]);
		$password = $user[0]["password"];

		if ($user[0] && password_verify($body["password"], $password)) {
			//Successfull Login.
	
			//expire date commented for now.
			//$expire     = $issuedAt->modify('+6 minutes')->getTimestamp();      // Add 60 seconds
			$tokenId    = base64_encode(random_bytes(16));
			$createdAt   = new DateTimeImmutable();
			$username = $user[0]["name"];

			// Expire -> 'exp'  => $expire, ..., ..., 
			$data = [
			    'createdAt'  => $createdAt->getTimestamp(),    // Issued at: time when the token was generated
			    'jti'  => $tokenId,                     		// Json Token Id: an unique identifier for the token
			    'iss'  => SERVER_NAME,                 			 // Issuer
			    'nbf'  => $createdAt->getTimestamp(),  			  // Not before
			    'data' => [                            			    // Data related to the signer user
			        'username' => $username,           				 // User name
			    ]
			];

			echo JWT::encode(
			    $data,
			    SECRET_KEY,
			    JWT_CRYPTO_ALGORITHM
			);
		}
		else {
			//Not valid login.
			require("./index.php");
		}
	}
?>