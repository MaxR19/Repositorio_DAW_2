<?php
//Vamos a hacer un proceso recursivo que me sume los números de un array dado
//me tiene que valer cualquier array de cualquier tipo elementos

function sumarValoresArray1(...$numeros): float {
    
    $suma = 0;

    if (count($numeros) === 0) {
        $suma = 0;
    } else {
        $suma = array_sum($numeros);
        
    }
    return $suma;
}

function sumarValoresArray2(array $numeros, int $indice = -1): float {
    $indice++;
    
    if (count($numeros) === 0 || $indice === count($numeros)) {
        $suma = 0;
    } elseif ($indice <>0 && $indice < count($numeros)) {  
        echo $suma;
        $suma += $numeros[$indice];
        sumarValoresArray2($numeros, $indice)    
    }
    return $suma;
}

$array = [1, 2, 3, 4, 5];
$resultado = sumarValoresArray1(...$array);
$resultado2 = sumarValoresArray2($array);

echo "La suma de los valores del array es: " . $resultado;
echo "La suma de los valores del array es: " . $resultado2;

