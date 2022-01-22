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
            $query = "SELECT idProduct, name, type, quantity, author.artName AS author, price, imgPath
                      FROM product
                      INNER JOIN album ON product.idAlbum = album.idAlbum
                      INNER JOIN author ON album.idAuthor = author.idAuthor
                      AND name LIKE ?";
            return execute_query($this->db, $query, array("%".$name."%"));
        } else {
            $query = "SELECT idProduct, name, type, quantity, author.artName AS author, price, imgPath
                      FROM product
                      INNER JOIN album ON product.idAlbum = album.idAlbum
                      INNER JOIN author ON album.idAuthor = author.idAuthor
                      AND name LIKE ?
                      AND type = ?";
            return execute_query($this->db, $query, array("%".$name."%", $filter));
        }
    
    }

    public function getProductDetails($idProduct) {
        $query = "SELECT name, type, quantity, product.description AS productDescription, 
                  album.description AS albumDescription, author.artName AS author, 
                  album.duration AS albumDuration, price, imgPath
                  FROM product
                  INNER JOIN album ON product.idAlbum = album.idAlbum
                  INNER JOIN author ON album.idAuthor = author.idAuthor
                  WHERE idProduct = ?";
        $productDetails = execute_query($this->db, $query, array($idProduct));

        $query = "SELECT song.duration AS duration, song.name AS name
                  FROM product
                  INNER JOIN album ON product.idAlbum = album.idAlbum
                  INNER JOIN song ON product.idAlbum = song.idAlbum
                  WHERE idProduct = ?";
        $songs = execute_query($this->db, $query, array($idProduct));
        $query = "SELECT genre
                  FROM product
                  INNER JOIN album ON product.idAlbum = album.idAlbum
                  INNER JOIN album_genre ON product.idAlbum = album_genre.album
                  WHERE idProduct = ?";
        $genres = execute_query($this->db, $query, array($idProduct));
        return array($productDetails, $songs, $genres);
    }

}

$dbSearchMgr = new DBSearchMgr($db);
?>
