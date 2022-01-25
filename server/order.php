<?php
require_once('utils.php');
require_once("db/dbconnector.php");
require_once("db/dbOrderManager.php");
require_once("db/dbUserManager.php");
require_once("db/dbNotificationManager.php");
require_once("db/dbTransactionManager.php");
require_once("db/dbCartManager.php");
require_once("db/dbCardManager.php");
require_once("db/dbProductManager.php");
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
        case "paymentDetails":
            $userId = get_token_data()->userId;
            if ($dbCartMgr->hasProductsInCart($userId)) {
                send_data(array("totale"=>$dbCartMgr->getTotalCartPrice($userId)));
            } else {
                send_error("Nulla da pagare");
            }
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
		case "addOrder":
            if (!is_client_logged()) {
                send_error("A shipper must be logged");
            }
            $idCustomer = get_token_data()->userId;
            $idOrder = $dbOrderMgr->addOrder(date("Y-m-d"), $idCustomer);
            if($idOrder > 0) {
                $dbNotificationMgr->sendNotification($idCustomer, "cliente", "Ordine effettuato", "La ringraziamo per aver utilizzato UniboVinyl, verrà ricontattato quando spediremo il suo ordine.");
                $cartElements = $dbCartMgr->getCart($idCustomer);
                if (count($cartElements) <= 0) {
                    send_error("Nessun articolo in carrello");
                }
                foreach($cartElements as $cartElem) {
                    $dbCartMgr->removeCartEntry($cartElem["idCartEntry"]);
                    $tmpSubprice = intval($cartElem["quantity"]) * floatval($cartElem["price"]);
                    $data = $dbOrderMgr->addOrderDetail($cartElem["idProduct"], $idOrder, $cartElem["quantity"], $tmpSubprice);
                }
                $res = $dbCardMgr->getCardId($idCustomer, $_POST["cardNumber"]);
                if(count($res) > 0) {
                    $idCard = $res[0]["idCard"];
                } else {
                    send_success(false); 
                }
                if($idCard > 0){
                    $dbTransactionMgr->addTransaction($idOrder, date("Y-m-d"), $idCard);
                    send_success($data);
                }
                send_success(false);
            } else {
                $dbNotificationMgr->sendNotification($idCustomer, "cliente", "Qualcosa è andato storto", "La preghiamo di effettuare nuovamente l'ordine, qualcosa è andato storto con il suo precedente ordine.");
                send_success(false);
            }
            break;
        case "changeState":
            if (!is_shipper_logged()) {
                send_error("A shipper must be logged");
            }
            $state = intval($_POST["state"]);
            $idOrder = intval($_POST["idOrder"]);
            $authors = [];
            $authors1 = [];
            if($state >= 0 && $state <= 2) {
                $res = $dbOrderMgr->getCustomerId($idOrder);
                if(count($res) > 0) {
                    $idCustomer = $res[0]["idCustomer"];
                } else {
                    send_success(false);
                }
                switch($state) {
                    case 1: 
                        $orderDetails = $dbOrderMgr->getOrderDetails($idOrder);
                        foreach($orderDetails as $orderDetail) {
                            $esito = $dbProductMgr->decreaseQuantity($orderDetail["idProduct"], $orderDetail["quantity"]);                  
                            if(!$esito){
                                send_success(false);
                            }
                            array_push($authors, $dbProductMgr->getProductAuthor($orderDetail["idProduct"]));
                        }
                        $authors = array_unique($authors);
                        foreach($authors as $author) {
                            $dbNotificationMgr->sendNotification($author, "artista", "Ordine #".$idOrder." spedito", "L' ordine #".$idOrder." è stato spedito, le segnaleremo quando verrà consegnato.");
                        }
                        $type = "spedito";
                        $dbNotificationMgr->sendNotification($idCustomer, "cliente", "Ordine #".$idOrder." spedito", "L' ordine #".$idOrder." è stato spedito, le segnaleremo quando verrà consegnato.");
                    break;
                    case 2: 
                        $orderDetails = $dbOrderMgr->getOrderDetails($idOrder);
                        foreach($orderDetails as $orderDetail) {
                            array_push($authors, $dbProductMgr->getProductAuthor($orderDetail["idProduct"]));
                        }
                        $authors = array_unique($authors);
                        foreach($authors as $author) {
                            $dbNotificationMgr->sendNotification($author, "artista", "Ordine #".$idOrder." consegnato", "L' ordine #".$idOrder." è stato consegnato, la ringraziamo per aver utilizzato UniboVinyl.");
                        }
                        $type = "consegnato";
                        $dbNotificationMgr->sendNotification($idCustomer, "cliente", "Ordine #".$idOrder." consegnato", "L' ordine #".$idOrder." è stato consegnato, la ringraziamo per aver utilizzato UniboVinyl.");        
                    break;
                }
                $data = $dbOrderMgr->changeState($idOrder, $state);
                $dbOrderMgr->setDate($idOrder, $type, date("Y-m-d"));
                send_data($data);
            }
            send_success(false);
            break;
        case "setDate":
            if (!is_shipper_logged()) {
                send_error("A shipper must be logged");
            }
            
            if($_POST["type"] == "spedito" || $_POST["type"] == "consegnato") {
                $data = $dbOrderMgr->setDate($_POST["idOrder"], $_POST["type"], date("Y-m-d"));
            }
            send_data($data);
            break;
        case "getOrder":
            //check if is one shipper get_token_data()->id or username.
            if (!is_shipper_logged()) {
                send_error("A shipper must be logged");
            }
            $orders = $dbOrderMgr->getOrders();
            $ordersDetails = [];
            $tot = [];  
            foreach($orders as $order) {
                $tmpOrder = [];
                $tmpOrder["order"] = [];
                $tmpOrder["products"] = [];
                $orderDetails = $dbOrderMgr->getOrderDetails($order["idOrder"]);
                array_push($tmpOrder["order"], $order);
                array_push($tmpOrder["products"], $orderDetails);
                array_push($tot, $tmpOrder);
            }
            send_data($tot);
            break;
        case "getCustomerOrders":
            if (!is_client_logged()) {
                send_error("A client must be logged");
            }
            $idCustomer = get_token_data()->userId;
            $orders = $dbOrderMgr->getCustomerOrders($idCustomer);
            $ordersDetails = [];
            $tot = [];  
            foreach($orders as $order) {
                $tmpOrder = [];
                $tmpOrder["order"] = [];
                $tmpOrder["products"] = [];
                $orderDetails = $dbOrderMgr->getOrderDetails($order["idOrder"]);
                array_push($tmpOrder["order"], $order);
                array_push($tmpOrder["products"], $orderDetails);
                array_push($tot, $tmpOrder);
            }

            send_data($tot);
            break;
		default:
			send_error("Unknown action");
			break;
	}
}
?>