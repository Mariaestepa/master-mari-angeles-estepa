<?php
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