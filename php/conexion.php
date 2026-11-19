<?php
// Conexión a Supabase (PostgreSQL) usando PDO.
// Los datos se leen de variables de entorno (Render -> Environment).
// Nunca escribas la contraseña directamente en este archivo.

$host = getenv('DB_HOST');
$port = getenv('DB_PORT') ?: '5432';
$name = getenv('DB_NAME') ?: 'postgres';
$user = getenv('DB_USER');
$pass = getenv('DB_PASS');

try {
    $pdo = new PDO(
        "pgsql:host=$host;port=$port;dbname=$name;sslmode=require",
        $user,
        $pass,
        [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
    );
} catch (PDOException $e) {
    error_log('Error de conexión: ' . $e->getMessage());
    http_response_code(500);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(['ok' => false, 'error' => 'Error de conexión con la base de datos']);
    exit;
}
