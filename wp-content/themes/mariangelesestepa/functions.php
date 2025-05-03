<?php
/* El dir se pone junto con /../ para indicar que es una plantilla dentro de una carpeta pero esto es para php, 
es mejor hacerlo con get header que es la función que se hace con wordpress
include_once __DIR__. ('/../header.php');*/
$plantillas = __DIR__.'/plantillas/';

function tresposts(){
    $plantillas = __DIR__.'/plantillas/';
    include $plantillas .'trespost.php';
}
add_shortcode('lastest_posts', 'tresposts');
?>

