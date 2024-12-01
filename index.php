     <?php 
      include $_SERVER['DOCUMENT_ROOT'].'/assets/header.php';
     ?>
     <?php 
         echo $_SERVER['DOCUMENT_ROOT'];
     ?>
    
    <section>
         <!--No se me actualizan ciertos cambios en la página hasta que no guardo aquí, además te explico un error que cometí desde el principio, 
         que fue no volcar la carpeta de github aquí sino solo la de ejemplo, 
         esto lo he hecho a posteriori cuando vi que dentro de ejemplo no podia crear carpetas, 
         entonces fue cuando me traje toda la carpeta de github, ¿esto influye en algo?
         
         Respuesta: Ahora esta todo correcto, no influye en nada, va perfecto
         En cuanto a los cambios es normal, hay que guardar los cambios para poder verlos en la página-->
        <h1>Hola soy Mari Ángeles Estepa <?php echo date("d/M/Y"); echo " Bienvenido a mi web sin forma 😬";?></h1> 
      <?php 
      $geles ="Tengo que ponerme a darle forma a la web";
      echo "$geles más pronto que tarde";
        ?>
     <section>
         <?php 
           $mensaje= "Hay disponibilidad";
           $producto="camisetas"; 
           $disponible="$";
           if ("$producto"=="$disponible"){
              echo "$mensaje" ." de producto.";
           }
           elseif($disponible=='$'){
            echo 'Tenemos disponiblidad suficiente de $producto';
           }
           else{
            echo 'No hay stock';
           }
        ?>
      </section>
      <section>
       Hola <?php echo htmlspecialchars($_POST['nombre']);  /*Es un mensaje personalizado que se le manda a un usuario después de rellenar
       el formulario de contacto, teniendo en cuenta los datos facilitados. htmlspecialchars garantiza que si alguien pone un carácter 
       especial se codificque correctamente.La parte (int) hace mención a un número que en este caso es la edad y si alguien pone algo 
       distinto a un número no se mostrará o dará error (duda: esta última parte no la tengo del todo clara) También tengo la duda */?>.
       Usted tiene <?php echo (int)$_POST['edad']; ?> años.
     </section>
        <div title="Este texto se lee cuando pasas el ratón por encima">Esto no es Hola Mundo</div>
        <p>Estamos <b style="color: aquamarine;">aquí</b> para aprender SEO</p>
        <p>Estamos <b style="color: rgb(217, 49, 181);">aquí</b> para <br> aprender</br>SEO</p>
        <img src="/imagenes/blog_que-es-seo_800x533.jpg" width="600" height="450" alt="Qué es SEO">
    </section>
    <section>
      <div class="intro">
         <h2>El pasaje estándar <b style="font-size: large;">Lorem Ipsum</b>, usado desde el año 1500.</h2>
         <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium,<a href="https://es.lipsum.com/" target="_blank"><b style="color: rgb(144, 238, 144);">rem aperiam</b></a>, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
         <ul>
             <li>Traducción hecha por H. Rackham en 1914</li>
             <li>Traducción hecha por H. Rackham en 1914</li>
             <li>At vero eos et accusamus et iusto odio dignissimos ducimus</li>
             <li>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium</li>
             <li>sunt in culpa qui officia deserunt mollit anim id est laborum.</li>
         </ul> 
         <!--No me funciona el atributo title
         Respuesta: - Si funciona, aparece al pasar el cursor por la primera palabra. 
                  - Revisa el cierre de esta etiqueta de debajo (aparece varias veces en el html) 
                  Pregunta: No he encontrado el cierre de la etiqueta que me comentas, supongo que es uno de span, ¿hay alguna manera
                   de pasar el código por alguna herramienta y que te diga si esta bien?-->
         <span title="Se lee cuando pasas">On the other hand, we denounce with righteous indignation and dislike</span>
      </div>
    </section>
    <div class="intro">
      <p>Es muy importante cuidar al paciente y el paciente será seguido por el paciente, pero durante este tiempo hay mucho trabajo y dolor.</p>
    </div>
    <section>
      <div>
         <span> <p>voluptate velit esse cillum dolore eu fugiat nulla pariatur.uando pasas"On the other hand, we denounce with righteous indignation and dislike</p>
            <p>Es muy importante cuidar al paciente y el paciente será seguido por el paciente, pero durante este tiempo hay mucho trabajo y dolor.</p>
            <h2 title="Hola">El pasaje estándar</h2>
            <!--He intentado añadir a una parte del texto el estilo de color sin añadir la etiqueta b y no me deja
            Respuesta: El atributo style debe ir forzosamente dentro de una etiqueta, por eso no te deja ponerlo solo -->
            <p>Para llegar al más mínimo detalle, <b style="color: crimson;"> nadie debe practicar ningún tipo de trabajo </b> a menos que obtenga algún beneficio de él.</p>
         </span> 
      </div>
   <section>
      <h3>Formulario de Contacto</h3>
       <form action="accion.php" method="post">
           <p>Su nombre: <input type="text" name="nombre" /></p>
           <p>Su edad: <input type="text" name="edad" /></p>
           <p><input type="submit" /></p>
       </form>
   </section>
   <!--Table row, table heading, table data-->
       <section>
            <table class="tabla">
                    <tr>
                       <th>Cursos</th>
                       <td>SEO avanzado</td>
                       <td>CRO Avanzado</td>
                    </tr>
                    <tr>
                       <th>Master</th>
                       <td>SEO técnico</td>
                       <td>Growth</td>
                    </tr>
                    <tr>
                       <th>Formación</th>
                       <td>Redes Sociales</td>
                       <td>Paid</td> 
                    </tr>
            </table>
       </section>
   <!--Cuando se pone id no hay que dejar espacios, hay que poner(-)-->
   <section id="preguntas-frecuentes">
      <h2>Preguntas frecuentes</h2>
      <!--Sección acordeón-->
        <details>
           <summary>¿Qué hacer para aprender SEO técnico?</summary>
           <p>Lo primero que tienes que hacer es un master.</p>
         </details>
         <details>
           <summary>¿Es posible aprender SEO técnico en un mes?</summary>
           <p>No, al menos necesitas de 6 a 8 meses para entenderlo bien.</p>
         </details>
         <details>
           <summary>¿Aprenderé todas las etiquetas SEO importantes?</summary>
           <p>Si, es posible aprenderlas.</p>
         </details>
   </section>   
   <section class="intro cita">
      <blockquote cite="https://desiremarketing.io/es/seo-quotes/">
         Un buen trabajo de SEO mejora con el tiempo. Lo único que hay que cambiar son los trucos de los motores de búsqueda cuando cambian los algoritmos de clasificación.<cite>Jill Whalen</cite> 
      </blockquote>
   </section>
   <section>
          <div class="bloque">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec dapibus ipsum et euismod consequat. Nunc interdum lacus in dolor lobortis congue. 
                In maximus efficitur sapien, et egestas diam ultricies eu. Nulla vehicula mauris justo, ut condimentum orci tristique vitae. Nulla iaculis et ante malesuada viverra. 
                Aenean sodales, sem in convallis ultricies, massa neque dignissim eros, ut commodo ante nisl vel risus. 
                Curabitur ut lacus eu nisl malesuada ornare in at nisi. Ut commodo lorem vitae tortor euismod, id volutpat dui hendrerit. Sed non risus blandit, elementum sem quis, 
                tempus tortor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam blandit sem ac sollicitudin aliquam. In id neque ac mi volutpat hendrerit. 
                Proin eu mauris ligula. Donec tempus in urna sit amet pellentesque. Nullam facilisis mi vitae fermentum finibus. Duis sodales convallis dui, nec euismod tellus.</div>
          <div class="bloque texto"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec dapibus ipsum et euismod consequat. Nunc interdum lacus in dolor lobortis congue. 
                In maximus efficitur sapien, et egestas diam ultricies eu. Nulla vehicula mauris justo, ut condimentum orci tristique vitae. Nulla iaculis et ante malesuada viverra. 
                Aenean sodales, sem in convallis ultricies, massa neque dignissim eros, ut commodo ante nisl vel risus. 
                Curabitur ut lacus eu nisl malesuada ornare in at nisi. Ut commodo lorem vitae tortor euismod, id volutpat dui hendrerit. Sed non risus blandit, elementum sem quis, 
                tempus tortor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam blandit sem ac sollicitudin aliquam. In id neque ac mi volutpat hendrerit. 
                Proin eu mauris ligula. Donec tempus in urna sit amet pellentesque. Nullam facilisis mi vitae fermentum finibus. Duis sodales convallis dui, nec euismod tellus.</div>
      </section>
      <section>
            <div>
               <p class="intro">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec dapibus ipsum et euismod consequat. Nunc interdum lacus in dolor lobortis congue. 
                  In maximus efficitur sapien, et egestas diam ultricies eu. Nulla vehicula mauris justo, ut condimentum orci tristique vitae. Nulla iaculis et ante malesuada viverra. 
                  Aenean sodales, sem in convallis ultricies, massa neque dignissim eros, ut commodo ante nisl vel risus. 
                  Curabitur ut lacus eu nisl malesuada ornare in at nisi. Ut commodo lorem vitae tortor euismod, id volutpat dui hendrerit. Sed non risus blandit, elementum sem quis, 
                  tempus tortor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam blandit sem ac sollicitudin aliquam. In id neque ac mi volutpat hendrerit. 
                  Proin eu mauris ligula. Donec tempus in urna sit amet pellentesque. Nullam facilisis mi vitae fermentum finibus. Duis sodales convallis dui, nec euismod tellus.</p>
            </div>
         <div class="bloque texto largo">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec dapibus ipsum et euismod consequat. Nunc interdum lacus in dolor lobortis congue. 
               In maximus efficitur sapien, et egestas diam ultricies eu. Nulla vehicula mauris justo, ut condimentum orci tristique vitae. Nulla iaculis et ante malesuada viverra. 
               Aenean sodales, sem in convallis ultricies, massa neque dignissim eros, ut commodo ante nisl vel risus. 
               Curabitur ut lacus eu nisl malesuada ornare in at nisi. Ut commodo lorem vitae tortor euismod, id volutpat dui hendrerit. Sed non risus blandit, elementum sem quis, 
               tempus tortor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam blandit sem ac sollicitudin aliquam. In id neque ac mi volutpat hendrerit. 
               Proin eu mauris ligula. Donec tempus in urna sit amet pellentesque. Nullam facilisis mi vitae fermentum finibus. Duis sodales convallis dui, nec euismod tellus.</div>
            <div class="bloque texto">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec dapibus ipsum et euismod consequat. Nunc interdum lacus in dolor lobortis congue. 
                  In maximus efficitur sapien, et egestas diam ultricies eu. Nulla vehicula mauris justo, ut condimentum orci tristique vitae. Nulla iaculis et ante malesuada viverra. 
                  Aenean sodales, sem in convallis ultricies, massa neque dignissim eros, ut commodo ante nisl vel risus. 
                  Curabitur ut lacus eu nisl malesuada ornare in at nisi. Ut commodo lorem vitae tortor euismod, id volutpat dui hendrerit. Sed non risus blandit, elementum sem quis, 
                  tempus tortor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam blandit sem ac sollicitudin aliquam. In id neque ac mi volutpat hendrerit. 
                  Proin eu mauris ligula. Donec tempus in urna sit amet pellentesque. Nullam facilisis mi vitae fermentum finibus. Duis sodales convallis dui, nec euismod tellus.</div>
            <div class="herencias">
                <div class="párrafos">
                   <p>Aenean sodales, sem in convallis ultricies, massa neque dignissim eros, ut commodo ante nisl vel risus.</p>
                </div>
                <p>Aenean sodales, sem in convallis ultricies, massa neque dignissim eros, ut commodo ante nisl vel risus.</p>
               </div>
            </section>
      <section class="imagenizquierda">
         <!--La etiqueta picture es para ofrecer distintas fuentes o formatos de imagenes antes de la fuente principal-->
      <picture>
         <source type="image/avif" srcset="imagenes/seo-imagenes-3.avif">
         <img src="/imagenes/seo-imagenes-3.jpg" loading="lazy" width="600" height="300" title="Imagen de SEO para imagenes" alt="SEO para imagenes">
      </picture>
      <div> 
         <h2 class="h2">Recomendaciones</h2>
         <ul>
            <li>Traducción hecha por H. Rackham en 1914</li>
            <li>Traducción hecha por H. Rackham en 1914</li>
            <li>At vero eos et accusamus et iusto odio dignissimos ducimus</li>
            <li>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium</li>
            <li>sunt in culpa qui officia deserunt mollit anim id est laborum.</li>
        </ul> 
      </div>
   </section>
   <section class="imagenderecha">
         <video width="320" height="240" controls poster="/imagenes/seo-imagenes-3.avif">
            <source src="/videos/movie.mp4" type="video/mp4">
            <source src="/videos/movie.ogg" type="video/ogg">
            Your browser does not support the video tag.
          </video>
          <div>
            <h2 class="h2">Causas</h2>
            <p>sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
          </div>
         </section>
          <section>
            <div class="imagenfondo"></div>
   </section>
   <section>
      <div class="imagenfondonorepeat"></div>
</section>
<?php 
      include $_SERVER['DOCUMENT_ROOT'].'/assets/footer.php';
     ?>