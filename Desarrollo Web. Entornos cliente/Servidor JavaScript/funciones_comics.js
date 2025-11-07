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

class Comic {
    
    constructor(id, titulo, autor, estado, prestado, localizacion) {
        this.id = Number(id);
        this.titulo = String(titulo);
        this.autor = String(autor);
        this.estado = String(estado);
        this.prestado = Boolean(prestado);
        this.localizacion = String(localizacion);
    }

    cargarColeccion() {
        return JSON.parse(localStorage.getItem("comics") || "[]");
    }

    guardarColeccion(comics) {
        localStorage.setItem("comics", JSON.stringify(comics));
    }    

    agregarComic(comic) {
        const comics = cargarColeccion();
        comics.push(comic);
        guardarColeccion(comics);
    }

    modificarEstado(id, nuevoEstado) {
        const comics = cargarColeccion();
        comics[id].estado = nuevoEstado;
        localStorage.setItem("comics", JSON.stringify(listaComics));
    }

    mostrarInfo() {
    console.log(`${this.id} ${this.titulo} — ${this.autor} [${this.estado}] ${this.prestado ? 'Prestado' : 'No prestado'} - ${this.localizacion}`);
  }
}


let guardarComics = document.getElementById("guardar_comic");

guardarComics.onclick = function () {
    let titulo = document.getElementById("titulo").value;
    let autor = document.getElementById("autor").value;
    let estado = document.getElementById("estado").value;
    let prestado = document.getElementById("prestado").value;
    let localizacion = document.getElementById("localizacion").value;

    validarCampos(titulo);
    validarCampos(autor);
    validarCampos(estado);
    validarCampos(prestado);
    validarCampos(localizacion);

    let comic = new Comic(id, titulo, autor, estado, prestado, localizacion);


}

function validarCampos(dato) {

    if (dato = null || dato === '') {
        alert(`${dato} no puede ser nulo o estar vacío`);
    }
}

function generarId() {

}

function generarIdComic(datos) {
    let id = 0;
    //Saco su elemento máximo
    let maximo = obtenerElementoMaximo(datos);
    //Recorro el array para ver cual es el primer id libre a partir del primero que tenemos
    for (let i = 1; i <= maximo; i++) {
        let resultado = datos.filter(idMaximo => idMaximo > i);

        if (resultado) {
            id = i;
            break;
        }
    }
    
    
    }

    //Si no tengo id el máximo es el siguiente
    if ($id == 0) {
        $id = $maximo + 1;
    }

    return $id;
}

function obtenerElementoMaximo(identificadores) {

    // Usamos reduce para encontrar el máximo
    let maximoId = identificadores.reduce(datos, function (maximo, id) {
        if (maximo == 0) {
            maximo = id;
        } else {
            return (maximo > id) ? maximo : id;
        }
    }, 0);

    return maximoId;
}