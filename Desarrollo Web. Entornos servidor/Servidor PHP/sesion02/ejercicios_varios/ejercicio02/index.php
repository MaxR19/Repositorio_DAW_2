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

// MovieTiles

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
array_splice($tableNew, 0, 1, ["Spider-Man: No Way Home"]);
printMovieDetails($tableNew);

// 4.
array_unshift($tableNew, "Avatar: El sentido del agua"); // Una cualquiera.
printMovieDetails($tableNew);

// 5.
array_push($tableNew, "Titanic");
printMovieDetails($tableNew);


// BestMovies

// 1.
