<?php

// while
$contador = 1;
echo "Conteo con while:<br/>";
while ($contador <= 5) {
    echo $contador . "<br/>";
    $contador++;
}

// do { ... } while (condición):
$intentos = 0;
echo "Conteo con do...while:<br/>";
do {
    $intentos++;
    echo "Intento número $intentos.<br/>";
} while ($intentos < 3 && $intentos > 5); // Se ejecutará una vez

// for
echo "Tabla de multiplicar del 7:<br/>";
for ($i = 1; $i <= 10; $i++) {
    echo "7 x $i = " . (7 * $i) . "<br/>";
}

// foreach (para arrays y objetos)
// Solo valores

$colores = ["rojo", "verde", "azul"];
echo "Mis colores favoritos (solo valor):<br/>";
foreach($colores as $color) {
    echo "- $color<br/>";
}

// Clave y valor:

$capitales = ["España" => "Madrid", "Francia" => "Paris", "Italia" => "Roma"];
foreach($capitales as $pais => $capital) {
    echo "La capital de $pais es $capital.<br/>";
}

$numeros = [10,20,30];
foreach ($numeros as $indice => $numero) {
    echo "Indice $indice: $numero<br/>";
}

