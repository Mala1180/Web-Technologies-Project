<?php
require_once('utils.php');
require_once("db/dbconnector.php");
require_once("db/dbCardManager.php");
require_once("db/dbUserManager.php");
require_once("../vendor/autoload.php");
require_once('validate.php');
require_once('mail.php');

use Firebase\JWT\JWT;

if ($_SERVER["REQUEST_METHOD"] == "GET") {
	if(!isset($_GET["action"])) {
		send_error("An action is required");
		exit();
	}
	switch ($_GET["action"]) {
		default:
			send_error("Unknown action");
			break;
	}
} else if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if(!isset($_POST["action"])) {
		send_error("An action is required");
		exit();
	}
	switch ($_POST["action"]) {
		case "getCard":
            $idCustomer = $dbUserMgr->getUserInfoForToken(get_token_data()->username, "cliente")[0]["idCustomer"];
            $data = $dbCardMgr->getCard($idCustomer);
            send_data($data);
            break;
        case "addCard":
            $idCustomer = $dbUserMgr->getUserInfoForToken(get_token_data()->username, "cliente")[0]["idCustomer"];
            $data = $dbCardMgr->addCard($idCustomer, $_POST["holder"], $_POST["cardNumber"], $_POST["circuit"], $_POST["expiryDate"], $_POST["cvv"], $_POST["isDefault"]);
            send_data($data);
            break;
		default:
			send_error("Unknown action");
			break;
	}
}
?>