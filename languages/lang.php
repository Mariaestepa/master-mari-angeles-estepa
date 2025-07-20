<?php 
$current_url = $_SERVER['REQUEST_SCHEME'].'://' . $_SERVER['HTTP_HOST']. $_SERVER['REQUEST_URI'];
$es_url = 'https://master-mari-angeles-estepa.test/idiomas';
$en_url = 'https://master-mari-angeles-estepa.test/en/languages';
if ($lang=='es'){
    $title='Página de idioma en español';
    $h1='Página de idioma en español';
    $contenido='Te ayudamos a posicionarte en los primeros resultados de Google con estrategias SEO personalizadas. Aumenta tu visibilidad, atrae tráfico orgánico de calidad y convierte visitas en clientes reales. Nuestro equipo de expertos en posicionamiento web analiza tu sitio, identifica oportunidades y aplica técnicas efectivas para mejorar tu ranking. Ya sea que tengas una tienda online, blog o página corporativa, trabajamos para que tu negocio destaque en Internet. ¡Contáctanos hoy y da el siguiente paso en tu estrategia digital!';
}
else {
    $title='English language page';
    $h1='English language page';
    $contenido='We help you reach the top of Google search results with customized SEO strategies. Increase your visibility, attract high-quality organic traffic, and turn visitors into real customers. Our team of SEO experts analyzes your website, identifies key opportunities, and implements effective techniques to improve your rankings. Whether you run an online store, blog, or corporate website, we work to make your business stand out online. Contact us today and take the next step in your digital strategy!';
}

?>

<html lang="<?php echo $lang; ?>">
   <head>
       <title><?php echo $title;?></title>
       <link rel="canonical" href="<?php echo $current_url;?>">
       <?php
       /*
       <link rel="alternate" hreflang="es" href="<?php echo $es_url;?>">
       <link rel="alternate" hreflang="en" href="<?php echo $en_url;?>">
       <link rel="alternate" hreflang="x-default" href="<?php echo $es_url;?>">
       */
      ?>
   </head>
   <body>
       <header>
         <nav></nav>
       </header>

        <section>
            <h1><?php echo $h1;?></h1>
        </section>
         <section>
            <div><?php echo $contenido;?></div>
        </section>

<div class="language-box">
     <a href="<?php echo $es_url;?>"class="language-button">
     <img src="/imagenes/bandera-españa.png" alt="Español"> Español
     </a>
     </div>
<div class="language-box">
     <a href="<?php echo $en_url;?>" class="language-button">
     <img src="/imagenes/bandera-americana.png" alt="Inglés"> English
     </a>
</div>
  </body>
</html>