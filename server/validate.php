<?php
declare(strict_types=1);

require_once('utils.php');
require_once($_SERVER["DOCUMENT_ROOT"] . "/vendor/autoload.php");

use Firebase\JWT\JWT;
session_start();

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

function isUserSessionActive(){
    return !empty($_SESSION["token"]) && validate($_SESSION["token"]);
}

function registerLoggedUser($token){
    $_SESSION["token"] = $token;
}

function unregisterLoggedUser() {
    unset($_SESSION["token"]);
}

/*
 * Checks if an authorization header is presente and if
 * the token is valid 
 */
function is_user_logged($session=0) {
    $token = get_auth_token();
    return ($session && isUserSessionActive()) || ($token > "" && validate($token));
}

/*
 * Extracts data from token. This should be called
 * after verifying that user is actually logged in.
 */
function get_token_data($token = "") {
    return JWT::decode($token != "" ? $token : get_auth_token(), SECRET_KEY, [JWT_CRYPTO_ALGORITHM])->data;
}

function is_client_logged($session=0) {
    return is_user_logged($session) && get_token_data($session ? $_SESSION["token"] : "")->type == "cliente";
}

function is_vendor_logged($session=0) {
    return is_user_logged($session) && get_token_data($session ? $_SESSION["token"] : "")->type == "artista";
}

function is_shipper_logged($session=0) {
    return is_user_logged($session) && get_token_data($session ? $_SESSION["token"] : "")->type == "shipper";
}



?>