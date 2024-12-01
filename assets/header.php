<!DOCTYPE html>
<html lang="es">
    <head>
      <!--Viewport, metaetiqueta que indica que la web está adaptada a móviles-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <meta charset="UTF-8">
       <link rel="stylesheet" href="/css/estilo.css">
       <!--No existe la metaetiqueta title, es la etiqueta title-->
       <title>Aprendiendo SEO técnico</title>
<!--Pregunta: ¿Los estilos de CSS también hay que moverlos? Si no entendí mal las clases de CSS, 
los que estan a nivel de página repercuten en la página, al contrario que la hoja de estilos externa que repercute en toda la web.-->
       <style>
           .intro {
               background: coral;
               width: fit-content;
               height: auto;
               padding: 30px;
               align-content: center;
               margin: 25px;
               border: solid violet 20px;
           }
           p.intro {
               background: yellow;
           }
           .intro.cita {
               color: white;
               font-size: 25px;
           }
       </style>
    </head>
<body>
    <header>
     <!--La etiqueta nav tiene que estar dentro de la etiqueta body nunca dentro de la etiqueta head-->
     <nav>
        <ul>
           <li><a href="/">Inicio</a></li>
           <li><a href="/sobre-mi.php">Sobre mi</a></li>
           <li><a href="/servicios.php"style="color:rgb(217, 49, 181);">Servicios</a></li>
           <li><a href="/contacto.php">Contacto</a></li>
           <li><a href="/carpeta/archivo-carpeta.php">Archivo dentro de una carpeta</a></li>
           <li><a href="https://carlos.sanchezdonate.com/master-seo-tecnico/" target="_blank">Más información</a></li>
        </ul> 
     </nav>
    </header>