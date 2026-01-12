<?php
require_once 'config/database.php';
require_once 'models/User.php';

class AuthController {
    private $user;

    public function __construct(){
        $db = (new Database())->connect();
        $this->user = new User($db);
    }

    public function login($email, $password){
        $data = $this->user->login($email);
        if($data && password_verify($password, $data['password'])){
            $_SESSION['user'] = [
                'id' => $data['id'],
                'name' => $data['name'],
                'email' => $data['email'],
                'role'  => $data['role']
            ];
            return true;
        }
        return false;
    }

    public function register($name,$email,$password){
        return $this->user->register($name,$email,$password);
    }
}