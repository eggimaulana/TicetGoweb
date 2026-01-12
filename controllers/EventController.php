<?php
require_once "config/database.php";

class EventController {
    private $db;

    public function __construct(){
        $database = new Database();
        $this->db = $database->connect();
    }

    // Beranda
    public function index(){
        $stmt = $this->db->query("SELECT * FROM events");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Pencarian
    public function search($q){
        $stmt = $this->db->prepare(
            "SELECT * FROM events 
             WHERE title LIKE ? OR location LIKE ?"
        );
        $stmt->execute(["%$q%","%$q%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Detail
    public function detail($id){
        $stmt = $this->db->prepare("SELECT * FROM events WHERE id=?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Ambil 1 event untuk edit
    public function find($id){
        $stmt = $this->db->prepare("SELECT * FROM events WHERE id=?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update event
    public function update($id, $data){
        $stmt = $this->db->prepare(
            "UPDATE events 
            SET title=?, location=?, price=?, `desc`=?, image=?
            WHERE id=?"
        );
        return $stmt->execute([
            $data['title'],
            $data['location'],
            $data['price'],
            $data['desc'],
            $data['image'] ?? null,
            $id
        ]);
    }

    // Delete event
    public function delete($id){
        $stmt = $this->db->prepare("DELETE FROM events WHERE id=?");
        return $stmt->execute([$id]);
    }

    public function getByCategory($keyword){
        $db = (new Database())->connect();

        $stmt = $db->prepare("
            SELECT * FROM events 
            WHERE title LIKE ? 
            OR `desc` LIKE ?
        ");

        $like = '%' . $keyword . '%';
        $stmt->execute([$like, $like]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAll(){
        $db = (new Database())->connect();
        return $db->query("SELECT * FROM events ORDER BY created_at DESC")->fetchAll();
    }

}
