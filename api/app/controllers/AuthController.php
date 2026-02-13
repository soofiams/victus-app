<?php
require_once __DIR__ . "/../../config/database.php";

class AuthController {

    // função de login de teste sem password hash
    public function loginTest($email, $password) {
        $db = new Database();
        $conn = $db->connect();

        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // teste simples: password fixa "1234"
        if ($user && $password === "sofiavictus2026") {
            return [
                "success" => true,
                "user" => [
                    "id" => $user['id'],
                    "name" => $user['name'],
                    "email" => $user['email']
                ]
            ];
        }

        return ["success" => false, "message" => "Credenciais invalidas"];
    }
}
