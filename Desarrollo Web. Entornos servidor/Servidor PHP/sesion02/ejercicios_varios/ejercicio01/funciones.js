let Meses = [
    {
        nombre: 'Enero',
        dias: 31
    },
    {
        nombre: 'Febrero',
        dias: 29
    },
    {
        nombre: 'Marzo',
        dias: 31
    },
    {
        nombre: 'Abril',
        dias: 30
    },
    {
        nombre: 'Mayo',
        dias: 31
    },
    {
        nombre: 'Junio',
        dias: 30
    },
    {
        nombre: 'Julio',
        dias: 31
    },
    {
        nombre: 'Agosto',
        dias: 31
    },
    {
        nombre: 'Septiembre',
        dias: 30
    },
    {
        nombre: 'Octubre',
        dias: 31
    },
    {
        nombre: 'Noviembre',
        dias: 30
    },
    {
        nombre: 'Diciembre',
        dias: 31
    }];

// Array con los días de la semana en castellano
const diasSemana = [
    "domingo",
    "lunes",
    "martes",
    "miércoles",
    "jueves",
    "viernes",
    "sábado"
];

function diaDeLaSemana(fecha) {
    // Obtener la fecha actual 'yyyy-MM-dd'
    const fechaActual = new Date(fecha);

    // Obtener el índice del día de la semana (0 es domingo, 6 es sábado)
    const diaSemanaIndex = fechaActual.getDay();

    // Obtener el nombre del día de la semana
    const diaSemanaTexto = diasSemana[diaSemanaIndex];
    return diaSemanaTexto;
}

