<?php 
$titulo = "Archivo de carpeta";
$producto1="";
define("titulo", "Titulo concreto sobre cada página");
define("pagina", "archivo de carpeta");
      include $_SERVER['DOCUMENT_ROOT'].'/assets/header.php';
     ?>
     <?php 
         echo $_SERVER['DOCUMENT_ROOT'];
     ?>
    <h1 style="color: darkgoldenrod;">Esta es la página de archivo de carpeta</h1>
    <div>
     <a href="/enlaces/enlaces-internos">Enlaces internos</a>
     <a href="/unica">Única</a>
    </div>
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
