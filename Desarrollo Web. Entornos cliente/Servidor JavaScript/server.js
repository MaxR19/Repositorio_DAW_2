// index.js
const express = require('express'); // Usa Express como framework de servidor HTTP
const path = require('path'); // Usa path para manipular rutas de archivos de forma segura
const sesion2 = require('./sesion_02/sesion_02'); // Importa el módulo local sesion_02
const ejemplos = require('./ejemplos'); // Importa el módulo local ejemplos.

const app = express();
app.use(express.static(path.join(__dirname, ''))); //Sirve archivos estáticos desde el 
                                                   // directorio raíz del proyecto.

// Endpoint raíz
app.get('/', (req, res) => {
  res.send('Bienvenido al servidor de desarrollo de entorno cliente web 🚀');
});

app.get('/ejemploshtml', (req, res) => {
  res.sendFile(path.join(__dirname, '', 'index.html'));
}); // Devuelve un archivo HTML localizado en el directorio raiz.

app.get('/ejemplos', (req, res) => {
  
  const resultado = ejemplos.ejemplo();
  res.send(`La variable pinta ${resultado}`);
}); // Ejecuta una función ejemplo() del módulo ejemplos y muestra el resultado.

//++ SESION2 
// Ejemplo: suma
app.get('/variables', (req, res) => {
  
  const resultado = sesion2.variables();
  res.send(`La variable pinta ${resultado}`);
}); // Función similar al anterior

app.get('/concatenar', (req, res) => {
  
  const resultado = sesion2.concatenar();
  res.send(true);
});

//-- SESION2

app.get('/sesion_02/ejerciciosbucles', (req, res) => {
  res.sendFile(path.join(__dirname, 'sesion_02', 'ejerciciosbucles.html'));
}); // Envía archivos específicos localizados en la subcarpeta sesion_02

// Arrancamos el servidor
app.listen(3000, () => {
  console.log('Servidor corriendo en http://localhost:3000');
}); // El servidor queda corriendo localmente en el puerto 3000.
