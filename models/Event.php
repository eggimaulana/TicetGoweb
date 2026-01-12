<?php
require_once __DIR__ . '/../config/Database.php';

class Event {

    private $db;

    public function __construct(){
        $database = new Database();      // ⬅️ BENAR untuk PDO
        $this->db = $database->connect();
    }

    // ======================
    // Ambil 1 event
    // ======================
    public function find($id){
        $stmt = $this->db->prepare("SELECT * FROM events WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // ======================
    // Ambil semua event
    // ======================
    public function all(){
        $stmt = $this->db->query("SELECT * FROM events");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
