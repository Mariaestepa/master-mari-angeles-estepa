<?php
get_header();
?>

   <div class="generico"> 
        <h1>
             <?php single_cat_title();?>
        </h1>

        <section id="contenido">
        <?php
           echo category_description();
        ?>
        </section>

   <section id="articulos">

         <?php
        $args = array(
         //-1 es para ver todos los posts//
      'posts_per_page' => -1,
      'post_type' => 'post',
      'orderby' => 'date', //poniendolo como rand se ordenan de manera aleatoria//
      'order' => 'DESC',
   ); //quedan todos los posts ordenados por fecha en forma descendente//
   $the_query = new WP_Query( $args);
     //un loop
   if ( $the_query->have_posts()){
   while ( $the_query->have_posts() ) {
           $the_query->the_post();
  //include
  
  include $plantillas .'/display-posts/card-posts.php';
   }
   }
  else{
   echo "No hay posts";
  }
   wp_reset_postdata();
         ?>
    </section>
   </div> 


   <section class="footer">
       <?php
           get_footer();
       ?>
   </section>
