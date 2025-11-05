<?php
require_once 'funciones.php';
$filTitulo = '';
$filEstado = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $filTitulo = $_POST['titulo'];
    $filEstado = $_POST['estado'];
}

$coleccion = [];
// $tareas = listarTareas($filtarea, $filestado);

?>

<html>

<head>
    <title>Aplicación de Gestion de Cómics</title>
    <script src="funciones.js" defer></script>
    <link rel="stylesheet" href="estilos.css">
</head>

<body>
    <form id="formulario" name="formulario" action="funciones.php" method="post">
        <input type="hidden" id="titulo" name="titulo">
        <input type="hidden" id="estado" name="estado">
        <input type="hidden" id="id" name="id">
        <div id="principal">
            <div id="cabecera">
                <div>Tarea</div>
                <div>Estados</div>
                <div>Botonera</div>
            </div>
            <div id="filtro">
                <div><input type="text" value="<?= $filTitulo ?>"
                        id="filTitulo" name="$filTitulo" onchange="filtrar()" /></div>
                <div>
                    <select id="filEstado" name="filEstado" onchange="filtrar()">
                        <option value=""></option>
                        <option value="pendiente" <?= $filestado === 'pendiente de leer' ? 'selected' : '' ?>>pendiente de leer
                        </option>
                        <option value="en progreso" <?= $filestado === 'leyendo' ? 'selected' : '' ?>>leyendo
                            progreso</option>
                        <option value="completada" <?= $filestado === 'leído' ? 'selected' : '' ?>>leído
                        </option>
                    </select>
                </div>
            </div>
            <div id="listado">
                <?php
                    foreach ($coleccionComics as $comic) {
                        ?>
                <div><input type="text" id="tarea<?= $comic->id ?>"
                        value="<?= $comic->titulo ?>" />
                </div>
                <div> <select id="estado<?= $titulo->id ?>"
                        name="filEstado">
                        <option value=""></option>
                        <option value="pendiente" <?= $titulo->estado === 'pendiente' ? 'selected' : '' ?>>pendiente
                        </option>
                        <option value="en progreso" <?= $titulo->estado === 'en progreso' ? 'selected' : '' ?>>en
                            progreso</option>
                        <option value="completada" <?= $titulo->estado === 'completada' ? 'selected' : '' ?>>completada
                        </option>
                    </select>
                </div>
                <div>
                    <input type="button" id="btnAnadir" onclick="anadirFila();" value="ADD" />
                    <input type="button" id="btnAnadir"
                        onclick="modificar('<?= $titulo->id ?>');"
                        value="MOD" />
                    <input type="button" id="btnAnadir"
                        onclick="eliminar('<?= $titulo->id ?>');"
                        value="DEL" />
                </div>
                <?php
                    }
?>
            </div>
        </div>
    </form>
</body>

</html>