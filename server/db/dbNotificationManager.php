<?php
require_once("db/dbconnector.php");

class DBNotificationMgr {
    private $db;

    public function __construct($dbConnection) {
        $this->db = $dbConnection;

        if($this->db->connect_error) {
            die("Connessione al database fallita.");
        }
    }

    public function getNotifications($customerId) {
        $query = "SELECT idNotification AS id, `subject`, `message`, notificationDate AS date, isRead
                FROM `notification`
                WHERE isDeleted = ? AND idCustomer = ?
                ORDER BY notificationDate DESC";
        return execute_query($this->db, $query, array("0", $customerId));
    }
    
    public function sendNotification($customerId, $subject, $message) {
        $query = "INSERT INTO `notification` (`subject`, `message`, notificationDate, isRead, isDeleted, customerId) 
                VALUES (?,?,?,?,?,?)";
        return execute_query($this->db, $query, array($subject, $message, date("Y-m-d"), 0, 0, $customerId));
    }

    public function readNotification($notificationId) {
        $query = "UPDATE `notification` SET isRead=? WHERE idNotification=?";
        return execute_query($this->db, $query, array(1, $notificationId));
    }

    public function unreadNotification($notificationId) {
        $query = "UPDATE `notification` SET isRead=? WHERE idNotification=?";
        return execute_query($this->db, $query, array(0, $notificationId));
    }

    public function deleteNotification($notificationId) {
        $query = "UPDATE `notification` SET isDeleted=? WHERE idNotification=?";
        return execute_query($this->db, $query, array(1, $notificationId));
    }
}

$dbNotificationMgr = new DBNotificationMgr($db);
?>
