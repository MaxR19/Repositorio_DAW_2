<?php
// Ejemplo de lógica PHP (opcional)
$nombre = $_GET['nombre'] ?? 'Visitante';
$nombreLimpio = htmlspecialchars($nombre, ENT_QUOTES, 'UTF-8');
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Página PHP con CSS y JS</title>

  <!-- CSS externo -->
  <link rel="stylesheet" href="/assets/style.css" />

  <!-- JS externo con defer -->
  <script src="/assets/main.js" defer></script>
</head>
<body>
  <header class="site-header">
    <h1>Hola, <?php echo $nombreLimpio; ?> 👋</h1>
  </header>

  <main class="container">
    <p>Esta página está renderizada por PHP y usa CSS y JS externos.</p>

    <form action="" method="get" class="demo-form">
      <label for="nombre">Cambia tu nombre:</label>
      <input type="text" id="nombre" name="nombre" placeholder="Escribe un nombre…" />
      <button type="submit">Aplicar</button>
    </form>

    <button id="btn-saludar" type="button">Saludar desde JS</button>
    <p id="resultado"></p>
  </main>

  <footer class="site-footer">
    <small>&copy; <?php echo date('Y'); ?> Mi Sitio</small>
  </footer>
</body>
</html>

<!-- 
index.php (servidor → genera HTML)
Procesa en PHP el parámetro nombre que llegue por GET (?nombre=...), lo sanea 
(htmlspecialchars) y lo inyecta en el HTML (en el <h1>).
Renderiza la página: estructura semántica (header, main, footer), formulario 
GET para cambiar el nombre, botón y zona de resultado.
Enlaza los recursos externos: style.css y main.js (este último con defer).
-->