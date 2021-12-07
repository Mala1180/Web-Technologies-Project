<?php  
    declare(strict_types=1);

    require_once('utils.php');
    require_once("db/dbconnector.php");
    require_once("db/dbNotificationManager.php");
    require_once("../vendor/autoload.php");
    require_once('validate.php');

    use Firebase\JWT\JWT;

    if (is_user_logged()) {
        send_data(get_token_data(), SECRET_KEY, [JWT_CRYPTO_ALGORITHM]);
    } else {
        /*
         * Statud code 403 should be yelded
         */
        header("HTTP/1.1 403 Forbidden");
        // header("HTTP/1.1 401 Unauthorized")
        send_error("User is not logged in");
    }
?>