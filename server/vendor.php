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
                $imgName = preg_replace('/\s+/', '_', $_POST["name"]);      
                $imgData = $_POST["image"];
                list($type, $imgData) = explode(';', $imgData);
                list(, $imgData)      = explode(',', $imgData);
                $imgData = base64_decode($imgData);
                file_put_contents('../public/img/products/'.$imgName.'.png', $imgData);

                $idAuthor = get_token_data()->userId;
                $data = $dbAlbumMgr->addAlbum($_POST["name"], $_POST["description"], $idAuthor, $_POST["duration"], $imgName.'.png');

                if($data) {
                    $idAlbum = $dbAlbumMgr->getIdFromTitleAndIdAuthor($idAuthor, $_POST["name"])[0]["idAlbum"];
                    $dbAlbumMgr->setAlbumGenre($idAlbum, $_POST["genre"]);
                    $songs = $_POST["songs"];
                    foreach ($songs as $song) {
                        $dbAlbumMgr->addSongToAlbum($idAlbum, $song["title"], $song["duration"]);
                    }  
                    $products = $_POST["products"];
                    foreach ($products as $product) {
                        $dbProductMgr->addProduct($product[0]["copy"], $product[0]["price"], $product[0]["description"], $product[0]["type"], $idAlbum);
                
                    }
                send_data($data);
                }
                break;
            case "addProduct":
                $idAuthor = get_token_data()->userId;
                $idAlbum = $dbAlbumMgr->getIdFromTitleAndIdAuthor($idAuthor, $_POST["albumTitle"])[0]["idAlbum"];
                $data = $dbProductMgr->addProduct($_POST["quantity"], $_POST["price"], $_POST["description"], $_POST["type"], $idAuthor, $idAlbum);
                send_data($data);
                break;
            case "addSongToAlbum":
                $idAlbum = $dbAlbumMgr->getIdFromTitleAndIdAuthor($dbUserMgr->getUserInfoForToken(get_token_data()->username, "artista")[0]["idAuthor"], $_POST["albumTitle"])[0]["idAlbum"];
                $data = $dbAlbumMgr->addSongToAlbum($idAlbum, $_POST["name"], $_POST["duration"]);
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
            case "getAllGenre":
                $data = $dbAlbumMgr->getAllGenre();
                send_data($data);
                break;
            case "setAlbumGenre":
                $idAuthor = get_token_data()->userId;
                $idAlbum = $dbAlbumMgr->getIdFromTitleAndIdAuthor($idAuthor, $_POST["albumTitle"])[0]["idAlbum"];
                $data = $dbAlbumMgr->setAlbumGenre($idAlbum, $_POST["genre"]);
                send_data($data);
                break;
            default:
                send_error("Unknown action");
                break;

        }
    }
?>