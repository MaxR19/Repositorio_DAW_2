import {sw} from './datos.js';

/* Vamos a crear un objeto extrayendo de él las propiedades
name y model de aquellas naves que tengan más de 100 pasajeros
(passengers). */

// Bucle para saber el contenido del objeto
for (let ship of sw.results) {
    console.log(ship);

    const ships = sw.results;
    ships.filter(s => toNumber(s.passengers) > 100);         // quedarnos solo con las que interesan
    const newShips = ships.map(getSWData);

    console.log(newShips);

}

function getSWData(ship) {
    return [ship.name, ship.model];
}

function toNumber(num) {
    let valor = isNaN(num) ? 0 : parseInt(num)
    if (valor <= 100) {
        return true;
    } else {
        return false;
    }
}

