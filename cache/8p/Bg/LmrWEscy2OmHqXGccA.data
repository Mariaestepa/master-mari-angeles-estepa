function load_on_iframe(){document.getElementById("iframeonclick").setAttribute("onClick",""),document.getElementById("iframeonclick").className=document.getElementById("iframeonclick").className.replace(/(?:^|\s)hidden(?!\S)/g,""),document.getElementById("iframeonclick").src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d12640.309781091826!2d-0.9916284999999999!3d37.62386605!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1ses!2ses!4v1659971988650!5m2!1ses!2ses"}

const element = document.getElementById ('ofuscacion');
element.addEventListener("click", linktree);

function linktree(){
    location.href='/sobre-mi';
}

// document.getElementById("headinginicio").outerHTML= "<h1>He cambiado el elemento entero</h1>";
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

document.getElementById("heading1").innerHTML= "Bienvenido a la página de contacto con javascript";
/*No es una buena práctica hacer este
 tipo de redirecciones porque Google no lee el javascript ni lo 
ejecuta hasta que no lo ha renderizado todo y no s
iempre lo hace, por lo tanto este tipo de redirecciones solo
 se deben hacer cuando no 
hay otras alternativas. Además con este tipo de redirecciones
 Google lee la página porque da un código 200 y después la redirige.*/
window.location.href = "https://carlos.sanchezdonate.com/redireccion-301-desde-sitebuilders/";






  