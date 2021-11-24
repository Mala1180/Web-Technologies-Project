<?php 

declare(strict_types=1);
use Firebase\JWT\JWT;

require_once('utils.php');
require_once("db/dbconnector.php");
require_once('./vendor/autoload.php');

$body = json_decode(file_get_contents('php://input'), true);

if(!isset($body["Authorization"])) {
    echo 'Token not found in request';
    exit;
}

$jwt = $body["Authorization"];
if (!$jwt) {
    // No token was able to be extracted from the authorization header
    header('HTTP/1.0 400 Bad Request');
    exit;
}

//JWT::$leeway += 60;
$token = JWT::decode((string)$jwt, SECRET_KEY, [JWT_CRYPTO_ALGORITHM]);
$now = new DateTimeImmutable();

if ($token->iss !== SERVER_NAME || $token->nbf > $now->getTimestamp())// || $token->exp < $now->getTimestamp() da aggiungere se aggiungiamo l'expiry
{
    header('HTTP/1.1 401 Unauthorized');
    exit;
}

//Il token è valido

printf("Questo è l'esito, se ti è arrivato vuol dire che il tuo token è valido");

 ?>
