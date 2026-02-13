<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

$conn = new mysqli("localhost", "root", "", "victus");

$result = $conn->query("SELECT * FROM videos");

$videos = [];

while ($row = $result->fetch_assoc()) {
    $videos[] = $row;
}

echo json_encode($videos);
?>
