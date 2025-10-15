function ejemplo(){
    let edad = prompt("Dime tu edad"); // El usuario introduce su edad

    let edadMasDiez = edad + 10;
    console.log(edadMasDiez); // "4010"
    return edadMasDiez;
}

module.exports = { ejemplo };