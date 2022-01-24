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
            $idCustomer = get_token_data()->userId;
            $idOrder = $dbOrderMgr->addOrder(date("Y-m-d"), $idCustomer);
            if($idOrder > 0) {
                $dbNotificationMgr->sendNotification($idCustomer, "Ordine effettuato", "La ringraziamo per aver utilizzato UniboVinyl, verrà ricontattato quando spediremo il suo ordine.");
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
                $dbNotificationMgr->sendNotification($idCustomer, "Qualcosa è andato storto", "La preghiamo di effettuare nuovamente l'ordine, qualcosa è andato storto con il suo precedente ordine.");
                send_success(false);
            }
            break;
        case "changeState":
            $state = intval($_POST["state"]);
            if($state >= 0 && $state <= 2) {
                $idCustomer = get_token_data()->userId;
                switch($state) {
                    case 1: 
                        $orderDetails = $dbOrderMgr->getOrderDetails($_POST["idOrder"]);
                        foreach($orderDetails as $orderDetail) {
                            $esito = $dbProductMgr->decreaseQuantity($orderDetail["idProduct"], $orderDetail["quantity"]);
                            if(!$esito){
                                send_success(false);
                            }
                        }
                        $type = "spedito";
                        $dbNotificationMgr->sendNotification($idCustomer, "Ordine spedito", "Il suo ordine è stato spedito, le segnaleremo quando verrà consegnato.");
                    break;
                    //ordine spedito, da consegnare
                    case 2: 
                        $type = "consegnato";
                        $dbNotificationMgr->sendNotification($idCustomer, "Ordine consegnato", "Il suo ordine è stato consegnato, la ringraziamo per aver utilizzato UniboVinyl.");        
                    break;
                }
                $data = $dbOrderMgr->changeState($_POST["idOrder"], $state);
                $dbOrderMgr->setDate($_POST["idOrder"], $type, date("Y-m-d"));
                send_data($data);
            }
            send_success(false);
            break;
        case "setDate":
            //check if is one shipper get_token_data()->id or username.
            if($_POST["type"] == "spedito" || $_POST["type"] == "consegnato") {
                $data = $dbOrderMgr->setDate($_POST["idOrder"], $_POST["type"], date("Y-m-d"));
            }
            send_data($data);
            break;
        case "getOrder":
            //check if is one shipper get_token_data()->id or username.
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