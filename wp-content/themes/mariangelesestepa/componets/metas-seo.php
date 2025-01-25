<?php 
$term = get_queried_object();
$protocol = isset($_SERVER["HTTPS"]) ? 'https' : 'http';
$url_sin_string = $protocol . '://' . $_SERVER['HTTP_HOST'] . strtok($_SERVER["REQUEST_URI"], '?');

?>
      
      <!--Viewport, metaetiqueta que indica que la web está adaptada a móviles-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta charset="UTF-8">

      
      <?php $metarobots_checked_values = get_field( 'metarobots', $term ); 
      if ( $metarobots_checked_values ) : ?>
      <meta name="robots" content="<?php the_field( 'metarobots', $term  ); ?>">
      <?php endif; ?>
      
      
      <?php the_field( 'custom_meta', $term); ?>
    
      <title><?php the_field( 'title', $term ); ?></title>
      <meta property="og:title" content="<?php
          if (get_field('og_title', $term )){
          the_field( 'og_title', $term );
          } else{the_field( 'title', $term );} ?>">

      <meta property="twitter:title" content="<?php
          if (get_field('twitter_title', $term ))
          {the_field( 'twitter_title', $term );} 
          elseif(get_field('og_title', $term )){the_field( 'og_title', $term );}
          else{the_field( 'title', $term );}?>">

   
     <?php
        if ( in_category('festivales') ){
        $metadesc_festivales = 'Si te gusta la música' . ' '. get_field( 'tipo_de_musica', $term) . ' ' .
        'no te puedes perder el' . ' ' . get_field( 'nombre_festival', $term ) . ' ' . 'que dura' . ' '. get_field( 'numero_de_dias', $term ) . ' '. 'dias,' . ' ' . 'desde el' . ' ' 
        . get_field( 'fecha_inicio', $term) . ' ' . 'hasta el' . ' ' . get_field( 'fecha_fin', $term ) . ' ' . 'en' . ' ' . get_field( 'ciudad', $term ) . ' ' .'y su precio es de' . ' '
        . get_field( 'precio', $term ) . ' ' . 'euros.';
        ?>
        <meta name="description" content="<?php echo $metadesc_festivales; ?>">
        <meta property="og:description" content="<?php echo $metadesc_festivales; ?>">
        <meta property="twitter:description" content="<?php echo $metadesc_festivales; ?>">
            
     <?php
           }
           else {
        ?>
         <meta name="description" content="<?php the_field( 'metadescripcion', $term ); ?>">
         <meta property="og:description" content="<?php
             if (get_field('og_description', $term )){
             the_field( 'og_description', $term );
             } else{the_field( 'metadescripcion', $term );}?>">
   
         <meta property="twitter:description" content="<?php
             if (get_field('twitter_description', $term ))
             {the_field( 'twitter_description', $term );} 
             elseif(get_field('og_description', $term )){the_field( 'og_description', $term );}
             else{the_field( 'metadescripcion', $term );}?>">

        <?php ;} ?>

      <link rel="canonical" href="<?php 
          if (get_field ('canonical', $term))
          {the_field('canonical',$term);}
          else {echo $url_sin_string;}
          ?>">
      <meta property="og:url" content="<?php 
          if (get_field ('canonical', $term))
          {the_field('canonical',$term);}
          else {echo $url_sin_string;}
          ?>">
      <meta property="twitter:url" content="<?php 
          if (get_field ('canonical', $term))
          {the_field('canonical', $term);}
          else {echo $url_sin_string;}
          ?>">


<?php $imagenpersonalizada ="https://master-mari-angeles-estepa.test/wp-content/themes/mariangelesestepa/imagenes/imagen chica 600px60px.webp";?>

      <meta property="og:image" content="<?php 
          $og_image = get_field('og_image', $term); // Obtener el campo personalizado
          if ($og_image) {
              echo $og_image; // Mostrar la imagen personalizada
          } else {
              echo $imagenpersonalizada; // Mostrar la imagen predeterminada
          }
      ?>">
      <!--De esta manera no me funciona el condicional-->
      <meta property="og:image" content="<?php 
          if (get_field ('og:image', $term))
          {the_field( 'og_image', $term );}
          else {echo $imagenpersonalizada;} ?>">
    

    <meta property="og:image:secure_url" content="<?php
        $og_image_secure_url = get_field('og:image:secure_url', $term); 
        if ($og_image_secure_url) {
            echo $og_image_secure_url; 
        } else {
            echo $imagenpersonalizada; 
        }
     ?>">

   <meta property="twitter:image" content="<?php 
       $twitter_image = get_field('twitter:image', $term);
       if ($twitter_image) {
           echo $twitter_image; 
       } else {
           echo $imagenpersonalizada; }?>">


      <meta property="og:image.alt" content="<?php the_field( 'title', $term ); ?>">

      <meta property="og:type" content="<?php the_field( 'tipo_contenido' ); ?>">
       <!--No se hacerla-->
      <meta property="twitter:card" content="summary_large_image">
    

      <meta name="twitter:site" content="<?php $twitter_site_username = get_field( 'twitter_site_username' ); ?><?php if ( $twitter_site_username ): ?><a href="<?php echo esc_url( $twitter_site_username); ?>></a>
        <?php endif; ?>
      <meta name="twitter:creator" content="<?php the_field( 'twitter_creator', $term ); ?>">
          
      <meta name="rating" content="adult">
