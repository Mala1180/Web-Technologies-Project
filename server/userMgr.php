<?php 
declare(strict_types=1);

require_once('utils.php');
require_once("db/dbconnector.php");
require_once("db/dbUserManager.php");
require_once('../vendor/autoload.php');
require_once('validate.php');

use Firebase\JWT\JWT;
    if($_SERVER["REQUEST_METHOD"] == "GET") {
        if(!isset($_GET["action"])) {
            send_error("An action is required");
            exit();
        }
        switch($_GET["action"]) {
            case "":
                break;
            default:
                break;
        }
        // è un get.
    } else if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(!isset($_POST["action"])) {
            send_error("An action is required");
            exit();
        }
        //è un post.
        switch ($_POST["action"]) {
            case "addcard":
                //da splittare BEARER
                $data = JWT::decode(substr(apache_request_headers()["Authorization"], 7, strlen(apache_request_headers()["Authorization"]) - 7), SECRET_KEY, [JWT_CRYPTO_ALGORITHM]);
                send_success($dbUserMgr->addCardToUser($data->data->username, $_POST["cardNumber"], $_POST["circuit"], $_POST["expiryDate"], $_POST["isDefault"]));
                break;
            case "requireUserInfo":
                $data = JWT::decode(apache_request_headers()["Authorization"], SECRET_KEY, [JWT_CRYPTO_ALGORITHM]);
                send_success($dbUserMgr->getUserInfo($data->data->username));
                break;
            default:
                break;
        }
    }

    function requireUserInfo($token) {     
        $data = JWT::decode($token, SECRET_KEY, [JWT_CRYPTO_ALGORITHM]);
        print(json_encode($GLOBALS["dbh"]->getUserInfo($data->data->username)));
    }
    function addCard($token, $cardNumber, $circuit, $expiryDate, $isDefault) {
        $data = JWT::decode($token, SECRET_KEY, [JWT_CRYPTO_ALGORITHM]);
        print($GLOBALS["dbh"]->addCardToUser($data->data->username, $cardNumber, $circuit, $expiryDate, $isDefault));
    }
?>