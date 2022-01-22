<?php
require_once('utils.php');
require_once("db/dbconnector.php");
require_once("db/dbOrderManager.php");
require_once("db/dbUserManager.php");
require_once("db/dbNotificationManager.php");
require_once("db/dbTransactionManager.php");
require_once("db/dbCartManager.php");
require_once("db/dbCardManager.php");
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
		case "addOrder":
            $idCustomer = $dbUserMgr->getUserInfoForToken(get_token_data()->username, "cliente")[0]["idCustomer"];
            $idOrder = $dbOrderMgr->addOrder(date("Y-m-d"), $idCustomer);
            if($idOrder > 0) {
                $dbNotificationMgr->sendNotification($idCustomer, "Ordine effettuato!", "La ringraziamo per aver utilizzato UniboVinyl");
                $cartElements = $dbCartMgr->getCart($idCustomer);
                foreach($cartElements as $cartElem) {
                    $dbCartMgr->removeCartEntry($cartElem["idCartEntry"]);
                    $tmpSubprice = intval($cartElem["quantity"]) * floatval($cartElem["price"]);
                    $data = $dbOrderMgr->addOrderDetail($cartElem["idProduct"], $idOrder, $cartElem["quantity"], $tmpSubprice);
                }
                $idCard = $dbCardMgr->getCardId($idCustomer, $_POST["cardNumber"])[0]["idCard"];
                if($idCard > 0){
                    $dbTransactionMgr->addTransaction($idOrder, date("Y-m-d"), $idCard);
                    send_data($data);
                }else {
                    send_data(false);
                }
            } else {
                $dbNotificationMgr->sendNotification($idCustomer, "Qualcosa è andato storto", "La preghiamo di effettuare nuovamente l'ordine, qualcosa è andato storto con il suo precedente ordine.");
                send_data(false);
            }
            break;
        case "getOrder":
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