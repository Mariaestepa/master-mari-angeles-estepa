<!DOCTYPE html>
<html lang="es">
    <head>
      <!--Viewport, metaetiqueta que indica que la web está adaptada a móviles-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <meta charset="UTF-8">
       <link href="/css/fonts.css?esto-es-un-parametro" rel="stylesheet">
       <link rel="stylesheet" href="https://<?php echo $_SERVER['HTTP_HOST'];?>/css/estilo.css?vale-cualquier-cosa">">
       <?php
       include_once $_SERVER['DOCUMENT_ROOT'].'/assets/functions.php';
       ?>
       <?php
     switch(constant("pagina")){
          case 'inicio':
              break;
          case'contacto':
            echo ' <link rel="stylesheet" href="/css/otro.css">';
             /* Creo que te salen las dos hojas de estilo porque no has puesto break*/
            break;
            case'Web básica':
              echo ' <link rel="stylesheet" href="/css/basica.css">';
              break;
          case 'sobre mi':
          case 'archivo de carpeta':
            echo ' <link rel="stylesheet" href="/css/estilo.css">';
              break;
          default:
            echo '<!-- No pongas css-->';
              break;
     }
     switch("$producto1"){
        case 'camisetasrojas':
           echo ' <link rel="stylesheet" href="/camisetas/rojas.php">';
            break;
        case'camisetasamarillas':
          echo ' <link rel="stylesheet" href="/camisetas/amarillas.php>';
          break;
        default:
          echo '<!-- No quedan camisetas-->';
            break;
   }

       ?>

       <!--No existe la metaetiqueta title, es la etiqueta title-->
       <title>
       <?php

        if (empty(titulo)){ 
        }
        else{
            echo"$titulo";
           }
       ?>
       </title>
<!--Pregunta: ¿Los estilos de CSS también hay que moverlos? Si no entendí mal las clases de CSS, 
los que estan a nivel de página repercuten en la página, al contrario que la hoja de estilos externa que repercute en toda la web.-->
</head>
<body>
    <header>
     <!--La etiqueta nav tiene que estar dentro de la etiqueta body nunca dentro de la etiqueta head-->
     <nav>
        <ul>
           <li><a href="/">Inicio</a></li>
           <li><a href="/sobre-mi">Sobre mi</a></li>
           <li><a href="/servicios"style="color: var(--rosa);">Servicios</a></li>
           <li><a href="/basica">Web básica</a></li>
           <li><a href="/contacto">Contacto</a></li>
           <li><a href="/carpeta/archivo-carpeta">Archivo dentro de una carpeta</a></li>
           <li><a href="/blog">Blog</a></li>
           <li><a href="https://carlos.sanchezdonate.com/master-seo-tecnico/" target="_blank">Más información</a></li>
        </ul> 
     </nav>
    </header>