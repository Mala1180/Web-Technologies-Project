<?php  
declare(strict_types=1);

require_once('utils.php');
require_once("db/dbconnector.php");
require_once("db/dbVendorManager.php");
require_once("db/dbProductManager.php");
require_once("db/dbAlbumManager.php");
require_once("db/dbUserManager.php");
require_once("../vendor/autoload.php");
require_once('validate.php');

    if($_SERVER["REQUEST_METHOD"] == "GET") {
        var_dump($_GET);
        if(!isset($_GET["action"])) {
            send_error("An action is required");
            exit();
        } 
        switch($_GET["action"]) {
            case "requestChange":
                $data = $dbUserMgr->addPasswordChangeReq($_GET["mail"], $_GET["type"]);
                send_data($data);
                break;
            case "recover":
                $data = $dbUserMgr->changePassword($_GET["code"], $_GET["newPassword"]);
                send_data($data);
                //var_dump($_GET["code"]);
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
            // case "recover":
            //     print_r($_POST["tempcode"]);
            //     break;
            default:
                send_error("Unknown action");
                break;

        }
    }
?>