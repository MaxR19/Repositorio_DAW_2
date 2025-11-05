<?php

require_once 'funciones.php';
//inicializo mi variable que va a contener el código html
$sHtml = "";

$sHtml .= "<style>";
$sHtml .= "    .titulo {";
$sHtml .= "        text-align:center;";
$sHtml .= "        font-family: Arial, sans-serif;";
$sHtml .= "        color: #000000ff;";
$sHtml .= "    }";
$sHtml .= "    .marco {";
$sHtml .= "        border:1px solid black;";
$sHtml .= "        text-align:center;";
$sHtml .= "        padding:10px;";
$sHtml .= "    }";
$sHtml .= "    div {";
$sHtml .= "        margin: 20px;";
$sHtml .= "    }";
$sHtml .= "</style>";

$sHtml .= "<h1 class=\"titulo\">Gestión de bibliotecas personales</h1>";

$sHtml .= "<div class=\"marco\">";
$sHtml .= " <form method=\"post\" action=\"\">";
$sHtml .= "     <button type=\"submit\" name=\"accion\" value=\"agregar\">Agregar</button>";
$sHtml .= "     <button type=\"submit\" name=\"accion\" value=\"ver\">Ver colección</button>";
$sHtml .= "     <button type=\"submit\" name=\"accion\" value=\"eliminar\">Eliminar</button>";
$sHtml .= " </form>";
$sHtml .= "</div>";

$accion = $_POST['accion'] ?? '';

switch ($accion) {
    case 'agregar':
        $sHtml .= "<div class=\"marco\">";
        $sHtml .= "<h2 class=\"titulo\">Agregar nuevo título</h2>";
        $sHtml .= "<form method=\"post\" action=\"\">";
        $sHtml .= "    <label for=\"tarea\">Nuevo título:</label>";
        $sHtml .= "    <input type=\"text\" id=\"tarea\" name=\"tarea\" value=\"\">";
        $sHtml .= "    <label for=\"estado\">Estado:</label>";
        $sHtml .= "    <select id=\"estado\" name=\"estado\">";
        $sHtml .= "    <option value=\"\"></option>";
        $sHtml .= "    <option value=\"pendiente\">Pendiente</option>";
        $sHtml .= "    <option value=\"leyendo\">Leyendo</option>";
        $sHtml .= "    <option value=\"leido\">Leído</option>";
        $sHtml .= "    </select>";
        $sHtml .= "    <label for=\"prestado\">En préstamo:</label>";
        $sHtml .= "    <input type=\"checkbox\" id=\"prestado\" name=\"prestado\"/>";
        $sHtml .= "    <button type=\"submit\" name=\"accion\" value=\"guardar\">Enviar</button>";
                        
        $titulo = trim($_POST['tarea']);
        $estado = trim($_POST['estado']);
        if (!empty($titulo) && !empty($estado)) {
            guardarTareas($titulo, $estado);
            $sHtml .= "<p>Tarea '$titulo' agregada correctamente.</p>";
        } else {
            $sHtml .= "<p style=\"color:red;\">El título del cómic no puede estar vacío.</p>";
        }

        $sHtml .= "</form>";
        $sHtml .= "</div>";
        break;
    case 'ver':
        $sHtml .= "<div class=\"marco\">";
        $sHtml .= "<h2 class=\"titulo\">Mi colección</h2>";
        $tareas = cargarTareas();
        $sHtml .= mostrarTareas($tareas);
        $sHtml .= "</div>";


        break;
    case 'eliminar':
        $sHtml .= "<div class=\"marco\">";
        $sHtml .= "<h2 class=\"titulo\">Eliminar título</h2>";
        $sHtml .= "<form method=\"post\" action=\"\">";
        $sHtml .= "    <label for=\"tarea\">Nueva Tarea:</label>";
        $sHtml .= "    <input type=\"text\" id=\"tarea\" name=\"tarea\" required placeholder=\"Introduzca la tarea que desea eliminar\">";
        $sHtml .= "    <button type=\"submit\" name=\"accion\" value=\"guardar\">Enviar</button>";
        $sHtml .= "</form>";
        $sHtml .= "</div>";
        break;
    default:
        break;
}

echo($sHtml);
?>