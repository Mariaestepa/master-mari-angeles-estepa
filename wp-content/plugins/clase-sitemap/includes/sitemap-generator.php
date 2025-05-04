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
//$resultblog->setAttribute('id', 1);
$argsblog = array(
'posts_per_page' => -1,
//'post__not_in' => array($post->ID), // Ensure that the current post is not displayed
'post_type' => 'post',
'orderby' => 'desc',
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
//$resultpage->setAttribute('id', 1);
$argspage = array(
'posts_per_page' => -1,
//'post__not_in' => array($post->ID), // Ensure that the current post is not displayed
'post_type' => 'page',
'orderby' => 'desc',
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
}
}
endwhile;
wp_reset_postdata();
endif;
// Así vemos el código que se hace
echo '<code class="codigo-post"><xmp>'. $dompage->saveXML() .'</xmp></code>';
echo '<a class="exitbutton" href="' . $rutita . '/mariangeles-paginas.xml" target="_blank">Comprobar Sitemap</a>';
$dompage->save('mariangeles-paginas.xml') or die('XML Create Error');


echo "<h2>Sitemap Index</h2>";

$domindex = new DOMDocument('1.0', 'UTF-8');
$domindex->formatOutput = true;
$domindex->preserveWhiteSpace = false;

$rootindex = $domindex->createElement('sitemapindex');
$domindex->appendChild($rootindex);
$rootindex->setAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');

// URLs de los sitemaps
$sitemaps = array(
    'sitemap-posts.xml',
    'sitemap-paginas.xml'
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

<?xml-stylesheet href="/wp-content/themes/mariangelesestepa/stylesheet.xsl" type="text/xsl"?>
</section>
<style>
.site-footer{display:none}.codigo-post{background:var(--light-grey);padding:40px 16px 16px;cursor:text;font-size:16px;overflow-x:scroll;display:block;max-width:100%;min-width:100px;background-color:#0c1021;color:#fff;background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='54' height='14' viewBox='0 0 54 14'%3E%3Cg fill='none' fill-rule='evenodd' transform='translate(1 1)'%3E%3Ccircle cx='6' cy='6' r='6' fill='%23FF5F56' stroke='%23E0443E' stroke-width='.5'%3E%3C/circle%3E%3Ccircle cx='26' cy='6' r='6' fill='%23FFBD2E' stroke='%23DEA123' stroke-width='.5'%3E%3C/circle%3E%3Ccircle cx='46' cy='6' r='6' fill='%2327C93F' stroke='%231AAB29' stroke-width='.5'%3E%3C/circle%3E%3C/g%3E%3C/svg%3E");background-repeat:no-repeat;background-position:16px 8px;font-family:monospace;background-attachment:local}.codigo-post pre{margin:none}a.exitbutton{background:#8d096b;color:#faf7fb;text-decoration:inherit;font-size:22px;margin:16px auto auto;display:flex;width:fit-content;padding:16px;font-weight:700}h2{color:#8d096b;font-size:40px}
</style>
</x-layout>


