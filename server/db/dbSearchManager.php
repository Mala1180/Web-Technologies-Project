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
            $query = "SELECT `name`, `description`
                  FROM `product`
                  WHERE `name` LIKE ?";
            return execute_query($this->db, $query, array("%".$name."%"));
        } else {
            $query = "SELECT `name`, `description`
                  FROM `product`
                  WHERE `name` LIKE ?
                  AND `type` = ?";
            return execute_query($this->db, $query, array("%".$name."%", $filter));
        }
    
    }

}

$dbSearchMgr = new DBSearchMgr($db);
?>
