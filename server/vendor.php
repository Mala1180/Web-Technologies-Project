<?php  
declare(strict_types=1);

require_once('utils.php');
require_once("db/dbconnector.php");
require_once("db/dbVendorManager.php");
require_once("db/dbProductManager.php");
require_once("db/dbAlbumManager.php");
require_once("../vendor/autoload.php");
require_once('validate.php');

    if($_SERVER["REQUEST_METHOD"] == "GET") {
        if(!isset($_GET["action"])) {
            send_error("An action is required");
            exit();
        } 
        switch($_GET["action"]) {
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
            case "addAlbum":
                $data = $dbAlbumMgr->addAlbum($_POST["name"], $_POST["description"], $_POST["idAuthor"], $_POST["duration"]);
                send_data($data);
                break;
            case "addProduct":
                $data = $dbProductMgr->addProduct($_POST["name"], $_POST["quantity"], $_POST["price"], $_POST["description"], $_POST["type"], $_POST["idAuthor"], $_POST["idAlbum"]);
                send_data($data);
                break;
            case "addSongToAlbum":
                $data = $dbAlbumMgr->addSongToAlbum($_POST["idAlbum"], $_POST["name"], $_POST["duration"]);
                send_data($data);
                break;
            case "removeProduct":
                $data = $dbProductMgr->removeProduct($_POST["idProduct"]);
                send_data($data);
                break;
            case "getProduct":
                $data = $dbProductMgr->getProduct($_POST["idProduct"]);
                send_data($data);
                break;
            case "getMyOrder":
                $data = $dbOrderMgr->getOrders($_POST["idVendor"]);
                send_data($data);
                break;
            default:
                send_error("Unknown action");
                break;

        }
    }
?>