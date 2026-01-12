<?php
require_once 'config/Database.php';

class BannerController {
    private $db;

    public function __construct(){
        $this->db = (new Database())->connect();
    }

    public function getActive(){
        $stmt = $this->db->query(
            "SELECT * FROM banners WHERE is_active = 1 ORDER BY created_at DESC LIMIT 1"
        );
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
