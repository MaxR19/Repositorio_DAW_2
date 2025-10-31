<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtenemos la acción del query string
    $accion = $_GET['accion'] ?? '';

    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $direccion = $_POST['direccion'];
    $sexo = $_POST['sexo'];
    $estudiosGM = $_POST['grado_medio'] ?? 'No';

    forEach($_POST as $salida) {
        print_r($salida."<br>");
    }

    echo "<b>ACCION:&nbsp;</b>$accion<br>";
    echo "<b>NOMBRE:&nbsp;</b>$nombre<br>";
    echo "<b>APELLIDOS:&nbsp;</b>$apellidos<br>";
    echo "<b>DIRECCION:&nbsp;</b>$direccion<br>";
    echo "<b>SEXO:&nbsp;</b>$sexo<br>";
    echo "<b>ESTUDIOS GRADO MEDIO:&nbsp;</b>$estudiosGM<br>";
}