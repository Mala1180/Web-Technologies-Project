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
            case "requireUserInfo":
                $data = get_token_data();
                send_success($dbUserMgr->getUserInfo($data->username));
                break;
            default:
                break;
        }
    }
?>