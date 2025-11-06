<?php
require_once 'funciones.php';
?>

<html>

<head>
    <title>Gestor de cómics</title>
    <script src="funciones.js" defer></script>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <h1 class="encabezados">Gestor de cómics</h1>
    <div class="marco">
        <form>
            <button type="button" onclick="mostrarFuncionalidad('agregar')">Agregar</button>
            <button type="button" onclick="mostrarFuncionalidad('modificar')">Ver colección</button>
            <button type="button" onclick="mostrarFuncionalidad('eliminar')">Eliminar</button>
        </form>
    </div>
    <div id="agregar" style="display: none;">
        <h2 class="encabezados">Agregar nuevo título</h2>
        <form id="formulario" action="" method="post">
            <label for="titulo">Nuevo título</label>
            <input type="text" id="titulo" name="titulo" value="">

            <label for="autor">Autor</label>
            <input type="text" id="autor" name="autor" value="">
            
            <label for="estado">Estado</label>
            <select id="estado" name="estado">
                <option value="" disabled selected>Seleccione estado</option>
                <option value="pendiente">Pendiente</option>
                <option value="leyendo">Leyendo</option>
                <option value="leido">Leído</option>
            </select>
            
            <label for="prestado">¿Está prestado?</label>
            <input type="checkbox" id="prestado" name="prestado"/>
            
            <label for="localizacion">Localización</label>
            <select id="localizacion" name="localizacion">
                <option value="" disabled selected>Seleccione ubicación</option>
                <option value="estanteria1">Estantería1</option>
                <option value="estanteria2">Estantería2</option>
                <option value="mueble">Mueble</option>
            </select>
            <button type="button" name="accion" value="agregar" onclick="anadir()">Enviar</button>
        </form>
    </div>
    <div id="modificar" style="display: block;">
        <h2 class="encabezados">Mi colección</h2>
        <?php
            echo mostrarColeccion();
        ?>
    </div>
    <div id="eliminar" style="display: none;">
    <h2 class="encabezados">Eliminar cómic</h2>
    <form id="formulario" method="post" action="funciones.php?accion=eliminar">
        <label for="id">ID o título del cómic a eliminar:</label>
        <input type="text" name="id" id="id" required />
        <button type="submit">Eliminar</button>
    </form>
</div>
</body>
</html>
