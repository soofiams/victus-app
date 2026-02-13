<?php
require_once __DIR__ . "/../../config/database.php";

class ProfileController {

    public function getProfile($user_id) {
        $db = new Database();
        $conn = $db->connect();

        $stmt = $conn->prepare("SELECT id, name, email, photo FROM users WHERE id = ?");
        $stmt->execute([$user_id]);

        return [
            "success" => true,
            "profile" => $stmt->fetch(PDO::FETCH_ASSOC)
        ];
    }

    public function updateProfile($user_id, $name, $email, $photo = null) {
        $db = new Database();
        $conn = $db->connect();

        $stmt = $conn->prepare("
            UPDATE users 
            SET name = ?, email = ?, photo = ?
            WHERE id = ?
        ");
        $stmt->execute([$name, $email, $photo, $user_id]);

        return ["success" => true, "message" => "Perfil atualizado"];
    }
}
