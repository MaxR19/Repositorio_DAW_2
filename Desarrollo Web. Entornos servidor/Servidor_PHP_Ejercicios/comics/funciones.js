// Esconder los cuadros de las funcionalidades hasta que se pulse el botón correspondiente
function mostrarFuncionalidad(div) {

    let agregar = document.getElementById('agregar');
    let mostrMod = document.getElementById('modificar');
    let eliminar = document.getElementById('eliminar');

    switch(div) {
        case 'agregar':
            agregar.style.display = 'block';
            mostrMod.style.display = 'none';
            eliminar.style.display = 'none';
            break;
        case 'modificar':
            mostrMod.style.display = 'block';
            agregar.style.display = 'none';
            eliminar.style.display = 'none';
            break;
        case 'eliminar':
            eliminar.style.display = 'block';
            agregar.style.display = 'none';
            mostrMod.style.display = 'none';
            break;
        default:
            alert("Sección no reconocida: " + div);
    }

}

let formulario = document.getElementById('formulario');

// Se formula la acción que se quiere ejecutar desde el switch
function anadir() {
    formulario.action='funciones.php?accion=agregar';
    formulario.submit();
}

function modificar() {
    formulario.action='funciones.php?accion=modificar';
    formulario.submit();
}