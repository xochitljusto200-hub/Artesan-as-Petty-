<?php
require 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_producto   = intval($_POST['id_producto'] ?? 0);
    $cantidad      = max(1, min(50, intval($_POST['cantidad'] ?? 1)));
    $calle         = $_POST['calle'] ?? '';
    $municipio     = $_POST['municipio'] ?? '';
    $cp            = $_POST['cp'] ?? '';
    $telefono      = $_POST['telefono'] ?? '';
    $instrucciones = $_POST['instrucciones'] ?? '';
    $metodo_pago   = $_POST['metodo_pago'] ?? '';
    
    $stmt = $pdo->prepare("SELECT precio, nombre FROM productos WHERE id = ?");
    $stmt->execute([$id_producto]);

    if ($row = $stmt->fetch()) {
        $total = $row['precio'] * $cantidad;
        $nombre_prod = $row['nombre'];
    } else {
        echo "Producto no válido.";
        exit;
    }

    try {
        $insert = $pdo->prepare("INSERT INTO pedidos (id_producto, cantidad, total, calle, municipio, cp, telefono, instrucciones, metodo_pago) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $insert->execute([$id_producto, $cantidad, $total, $calle, $municipio, $cp, $telefono, $instrucciones, $metodo_pago]);
        $exito = true;
    } catch (PDOException $e) {
        error_log($e->getMessage());
        $exito = false;
        $error_msg = 'No se pudo registrar el pedido.';
    }
} else {
    header("Location: ../index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<title>Pedido Registrado - Artesanías Petty</title>
<link href="https://fonts.googleapis.com/css2?family=Patrick+Hand&family=Quicksand:wght@400;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="../css/style.css">
</head>
<body>

<header>
  <div class="logo"><img class="lg" src="../img/logo.jpg" alt="Logo Artesanías Petty">Artesanías Petty</div>
  <nav id="nav">
    <a href="../index.php#inicio">Inicio</a>
    <a href="../index.php#productos">Productos</a>
    <a href="../index.php#contacto">Contacto</a>
  </nav>
</header>

<div class="wrap" style="background: rgb(255, 255, 255); text-align: center;">
<section>
    <?php if (isset($exito) && $exito): ?>
        <h2 style="color: rgb(238, 111, 160);">¡Pedido Realizado con Éxito! 💗</h2>
        <p class="sub" style="margin-top: 10px;">Hemos recibido tu orden para <strong><?php echo htmlspecialchars($nombre_prod); ?></strong> (<?php echo $cantidad; ?> pieza/s).</p>
        <p style="margin: 15px 0; font-weight: 600;">Total a pagar: $<span style="color: rgb(238, 111, 160); font-size: 1.3rem;"><?php echo number_format($total, 2); ?></span> MXN</p>
        <p style="color: rgb(107, 79, 70); font-size: 0.95rem;">Nos pondremos en contacto al teléfono <strong><?php echo htmlspecialchars($telefono); ?></strong> y enviaremos tu pedido a <strong><?php echo htmlspecialchars($calle); ?>, <?php echo htmlspecialchars($municipio); ?></strong>.</p>
    <?php else: ?>
        <h2 style="color: #d9534f;">Hubo un error</h2>
        <p>No pudimos guardar tu pedido. Detalles: <?php echo htmlspecialchars($error_msg ?? 'Error desconocido'); ?></p>
    <?php endif; ?>

    <div style="margin-top: 30px;">
        <a href="../index.php" class="btn">🏠 Volver a la Tienda</a>
    </div>
</section>
</div>

<footer>
  <img class="biglogo" src="../img/logo-grande.jpg" alt="Artesanías Petty">
  <h2>¡Gracias por apoyar el talento local!</h2>
</footer>

</body>
</html>