<?php include 'php/conexion.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<title>Artesanías Petty</title>
<link href="https://fonts.googleapis.com/css2?family=Patrick+Hand&family=Quicksand:wght@400;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="css/style.css">
</head>
<body>
<header>
  <div class="logo"><img class="lg" src="img/logo.jpg" alt="Logo Artesanías Petty">Artesanías Petty</div>
  <nav id="nav">
    <a href="#inicio">Inicio</a><a href="#productos">Productos</a><a href="#hacemos">Lo que hacemos</a><a href="#objetivos">Objetivos</a><a href="#contacto">Contacto</a>
  </nav>
</header>

<div class="wrap">
<section id="inicio">
  <div class="hero">
    <div>
      <h1>¡Bienvenidos a Artesanías Petty!</h1>
      <p>Aquí encontrarás piezas únicas, hechas con amor y tradición por artesanos de Ixtlahuaca, Estado de México.</p>
      <p><a class="btn" href="#productos">Ver productos →</a></p>
    </div>
    <div style="text-align:center"><div class="bubble">Apoyas el talento local 💗</div><img class="heroimg" src="img/gato-laptop.png" alt="Gatito con laptop"></div>
  </div>
  <div class="feats">
    <div class="feat"><i>💗</i>Artesanías 100% originales</div>
    <div class="feat"><i>🏪</i>Apoya a los artesanos locales</div>
    <div class="feat"><i>🌸</i>Cultura y tradición de Ixtlahuaca</div>
  </div>
</section>
</div>

<div class="wrap-white">
<section id="productos">
  <h2>Nuestros Productos</h2>
  <p class="sub">Cada pieza cuenta una historia, hecha por manos artesanas de Ixtlahuaca.</p>
  
  <div class="grid">
    <?php
    $productos = $pdo->query("SELECT * FROM productos ORDER BY id")->fetchAll();
    if (count($productos) > 0) {
        foreach ($productos as $row) {
    ?>
        <div class="prod">
            <img class="ph" src="<?php echo htmlspecialchars($row['imagen']); ?>" alt="<?php echo htmlspecialchars($row['nombre']); ?>">
            <h3><?php echo htmlspecialchars($row['nombre']); ?></h3>
            
            <!-- Descripción de materiales y origen en Ixtlahuaca -->
            <p style="font-size: 0.85rem; color: rgb(107, 79, 70); margin: 6px 0 10px 0; line-height: 1.4;">
                <?php echo htmlspecialchars($row['descripcion']); ?>
            </p>

            <small>Desde $<?php echo number_format($row['precio'], 2); ?> MXN</small>
            
            <!-- Botón para procesar la compra -->
            <form action="php/procesar_compra.php" method="POST" style="margin-top: 10px;">
                <input type="hidden" name="id_producto" value="<?php echo $row['id']; ?>">
                <button type="submit" class="btn" style="padding: 6px 12px; font-size: 0.85rem;">Comprar 💗</button>
            </form>
        </div>
    <?php 
        }
    } else {
        echo "<p>No hay productos disponibles por el momento.</p>";
    }
    ?>
  </div>

  <div class="banner"><img src="img/gato-banner.jpg" alt="">💗 Lleva un pedacito de Ixtlahuaca contigo 💗</div>
</section>
</div>

<div class="wrap">
<section id="hacemos">
  <h2>Lo que hacemos</h2>
  <div class="two">
    <img class="pic" src="img/tejido.jpg" alt="Artesana tejiendo una canasta">
    <div>
      <p>En Artesanías Petty promovemos y comercializamos las artesanías de Ixtlahuaca, Estado de México, a través de una plataforma digital que conecta a los artesanos con más personas.</p>
      <div class="pill"><i>💗</i>Mostramos la diversidad de nuestras artesanías.</div>
      <div class="pill"><i>🏪</i>Facilitamos la compra y venta de productos.</div>
      <div class="pill"><i>🌸</i>Apoyamos el talento local y la economía de la región.</div>
    </div>
  </div>
</section>
</div>

<div class="wrap-white">
<section id="objetivos">
  <h2>Objetivos</h2>
  <div class="two" style="align-items:stretch;margin-top:24px">
    <div class="box b1"><h3>🎯 Objetivo general</h3><p style="margin:0;font-size:.95rem">Desarrollar una aplicación web para la promoción y venta de artesanías de Ixtlahuaca, Estado de México, que permita a los artesanos mostrar y comercializar sus productos de manera digital, ampliando su alcance a nuevos clientes y fortaleciendo la economía local y contribuyendo a la preservación y difusión del patrimonio cultural de la región, mediante el uso de tecnologías web.</p></div>
    <div class="box b2"><h3>⭐ Objetivos específicos</h3>
      <div class="num"><b>1</b>Desarrollar aplicaciones web</div>
      <div class="num"><b>2</b>Promocionar los productos mediante las aplicaciones web</div>
      <div class="num"><b>3</b>Promover artesanías</div><img class="cat2" src="img/gato-corazon-1.jpg" alt="Gatito con corazón">
    </div>
  </div>
</section>
</div>

<div class="wrap">
<section id="contacto">
  <h2>Contáctanos</h2>
  <div class="contact" style="margin-top:28px">
    <div>
      <div class="row"><i>📞</i>7122025074</div>
      <div class="row"><i>✉️</i>artesaniaspetty@gmail.com</div>
      <div class="row"><i>📍</i>Ixtlahuaca, Estado de México</div>
      <div class="bubble">¡Será un gusto atenderte! 💗</div>
      <img class="cup" src="img/lapices.jpg" alt="">
      <div class="social"><a style="background:#3b7ddd" href="https://facebook.com/Sof Justo">f</a><a style="background:#e1558f" href="https://instagram.com/xchtl.lju">ig</a><a style="background:#38b862" href="https://tiktok.com/@mei.justo">tk</a></div>
    </div>
    <div>
    <img class="peek" src="img/gato-asomado.jpg" alt="">
    <form id="f" action="php/guardar_mensaje.php" method="POST">
      <label>Nombre<input name="nombre" required></label>
      <label>Correo electrónico<input type="email" name="correo" required></label>
      <label>Mensaje<textarea name="mensaje" rows="4" required></textarea></label>
      <button class="btn" type="submit">✈ Enviar</button>
      <div id="ok">¡Gracias! Te responderemos pronto 💗</div>
    </form>
    </div>
  </div>
</section>
</div>

<div class="wrap-white">
<section id="sugerencias-seccion">
    <h2>Comentarios y Sugerencias</h2>
    <p class="sub">¡Tu opinión nos ayuda a mejorar cada día!</p>
    <div style="max-width: 600px; margin: auto;">
        <form id="f-sugerencias" method="POST">
            <label>Tu Nombre<input type="text" name="nombre" required placeholder="Ej. Xóchitl"></label>
            <label>Tu Comentario o Sugerencia<textarea name="comentario" rows="4" required placeholder="Escribe aquí tus comentarios..."></textarea></label>
            <button type="submit" class="btn" style="width: 100%;">Enviar Sugerencia 💌</button>
            <div id="ok-sugerencia" style="display: none; text-align: center; font-weight: 700; margin-top: 10px; color: rgb(238, 111, 160);">¡Gracias por tu sugerencia! 💖</div>
        </form>
    </div>
</section>
</div>

<footer>
  <img class="biglogo" src="img/logo-grande.jpg" alt="Artesanías Petty"><img class="cat3" src="img/gato-corazon-2.jpg" alt="Gatito con corazón">
  <h2>¡Gracias por ser parte de nuestra historia!</h2>
  <p class="sub">Juntos fortalecemos la cultura, el talento y las tradiciones de Ixtlahuaca.</p>
  <a class="btn" href="#inicio">🏠 Volver al inicio</a>
</footer>

<script src="js/formulario.js"></script>
<script src="js/main.js"></script>
</body>
</html>