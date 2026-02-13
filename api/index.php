<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: POST, OPTIONS");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}

header("Content-Type: application/json");

$host = "localhost";
$user = "root";
$pass = "";
$db = "victus";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "Erro ligação BD"]);
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data["email"]) || !isset($data["password"])) {
    echo json_encode(["success" => false, "message" => "Dados inválidos"]);
    exit;
}

$email = $data["email"];
$password = $data["password"];

$sql = "SELECT * FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {

    $user = $result->fetch_assoc();

    // comparação direta (SEM password_verify)
    if ($user["password"] == $password) {

        echo json_encode([
            "success" => true,
            "nome" => $user["nome"]
        ]);

    } else {
        echo json_encode([
            "success" => false,
            "message" => "Password errada"
        ]);
    }

} else {

    echo json_encode([
        "success" => false,
        "message" => "Email não encontrado"
    ]);
}
?>
