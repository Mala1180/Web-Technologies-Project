<?php 

declare(strict_types=1);

require_once('utils.php');
require_once("db/dbconnector.php");
require_once('./vendor/autoload.php');
require_once('validate.php');

use Firebase\JWT\JWT;

	$body = json_decode(file_get_contents('php://input'), true);

    if(validate($body["Authorization"])) {
        switch ($body["action"]) {
            case "myprofile":
                requireUserInfo($body["Authorization"]);
                break;
            case "addcard":
                addCard($body["Authorization"], $body["cardNumber"], $body["circuit"], $body["expiryDate"], $body["isDefault"]);
                break;
            case "action3":
                echo "action 3";
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