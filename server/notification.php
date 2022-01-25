<?php  
declare(strict_types=1);

require_once('utils.php');
require_once("db/dbconnector.php");
require_once("db/dbNotificationManager.php");
require_once("db/dbUserManager.php");
require_once("../vendor/autoload.php");
require_once('validate.php');


    if (!(is_client_logged() || is_vendor_logged())) {
        send_error("A user must be logged");
    }
    
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        if (!isset($_GET["action"])) {
            send_error("An action is required");
            exit();
        } 
        switch ($_GET["action"]) {
            /*
             * Get list of all notifications
             */
            case "getnotifications":
                $idCustomer = get_token_data()->userId;
                $data = $dbNotificationMgr->getNotifications($idCustomer);
                send_data($data);
                break;
            default:
            send_error("Unknown action");
                break;

        }
    } else if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!isset($_POST["action"])) {
            send_error("An action is required");
            exit();
        }
        switch ($_POST["action"]) {
            case "readnotification":
                checkParams($_POST, array("notificationId"));
                send_success($dbNotificationMgr->readNotification($_POST["notificationId"]));
                break;
            case "unreadnotification":
                checkParams($_POST, array("notificationId"));
                send_success($dbNotificationMgr->unreadNotification($_POST["notificationId"]));
                break;
            case "deletenotification":
                checkParams($_POST, array("notificationId"));
                send_success($dbNotificationMgr->deleteNotification($_POST["notificationId"]));
                break;
            default:
                send_error("Unknown action");
                break;

        }
    }
?>