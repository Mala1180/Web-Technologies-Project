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

    public function getNotifications($userId, $type) {
        if($type == "cliente") {
            $query = "SELECT idNotification AS id, `subject`, `message`, notificationDate AS date, isRead
            FROM `notification`
            WHERE isDeleted = ? AND idCustomer = ?
            ORDER BY notificationDate DESC, idNotification DESC";
        } else if ($type == "artista") {
            $query = "SELECT idNotification AS id, `subject`, `message`, notificationDate AS date, isRead
            FROM `notification`
            WHERE isDeleted = ? AND idAuthor = ?
            ORDER BY notificationDate DESC, idNotification DESC";
        }
        
        return execute_query($this->db, $query, array("0", $userId));
    }
    
    public function getUnreadNotificationsNumber($userId, $type) {
        if($type == "cliente") {
            $query = "SELECT COUNT(*) AS unreadNotificationsNumber
                FROM `notification`
                WHERE isDeleted = ? 
                AND isRead = ?
                AND idCustomer = ?
                ORDER BY notificationDate DESC, idNotification DESC";
        } else if ($type == "artista") {
            $query = "SELECT COUNT(*) AS unreadNotificationsNumber
                FROM `notification`
                WHERE isDeleted = ? 
                AND isRead = ?
                AND idAuthor = ?
                ORDER BY notificationDate DESC, idNotification DESC";
        }
        return execute_query($this->db, $query, array("0", "0", $userId));
    }

    public function sendNotification($idUser, $type, $subject, $message) {
        $query = "INSERT INTO `notification` (`subject`, `message`, `notificationDate`, `isRead`, `isDeleted`, `idCustomer`, `idAuthor`) 
                VALUES (?,?,?,?,?,?,?)";
        if($type == "cliente") {
            return execute_query($this->db, $query, array($subject, $message, date("Y-m-d"), "0", "0", $idUser, NULL));
        } else if ($type == "artista") {
            return execute_query($this->db, $query, array($subject, $message, date("Y-m-d"), "0", "0", NULL, $idUser));
        }
        return false;
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
        $query = "UPDATE `notification` SET isDeleted=?, isRead=? WHERE idNotification=?";
        return execute_query($this->db, $query, array(1, 1, $notificationId));
    }
}

$dbNotificationMgr = new DBNotificationMgr($db);
?>
