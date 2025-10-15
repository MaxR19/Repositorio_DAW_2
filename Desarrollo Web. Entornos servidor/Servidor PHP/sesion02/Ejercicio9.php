<?php
$titulo = "Informe Mensual";
$contenidoHeredoc=<<<TEXTO
Este es un ejemplo de Heredoc
El título del informe es: "$titulo" .
Podemos usar "comillas dobles" sin problema.
Y saltos de
línea.
TEXTO;
echo nl2br($contenidoHeredoc);

$variable = "No se verá este valor"; 
$contenidoNowdoc = <<<'EOT' 
Esto es un ejemplo de Nowdoc. 
El valor de $variable es: $variable. 
Las secuencias como \n no se interpretan. 
'EOT';
echo nl2br($contenidoNowdoc);


?>