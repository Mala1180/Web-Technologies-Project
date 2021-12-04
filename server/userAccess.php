<?php
require_once('utils.php');
require_once("db/dbconnector.php");
require_once("db/dbUserManager.php");
require_once("../vendor/autoload.php");
require_once('validate.php');

use Firebase\JWT\JWT;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if(!isset($_POST["action"])) {
		send_error("An action is required");
		exit();
	}
	switch ($_POST["action"]) {
		case "login":
            checkParams($_POST, array("username", "password"));
            $user = $dbUserMgr->login($_POST["username"]);
            $password = $user[0]["password"];
            if ($user[0] && password_verify($_POST["password"], $password)) {
                /**
                 * Successful Login. Opinion: Refactor for the token adding a method to ourjwtclass :D, whad do you think?
                 */	
                $tokenId    = base64_encode(random_bytes(16));
                $createdAt   = new DateTimeImmutable();
                $username = $_POST["username"];
                $data = [
                    'createdAt'  => $createdAt->getTimestamp(),    // Issued at: time when the token was generated
                    'jti'  => $tokenId,                     		// Json Token Id: an unique identifier for the token
                    'iss'  => SERVER_NAME,                 			 // Issuer
                    'nbf'  => $createdAt->getTimestamp(),  			  // Not before
                    'data' => [                            			    // Data related to the signer user
                        'username' => $username,           				 // Username
                    ]
                ];
                send_data(JWT::encode(
                    $data,
                    SECRET_KEY,
                    JWT_CRYPTO_ALGORITHM
                ));
            }
            else {
                /**
                 * Login failed.
                 */	
                send_error("Invalid credentials");
            }      
			break;
		case "logout":
            echo "logout";
			break;
		case "register":
			checkParams($_POST, array("name", "surname", "email", "username", "password"));
			send_success($dbUserMgr->register($_POST["name"], $_POST["surname"], $_POST["email"], $_POST["username"], password_hash($_POST['password'], PASSWORD_BCRYPT)));
			break;
		default:
			send_error("Unknown action");
			break;
	}
}
?>