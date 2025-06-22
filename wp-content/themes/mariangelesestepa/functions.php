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

/* Función para crear bloque de noticias en wordpress*/
function crear_post_type_noticias() {
    $labels = array(
        'name'                  => 'Noticias',
        'singular_name'         => 'Noticia',
        'menu_name'             => 'Noticias',
        'name_admin_bar'        => 'Noticia',
        'add_new'               => 'Agregar nueva',
        'add_new_item'          => 'Agregar nueva Noticia',
        'new_item'              => 'Nueva Noticia',
        'edit_item'             => 'Editar Noticia',
        'view_item'             => 'Ver Noticia',
        'all_items'             => 'Todas las Noticias',
        'search_items'          => 'Buscar Noticias',
        'not_found'             => 'No se encontraron noticias.',
        'not_found_in_trash'    => 'No se encontraron noticias en la papelera.',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'has_archive'        => true,
        'rewrite'            => array('slug' => 'noticias'),
        'supports'           => array('title', 'editor', 'excerpt', 'thumbnail', 'author', 'revisions'),
        'show_in_rest'       => true, // para compatibilidad con Gutenberg
        'menu_icon'          => 'dashicons-megaphone', // ícono del menú en el admin
    );

    register_post_type('noticia', $args);
}

add_action('init', 'crear_post_type_noticias');



function esDispositivoMovil() {
    $userAgent = strtolower($_SERVER['HTTP_USER_AGENT']); 
    $patronesMoviles = '/(android|iphone|ipad|ipod|blackberry|windows phone|opera mini|opera mobi|palm|symbian|nokia|fennec|kindle|silk|playbook|bb10|meego|webos|mobile|tablet|smartphone)/i';
    return preg_match($patronesMoviles, $userAgent);
}
/*
<?php
if (esDispositivoMovil()): ?>
    <p>Solo funciono en movil</p>
<?php endif; ?>
*/
?>
