<?php

$archivo = 'comics.json';

// Función: leer el contenido del archivo JSON y convertirlo en un array asociativo
function cargarColeccion($archivo) {

    // Verificar si el archivo existe. Si no existe, devuelve un log indicando el error y un nulo.
    if (!file_exists($archivo)) {
        error_log("Error: El archivo '$archivo' no existe.");
        return null;
    }

    // Leer el contenido del archivo y guardarlo como una cadena de texto en la variable.
    $cadenaJSON = file_get_contents($archivo);
    
    // Si no puede leer el archivo, devuelve un log y un nulo.
    if ($cadenaJSON === false) {
            error_log("Error: No se pudo leer el archivo '$archivo'.");
            return null;
        }

    $coleccion = json_decode($cadenaJSON, true);
    // Convierte la cadena de texto (en formato JSON) a un array asociativo 

    // Verificar errores de decodificación
    if (json_last_error() !== JSON_ERROR_NONE) {
        error_log('Error al decodificar JSON: ' . json_last_error_msg());
        return null;
    }

    return is_array($coleccion) ? $coleccion : [];
    // Comprueba si lo que devuelve esta función es un array. De lo contrario, devuelve un array vacío.   
}

// Mostrar las tareas
function mostrarColeccion() {
    
    global $archivo;

    $coleccionJSON = cargarColeccion($archivo);
    
    if (empty($coleccionJSON)) {
        return "<p>No hay títulos registrados.</p>";
    }

    $html = "";
    $html .= "<table>";
    $html .= "<th><b>Id<b></th>";
    $html .= "<th><b>Título<b></th>";
    $html .= "<th><b>Autor<b></th>";
    $html .= "<th><b>Estado<b></th>";
    $html .= "<th><b>En préstamo<b></th>";
    $html .= "<th><b>Localización<b></th>";
    
    foreach ($coleccionJSON as $comic) {
        $html .= "<tr>";
        $html .= "<td>$comic->id</td>";
        $html .= "<td>$comic->titulo}</td>";
        $html .= "<td>$comic->autor</td>";
        $html .= "<td>$comic->estado}</td>";
        $html .= "<td>$comic->prestado}</td>";
        $html .= "<td>$comic->localizacion}</td>";
        $html .= "</tr>";
    }
    
    $html .= "</table>";

    return $html;
}

function guardarColeccion($archivo, $coleccion) {
    
    /*
    // Paso 1: Leer archivo si existe
    $cadenaJSON = file_exists($archivo) ? file_get_contents($archivo) : '[]';

    // Paso 2: Convertir en array asociativo
    $coleccion = json_decode($cadenaJSON, true);

    if (!is_array($coleccion)) {
        $coleccion = []; // Manejar posible corrupción de JSON
    }
    */

    $comicsJSON = json_encode($coleccion, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    
    // Paso 4: Guardar el nuevo array como JSON
    if ( file_put_contents($archivo, $comicsJSON) === false) {
        error_log("Error: No se pudo escribir en el archivo '$archivo'.");
        return false;
    }
    return true; 
}

function anadirComic($titulo, $autor, $estado, $prestado, $localizacion) {
    
    //Cargo el json en memoria
    $coleccion = cargarJSON('tareas.json');
    if ($coleccion === null) {
        return false;
    }

    // Genero el id nuevo para la tarea
    $id = generarIdTarea($tareas);

    // Paso 3: Agregar un nuevo cómic
    $comic = (object)[
        'id' => $id,
        'titulo' => $titulo,
        'autor' => $autor,
        'estado' => $estado,
        'prestado' => $prestado,
        'localización' => $localizacion
    ];

    // Anadir el nuevo cómic a la colección
    $coleccion[] = $comic;

    guardarColeccion();
    return true;
}

function generarIdTarea($tareas): int
{
    $id = 0;
    //Saco su elemento máximo
    $maximo = obtenerElementoMaximo($tareas, 'id');
    //Recorro el array para ver cual es el primer id libre a partir del primero que tenemos
    for ($i = 1; $i <= $maximo; $i++) {
        $resultado = array_filter($tareas, function ($tarea) use ($i) {
            return $tarea->id == $i;
        });
        if (empty($resultado)) {
            $id = $i;
            break;
        }
    }

    //Si no tengo id el máximo es el siguiente
    if ($id == 0) {
        $id = $maximo + 1;
    }

    return $id;
}

function obtenerElementoMaximo($datos, $propiedad)
{
    if (empty($datos)) {
        return null;
    }

    // Usamos array_reduce para encontrar el máximo
    $maximo = array_reduce($datos, function ($a, $b) use ($propiedad) {
        if ($a === null) {
            return $b;
        }
        return ($b->$propiedad > $a->$propiedad) ? $b : $a;
    });

    return $maximo->id;
}