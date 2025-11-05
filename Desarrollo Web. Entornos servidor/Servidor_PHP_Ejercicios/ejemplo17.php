<?php
$misFrutas = ["Manzana", "Naranja", "Pera"];
$stringFrutas = implode(", ", $misFrutas); // "Manzana, Naranja, Pera"
$csvLinea = "Ana;Perez;30;Madrid";
$datosArray = explode(";", $csvLinea); // ["Ana", "Perez", "30", "Madrid"]