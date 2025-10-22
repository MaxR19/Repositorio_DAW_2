<?php

// Leer JSON y convertir a array asociativo
function cargarTareas()
{
    $archivo = 'tareas.json';

    if (!file_exists($archivo)) {
        return []; // archivo vacío o no existe
    }

    $tarea = file_get_contents($archivo);
    $tareas = json_decode($tarea, true); // true = array asociativo

    return is_array($tareas) ? $tareas : [];
}

// Mostrar las tareas
function mostrarTareas($tareas)
{
    if (empty($tareas)) {
        return "<p>No hay tareas registradas.</p>";
    }

    $html = "<ul>";
    foreach ($tareas as $tarea) {
        $estado = $tarea['completado'] ? "✅" : "⏳";
        $html .= "<li>{$estado} {$tarea['titulo']}</li>";
    }
    $html .= "</ul>";

    return $html;
}

function guardarTareas($tituloTarea)
{
    $archivo = 'tareas.json';

    // Paso 1: Leer archivo si existe
    $tarea = file_exists($archivo) ? file_get_contents($archivo) : '[]';

    // Paso 2: Convertir en array asociativo
    $tareas = json_decode($tarea, true);

    if (!is_array($tareas)) {
        $tareas = []; // Manejar posible corrupción de JSON
    }

    // Paso 3: Agregar nueva tarea
    $nuevaTarea = [
        'titulo' => $tituloTarea,
        'completado' => false
    ];

    $tareas[] = $nuevaTarea;

    // Paso 4: Guardar el nuevo array como JSON
    file_put_contents($archivo, json_encode($tareas, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}
