<?php  
declare(strict_types=1);

require_once('utils.php');
require_once("db/dbconnector.php");
require_once("db/dbSearchManager.php");
require_once("../vendor/autoload.php");
require_once('validate.php');

    if($_SERVER["REQUEST_METHOD"] == "GET") {
        if(!isset($_GET["action"])) {
            send_error("An action is required");
            exit();
        } 
        switch($_GET["action"]) {
            /*
             * Get list of all notifications
             */
            case "search":
                $data = $dbSearchMgr->searchProducts($_GET["query"], $_GET["filter"]);
                send_data($data);
                break;
            default:
            send_error("Unknown action");
                break;

        }
    } else if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(!isset($_POST["action"])) {
            send_error("An action is required");
            exit();
        }
        //è un post.
        switch ($_POST["action"]) {

            default:
                send_error("Unknown action");
                break;

        }
    }
?>