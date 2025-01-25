<!DOCTYPE html>
<html <?php language_attributes();?>>
    <head>
       <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css" type='text/css' media='all'>
       
       <?php
          /* <link href="/css/fonts.css" rel="stylesheet">
             include_once $_SERVER['DOCUMENT_ROOT'].'/assets/functions.php'; */
       
include 'componets/metas-seo.php';
wp_head(); 
       ?>
</head>
<body>
    <header>
     <!--La etiqueta nav tiene que estar dentro de la etiqueta body nunca dentro de la etiqueta head-->
    <nav>
        <ul>
           <li><a href="/">Agencia de Marketing Digital</a></li>
           <li><a href="/nosotros/">Sobre Nosotros</a></li>
     </nav>
    </header>