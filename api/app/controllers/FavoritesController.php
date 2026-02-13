<?php
namespace App\Controllers;

require_once __DIR__ . "/../../config/database.php";

use Database;

class FavoritesController {

    // Obter favoritos de um utilizador
    public function getFavorites($user_id) {
        $db = new \Database();
        $conn = $db->connect();

        $stmt = $conn->prepare("
            SELECT v.* FROM favorites f 
            JOIN videos v ON f.video_id = v.id 
            WHERE f.user_id = ?
        ");
        $stmt->execute([$user_id]);
        $favorites = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return ["success" => true, "favorites" => $favorites];
    }

    // Marcar / desmarcar favorito
    public function toggleFavorite($user_id, $video_id) {
        $db = new \Database();
        $conn = $db->connect();

        $stmt = $conn->prepare("SELECT * FROM favorites WHERE user_id = ? AND video_id = ?");
        $stmt->execute([$user_id, $video_id]);
        $exists = $stmt->fetch(\PDO::FETCH_ASSOC);

        if ($exists) {
            $stmt = $conn->prepare("DELETE FROM favorites WHERE user_id = ? AND video_id = ?");
            $stmt->execute([$user_id, $video_id]);
            return ["success" => true, "message" => "Removido dos favoritos"];
        } else {
            $stmt = $conn->prepare("INSERT INTO favorites (user_id, video_id) VALUES (?, ?)");
            $stmt->execute([$user_id, $video_id]);
            return ["success" => true, "message" => "Adicionado aos favoritos"];
        }
    }

} // <-- esta chave fecha a classe corretamente
