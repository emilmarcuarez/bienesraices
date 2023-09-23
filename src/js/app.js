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
  
  
  