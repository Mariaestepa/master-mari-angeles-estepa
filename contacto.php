<?php 
 $titulo = "Contacto";
 $producto1="";
 define("titulo", "Titulo concreto sobre cada página");
 define("pagina", "contacto");
      include $_SERVER['DOCUMENT_ROOT'].'/assets/header.php';
     ?>   
     <?php 
         echo $_SERVER['DOCUMENT_ROOT'];
     ?>
    <h1 id="heading1"><?php echo "Bienvenido a la página de contacto";?></h1>
     <div id="javascript" class="prueba">Blog</div>
     <script>
        document.getElementById("javascript").innerHTML = "Blog SEO con JavaScript";
     </script>
    <?php 
      include $_SERVER['DOCUMENT_ROOT'].'/assets/footer.php';
     ?>
     <script src="/scripts/archivo.js"></script>

     