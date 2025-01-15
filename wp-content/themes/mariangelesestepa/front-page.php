<?php
get_header();
?>

 <section>
   <div> 
        <h1>
             <?php the_title();?>
        </h1>
             <p >Tan sólo con la mejor calidad se pueden alcanzar los mejores resultados.</p>
     </div> 
</section>
<?php
//echo the_content();
?>
<?php
include $plantillas .'trespost.php';
?>

   <section class="footer">
       <?php
           get_footer();
       ?>
   </section>

           
      
