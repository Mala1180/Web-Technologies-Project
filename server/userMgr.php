<?php 
declare(strict_types=1);

require_once('utils.php');
require_once("db/dbconnector.php");
require_once("db/dbUserManager.php");
require_once('../vendor/autoload.php');
require_once('validate.php');

use Firebase\JWT\JWT;
    if(!isset($_REQUEST["action"])) {
        send_error("An action is required");
    }

    if($_SERVER["REQUEST_METHOD"] == "GET") {
        switch($_GET["action"]) {
            case "":
                break;
            default:
                break;
        }
    } else if ($_SERVER["REQUEST_METHOD"] == "POST") {
        switch ($_POST["action"]) {
            // case "requireUserInfo":
            //     $data = get_token_data();
            //     send_success($dbUserMgr->getUserInfo($data->username));
            //     break;
            case "getUserInfo":
                $data = $dbUserMgr->getUserInfo(get_token_data()->userId, get_token_data()->type);
                send_data($data);
                break;
            case "getUserType":
                send_data(is_user_logged() ? get_token_data()->type : "");
                break;
            case "updateUserInfo":
                $data = $dbUserMgr->updateUserInfo(get_token_data()->userId,
                                                   get_token_data()->type,
                                                   $_POST["name"],
                                                   $_POST["surname"],
                                                   $_POST["username"],
                                                   $_POST["email"]);
                send_data($data);
                break;
            default:
                break;
        }
    }
?>