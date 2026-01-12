<?php
class User {
    private $db;

    public function __construct($db){
        $this->db = $db;
    }

    public function login($email){
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email=?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function register($name,$email,$password){
        $stmt = $this->db->prepare(
            "INSERT INTO users (name,email,password) VALUES (?,?,?)"
        );
        return $stmt->execute([$name,$email,password_hash($password,PASSWORD_DEFAULT)]);
    }
}
