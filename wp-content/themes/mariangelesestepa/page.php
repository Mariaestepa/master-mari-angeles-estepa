<?php
get_header();
?>
 <section>
   <div> 
        <h1>
             <?php the_title();?>Hola carlso
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
   <section class="footer">
       <?php
           get_footer();
       ?>
   </section>

           
      
