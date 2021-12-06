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
function get_token_from_bearer($authorization) {
    return substr($authorization, 7);
}

/*
 * Checks if an authorization header is presente and if
 * the token is valid 
 */
function is_user_logged() {
    if (!isset($request_headers["Authorization"])) {
        return false;
    }
    return validate(get_token_from_bearer($request_headers["Authorization"]));
}
?>