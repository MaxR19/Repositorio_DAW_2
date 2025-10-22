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

$sHtml .= "<h1 class=\"titulo\">Bienvenido al sistema gestor de tareas</h1>";

$sHtml .= "<div class=\"marco\">";
$sHtml .= "<form method=\"post\" action=\"\">";
$sHtml .= "<button type=\"submit\" name=\"accion\" value=\"agregar\">Agregar Tarea</button>";
$sHtml .= "<button type=\"submit\" name=\"accion\" value=\"ver\">Ver Tareas</button>";
$sHtml .= "<button type=\"submit\" name=\"accion\" value=\"eliminar\">Eliminar Tarea</button>";
$sHtml .= "   </form>";
$sHtml .= "</div>";

$accion = $_POST['accion'] ?? '';

switch ($accion) {
    case 'agregar':
        $sHtml .= "<div class=\"marco\">";
        $sHtml .= "<h2 class=\"titulo\">Agregar nueva tarea</h2>";
        $sHtml .= "<form method=\"post\" action=\"\">";
        $sHtml .= "    <label for=\"tarea\">Nueva Tarea:</label>";
        $sHtml .= "    <input type=\"text\" id=\"tarea\" name=\"tarea\" required placeholder=\"Introduzca la tarea que desea agregar\">";
        $sHtml .= "    <button type=\"submit\" name=\"accion\" value=\"guardar\">Enviar</button>";

        $titulo = trim($_POST['tarea']);
        if (!empty($titulo)) {
            guardarTareas($tituloTarea);
            $sHtml .= "<p>Tarea '$titulo' agregada correctamente.</p>";
        } else {
            $sHtml .= "<p style=\"color:red;\">El título de la tarea no puede estar vacío.</p>";
        }

        $sHtml .= "</form>";
        $sHtml .= "</div>";
        break;
    case 'ver':
        $sHtml .= "<div class=\"marco\">";
        $sHtml .= "<h2 class=\"titulo\">Lista de tareas</h2>";
        $tareas = cargarTareas();
        $sHtml .= mostrarTareas($tareas);
        $sHtml .= "</div>";


        break;
    case 'eliminar':
        $sHtml .= "<div class=\"marco\">";
        $sHtml .= "<h2 class=\"titulo\">Eliminar tarea</h2>";
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
