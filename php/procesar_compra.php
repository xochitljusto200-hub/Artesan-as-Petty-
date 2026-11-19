<?php
require 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_producto = intval($_POST['id_producto'] ?? 0);

    $stmt = $pdo->prepare("SELECT * FROM productos WHERE id = ?");
    $stmt->execute([$id_producto]);

    if ($row = $stmt->fetch()) {
        $nombre_prod = $row['nombre'];
        $precio_prod = $row['precio'];
        $imagen_prod = $row['imagen'];
        $desc_prod = $row['descripcion'];
    } else {
        echo "Producto no encontrado.";
        exit;
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
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<title>Finalizar Compra - Artesanías Petty</title>
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

<div class="wrap" style="background: rgb(255, 255, 255);">
<section>
    <h2>Finalizar tu Compra 💗</h2>
    <p class="sub">Estás a un paso de llevarte una hermosa artesanía a casa.</p>

    <div style="display: flex; align-items: center; gap: 20px; background: rgb(251, 211, 225); border: 2px dashed rgb(246, 184, 207); border-radius: 18px; padding: 16px; margin-bottom: 24px;">
        <img src="../<?php echo htmlspecialchars($imagen_prod); ?>" alt="<?php echo htmlspecialchars($nombre_prod); ?>" style="width: 90px; height: 90px; object-fit: cover; border-radius: 14px; border: 2px solid rgb(246, 184, 207);">
        <div>
            <h3 style="margin: 0; font-size: 1.5rem;"><?php echo htmlspecialchars($nombre_prod); ?></h3>
            <p style="margin: 4px 0 0 0; font-weight: 600; font-size: 0.88rem; color: rgb(107, 79, 70);"><?php echo htmlspecialchars($desc_prod); ?></p>
            <p style="margin: 4px 0 0 0; font-weight: 600;">Precio unitario: $<span id="precio_unitario"><?php echo $precio_prod; ?></span> MXN</p>
        </div>
    </div>

    <form action="guardar_pedido.php" method="POST">
        <input type="hidden" name="id_producto" value="<?php echo $id_producto; ?>">

        <label>¿Cuántas piezas quieres?</label>
        <input type="number" name="cantidad" id="cantidad" value="1" min="1" max="50" required oninput="calcularTotal()">

        <div style="font-family: 'Patrick Hand', cursive; font-size: 1.6rem; color: rgb(238, 111, 160); text-align: center; margin: 20px 0;">
            Total a pagar: $<span id="total_pagar"><?php echo $precio_prod; ?></span> MXN
        </div>

        <hr style="border: 0; border-top: 2px dashed rgb(246, 184, 207); margin: 20px 0;">

        <h3 style="font-size: 1.4rem; margin-bottom: 4px;">Datos de Envío y Contacto</h3>

        <label>Calle y Número</label>
        <input type="text" name="calle" required placeholder="Ej. Av. Principal #123">

        <label>Municipio</label>
        <input type="text" name="municipio" required placeholder="Ej. Ixtlahuaca">

        <label>Código Postal (CP)</label>
        <input type="text" name="cp" required placeholder="Ej. 50740" maxlength="5">

        <label>Número Telefónico</label>
        <input type="tel" name="telefono" required placeholder="Ej. 7121234567">

        <label>Instrucciones de entrega</label>
        <textarea name="instrucciones" rows="3" placeholder="Ej. Tocar timbre, casa de color rosa, referencias..."></textarea>

        <label>Método de Pago</label>
        <select name="metodo_pago" required style="width: 100%; margin-top: 4px; padding: 10px 12px; border: 2px solid rgb(246, 184, 207); border-radius: 12px; background: rgb(255, 255, 255); color: rgb(74, 42, 31); font: inherit;">
            <option value="">Selecciona una opción</option>
            <option value="Tarjeta">Tarjeta de Crédito / Débito</option>
            <option value="Transferencia">Transferencia Bancaria</option>
            <option value="Efectivo">Pago contra entrega (Efectivo)</option>
        </select>

        <button type="submit" class="btn" style="width: 100%; margin-top: 24px;">Confirmar Pedido 🛍️</button>
    </form>

    <div style="text-align: center; margin-top: 16px;">
        <a href="../index.php" style="color: rgb(107, 79, 70); font-weight: 600; text-decoration: none;">← Volver a la tienda</a>
    </div>
</section>
</div>

<footer>
  <img class="biglogo" src="../img/logo-grande.jpg" alt="Artesanías Petty">
  <h2>¡Gracias por apoyar el talento local!</h2>
  <a class="btn" href="../index.php" style="margin-top: 14px;">🏠 Volver al inicio</a>
</footer>

<script>
function calcularTotal() {
    let precio = parseFloat(document.getElementById('precio_unitario').innerText);
    let cantidad = parseInt(document.getElementById('cantidad').value) || 1;
    let total = precio * cantidad;
    document.getElementById('total_pagar').innerText = total.toFixed(2);
}
</script>

</body>
</html>