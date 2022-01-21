<?php
require_once('utils.php');
require_once("db/dbconnector.php");
require_once("db/dbCartManager.php");
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
            send_data($dbCartMgr->getCart(1));
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