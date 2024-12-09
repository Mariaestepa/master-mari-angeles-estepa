
// Eliminar un elemento aunque no haya función:
// document.getElementById("borrarelemento").outerHTML = "";

function eliminaelemento() {
    document.getElementById("borrarelemento").outerHTML = "<h3>He cambiado el elemento entero</h3>";
  }


  document.addEventListener("DOMContentLoaded", function () {
    // Selecciona todas las etiquetas <a> con target="_blank"
    const links = document.querySelectorAll('a[target="_blank"]');
    
    // Itera sobre cada enlace y añade el atributo rel="nofollow"
    links.forEach(link => {
        const currentRel = link.getAttribute("rel");
        if (currentRel) {
            // Si ya existe un atributo rel, añade "nofollow" si no está presente
            if (!currentRel.includes("nofollow")) {
                link.setAttribute("rel", currentRel + " nofollow");
            }
        } else {
            // Si no existe un atributo rel, se añade "nofollow"
            link.setAttribute("rel", "nofollow");
        }
    });
});


// Esto no funciona en servicios, porque no se llama en servicios
// Como no existe ese elemento, no continua el script en los otros
// document.getElementById("heading").innerHTML= "Sobre mi con javascript!";

document.addEventListener("DOMContentLoaded", function () {
    const headingElement = document.getElementById("heading");
    
    if (headingElement) {
        // Si el elemento con id "heading" existe, actualiza su contenido
        headingElement.innerHTML = "Sobre mí con JavaScript!";
    }
});


/* No me funciona 
el script de contacto
 ni de inicio a pesar de tener el script abajo, 
 viendo la parte de selectores dice que clases
puede haber muchas pero id solo uno*/
document.getElementById("heading1").innerHTML= "Bienvenido a la página de contacto con javascript";
/*No me funciona la redirección. No es una buena práctica hacer este tipo de redirecciones porque Google no lee el javascript ni lo 
ejecuta hasta que no lo ha renderizado todo y no siempre lo hace, por lo tanto este tipo de redirecciones solo se deben hacer cuando no 
hay otras alternativas. Además con este tipo de redirecciones Google lee la página porque da un código 200 y después la redirige.*/
window.location.href = "https://carlos.sanchezdonate.com/redireccion-301-desde-sitebuilders/";
/* Hasta que no he puesto este código no me salía el js en la consola*/


// Elimar elemento ejemplo:



  