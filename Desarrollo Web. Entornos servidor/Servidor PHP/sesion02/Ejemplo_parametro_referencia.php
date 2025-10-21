<?php
function incrementarValor(int &$numero) {
    $numero++;

    if($numero>5) {
        echo $numero."<br>";
        echo "termino";
        return true;
    } else {
        echo $numero;
        incrementarValor($numero);
    }
    echo "Dentro de la función, número es: $numero <br/>";
}

$miNumero = 5;

echo "Antes de llamar a la función, miNúmero es: $miNumero <br/>";

incrementarValor($miNumero);

echo "Después de llamar a la función, miNúmero es: $miNumero <br/>";

?>