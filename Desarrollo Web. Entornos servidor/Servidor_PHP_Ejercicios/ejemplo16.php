<?php
// ARRAYS MULTIDIMENSIONALES

// Creación
// Matriz de 3x3
$matriz = [
[1, 2, 3],
[4, 5, 6],
[7, 8, 9]
];

// Array de contactos (cada contacto es un array asociativo)
$contactos = [
"Juan" => ["telefono" => "666111222", "email" => "juan@ej.com"],
"Maria" => ["telefono" => "655333444", "email" => "maria@ej.com"],
"Pedro" => ["telefono" => "677888999", "email" => "pedro@ej.com", "ciudad"
=> "Valencia"]
];

// Acceso a elementos
echo $matriz[1][2]; // 6 (fila 1, columna 2 - índices empiezan en 0)
echo $contactos["Maria"]["email"]; // maria@ej.com

// Recorrido (con foreach)
echo "Contactos Detallados:<br/>";
foreach ($contactos as $nombreContacto => $datosContacto) { 
    echo "<strong>Contacto: $nombreContacto</strong><br/>"; 
    
    foreach ($datosContacto as $claveDato => $valorDato) {
        echo "&nbsp;&nbsp;&nbsp;<em>$claveDato:</em> $valorDato<br/>";
    }
    echo "<br/>";
}