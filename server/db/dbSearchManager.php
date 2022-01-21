<?php
require_once("db/dbconnector.php");
class DBSearchMgr {
    private $db;

    public function __construct($dbConnection) {
        $this->db = $dbConnection;

        if($this->db->connect_error) {
            die("Connessione al database fallita.");
        }
    }

    public function searchProducts($name, $filter) {
        if ($filter == "") {
<<<<<<< HEAD
            $query = "SELECT `name`, `description`
                  FROM `product`
                  WHERE `name` LIKE ?";
=======
            $query = "SELECT idProduct, name, type, quantity, product.description AS productDescription, 
                      album.description AS albumDescription, author.artName AS author, duration, price, imgPath
                      FROM product
                      INNER JOIN album ON product.idAlbum = album.idAlbum
                      INNER JOIN author ON album.idAuthor = author.idAuthor
                      AND name LIKE ?";
>>>>>>> mala
            return execute_query($this->db, $query, array("%".$name."%"));
        } else {
            $query = "SELECT idProduct, name, type, quantity, product.description AS productDescription, 
                      album.description AS albumDescription, author.artName AS author, duration, price, imgPath
                      FROM product
                      INNER JOIN album ON product.idAlbum = album.idAlbum
                      INNER JOIN author ON album.idAuthor = author.idAuthor
                      AND name LIKE ?
                      AND type = ?";
            return execute_query($this->db, $query, array("%".$name."%", $filter));
        }
    
    }

}

$dbSearchMgr = new DBSearchMgr($db);
?>
