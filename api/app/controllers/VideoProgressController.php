<?php
namespace App\Controllers;

require_once __DIR__ . "/../../config/database.php";

class VideoProgressController {

    public function getProgress($user_id) {
        $db = new \Database();
        $conn = $db->connect();

        $stmt = $conn->prepare("SELECT * FROM video_progress WHERE user_id = ?");
        $stmt->execute([$user_id]);
        $progress = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return ["success" => true, "progress" => $progress];
    }

    public function updateProgress($user_id, $video_id, $progress_seconds, $is_completed) {
        $db = new \Database();
        $conn = $db->connect();

        $stmt = $conn->prepare("SELECT * FROM video_progress WHERE user_id = ? AND video_id = ?");
        $stmt->execute([$user_id, $video_id]);
        $exists = $stmt->fetch(\PDO::FETCH_ASSOC);

        if ($exists) {
            $stmt = $conn->prepare("UPDATE video_progress SET progress_seconds = ?, is_completed = ?, updated_at = NOW() WHERE user_id = ? AND video_id = ?");
            $stmt->execute([$progress_seconds, $is_completed ? 1 : 0, $user_id, $video_id]);

        } else {
            $stmt = $conn->prepare("INSERT INTO video_progress (user_id, video_id, progress_seconds, is_completed) VALUES (?, ?, ?, ?)");
            $stmt->execute([$user_id, $video_id, $progress_seconds, $is_completed ? 1 : 0]);
        }

        return ["success" => true, "message" => "Progresso atualizado"];
    }
}

