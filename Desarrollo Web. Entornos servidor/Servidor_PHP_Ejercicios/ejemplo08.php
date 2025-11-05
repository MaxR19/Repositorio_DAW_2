<?php
$usuario = "Ana";
$edad = 30;
echo "Usuario: $usuario, Edad: $edad años.\nSiguiente línea.\n";
echo "El precio es de \$100 dólares.\n";
echo "Podemos usar llaves: {$usuario} tiene {$edad} años.\n";

echo "<br/>";

$usuario = "Luis";
echo 'Usuario: $usuario, Edad: $edad años.\nEsto NO es un salto de línea.'; 
echo 'Para una comilla simple: \' y una barra: \\ ';