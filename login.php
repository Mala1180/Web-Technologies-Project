<?php 

declare(strict_types=1);
use Firebase\JWT\JWT;

define("SECRET_KEY", "hellomyfriends,i'mthemadafakalongsecret:D");
require_once("db/dbconnector.php");
require_once('./vendor/autoload.php');


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
			$serverName = "192.168.64.2";
			$username = $user[0]["name"];

			// Create the token as an array
			// Expire -> 'exp'  => $expire, ..., ..., 
			$data = [
			    'createdAt'  => $createdAt->getTimestamp(),    // Issued at: time when the token was generated
			    'jti'  => $tokenId,                     		// Json Token Id: an unique identifier for the token
			    'iss'  => $serverName,                 			 // Issuer
			    'nbf'  => $createdAt->getTimestamp(),  			  // Not before
			    'data' => [                            			    // Data related to the signer user
			        'username' => $username,           				 // User name
			    ]
			];

			// Encode the array to a JWT string.
			echo JWT::encode(
			    $data,
			    SECRET_KEY, // My signing key
			    'HS512'     // Algorithm used to sign the token, see https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40#section-3
			);
		}
		else {
			//Not valid login.
			require("./index.php");
		}
	}
?>