<?php
// if simple

$edad = 20;
if ($edad >= 18) {
    echo "Eres mayor de edad.<br/>";
}

// if else

$temperatura = 15;
if ($temperatura > 25) {
    echo "Hace calor.<br/>";
} else {
    echo "No hace tanto calor.<br/>";
}

// if elseif else
$nota = 7;
if ($nota >= 9) {
    echo "Sobresaliente.<br/>";
} elseif ($nota >= 7) {
    echo "Notable.<br/>";
} elseif ($nota >= 5) {
    echo "Aprobado.<br/>";
} else {
    echo "Suspenso.<br/>";
}

// Operador ternario condición ? valor_si_true : valor_si_false:

$numero = 10;
$tipoNumero = ($numero % 2 == 0) ? "par" : "impar";
echo "El número $numero es $tipoNumero.<br/>";
$valor = 0;
$mensaje = ($valor == 0) ? "cero" : (($valor % 2 == 0) ? "par" : "impar");
echo "El valor $valor es $mensaje.<br/>";

// Condiciones complejas con operadores lógicos

$edad = 25;
$tieneCarnet = true;
if ($edad >= 18 && $tieneCarnet) {
    echo "Puedes conducir.<br/>";
}
if (!($edad < 18)) { // equivalente a if ($edad >= 18)
    echo "No eres menor de 18.<br/>";
}