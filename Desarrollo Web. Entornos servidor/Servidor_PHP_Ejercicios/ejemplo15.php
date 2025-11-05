<?php
// ARRAYS ASOCIATIVOS

// Creación
$persona = [
    "nombre" => "Ana",
    "apellido" => "García",
    "edad" => 30,
    "ciudad" => "Madrid"
];

$coche = [];
$coche["marca"] = "Seat";
$coche["modelo"] = "Ibiza";
$coche["año"] = "2022";

// Acceso a elementos

echo $persona["nombre"]; // Ana
echo $coche["modelo"]; // Ibiza

// Añadir nuevo elemento
$persona["email"] = "ana.garcia@ejemplo.com"; 

// Mezcla de claves
$mixto = ["clave1" => "valor1", 100, "clave2" => "valor2"];
$mixto[] = "último"; // Se añade con clave númerica (ej. 0 si no hay, o la siguiente disponible)
print_r($mixto); // Para ver la estructura del array

echo "<br/>";

// Recorrido con foreach
echo "Datos de la persona:<br/>";
foreach ($persona as $clave => $valor) {
    echo "<strong>$clave:</strong> $valor<br/>";
}

// Si solo necesitas los valores
foreach ($persona as $valor) {
    echo "$valor<br/>";
}