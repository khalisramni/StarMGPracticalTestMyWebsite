<?php
require_once __DIR__ . '/../config.php'; // DB config

header('Content-Type: application/json');

// Read raw POST body
$input = file_get_contents('php://input');
$data = json_decode($input, true);

// Validate input
if (!$data || !isset($data['guid'], $data['date'], $data['version'])) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Invalid input']);
    exit();
}

// Sanitize values
$guid = $data['guid'];
$datetime = date('Y-m-d H:i:s', strtotime($data['date']));
$version = (int)$data['version'];

// Insert into DB
try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8mb4", $db_user, $db_pass);
    $stmt = $pdo->prepare("INSERT INTO user_consent (guid, consent_date, version) VALUES (?, ?, ?)");
    $stmt->execute([$guid, $datetime, $version]);

    echo json_encode(['status' => 'success']);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Database error']);
}
