<?php
// Hook para manejar la información del plugin
add_filter('plugins_api', 'geohatllm_plugin_info', 10, 3);

function geohatllm_plugin_info($result, $action, $args) {
    if ($action !== 'plugin_information') {
        return $result;
    }
    
    // Verificar si es nuestro plugin
    if ($args->slug !== 'geohatllm') {
        return $result;
    }
    
    $remote_url = 'https://geohat-llm.com/update.json';
    $response = wp_remote_get($remote_url, ['timeout' => 10]);
    
    if (is_wp_error($response)) {
        return $result;
    }
    
    $data = json_decode(wp_remote_retrieve_body($response));
    if (!$data) {
        return $result;
    }
    
    // Crear objeto con la información del plugin
    $plugin_info = new stdClass();
    $plugin_info->name = 'geohatllm';
    $plugin_info->slug = 'geohatllm';
    $plugin_info->version = $data->version;
    $plugin_info->author = 'Asdrubal SEO';
    $plugin_info->homepage = 'https://geohat-llm.com/';
    $plugin_info->download_link = $data->download_url;
    $plugin_info->trunk = $data->download_url;
    $plugin_info->requires = isset($data->requires) ? $data->requires : '6.0';
    $plugin_info->tested = isset($data->tested) ? $data->tested : '6.7';
    $plugin_info->requires_php = isset($data->requires_php) ? $data->requires_php : '7.4';
    $plugin_info->last_updated = isset($data->last_updated) ? $data->last_updated : date('Y-m-d');
    
    // IMPORTANTE: Agregar iconos para que se muestren en la lista
    $plugin_info->icons = array(
        '1x' => isset($data->icon_1x) ? $data->icon_1x : 'https://geohat-llm.com/assets/icon-128x128.png',
        '2x' => isset($data->icon_2x) ? $data->icon_2x : 'https://geohat-llm.com/assets/icon-256x256.png',
        'svg' => isset($data->icon_svg) ? $data->icon_svg : 'https://geohat-llm.com/assets/icon.svg',
        'default' => isset($data->icon_default) ? $data->icon_default : 'https://geohat-llm.com/wp-content/themes/asdrubal/assets/images/logo-llm-square.png'
    );
    
    // Opcional: También puedes agregar banners
    $plugin_info->banners = array(
        'low' => isset($data->banner_low) ? $data->banner_low : 'https://geohat-llm.com/assets/banner-772x250.png',
        'high' => isset($data->banner_high) ? $data->banner_high : 'https://geohat-llm.com/assets/banner-1544x500.png'
    );
    
    $plugin_info->sections = array(
        'description' => 'Add information to your website for LLMs or hide content from LLMs.',
        'changelog' => isset($data->changelog) ? $data->changelog : 'Version ' . $data->version
    );
    
    return $plugin_info;
}

// Hook para verificar actualizaciones
add_filter('pre_set_site_transient_update_plugins', 'geohatllm_check_for_updates');

function geohatllm_check_for_updates($transient) {
    if (empty($transient->checked)) {
        return $transient;
    }
    
    $plugin_slug = 'geohatllm/geohatllm.php';
    $remote_url = 'https://geohat-llm.com/update.json';
    
    // Obtener datos remotos
    $response = wp_remote_get($remote_url, ['timeout' => 10]);
    
    if (is_wp_error($response) || wp_remote_retrieve_response_code($response) !== 200) {
        return $transient;
    }
    
    $data = json_decode(wp_remote_retrieve_body($response));
    if (!$data) {
        return $transient;
    }
    
    // Verificar si hay actualización disponible
    $current_version = GEOHATLLM_VERSION;
    
    if (version_compare($data->version, $current_version, '>')) {
        // Preparar los iconos
        $icons = array(
            '1x' => isset($data->icon_1x) ? $data->icon_1x : 'https://geohat-llm.com/assets/icon-128x128.png',
            '2x' => isset($data->icon_2x) ? $data->icon_2x : 'https://geohat-llm.com/assets/icon-256x256.png',
            'svg' => isset($data->icon_svg) ? $data->icon_svg : 'https://geohat-llm.com/assets/icon.svg',
            'default' => isset($data->icon_default) ? $data->icon_default : 'https://geohat-llm.com/assets/icon-128x128.png'
        );
        
        // Preparar los banners (opcional)
        $banners = array(
            'low' => isset($data->banner_low) ? $data->banner_low : '',
            'high' => isset($data->banner_high) ? $data->banner_high : ''
        );
        
        $plugin_data = array(
            'id'            => $plugin_slug,
            'slug'          => 'geohatllm',
            'plugin'        => $plugin_slug,
            'new_version'   => $data->version,
            'url'           => 'https://geohat-llm.com/',
            'package'       => $data->download_url,
            'icons'         => $icons, // IMPORTANTE: Agregar los iconos aquí
            'banners'       => $banners, // Opcional: Agregar banners
            'tested'        => isset($data->tested) ? $data->tested : '6.7',
            'requires_php'  => isset($data->requires_php) ? $data->requires_php : '7.4',
            'compatibility' => new stdClass(),
        );
        
        $transient->response[$plugin_slug] = (object) $plugin_data;
    }
    
    return $transient;
}

// Opcional: Limpiar caché de actualizaciones para forzar recarga
add_action('upgrader_process_complete', 'geohatllm_clear_update_cache', 10, 2);

function geohatllm_clear_update_cache($upgrader_object, $options) {
    if ($options['action'] == 'update' && $options['type'] == 'plugin') {
        delete_site_transient('update_plugins');
    }
}
/*
// Opcional: Forzar verificación de actualizaciones (útil para debugging)
add_filter('site_transient_update_plugins', 'geohatllm_force_check');

function geohatllm_force_check($transient) {
    // Solo en modo debug
    if (defined('WP_DEBUG') && WP_DEBUG) {
        if (isset($transient->last_checked) && time() - $transient->last_checked < 60) {
            // Ya se verificó en el último minuto
            return $transient;
        }
    }
    return $transient;
}
*/