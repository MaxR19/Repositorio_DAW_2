<?php

require_once 'datos.php';

function printMovieDetails($movieTitles) {

    $sHtml = "<table border='1' cellpadding='5'>";

    $contador = 0;

    foreach ($movieTitles as $movie) {

        $contador++;

        $sHtml .= "<tr><td>$contador</td><td>$movie</td></tr>";
    }

    $sHtml .= "</table>";
    $sHtml .= "<br/><br/>";
    echo $sHtml;
}

// 1.
$tableOrdered = [];
$tableOrdered = $movieTitles;
sort($tableOrdered);
printMovieDetails($tableOrdered);

// 2.
$arrayEspecificMovies = [];
$arrayEspecificMovies = array_slice($tableOrdered, 10, 5, false);
printMovieDetails($arrayEspecificMovies);

// 3.
$tableNew = [];
$tableNew = $movieTitles;
array_splice($tableNew, 18, 1, ["El silencio de los corderos"]);