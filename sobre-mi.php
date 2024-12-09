<?php 
$titulo= "Sobre mi";
$producto1="";
 define("titulo", "Titulo concreto sobre cada página");
 define("pagina", "sobre mi");
      include $_SERVER['DOCUMENT_ROOT'].'/assets/header.php';
     ?>
     <?php 
         echo $_SERVER['DOCUMENT_ROOT'];
     ?>
   <h1 id="heading"><?php echo "Sobre mi";?></h1>

   <div id="javascript" class="prueba">¿Quieres saber más?</div>
   <div id="javascript" class="prueba">¿Quieres saber más?</div>
   <p id="javascript" class="prueba">¿Quieres saber más?</p>
     <!--Este solo vale para cambiar un elemento dependiendo del número que pongamos entre corchetes, 
     pero no para cambiar todos los elementos como la función de abajo-->
      <!--document.getElementsByClassName("prueba")[2].innerHTML = "¿Quieres saber más con Javascript?";-->
      <script>
      const collection = document.getElementsByClassName("prueba");
      for (let i = 0; i < collection.length; i++) {
      collection[i].innerHTML = "¿Quieres saber más con poner texto en Javascript?";
      }
      </script>
    <?php 
      include $_SERVER['DOCUMENT_ROOT'].'/assets/footer.php';
     ?>
     <script src="/scripts/archivo.js"></script>