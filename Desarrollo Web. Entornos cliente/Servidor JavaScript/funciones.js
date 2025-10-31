import {Meses, diaDeLaSemana} from './datos.js';

let formulario = document.getElementById("formulario");

formulario.addEventListener("submit", function (evento) {
    evento.preventDefault(); // Para evitar que se recargue la página

    const anio = document.getElementById("anio").value;
    const resultado = document.getElementById("resultado");
    resultado.innerHTML = ""; // Se asegura de limpiar resultados previos.

    for (const mes of Meses) {
        const mesTitulo = mes.nombre.toUpperCase();
        resultado.innerHTML += `<h2>${mesTitulo}</h2>`;    

        if (mes.nombre === "Febrero" && ((anio % 4 === 0 && anio % 100 !== 0) || (anio % 400 === 0))) {
            mes.dias = 29;
        } else if (mes.nombre === "Febrero") {
            mes.dias = 28;
        }

        for (let dia = 1; dia <= mes.dias; dia++) {
        
            const mesSerializado = (meses) => (meses < 10 ? '0' + String(meses) : String(meses));

            //const numeroMes = String(Meses.indexOf(mes) + 1).padStart(2, '0');
            //const fecha = `${anio}-${numeroMes}-${String(dia).padStart(2, '0')}`;

            const numeroMes = Meses.indexOf(mes) + 1;
            const fecha = `${anio}-${mesSerializado(numeroMes)}-${mesSerializado(dia)}`;
            let diaSemana = diaDeLaSemana(fecha);
            const diaTexto = `<p>${diaSemana}: ${dia} de ${mes.nombre} de ${anio}</p>`;
            console.log(diaTexto);
            resultado.innerHTML += diaTexto;
        }
        resultado.innerHTML += `<hr>`;
    }
});