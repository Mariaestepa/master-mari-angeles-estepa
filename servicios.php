<?php 
 $titulo = "servicios";
 $producto1="camisetasamarillas";
 define("titulo", "Titulo concreto sobre cada página");
 define("pagina", "servicios");
 define("precio1", "50$");
 define("precio2", "100$");
 define("precio3", "150$");
      include $_SERVER['DOCUMENT_ROOT'].'/assets/header.php';
     ?>
     <?php 
         echo $_SERVER['DOCUMENT_ROOT'];
     ?>
   <h1 id="heading" style="color: fuchsia"><?php echo "Servicios";?></h1>
  <script> 
      document.getElementById("heading").innerHTML= "Servicios con javascript...";

      document.getElementById("heading").innerHTML= "Servicios con javascript!!!!!!";

      document.getElementById("heading").outerHTML= "<h1 id='noheading'>El orden del JS importa y mucho</h1>";
      
      document.getElementById("heading").innerHTML= "Hola Mari Angeles";

     // Si lo pones así si funciona porque has cambiado el id al nuevo que ha puesto js
     // document.getElementById("noheading").innerHTML= "Hola Mari Angeles";
    </script>
    <?php
    precios();
    ?>
    <div>
     <h3 id="javascript1" class="prueba">SEO</h3>
     <h3 id="javascript2" class="prueba">SEM</h3>
     <h3 id="javascript3" class="prueba">Analítica</h3>
    </div>
    <script>
         const collection = document.getElementsByTagName("h3");
         for (let i = 0; i < collection.length; i++) {
         collection[i].innerHTML = "Servicios modificados con javascript";
         }
      </script> 
     <!-- No me funcionaban los condicionales porque tenia el div metido dentro de un script-->
    <div id="variante"></div>
    <script>
    let precio = 100;
    let servicios;
          if (precio > 200){
          servicios ="son muy caros";
        }
          else if (precio >= 150){
          servicios ="están bien de precio";
        }
          else if (precio >= 50){
          servicios ="son baratos";
        }
        else{ 
           servicios = "Lo compro";
        }

        let month;
       switch (new Date().getMonth()){
        case 0:
        month= "Enero";
       break;
       case 1:
        month ="Febrero";
        break;
        case 2:
        month ="Marzo";
        break;
        case 3:
        month ="Abril";
        break;
        case 4:
        month ="Mayo";
        break;
        case 5:
        month ="junio";
        break;
        case 6:
        month ="julio";
        break;
        case 7:
        month ="agosto";
        break;
        case 8:
        month ="septiembe";
        break;
        case 9:
        month ="octubre";
        break;
        case 10:
        month ="noviembre";
        break;
        case 11:
        month ="diciembre";
        break;
      }
      
      document.getElementById("variante").innerHTML = "Los servicios " + servicios + " en " + month;
    </script>
     <?php 
      include $_SERVER['DOCUMENT_ROOT'].'/assets/footer.php';
     ?>
      <script src="/scripts/archivo.js"></script>
  