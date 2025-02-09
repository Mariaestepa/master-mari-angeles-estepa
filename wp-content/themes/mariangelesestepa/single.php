<?php
get_header();
?>
<div class="generico">
     <h1>
          <?php the_title();?>
     </h1>
 <section id="contenido">
 <?php
 //Duda con respecto al plugin: ¿cuándo hay que usar el echo get_field('campo')? es también para el tema de las metaetiquetas
 // que a veces el plugin me da errores
 if (get_field('descripcion_corta')){
     ?>
 <img class= "cabecerapost" height="300px" src="<?php the_field( 'imagen_cabecera' ); ?>" />
 <div class="descripcioncorta"><?php echo get_field( 'descripcion_corta' ); ?></div>
   <?php
}
else {;}
      if ( in_category('festivales') ){
       }
        else {;}
        echo the_content();
   ?>
</section>
</div>
<?php
get_footer();
?>