<?php
require_once('utils.php');
require_once("db/dbconnector.php");
require_once("db/dbUserManager.php");
require_once("../vendor/autoload.php");
require_once('validate.php');
require_once('mail.php');

use Firebase\JWT\JWT;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if(!isset($_POST["action"])) {
		send_error("An action is required");
		exit();
	}
	switch ($_POST["action"]) {
		case "login":
            checkParams($_POST, array("username", "password", "type"));
            if ($dbUserMgr->login($_POST["username"], $_POST["password"], $_POST["type"])) {
                /**
                 * Successful Login. Opinion: Refactor for the token adding a method to ourjwtclass :D, whad do you think?
                 */	
                $tokenId    = base64_encode(random_bytes(16));
                $createdAt   = new DateTimeImmutable();
                $username = $_POST["username"];
                $type = $_POST["type"];
                $userId = 0;
                switch($type) {
                    case "cliente":
                        $userId = $dbUserMgr->getUserInfoForToken($username, $type)["idCustomer"];
                        break;
                    case "artista":
                        $userId = $dbUserMgr->getUserInfoForToken($username, $type)["idAuthor"];
                        break;
                    case "shipper":
                        $userId = $dbUserMgr->getUserInfoForToken($username, $type)["idShipper"];
                        break;

                }
                $data = [
                    'createdAt'  => $createdAt->getTimestamp(),    // Issued at: time when the token was generated
                    'jti'  => $tokenId,                     		// Json Token Id: an unique identifier for the token
                    'iss'  => SERVER_NAME,                 			 // Issuer
                    'nbf'  => $createdAt->getTimestamp(),  			  // Not before
                    'data' => [                            			    // Data related to the signer user
                        'username' => $username,
                        'userId' => $userId,         				 // Username
                        'type' => $type
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
            /*
             * Is not mandatory (and actually useless) that client side calls this api.
             * For the server authorization is determined by the presence of
             * the Authorization header.
             */
            send_success(true);
			break;
		case "register":
            checkParams($_POST, array("type", "email", "username", "password"));
            if ($_POST["type"] == "cliente") {
                checkParams($_POST, array("name", "surname"));
                send_success($dbUserMgr->registerCustomer($_POST["name"], $_POST["surname"], $_POST["email"], $_POST["username"], $_POST["password"]));
            } else if ($_POST["type"] == "artista") {
                checkParams($_POST, array("artName"));
                send_success($dbUserMgr->registerAuthor($_POST["artName"], $_POST["email"], $_POST["username"], $_POST["password"]));
            }
			break;
		default:
			send_error("Unknown action");
			break;
	}
}
?>