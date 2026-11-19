<?php
header('Content-Type: application/json; charset=utf-8');
require __DIR__ . '/conexion.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['ok' => false, 'error' => 'Método no permitido']);
    exit;
}

$nombre = trim($_POST['nombre'] ?? '');
$comentario = trim($_POST['comentario'] ?? '');

if ($nombre === '' || $comentario === '') {
    http_response_code(400);
    echo json_encode(['ok' => false, 'error' => 'Por favor llena todos los campos']);
    exit;
}

try {
    $stmt = $pdo->prepare("INSERT INTO sugerencias (nombre, comentario) VALUES (?, ?)");
    $stmt->execute([$nombre, $comentario]);
    echo json_encode(['ok' => true]);
} catch (PDOException $e) {
    error_log($e->getMessage());
    http_response_code(500);
    echo json_encode(['ok' => false, 'error' => 'No se pudo guardar la sugerencia']);
}