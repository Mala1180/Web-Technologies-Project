<?php
require_once("db/dbconnector.php");

class DBAlbumMgr {
 	private $db;
 	
 	public function __construct($dbConnection) {
 		$this->db = $dbConnection;

 		if($this->db->connect_error) {
 			die("Connessione al database fallita.");
 		}
 	}

 	public function addAlbum($name, $description, $idAuthor, $duration) {
		$query = "INSERT INTO `album` (`name`, `description`, `idAuthor`, `duration`) VALUES (?, ?, ?, ?)";
		return execute_query($this->db, $query, array($name, $description, $idAuthor, $duration));
 	}

 	public function removeAlbum($idAlbum) {
 		$query = "DELETE FROM `album` WHERE idAlbum=?";
		return execute_query($this->db, $query, array($idAlbum));
 	}

    public function addSongToAlbum($idAlbum, $name, $duration) {
		$query = "INSERT INTO `song` (`idAlbum`, `name`, `duration`) VALUES (?, ?, ?)";
		return execute_query($this->db, $query, array($idAlbum, $name, $duration));
 	}

	public function modifySong($idAlbum, $name, $duration) {
		$query = "UPDATE `song` SET name=?, duration=? WHERE idAlbum=?";
		return execute_query($this->db, $query, array($idAlbum, $name, $duration));
 	}

    public function removeSong($idSong) {
        $query = "DELETE FROM `song` WHERE idSong=?";
       return execute_query($this->db, $query, array($idSong));
    }

	public function getAllGenre() {
		$query = "SELECT * FROM genre";
		return execute_query($this->db, $query);
 	}

}

$dbAlbumMgr = new DBAlbumMgr($db);
?>
