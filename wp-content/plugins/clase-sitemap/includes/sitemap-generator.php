<?php
$protocol = isset($_SERVER["HTTPS"]) ? 'https' : 'http' . '://';
$rutita = $current_url="//".$_SERVER['HTTP_HOST'];
$canonical = get_field( 'canonical' );
?><x-layout>

<section>
<div style="height:44px;"> </div>
<?php
// Blog
echo "<h2>Blog</h2>";
$domblog = new DOMDocument('1.0','UTF-8');
$domblog->formatOutput = true;
$domblog->preserveWhiteSpace = false;
$rootblog = $domblog->createElement('urlset');
$domblog->appendChild($rootblog);
$rootblog->setAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');
$rootblog->setAttribute('xmlns:image', 'http://www.google.com/schemas/sitemap-image/1.1');

//$resultblog->setAttribute('id', 1);
$argsblog = array(
'posts_per_page' => -1,
//'post__not_in' => array($post->ID), // Ensure that the current post is not displayed
'post_type' => 'post',
'orderby' => 'date',
'order' => 'DESC',
'post_status' => 'publish',
);
$obtencionblog = new WP_Query( $argsblog );
if ($obtencionblog->have_posts()) :
while ($obtencionblog->have_posts()) : $obtencionblog->the_post();
if (!get_field("canonical")) {
$metarobots_checked_values = get_field('metarobots');
if ($metarobots_checked_values && (in_array('all', $metarobots_checked_values) || in_array('index', $metarobots_checked_values))) {
$enlace = get_permalink();
$lastestmod = get_the_modified_date('Y-m-d');
$resultblog = $domblog->createElement('url');
$rootblog->appendChild($resultblog);
$resultblog->appendChild($domblog->createElement('loc', $enlace));
$resultblog->appendChild($domblog->createElement('lastmod', $lastestmod));


 // Obtener imágenes del contenido
 $post_content = get_the_content();
 preg_match_all('/<img[^>]+src=["\']([^"\']+)["\']/i', $post_content, $matches);

 if (!empty($matches[1])) {
     foreach ($matches[1] as $img_url) {
         $image_tag = $domblog->createElement('image:image');
         $image_loc = $domblog->createElement('image:loc', $img_url);
         $image_tag->appendChild($image_loc);
         $resultblog->appendChild($image_tag);
     }
 }

}
}
endwhile;
wp_reset_postdata();
endif;
// Así vemos el código que se hace
echo '<code class="codigo-post"><xmp>'. $domblog->saveXML() .'</xmp></code>';
echo '<a class="exitbutton" href="' . $rutita . '/mariangeles-posts.xml" target="_blank">Comprobar Sitemap</a>';
$domblog->save('mariangeles-posts.xml') or die('XML Create Error');



echo "<h2>Pages</h2>";
$dompage = new DOMDocument('1.0','UTF-8');
$dompage->formatOutput = true;
$dompage->preserveWhiteSpace = false;
$rootpage = $dompage->createElement('urlset');
$dompage->appendChild($rootpage);
$rootpage->setAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');
$rootpage->setAttribute('xmlns:image', 'http://www.google.com/schemas/sitemap-image/1.1');
//$resultpage->setAttribute('id', 1);
$argspage = array(
'posts_per_page' => -1,
//'post__not_in' => array($post->ID), // Ensure that the current post is not displayed
'post_type' => 'page',
'orderby' => 'date',
'order' => 'DESC',
'post_status' => 'publish',
);
$obtencionpage = new WP_Query( $argspage );
if ($obtencionpage->have_posts()) :
while ($obtencionpage->have_posts()) : $obtencionpage->the_post();
if (!get_field("canonical")) {
$metarobots_checked_values = get_field('metarobots');
if ($metarobots_checked_values && (in_array('all', $metarobots_checked_values) || in_array('index', $metarobots_checked_values))) {
$enlace = get_permalink();
$lastestmod = get_the_modified_date('Y-m-d');
$resultpage = $dompage->createElement('url');
$rootpage->appendChild($resultpage);
$resultpage->appendChild($dompage->createElement('loc', $enlace));
$resultpage->appendChild($dompage->createElement('lastmod', $lastestmod));


// Obtener imágenes del contenido
$page_content = get_the_content();
preg_match_all('/<img[^>]+src=["\']([^"\']+)["\']/i', $page_content, $matches);

if (!empty($matches[1])) {
    foreach ($matches[1] as $img_url) {
        $image_tag = $dompage->createElement('image:image');
        $image_loc = $dompage->createElement('image:loc', $img_url);
        $image_tag->appendChild($image_loc);
        $resultpage->appendChild($image_tag);
    }
}
}
}
endwhile;
wp_reset_postdata();
endif;
// Así vemos el código que se hace
echo '<code class="codigo-post"><xmp>'. $dompage->saveXML() .'</xmp></code>';
echo '<a class="exitbutton" href="' . $rutita . '/mariangeles-paginas.xml" target="_blank">Comprobar Sitemap</a>';
$dompage->save('mariangeles-paginas.xml') or die('XML Create Error');


echo "<h2>Noticias</h2>";
$domnoticia = new DOMDocument('1.0','UTF-8');
$domnoticia->formatOutput = true;
$domnoticia->preserveWhiteSpace = false;
$rootnoticia = $domnoticia->createElement('urlset');
$domnoticia->appendChild($rootnoticia);
$rootnoticia->setAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');
$rootnoticia->setAttribute('xmlns:news', 'http://www.google.com/schemas/sitemap-news/0.9');
//$resultnoticia->setAttribute('id', 1);
$argsnoticia = array(
'posts_per_noticia' => -1,
//'post__not_in' => array($post->ID), // Ensure that the current post is not displayed
'post_type' => 'noticia',
'orderby' => 'date',
'order' => 'DESC',
'post_status' => 'publish',
);
$obtencionnoticia = new WP_Query( $argsnoticia );
if ($obtencionnoticia->have_posts()) :
while ($obtencionnoticia->have_posts()) : $obtencionnoticia->the_post();
if (!get_field("canonical")) {
$metarobots_checked_values = get_field('metarobots');
if ($metarobots_checked_values && (in_array('all', $metarobots_checked_values) || in_array('index', $metarobots_checked_values))) {
$enlace = get_permalink();
$lastestmod = get_the_modified_date('Y-m-d');
$resultnoticia = $domnoticia->createElement('url');
$rootnoticia->appendChild($resultnoticia);
$resultnoticia->appendChild($domnoticia->createElement('loc', $enlace));
$resultnoticia->appendChild($domnoticia->createElement('lastmod', $lastestmod));


$publicationDate = get_the_modified_date('Y-m-d\TH:i:s.uP');
$publicationDateTimestamp = strtotime($publicationDate);
$currentDateTimestamp = strtotime(date('Y-m-d'));
$daysDifference = floor(($currentDateTimestamp - $publicationDateTimestamp) / (60 * 60 * 24));

if ($daysDifference <= 2) {
// Añadir estructura adicional dentro de <news:news>
$newsElement = $domnoticia->createElement('news:news');
$resultnoticia->appendChild($newsElement);
$titulonoticia = get_the_title();
$publishednoticia = get_the_modified_date('Y-m-d\TH:i:s.uP');
$newstitle = get_field('title');

// Definir las variables dentro de <news:news> según tus necesidades
$publicationElement = $domnoticia->createElement('news:publication');
$publicationNameElement = $domnoticia->createElement('news:name', $titulonoticia);
$publicationLanguageElement = $domnoticia->createElement('news:language', 'es');
$publicationElement->appendChild($publicationNameElement);
$publicationElement->appendChild($publicationLanguageElement);
$newsElement->appendChild($publicationElement);

$publicationDateElement = $domnoticia->createElement('news:publication_date', $publishednoticia);
$newsElement->appendChild($publicationDateElement);

$titleElement = $domnoticia->createElement('news:title', $newstitle);
$newsElement->appendChild($titleElement);
}
    }
    }
    
    endwhile;
    wp_reset_postdata();
endif;

echo '<code class="codigo-post"><xmp>' . $domnoticia->saveXML() . '</xmp></code>';
echo '<a class="exitbutton" href="' . get_site_url() . '/mariangeles-noticias.xml" target="_blank">Comprobar Sitemap</a>';

$domnoticia->save(ABSPATH . 'mariangeles-noticias.xml') or die('Error al crear XML');


echo "<h2>Sitemap Index</h2>";
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https://' : 'http://';
$domindex = new DOMDocument('1.0', 'UTF-8');
$domindex->formatOutput = true;
$domindex->preserveWhiteSpace = false;

$rootindex = $domindex->createElement('sitemapindex');
$domindex->appendChild($rootindex);
$rootindex->setAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');

// URLs de los sitemaps
$sitemaps = array(
    'mariangeles-posts.xml',
    'mariangeles-paginas.xml',
    'mariangeles-noticias.xml',
);

foreach ($sitemaps as $sitemapfile) {
    $sitemap = $domindex->createElement('sitemap');
    $rootindex->appendChild($sitemap);

    $sitemap->appendChild($domindex->createElement('loc', $protocol . $_SERVER['HTTP_HOST'] . '/' . $sitemapfile));
    $sitemap->appendChild($domindex->createElement('lastmod', date('Y-m-d')));
}

echo '<code class="codigo-post"><xmp>'. $domindex->saveXML() .'</xmp></code>';
echo '<a class="exitbutton" href="' . $rutita . '/mariangeles-index.xml" target="_blank">Ver Sitemap Index</a>';

$domindex->save('mariangeles-index.xml') or die('No se pudo crear el índice de sitemaps');
?>

</section>
<style>
.site-footer{display:none}.codigo-post{background:var(--light-grey);padding:40px 16px 16px;cursor:text;font-size:16px;overflow-x:scroll;display:block;max-width:100%;min-width:100px;background-color:#0c1021;color:#fff;background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='54' height='14' viewBox='0 0 54 14'%3E%3Cg fill='none' fill-rule='evenodd' transform='translate(1 1)'%3E%3Ccircle cx='6' cy='6' r='6' fill='%23FF5F56' stroke='%23E0443E' stroke-width='.5'%3E%3C/circle%3E%3Ccircle cx='26' cy='6' r='6' fill='%23FFBD2E' stroke='%23DEA123' stroke-width='.5'%3E%3C/circle%3E%3Ccircle cx='46' cy='6' r='6' fill='%2327C93F' stroke='%231AAB29' stroke-width='.5'%3E%3C/circle%3E%3C/g%3E%3C/svg%3E");background-repeat:no-repeat;background-position:16px 8px;font-family:monospace;background-attachment:local}.codigo-post pre{margin:none}a.exitbutton{background:#8d096b;color:#faf7fb;text-decoration:inherit;font-size:22px;margin:16px auto auto;display:flex;width:fit-content;padding:16px;font-weight:700}h2{color:#8d096b;font-size:40px}
</style>
</x-layout>


