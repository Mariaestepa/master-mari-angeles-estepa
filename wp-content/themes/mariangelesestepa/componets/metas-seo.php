<?php 
$term = get_queried_object();
$protocol = isset($_SERVER["HTTPS"]) ? 'https' : 'http';
$url_sin_string = $protocol . '://' . $_SERVER['HTTP_HOST'] . strtok($_SERVER["REQUEST_URI"], '?');
$imagenpersonalizada ="https://master-mari-angeles-estepa.test/wp-content/themes/mariangelesestepa/imagenes/imagen chica 600px60px.webp"
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

<!--Aunque tengo imagen en el og:image se muestra la de la variable-->
      <meta property="og:image" content="<?php 
          if (get_field ('og:image', $term))
          {the_field( 'og_image', $term );}
          else {echo $imagenpersonalizada;} ?>" />
      <meta property="og:image:secure_url" content="<?php 
          if (get_field ('og:image:secure_url', $term))
          {the_field( 'og:image:secure_url', $term );}
          else {echo $imagenpersonalizada;}
         ?>">
      <meta property="twitter:image" content="<?php 
           if (get_field ('twitter:image', $term))
           {the_field( 'twitter:image', $term );}
           else {echo $imagenpersonalizada;} ?>">



      <meta property="og:image.alt" content="<?php the_field( 'title', $term ); ?>">

      <meta property="og:type" content="website">
      <meta property="twitter:card" content="summary_large_image">
    

      <meta name="twitter:site" content="@Mª_Ángeles">
      <meta name="twitter:creator" content="<?php the_field( 'twitter_creator', $term  ); ?>">

      <meta name="rating" content="adult">
