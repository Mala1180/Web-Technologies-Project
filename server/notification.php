<?php  
declare(strict_types=1);

require_once('utils.php');
require_once("db/dbconnector.php");
require_once("db/dbNotificationManager.php");
require_once("db/dbUserManager.php");
require_once("../vendor/autoload.php");
require_once('validate.php');

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        if (!isset($_GET["action"])) {
            send_error("An action is required");
            exit();
        } 
        switch ($_GET["action"]) {
            /*
<<<<<<< HEAD
            * Get list of all notifications
            */
=======
             * Get list of all notifications
             */
>>>>>>> mala
            case "getnotifications":
                $idCustomer = $dbUserMgr->getUserInfoForToken(get_token_data()->username, "cliente")[0]["idCustomer"];
                $data = $dbNotificationMgr->getNotifications($idCustomer); // TODO: customer id must be taken from jwt
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
        //è un post.
        switch ($_POST["action"]) {
            case "readnotification":
                checkParams($_POST, array("notificationId")); // Should it be more specific? no
                send_success($dbNotificationMgr->readNotification($_POST["notificationId"]));
                break;
            case "unreadnotification":
                checkParams($_POST, array("notificationId")); // Should it be more specific? no
                send_success($dbNotificationMgr->unreadNotification($_POST["notificationId"]));
                break;
            case "deletenotification":
                checkParams($_POST, array("notificationId")); // Should it be more specific? no
                send_success($dbNotificationMgr->deleteNotification($_POST["notificationId"]));
                break;
            default:
                send_error("Unknown action");
                break;

        }
    }
?>