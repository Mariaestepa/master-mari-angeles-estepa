<?php
get_header();
?>
 <section>
   <div> 
        <h1>
             <?php the_title();?>Hola Carlos
        </h1>
             <p >Tan sólo con la mejor calidad se pueden alcanzar los mejores resultados.</p>
     </div> 
</section>
<?php
echo the_content();
?>
       <!--La etiqueta picture es para ofrecer distintas fuentes o formatos de imagenes antes de la fuente principal-->
   <section class="imagenizquierda">
         <!--La etiqueta picture es para ofrecer distintas fuentes o formatos de imagenes antes de la fuente principal-->
      <picture>
         <source type="image/avif" srcset="wp-content\themes\mariangelesestepa\imagenes/agencia seo.avif">
         <img src="wp-content\themes\mariangelesestepa\imagenes/agencia seo.jpg" loading="lazy" width="600" height="300" title="Imagen de SEO para imagenes" alt="SEO para imagenes">
      </picture>
      <div> 
         <h2>Todo sobre nosotros</h2>
              <!--Sección acordeón-->
        <details>
             <summary>Nuestro equipo</summary>
             <p>Todo el equipo reúne los mismos requisitos: buena gente, pasión por su trabajo y especialización absoluta en su oficio.</p>
         </details>
         <details>
              <summary>La agencia</summary>
              <p>Ayudamos a miles de personas a cumplir sus objetivos empresariales, profesionales y personales consiguiendo hacerlo accesible a todo tipo de empresa de una forma justa, sencilla, cercana, profesional, alegre y rentable.</p>
         </details>
         <details>
              <summary>Nuestros procesos.</summary>
              <p>Estamos comprometidos con los demás. Queremos que cada día que la maquinaria esté en funcionamiento, a la vez, estemos ayudando a crear un mundo mejor.</p>
         </details>
      </div>
   </section>
   <section>
      <div>
        <h2> Servicios</h2>
      </div>
   </section>
   <section>
        <h2>Localización agencia marketing digital</h2>
        <div id="iframeboxing" onclick="load_on_iframe()" style="background: url('https://master-mari-angeles-estepa.test/wp-content/themes/mariangelesestepa/imagenes/onload-iframe.webp');">
        <iframe id="iframeonclick" class="hidden" style="border: 0;" src="" width="600" height="450" allowfullscreen="allowfullscreen"></iframe></div>
        <script> function load_on_iframe(){document.getElementById("iframeonclick").setAttribute("onClick",""),document.getElementById("iframeonclick").className=document.getElementById("iframeonclick").className.replace(/(?:^|\s)hidden(?!\S)/g,""),document.getElementById("iframeonclick").src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3178.576875452628!2d-3.602639923716621!3d37.186525345826674!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd71fcc2f58c33ff%3A0x1b7417ba0588002e!2sC.%20Real%20de%20Cartuja%2C%20Albaic%C3%ADn%2C%2018012%20Granada!5e0!3m2!1ses!2ses!4v1739915723687!5m2!1ses!2ses"}</script>

   <section class="footer">
       <?php
           get_footer();
       ?>
   </section>

           
      
