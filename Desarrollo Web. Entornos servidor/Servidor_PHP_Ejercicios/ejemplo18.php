<?php

// FUNCIONES

// Definición y llamada a funciones
function saludarUsuario() {
    echo "¡Bienvenido al sistema!<br/>";
}

saludarUsuario(); // Imprime: ¡Bienvenido al sistema!
// PHP, por defecto, no es sensible a mayúsculas/minúsculas para los nombres de funciones, clases y palabras clave del lenguaje (como if, else, echo).
// Sin embargo, ES SENSIBLE para los nombres de variables.
// Aunque funcione, es una MUY BUENA PRÁCTICA ser consistente con las mayúsculas/minúsculas.
// SaludarUsuario(); // Esto también funcionaría, pero no es recomendable mezclar.

// Funciones con parámetros
function darBienvenidaPersonalizada($nombreUsuario) {
echo "¡Hola, $nombreUsuario! Es un placer tenerte aquí.<br/>";
}
darBienvenidaPersonalizada("Ana"); // ¡Hola, Ana! Es un placer tenerte aquí.
darBienvenidaPersonalizada("Carlos"); // ¡Hola, Carlos! Es un placer tenerte aquí.