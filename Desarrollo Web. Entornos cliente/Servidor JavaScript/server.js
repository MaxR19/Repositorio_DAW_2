// index.js
const express = require('express');
const path = require('path');
const sesion2 = require('./sesion_02/sesion_02');
const ejemplos = require('./ejemplos');

const app = express();
app.use(express.static(path.join(__dirname, '')));

// Endpoint raíz
app.get('/', (req, res) => {
  res.send('Bienvenido al servidor de desarrollo de entorno cliente web 🚀');
});

app.get('/ejemploshtml', (req, res) => {
  res.sendFile(path.join(__dirname, '', 'index.html'));
});

app.get('/ejemplos', (req, res) => {
  
  const resultado = ejemplos.ejemplo();
  res.send(`La variable pinta ${resultado}`);
});

//++ SESION2 
// Ejemplo: suma
app.get('/variables', (req, res) => {
  
  const resultado = sesion2.variables();
  res.send(`La variable pinta ${resultado}`);
});

app.get('/concatenar', (req, res) => {
  
  const resultado = sesion2.concatenar();
  res.send(true);
});

//-- SESION2

app.get('/sesion_02/ejerciciosbucles', (req, res) => {
  res.sendFile(path.join(__dirname, 'sesion_02', 'ejerciciosbucles.html'));
});

// Arrancamos el servidor
app.listen(3000, () => {
  console.log('Servidor corriendo en http://localhost:3000');
});
