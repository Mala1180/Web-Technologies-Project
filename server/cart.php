<?php
require_once('utils.php');
require_once("db/dbconnector.php");
require_once("db/dbCartManager.php");
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
		case "getcart":
			$idCustomer = $dbUserMgr->getUserInfoForToken(get_token_data()->username, "cliente")[0]["idCustomer"];
            send_data($dbCartMgr->getCart($idCustomer));
            break;
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
		case "setquantity":
            checkParams($_POST, array("idCartEntry", "quantity"));
            send_success($dbCartMgr->editProductQuantity($_POST["idCartEntry"], $_POST["quantity"]));
            break;
		case "addEntry":
				checkParams($_POST, array("idProduct"));
				$idCustomer = $dbUserMgr->getUserInfoForToken(get_token_data()->username, "cliente")[0]["idCustomer"];
				send_success($dbCartMgr->addToCart($_POST["idProduct"], $idCustomer, 1));
				break;
        case "removeentry":
            checkParams($_POST, array("idCartEntry"));
            send_success($dbCartMgr->removeCartEntry($_POST["idCartEntry"]));
            break;
		default:
			send_error("Unknown action");
			break;
	}
}
?>