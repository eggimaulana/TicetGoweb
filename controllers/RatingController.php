<?php
require_once 'config/database.php';

class RatingController {
    private $db;

    public function __construct(){
        $this->db = (new Database())->connect();
    }

    public function add($userId, $eventId, $rating, $review){
        $stmt = $this->db->prepare(
            "INSERT INTO ratings (user_id, event_id, rating, review)
             VALUES (?, ?, ?, ?)"
        );
        return $stmt->execute([$userId, $eventId, $rating, $review]);
    }

    public function getByEvent($eventId){
        $stmt = $this->db->prepare(
            "SELECT r.rating, r.review, r.created_at, u.name
             FROM ratings r
             JOIN users u ON r.user_id = u.id
             WHERE r.event_id = ?
             ORDER BY r.created_at DESC"
        );
        $stmt->execute([$eventId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}