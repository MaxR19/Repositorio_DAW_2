// /assets/main.js
document.addEventListener('DOMContentLoaded', () => {
  const btn = document.getElementById('btn-saludar');
  const out = document.getElementById('resultado');
  if (btn && out) {
    btn.addEventListener('click', () => {
      out.textContent = '¡Hola desde JavaScript (defer) 👌!';
    });
  }
});

/*
assets/main.js (cliente → comportamiento)
Espera a que el DOM esté listo (DOMContentLoaded), seguro junto a defer.
Busca el botón “Saludar” y el párrafo de salida.
Escucha el clic en el botón y escribe un mensaje en el <p id="resultado">.
*/