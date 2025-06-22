<?php
function wp_seofooter() {
    
    $protocol = isset($_SERVER["HTTPS"]) ? 'https' : 'http';
    $url_sin_string = $protocol . '://' . $_SERVER['HTTP_HOST'] . strtok($_SERVER['REQUEST_URI'], '?');
    $term = get_queried_object();


    the_field('custom_meta_footer', $term);

    // Mostrar datos estructurados en la página de inicio o la de 'nosotros'
    if (is_front_page() || is_page()) {
        ?>
        <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "Organization",
          "url": "<?php echo ($url_sin_string);?>",
          "logo": "<?php echo (get_template_directory_uri()); ?>/imagenes/logo.png",
          "name": "Mª Ángeles Estepa"
        }
        </script>
        <?php

     // PRODUCT
    } elseif (is_product()) {
        global $product;

        if (!isset($product) || !($product instanceof WC_Product)) {
            $product = wc_get_product(get_the_ID());
        }

        if ($product instanceof WC_Product) {
            $product_id = $product->get_id();
            $name = $product->get_name();
            $description = wp_strip_all_tags($product->get_description());
            $sku = $product->get_sku();
            $price = $product->get_price();
            $currency = get_woocommerce_currency();
            $availability = $product->is_in_stock() ? "https://schema.org/InStock" : "https://schema.org/OutOfStock";
            $brand_name = get_field('marca');
            if (empty($brand_name)) {
            $brand_name = 'Sin marca';}
            $images = [];
            $main_image = wp_get_attachment_url($product->get_image_id());
            if ($main_image) {
                $images[] = esc_url($main_image);
            }
            foreach ($product->get_gallery_image_ids() as $img_id) {
                $images[] = esc_url(wp_get_attachment_url($img_id));
            }

            $average = $product->get_average_rating();
            $count = $product->get_review_count();
            ?>
            <script type="application/ld+json">
            {
                "@context": "https://schema.org/",
                "@type": "Product",
                "name": "<?php echo esc_js($name); ?>",
                "image": <?php echo str_replace('\\/', '/', json_encode($images)); ?>,
                "description": "<?php echo esc_js($description); ?>",
                "sku": "<?php echo esc_js($sku); ?>",
                "brand": {
                    "@type": "Brand",
                    "name": "<?php echo esc_js($brand_name); ?>"
                },
                <?php if ($count > 0): ?>
                "aggregateRating": {
                    "@type": "AggregateRating",
                    "ratingValue": "<?php echo esc_js($average); ?>",
                    "reviewCount": "<?php echo esc_js($count); ?>"
                },
                <?php endif; ?>
                "offers": {
                    "@type": "Offer",
                    "url": "<?php echo esc_url(get_permalink($product_id)); ?>",
                    "priceCurrency": "<?php echo esc_js($currency); ?>",
                    "price": "<?php echo esc_js($price); ?>",
                    "priceValidUntil": "<?php echo date('Y-m-d', strtotime('+1 year')); ?>",
                    "itemCondition": "https://schema.org/NewCondition",
                    "availability": "<?php echo $availability; ?>"
                }
            }
            </script>
            <?php
        }

    // NEWSARTICLE
    } elseif (is_singular('post')) {
        ?>
        <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "NewsArticle",
            "mainEntityOfPage": {
                "@type": "WebPage",
                "@id": "<?php echo esc_url($url_sin_string); ?>"
            },
            "headline": "<?php echo esc_js(get_the_title()); ?>",
            "image": "<?php echo the_field('imagen_cabecera'); ?>",
            "datePublished": "<?php echo get_the_date('c'); ?>",
            "dateModified": "<?php echo get_the_modified_date('c'); ?>",
            "description": "<?php echo the_field('metadescripcion'); ?>"
        }
        </script>
        <?php
    }
}

add_action('wp_footer', 'wp_seofooter');
?>
