<?php

class ProfileController {
    public static function update($conn, $id, $name, $email) {
        return $conn->query("
            UPDATE users SET 
                name='$name',
                email='$email'
            WHERE id='$id'
        ");
    }

    public static function changePassword($conn, $id, $old, $new) {
        // cek password lama
        $query = $conn->query("SELECT password FROM users WHERE id='$id'");
        $user = $query->fetch_assoc();

        if (!password_verify($old, $user['password'])) {
            return "wrong_old_password";
        }

        $newHash = password_hash($new, PASSWORD_DEFAULT);

        return $conn->query("
            UPDATE users SET password='$newHash' WHERE id='$id'
        ");
    }
}