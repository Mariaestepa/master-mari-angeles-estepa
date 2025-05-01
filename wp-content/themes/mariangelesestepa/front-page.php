<?php
get_header();
?>
 <section class="imagencabecera">
     <div class="cabecera">
        <h1>
             <?php the_title();?>
        </h1>
             <p class="slider">Tan sólo con la mejor calidad se pueden alcanzar los mejores resultados.</p>
    </div>
</section>
 <section id="contenido">
     <?php
     echo the_content();
     ?>
 </section>
       <!--La etiqueta picture es para ofrecer distintas fuentes o formatos de imagenes antes de la fuente principal-->
   <section class="imagenizquierda">
         <!--La etiqueta picture es para ofrecer distintas fuentes o formatos de imagenes antes de la fuente principal-->
      <picture>
         <source type="image/avif" srcset="https://master-mari-angeles-estepa.test/wp-content\themes\mariangelesestepa\imagenes/nosotros.avif">
         <source type="image/webp" srcset="https://master-mari-angeles-estepa.test/wp-content\themes\mariangelesestepa\imagenes/nosotros.webp">
         <img src="https://master-mari-angeles-estepa.test/wp-content\themes\mariangelesestepa\imagenes/nosotros.jpg" loading="lazy" width="500" height="300" title="Imagen de SEO para imagenes" alt="SEO para imagenes">
      </picture>
      <div class="acordeon"> 
         <h2>Todo sobre nosotros</h2>
              <!--Sección acordeón-->
        <details>
             <summary>Nuestro equipo</summary>
             <p>Resultados, creatividad, emoción, plazos cumplidos, marketing sencillo… todo ello depende de personas y, por eso, apostamos por formar el mejor equipo posible. 
               Todo el equipo reúne los mismos requisitos: buena gente, pasión por su trabajo y especialización absoluta en su oficio. En omibu contamos con técnicos especializados por cada área de trabajo.</p>
         </details>
         <details>
              <summary>La agencia</summary>
              <p>Ayudamos a miles de personas a cumplir sus objetivos empresariales, profesionales y personales consiguiendo hacerlo accesible a todo tipo de empresa de una forma justa, sencilla, cercana, profesional, alegre y rentable.</p>
         </details>
         <details>
              <summary>Nuestros procesos</summary>
              <p>Estamos comprometidos con los demás. Queremos que cada día que la maquinaria esté en funcionamiento, a la vez, estemos ayudando a crear un mundo mejor.</p>
         </details>
      </div>
   </section>
   <section>
      <div>
        <h2> Servicios de marketing digital</h2>
      </div>
      <div class="centrados">Descubre cómo podemos ayudarte a alcanzar tus metas con nuestra amplia gama de servicios. 
         Te brindaremos una solución única y personalizada para cumplir con tus objetivos.
      </div>
   </section>

   <section class="zona-servicios">
  <div class="tarjetas">
    <div class="tarjeta">
      <div class="icono">
        <img src="https://cdn-icons-png.flaticon.com/512/25/25313.png" alt="SEO" />
      </div>
      <h3>Posicionamiento SEO</h3>
      <p>La clave para que tus clientes te encuentren: posicionarte en la primera página de Google</p>
    </div>

    <div class="tarjeta">
      <div class="icono">
        <img src="https://cdn-icons-png.flaticon.com/512/1828/1828884.png" alt="Paid Media" />
      </div>
      <h3>Paid Media</h3>
      <p>Elige quién verá tu anuncio y en qué momento. <br>Conecta con tu cliente ideal</p>
    </div>

    <div class="tarjeta">
      <div class="icono">
        <img src="https://cdn-icons-png.flaticon.com/512/60/60525.png" alt="Marketing de contenidos" />
      </div>
      <h3>Marketing de contenidos</h3>
      <p>Crea contenido de valor y atrae a tus clientes de forma natural</p>
    </div>
  </div>
</section>

<a href="https://master-mari-angeles-estepa.test/nosotros/" class="boton">Conócenos</a>

<section>
  <h2>Lo que nos hace únicos</h2>
  <div class="container">
  <div class="grid">
      <div class="item">
        <h3>IMPULSO</h3>
        <p>Impulsamos el ADN digital de tu negocio gracias a nuestros profesionales altamente formados y las mejores tecnologías.</p>
      </div>
      <div class="item">
        <h3>DESARROLLO</h3>
        <p>Diseñamos fórmulas totalmente personalizadas para convertir el potencial digital de tu marca en resultados tangibles.</p>
      </div>
      <div class="item">
        <h3>EVOLUCIÓN</h3>
        <p>Planificamos y ejecutamos tu evolución hacia el éxito digital gracias a nuestras estrategias dirigidas al crecimiento y la rentabilidad de tu negocio.</p>
      </div>
    </div>
  </div>
  </section>

 
<section>
<h2>Últimas novedades del blog</h2>
<div class="centrados">Descubre cómo podemos ayudarte a alcanzar tus metas con nuestra amplia gama de servicios. 
     Te brindaremos una solución única y personalizada para cumplir con tus objetivos.
</div>
</section>
<?php
include $plantillas .'trespost.php';
?>
   <section class="footer">
       <?php
           get_footer();
       ?>
   </section>

           
      
