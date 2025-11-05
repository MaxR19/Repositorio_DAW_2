<?php
$mes = 4; // Abril
switch ($mes) {
    case 1: case 3: case 5: case 7: case 8: case 10: case 12:
        $diasDelMes = "tiene 31 días";
        break;
    case 4: case 6: case 9: case 11:
        $diasDelMes = "tiene 30 días";
        break;
    case 2:
        $diasDelMes = "tiene 28 días (o 29 si es bisiesto)";
        break;
    default:
        $diasDelMes = "mes inválido";
}
echo "El mes número $mes $diasDelMes.<br/>";