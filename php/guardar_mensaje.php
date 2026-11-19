<?php
header('Content-Type: application/json; charset=utf-8');
require __DIR__ . '/conexion.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['ok' => false, 'error' => 'Método no permitido']);
    exit;
}

$nombre  = trim($_POST['nombre'] ?? '');
$correo  = trim($_POST['correo'] ?? '');
$mensaje = trim($_POST['mensaje'] ?? '');

if ($nombre === '' || $mensaje === '' || !filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode(['ok' => false, 'error' => 'Por favor llena todos los campos con datos válidos']);
    exit;
}

try {
    $stmt = $pdo->prepare("INSERT INTO mensajes (nombre, correo, mensaje) VALUES (?, ?, ?)");
    $stmt->execute([$nombre, $correo, $mensaje]);
    echo json_encode(['ok' => true]);
} catch (PDOException $e) {
    error_log($e->getMessage());
    http_response_code(500);
    echo json_encode(['ok' => false, 'error' => 'No se pudo guardar el mensaje']);
}
