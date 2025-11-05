<?php
$titulo = "Informe mensual";
$contenidoHeredoc = <<<TEXTO
Este es un ejemplo de Heredoc.
El título del informe es: $titulo.
Podemos usar "comillas dobles" sin problema.
Y saltos de
línea también.
TEXTO;
echo nl2br($contenidoHeredoc);

$variable = "No se verá este valor";
$contenidoNowdoc = <<<'EOT'
Esto es un ejemplo de Nowdoc.
El valor de $variable es: $variable.
Las secuencias como \n no se interpretan.
EOT; 

echo nl2br($contenidoNowdoc);

$texto = <<<'FIN'
Este es un bloque de texto tipo Nowdoc.
Las variables como $variable no se interpretan.
Las secuencias como \n o \t tampoco funcionan aquí.
Es ideal para escribir texto literal o código sin procesar.
FIN;

echo nl2br($texto);