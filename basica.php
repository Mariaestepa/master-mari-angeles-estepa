<?php 
$titulo= "Web básica";
$producto1="";
$javascript="web básica con Javascript";
 define("titulo", "Titulo concreto sobre cada página");
 define("pagina", "Web básica");
      include $_SERVER['DOCUMENT_ROOT'].'/assets/header.php';
$imgcover="https://querkus.es/wp-content/uploads/2019/10/banner-granada-educa.jpg"
     ?>
     <section class="basica">
        <div>
            <h1 id="cambiah1"> Bienvenido a la web básica</h1>
            <p >voluptate velit esse cillum dolore eu fugiat nulla pariatur.uando pasas"On the other hand, we denounce with righteous indignation and dislike</p>
        </div> 
     </section>
     <style>
      section.basica {background-image: url(<?php echo $imgcover;?>);
      }
     </style> 
     <script>
     document.getElementById("cambiah1").innerHTML= "Bienvenido a la nueva <?php echo $javascript;?>";
      </script> 
    <?php 
      include $_SERVER['DOCUMENT_ROOT'].'/assets/footer.php';
     ?>
   