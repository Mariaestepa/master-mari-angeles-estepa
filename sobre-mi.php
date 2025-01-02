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

   <div id="javascript1" class="prueba">¿Quieres saber más?</div>
   <div id="javascript2" class="prueba">¿Quieres saber más?</div>
   <p id="javascript3" class="prueba">¿Quieres saber más?</p>
   <div id="cambiante"> 
</div>
<div class="boton" onclick="funcionmaria()">
   Púlsame para funcionar
</div>
     <!--Este solo vale para cambiar un elemento dependiendo del número que pongamos entre corchetes, 
     pero no para cambiar todos los elementos como la función de abajo-->
      <!--document.getElementsByClassName("prueba")[2].innerHTML = "¿Quieres saber más con Javascript?";-->
      <script>
      //const collection = document.getElementsByClassName("prueba");
      //for (let i = 0; i < collection.length; i++) {
      //collection[i].innerHTML = "¿Quieres saber más con Javascript";
     // }
     function funcionmaria(){
     const collection = document.getElementsByClassName("prueba");
      for (let i = 0; i < collection.length; i++) {
      collection[i].classList.add("redjs");
    }
    }
    </script>
    <style>
     .redjs{
     color: red;
     }
   </style>

    <?php 
      include $_SERVER['DOCUMENT_ROOT'].'/assets/footer.php';
     ?>
     <div>Hola ndsjjdsjdj </div>
     <script src="/scripts/archivo.js"></script>