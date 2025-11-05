<?php

require_once "datos.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $anio = $_POST['anio'];

    echo "<b>AÑO:&nbsp;</b>$anio<br>";
}

?>

<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Formulario fecha</title>
  <script src="funciones.js" defer></script>
</head>
<body>
  <h1>Fecha y día de la semana</h1>
  <form id="frm" name="frm" action="funciones.php" method="post">
    <div>
        <label for="anio">Año</label>
        <input type="text" id="anio" name="anio" placeholder="Año" required>
    </div>
    <button id="button" type="submit" onclick="diaDeLaSemana('<?= $anio->fecha')">Enviar</button>
  </form>
</body>
</html>




