<?php
declare(strict_types=1);

require_once('utils.php');
require_once('./vendor/autoload.php');

use Firebase\JWT\JWT;

function validate($JSONWebToken) {
    if(isset($JSONWebToken) && $JSONWebToken) {
        $token = JWT::decode((string)$JSONWebToken, SECRET_KEY, [JWT_CRYPTO_ALGORITHM]);
        $now = new DateTimeImmutable();

        if ($token->iss !== SERVER_NAME || $token->nbf > $now->getTimestamp())// || $token->exp < $now->getTimestamp() da aggiungere se aggiungiamo l'expiry
        {
            return false;
        }
        return true;
    }
}
?>