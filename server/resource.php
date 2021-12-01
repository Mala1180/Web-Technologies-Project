<?php 
declare(strict_types=1);
require_once('utils.php');
require_once("db/dbconnector.php");
require_once('./vendor/autoload.php');
require_once('validate.php');
use Firebase\JWT\JWT;

$body = json_decode(file_get_contents('php://input'), true);

if(validate($body["Authorization"])) {
    printf("Questo è l'esito, se ti è arrivato vuol dire che il tuo token è valido");
}
?>
