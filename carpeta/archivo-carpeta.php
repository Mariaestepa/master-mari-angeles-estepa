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
    <?php 
      include $_SERVER['DOCUMENT_ROOT'].'/assets/footer.php';
     ?>