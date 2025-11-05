<?php
echo "Versión de PHP: " . PHP_VERSION . "<br/>"; 
echo "Valor de PI: " . M_PI . "<br/>";

function probarMagicas() {
    echo "Esta función está en la línea: " . __LINE__ . " del archivo " . __FILE__ . "<br/>"; 
    echo "Nombre de la función: " . __FUNCTION__ . "<br/>";
}
probarMagicas();