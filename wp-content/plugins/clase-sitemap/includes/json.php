<?php
function wp_seofooter() {
  if (!function_exists('get_field')) {
        return; // Salimos si ACF no está disponible
    }
    $protocol = isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] === "on" ? 'https' : 'http';
    $url_sin_string = $protocol . '://' . $_SERVER['HTTP_HOST'] . strtok($_SERVER['REQUEST_URI'], '?');
    $term = get_queried_object();
    $proyectoname = "Ejemplo";

    if ($term) {
        $meta_footer = get_field('custom_meta_footer', $term);
        if ($meta_footer) {
            echo $meta_footer;
        }
  
  if (is_home() || (is_front_page() && is_page())) {

        ?>
        <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "Organization",
          "name": "Mª Ángeles Estepa",
          "url": "<?php echo esc_url($url_sin_string); ?>",
          "logo": "<?php echo esc_url(get_template_directory_uri()); ?>/imagenes/logo.png"
        }
        </script>
        <?php
    }
    // Mostrar script solo en productos
    elseif (is_singular('product')) {
        ?>
        <script type="application/ld+json">
        {
          "@context": "https://schema.org/",
          "@type": "Product",
          "name": "<?php the_title(); ?>",
          "image": [
            "<?php the_field('product_image'); ?>" 
          ],
          "description": "<?php the_field('metadescripcion'); ?>",
          "sku": "<?php the_field('sku'); ?>",
          "mpn": "<?php the_ID(); ?>",
          "brand": {
            "@type": "Brand",
            "name": "<?php the_field('marca'); ?>"
          },
          "offers": {
            "@type": "Offer",
            "url": "<?php echo $url_sin_string; ?>",
            "priceCurrency": "EUR",
            "price": "<?php the_field('precio'); ?>",
            "availability": "<?php the_field( 'disponib' ); ?>"
          }
        }
        </script>
        <?php
    }
    // Mostrar script en otras páginas o posts individuales
    elseif (is_singular()) {
        ?>
        <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "NewsArticle",
          "mainEntityOfPage": {
            "@type": "WebPage",
            "@id": "<?php echo $url_sin_string;?>"
          },
          "headline": "<?php the_title(); ?>",
          "image": [
            "<?php the_field('imagen_cabecera'); ?>"
          ],
          "datePublished": "<?php echo get_the_date('c'); ?>",
          "dateModified": "<?php echo get_the_modified_date('c'); ?>",
          "description": "<?php the_field('metadescripcion'); ?>"
        }
        </script>
        <?php
    }
   }
    }
     
add_action('wp_footer', 'wp_seofooter');
?>


// Obtener los datos básicos del producto
        $product_name = $product->get_name();
        $product_url = get_permalink($product->get_id());
        $product_image = wp_get_attachment_url($product->get_image_id());
        $product_sku = $product->get_sku();
        $currency = get_woocommerce_currency();
        $product_availability = $product->is_in_stock() ? 'https://schema.org/InStock' : 'https://schema.org/OutOfStock';

        <script type="application/ld+json">
        {
            "@context": "https://schema.org/",
            "@type": "Product",
            "name": "<?php echo esc_js($product_name); ?>",
            "image": "<?php echo esc_url($product_image); ?>",
            "description": <?php echo json_encode($product_description); ?>,
            "sku": "<?php echo esc_js($product_sku); ?>",
            "mpn": "<?php echo esc_js($product_sku); ?>",
            "offers": {
                "@type": "AggregateOffer",
                "url": "<?php echo esc_url($product_url); ?>",
                "priceCurrency": "<?php echo esc_js($currency); ?>",
                "lowPrice": "<?php echo esc_js($product_price_min); ?>",
                "highPrice": "<?php echo esc_js($product_price_max); ?>",
                "priceValidUntil": "<?php echo date('Y-m-d', strtotime('+1 year')); ?>",
                "availability": "<?php echo esc_js($product_availability); ?>",
                "itemCondition": "https://schema.org/NewCondition"
                 }
        </script>