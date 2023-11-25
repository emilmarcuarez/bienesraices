document.addEventListener('DOMContentLoaded', function() {

    eventListeners();
    darkMode();
    limitarCaracteres();
});

function darkMode() {

    const prefiereDarkMode = window.matchMedia('(prefers-color-scheme: dark)');

    // console.log(prefiereDarkMode.matches);

    if(prefiereDarkMode.matches) {
        document.body.classList.add('dark-mode');
    } else {
        document.body.classList.remove('dark-mode');
    }

    prefiereDarkMode.addEventListener('change', function() {
        if(prefiereDarkMode.matches) {
            document.body.classList.add('dark-mode');
        } else {
            document.body.classList.remove('dark-mode');
        }
    });

    const botonDarkMode = document.querySelector('.dark-mode-boton');
    botonDarkMode.addEventListener('click', function() {
        document.body.classList.toggle('dark-mode');
    });
}

// menu de hamburguesas

function eventListeners() {
    const mobileMenu = document.querySelector('.mobile-menu');

    mobileMenu.addEventListener('click', navegacionResponsive);
   
    // muestra campos condicionales
    const metodoContacto=document.querySelectorAll('input[name="contacto[contactar]"]')
   
    // para añadirle un eventlisteners a un elemento:
    metodoContacto.forEach(input => input.addEventListener('click', mostrarMetodosContacto));

}


function navegacionResponsive() {
    const navegacion = document.querySelector('.navegacion');

    navegacion.classList.toggle('mostrar')
}
function limitarCaracteres() {
    var parrafos = document.querySelectorAll(".descripcion");
  
    parrafos.forEach(parrafo => {
      var texto = parrafo.innerHTML;
      var limite = 50; // Define el número máximo de caracteres que deseas mostrar
  
      if (texto.length > limite) {
        // En el caso específico de la función slice(0, limite), el valor 0 indica que se desea comenzar desde el primer carácter de la cadena original. El parámetro limite representa el índice final, es decir, el carácter justo antes del cual deseas cortar la cadena.
        var nuevoTexto = texto.slice(0, limite) + "...";
        parrafo.innerHTML = nuevoTexto;
      }
    });
  }

  function mostrarMetodosContacto(e){
    const contactoDiv=document.querySelector('#contacto');

   if(e.target.value==='telefono'){
    contactoDiv.innerHTML=`
    <label for="telefono">Numero de teléfono</label>
    <input type="tel" placeholder="Tu Teléfono" id="telefono" name="contacto[telefono]" required>
    
    <p>Elija la fecha y la hora para la llamada:</p>

    <label for="fecha">Fecha:</label>
    <input type="date" id="fecha" name="contacto[fecha]">

    <label for="hora">Hora:</label>
    <input type="time" id="hora" min="09:00" max="18:00" name="contacto[hora]">
    `;
   }else{
    contactoDiv.innerHTML=`
    <label for="email">E-mail</label>
    <input type="email" placeholder="Tu Email" id="email" name="contacto[email]" required>`;
   }
  }
  
  
  