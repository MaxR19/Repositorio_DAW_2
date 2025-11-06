<?php

$archivo = 'comics.json';

// Verificamos si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Obtenemos la acción del query string con el GET
    $accion = $_GET['accion'] ?? '';

    // Obtenemos los valores ingresados por el usuario
    $titulo = $_POST['titulo'] ?? '';
    $autor = $_POST['autor'] ?? '';
    $estado = $_POST['estado'] ?? '';
    $localizacion = $_POST['localizacion'] ?? '';
    $id = $_POST['id'] ?? '';

    $prestado = "";
    if(isset($_POST['prestado'])){
        $prestado=($_POST['prestado']=="on"?"Si":"No");
    }else{
        $prestado="No";
    }


    // Llamamos a la función correspondiente
    switch ($accion) {
        case 'modificar':
            modificarEstado($estado, $id);
            volver();
            break;
        case 'eliminar':
            eliminarComic($id);
            volver();
            break;
        case 'agregar':
            anadirComic($titulo, $autor, $estado, $prestado, $localizacion);
            volver();
            break;
        default:
    }
}

function volver()
{
    //Volvemos a la página que ha hecho el submit
    header('Location: index.php?accion=modificar');
    exit();
}



function cargarColeccion($archivo) {

    $inicio = [];
    
    // Verificar si el archivo existe. Si no existe, devuelve un log indicando el error y un nulo.
    if (!file_exists($archivo)) {
        error_log("Error: El archivo '$archivo' no existe.");
        return $inicio;
    }

    // Leer el contenido del archivo y guardarlo como una cadena de texto en la variable.
    $cadenaJSON = file_get_contents($archivo);
    
    // Si no puede leer el archivo, se crea un log indicando el error y devuelve .
    if ($cadenaJSON === false) {
        error_log("Error: No se pudo leer el archivo '$archivo'.");
        return $inicio;
    }

    if (trim($cadenaJSON) === '') {
        error_log("Archivo '$archivo' vacío.");
        return $inicio;
    }

    $coleccion = json_decode($cadenaJSON, false);
    // Convierte la cadena de texto (en formato JSON) a un array de objetos 

    // Verificar errores de decodificación
    if (json_last_error() !== JSON_ERROR_NONE) {
        error_log('Error al decodificar JSON: ' . json_last_error_msg());
        return $inicio;
    }

    return $coleccion ?? $inicio;
    // Comprueba si lo que devuelve esta función es un array. De lo contrario, devuelve la variable con el array vacío.   
}



// Mostrar los cómics dentro de la colección
function mostrarColeccion() {
    
    global $archivo;

    $coleccionJSON = cargarColeccion($archivo);
    
    if (empty($coleccionJSON)) {
        return "<p>No hay títulos registrados.</p>";
    }

    // Creamos la tabla donde recogemos todos los registros.
    $html = "";
    $html .= "<table>";
    $html .= "<th><b>Id</b></th>";
    $html .= "<th><b>Título</b></th>";
    $html .= "<th><b>Autor</b></th>";
    $html .= "<th><b>Estado</b></th>";
    $html .= "<th><b>En préstamo</b></th>";
    $html .= "<th><b>Localización</b></th>";
    
    // Hacemos un for-each para que nos devuelva los valores de todos los registros y rellenar la tabla.
    foreach ($coleccionJSON as $comic) {
        $html .= "<tr>";
        $html .= "<td>$comic->id</td>";
        $html .= "<td>$comic->titulo</td>";
        $html .= "<td>$comic->autor</td>";
        $html .= "<td>";
        $html .= "<form method = \"post\" onchange = \"modificar()\">";
        $html .= "<select id=\"estado\" ".($comic->id). " name=\"estado\">";
        $html .= "<option value=\"\"></option>";
        $html .= "<option value=\"pendiente\" " .($comic->estado === 'pendiente' ? 'selected' : ''). ">Pendiente</option>";
        $html .= "<option value=\"leyendo\" " . ($comic->estado === 'leyendo' ? 'selected' : '') . ">Leyendo</option>";
        $html .= "<option value=\"leido\" " . ($comic->estado === 'leido' ? 'selected' : '') . ">Leído</option>";
        $html .= "</select>";
        $html .= "</form>";
        $html .= "</td>";
        $html .= "<td>$comic->prestado</td>";
        $html .= "<td>$comic->localizacion</td>";
        $html .= "</tr>";
    }
    
    $html .= "</table>";

    return $html;
}



function guardarColeccion($archivo, $coleccion) {
    
    $comicsJSON = json_encode($coleccion, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    
    // Paso 4: Guardar el nuevo array como JSON
    if ( file_put_contents($archivo, $comicsJSON) === false) {
        error_log("Error: No se pudo escribir en el archivo '$archivo'.");
        return false;
    }
    return true; 
}



function anadirComic($titulo, $autor, $estado, $prestado, $localizacion) {
    
    global $archivo;

    //Cargo el contenido del archivo json en memoria
    $coleccion = cargarColeccion($archivo);
    if ($coleccion === null) {
        return false;
    }

    // Generar el id automático para el cómic
    $id = generarId($coleccion);

    // Agregar un nuevo cómic
    $comic = (object)[
        'id' => $id,
        'titulo' => $titulo,
        'autor' => $autor,
        'estado' => $estado,
        'prestado' => $prestado,
        'localizacion' => $localizacion
    ];

    // Anadir el nuevo cómic a la colección
    $coleccion[] = $comic;

    guardarColeccion($archivo, $coleccion);
    return true;
}



function modificarEstado($nuevoEstado, $id) {
    global $archivo;

    // Cargar el archivo JSON en memoria
    $coleccion = cargarColeccion($archivo);
    if ($coleccion === null) {
        return false;
    }

    // Recorrer por referencia para modificar el objeto
    foreach ($coleccion as &$comic) {
        if ($comic->id == $id) {
            $comic->estado = $nuevoEstado; 
            // Cambiar el estado cuando el id del cómic que hemos modificado su estado es el mismo que el que pasa en ese
            // momento en el for-each.
            
            break;
        }
    }
    unset($comic); 
    // Se elimina el objeto cómic. Es una buena práctica al usar referencias (&)

    // Guardar el JSON actualizado
    guardarColeccion($archivo, $coleccion);

    return true;
}

function generarId($coleccion): int
{
    $id = 0;
    //Saco su elemento máximo
    $maximo = obtenerElementoMaximo($coleccion, 'id');
    //Recorro el array para ver cual es el primer id libre a partir del primero que tenemos
    for ($i = 1; $i <= $maximo; $i++) {
        $resultado = array_filter($coleccion, function ($comic) use ($i) {
            return $comic->id == $i;
        });
        if (empty($resultado)) {
            $id = $i;
            break;
        }
    }

    //Si no tengo ningún id disponible, el máximo es el siguiente
    if ($id == 0) {
        $id = $maximo + 1;
    }

    return $id;
}


function obtenerElementoMaximo($objetos, $propiedad) {
    if (empty($objetos)) {
        return null;
    }

    // Usamos array_reduce para encontrar el máximo
    $maximo = array_reduce($objetos, function ($a, $b) use ($propiedad) {
        if ($a === null) {
            return $b;
        }
        return ($b->$propiedad > $a->$propiedad) ? $b : $a;
    });

    return $maximo->id;
}

function eliminarComic($id) {
    global $archivo;

    $coleccion = cargarColeccion($archivo);
    if ($coleccion === null) {
        return false;
    }

    // Diferenciar si se busca por ID (numérico) o por título (texto)
    $nuevaColeccion = array_filter($coleccion, function($comic) use ($id) {
        if (is_numeric($id)) {
            return $comic->id != $id; // Eliminar por id
        } else {
            return strtolower($comic->titulo) !== strtolower($id); // Eliminar por título (insensible a mayúsculas)
        }
    });

    // Reindexar el array para obtener índices consecutivos
    $nuevaColeccion = array_values($nuevaColeccion);

    return guardarColeccion($archivo, $nuevaColeccion);
}