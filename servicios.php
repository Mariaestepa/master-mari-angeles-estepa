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
    <h1 style="color: darkgoldenrod;">Servicios</h1>
    <?php
     /* Me daba error la función se la ponia antes del include header pero justo debajo me funciona, no entiendo el por qué */
    precios();
    ?>
    <?php 
      include $_SERVER['DOCUMENT_ROOT'].'/assets/footer.php';
     ?>