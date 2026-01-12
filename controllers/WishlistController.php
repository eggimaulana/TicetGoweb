<?php
require_once 'config/database.php';

class WishlistController {
    private $db;

    public function __construct(){
        $this->db = (new Database())->connect();
    }

    public function add($userId, $eventId){
        $stmt = $this->db->prepare(
            "INSERT IGNORE INTO wishlists (user_id, event_id)
             VALUES (?, ?)"
        );
        return $stmt->execute([$userId, $eventId]);
    }

    public function remove($userId, $eventId){
        $stmt = $this->db->prepare(
            "DELETE FROM wishlists WHERE user_id=? AND event_id=?"
        );
        return $stmt->execute([$userId, $eventId]);
    }

    public function getByUser($userId){
        $stmt = $this->db->prepare(
            "SELECT e.*
             FROM wishlists w
             JOIN events e ON w.event_id = e.id
             WHERE w.user_id=?
             ORDER BY w.created_at DESC"
        );
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function isWishlisted($userId, $eventId){
        $stmt = $this->db->prepare(
            "SELECT id FROM wishlists WHERE user_id=? AND event_id=?"
        );
        $stmt->execute([$userId, $eventId]);
        return $stmt->fetch() !== false;
    }
}