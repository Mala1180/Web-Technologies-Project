<?php
declare(strict_types=1);

require_once('utils.php');
require_once('../vendor/autoload.php');

use Firebase\JWT\JWT;

function validate($JSONWebToken) {
    if(isset($JSONWebToken) && $JSONWebToken) {
        $token = JWT::decode((string)$JSONWebToken, SECRET_KEY, [JWT_CRYPTO_ALGORITHM]);
        $now = new DateTimeImmutable();
        return $token->iss === SERVER_NAME && $token->nbf < $now->getTimestamp();
    }
}
/*
 * Gets the the jwt token from authorization header 
 */
function get_auth_token() {
    if (isset(getallheaders()["Authorization"])) {
        return substr(getallheaders()["Authorization"], 7);
    }
    return "";
}
/*
 * Checks if an authorization header is presente and if
 * the token is valid 
 */
function is_user_logged() {
    $token = get_auth_token();
    return $token > "" && validate($token);
}
/*
 * Extracts data from token. This should be called
 * after verifying that user is actually logged in.
 */
function get_token_data() {
    return JWT::decode(get_auth_token(), SECRET_KEY, [JWT_CRYPTO_ALGORITHM])->data;
}

function is_client_logged() {
    return is_user_logged() && get_token_data()->type = "cliente";
}

function is_vendor_logged() {
    return is_user_logged() && get_token_data()->type = "artista";
}

function is_shipper_logged() {
    return is_user_logged() && get_token_data()->type = "shipper";
}
?>