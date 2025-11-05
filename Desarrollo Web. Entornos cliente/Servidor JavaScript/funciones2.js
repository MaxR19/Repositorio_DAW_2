import {bestMovies, movieTitles} from './datos.js';

const resultado = document.getElementById("resultado");

function mostrarPeliculas(movies , titulo) {

    const tabla = document.createElement("div");

    const h2 = document.createElement('h2');
    h2.className = 'centerText';
    h2.textContent = titulo;
    tabla.appendChild(h2);

    for (const movie of movies) {
        const ul = document.createElement('ul');
        ul.textContent = movie;
        tabla.appendChild(ul);
    }

    tabla.className = "tablaPeliculas";
    resultado.appendChild(tabla);
}


// 1. Mostrar las películas ordenadas alfabéticamente
const auxMovies = [...movieTitles].sort();
mostrarPeliculas(auxMovies, "Lista de películas ordenadas alfabéticamente");

// 2. Saca de la 11 a la 15 en otra variable 

const peliculas11a15 = auxMovies.slice(10, 15);
mostrarPeliculas(peliculas11a15, "Películas de la 11 a la 15");   