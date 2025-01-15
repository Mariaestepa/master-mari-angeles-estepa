<?php
/* El dir se pone junto con /../ para indicar que es una plantilla dentro de una carpeta pero esto es para php, 
es mejor hacerlo con get header que es la función que se hace con wordpress
include_once __DIR__. ('/../header.php');*/
get_header();
/* Template Name: Lista precios*/
?>
 <div class="precios"> Precios rebajados</div>
<h1>
     <?php the_title();?>
</h1>
<?php
echo the_content();
?>

<?php
/* include_once __DIR__. ('/../footer.php');*/
get_footer();
?>