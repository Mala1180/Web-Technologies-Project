<?php  
declare(strict_types=1);

require_once('utils.php');
require_once("db/dbconnector.php");
require_once("db/dbProductManager.php");
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
            case "getallproducts":
                send_data($dbProductMgr->getProducts());
                break;
            case "getvendorproducts":
                if (!is_vendor_logged()) {
                    send_error("A vendor must be logged");
                }
                $name = isset($_GET["name"]) ? $_GET["name"] : "";
                $type = isset($_GET["type"]) ? $_GET["type"] : "";
                send_data($dbProductMgr->getProducts(get_token_data()->userId, $name, $type));
            default:
            send_error("Unknown action");
                break;

        }
    } else if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(!isset($_POST["action"])) {
            send_error("An action is required");
            exit();
        }
        if (!is_vendor_logged()) {
            send_error("A vendor must be logged");
        }
        //è un post.
        switch ($_POST["action"]) {
            case "editProduct":
                checkParams($_POST, array("idProduct", "price", "quantity"));
                send_success($dbProductMgr->editProduct($_POST["idProduct"], $_POST["price"], $_POST["quantity"]));
                break;
            
            case "removeProduct":
                checkParams($_POST, array("idProduct"));
                send_success($dbProductMgr->removeProduct($_POST["idProduct"]));
                break;
            default:
                send_error("Unknown action");
                break;

        }
    }
?>