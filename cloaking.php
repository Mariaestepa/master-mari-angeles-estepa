<?php 
 $titulo = "Cloaking";
 $producto1="";
 define("titulo", "Página testing cloaking");
 define("pagina", "Página testing cloaking");
      include $_SERVER['DOCUMENT_ROOT'].'/assets/header.php';
     ?>   
     <?php 
         echo $_SERVER['DOCUMENT_ROOT'];
     ?>
<h1>Página testing cloaking</h1>

<p>
<?php
// Forma de poner un contenido si user agent

if (strstr(strtolower($_SERVER['HTTP_USER_AGENT']), "googlebot")) {
    echo '<p>Contenido que se muestra sólo a Googlebot: <span style="color:green">ESTE CONTENIDO SOLO SE MUESTRA A GOOGLEBOT</span></p>';}
else {
    echo '<p>Contenido que se muestra sólo a Googlebot: <span style="color:red">NO LO DETECTAS</span></p>';
}
?>
</p>
