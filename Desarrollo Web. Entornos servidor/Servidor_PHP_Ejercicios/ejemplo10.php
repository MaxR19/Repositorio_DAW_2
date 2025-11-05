<?php
echo "Fecha actual: " . date("d-m-Y") . "<br/>"; 
echo "Fecha y hora: " . date("l d \d\e F \d\e Y, H:i:s A") . "<br/>"; 

// mktime(hora, minuto, segundo, mes, día, año);
$timestamp = mktime(10, 15, 35, 10, 5, 2019); 
echo "Fecha generada con mktime: " . date("d-m-Y H:i:s", $timestamp) . "<br/>";

$hoy = date_create("now");
echo "Hoy: " . $hoy->format("Y-m-d H:i:s") . "<br/>";
$futura = date_create("2025-12-31");
$diferencia = date_diff($hoy, $futura);
echo "Días hasta el 31/12/2025: " . $diferencia->format("%R%a días") . "<br/>";
echo "Desglose: " . $diferencia->format("%y años, %m meses, %d días, %h horas, %i minutos, %s segundos") . "<br/>";

date_default_timezone_set('Europe/Madrid');
?>