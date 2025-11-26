<?php
// CONFIGURACIÓN PARA QUE LA CACHÉ NO JODA EL PLUGIN

add_action('init', 'asdrubal_disable_cache_for_bots', 1);
function asdrubal_disable_cache_for_bots() {
    if (defined('DOING_AJAX') && DOING_AJAX) return;

    $disable_cache = get_option('asdrubal_llm_disable_cache', false);
    if (!$disable_cache) return;

    $ua = strtolower(asdrubal_get_effective_user_agent());
    
    // CORRECCIÓN: Asegurar que $allowed_bots siempre sea un array
    $allowed_bots = get_option('asdrubal_llm_selected_bots', array());
    if (!is_array($allowed_bots)) {
        $allowed_bots = [];
    }
    
    $custom = get_option('asdrubal_llm_custom_bots', '');
    $custom_list = array_filter(array_map('trim', explode("\n", $custom)));
    $allowed_bots = array_merge($allowed_bots, $custom_list);

    $is_bot = false;
    
    foreach ($allowed_bots as $bot) {
        if (stripos($ua, $bot) !== false) {
            $is_bot = true;
            break;
        }
    }
    
    // NUEVO: iPhone sin JS (Grok)
    if (asdrubal_is_iphone_no_js_llm($ua)) {
        $is_bot = true;
    }
    
    if ($is_bot) {
        // Desactivar todas las cachés
        if (!defined('DONOTCACHEPAGE')) define('DONOTCACHEPAGE', true);
        if (!defined('DONOTCACHEOBJECT')) define('DONOTCACHEOBJECT', true);
        if (!defined('DONOTCACHEDB')) define('DONOTCACHEDB', true);
        
        // LiteSpeed Cache - Método correcto
        if (!defined('LSCACHE_NO_CACHE')) define('LSCACHE_NO_CACHE', true);
        do_action('litespeed_control_set_nocache', 'bot detected');
        
        // NitroPack
        if (!defined('NITROPACK_DISABLE_CACHE')) define('NITROPACK_DISABLE_CACHE', true);
        
        // WP Rocket
        if (!defined('DONOTROCKETOPTIMIZE')) define('DONOTROCKETOPTIMIZE', true);
        
        // W3 Total Cache
        if (!defined('DONOTMINIFY')) define('DONOTMINIFY', true);
        
        // Añadir headers para asegurar que no se cachea
        if (!headers_sent()) {
            header('Cache-Control: no-cache, no-store, must-revalidate');
            header('Pragma: no-cache');
            header('Expires: 0');
        }
    }
}

// Hook adicional específico para LiteSpeed
add_filter('litespeed_cache_check_cookies', 'asdrubal_litespeed_bypass_for_bots', 10, 1);
function asdrubal_litespeed_bypass_for_bots($can_cache) {
    $disable_cache = get_option('asdrubal_llm_disable_cache', false);
    if (!$disable_cache) return $can_cache;

    $ua = strtolower(asdrubal_get_effective_user_agent());
    
    $allowed_bots = get_option('asdrubal_llm_selected_bots', array());
    if (!is_array($allowed_bots)) {
        $allowed_bots = [];
    }
    
    $custom = get_option('asdrubal_llm_custom_bots', '');
    $custom_list = array_filter(array_map('trim', explode("\n", $custom)));
    $allowed_bots = array_merge($allowed_bots, $custom_list);

    foreach ($allowed_bots as $bot) {
        if (stripos($ua, $bot) !== false) {
            return false; // No cachear
        }
    }
    
    if (asdrubal_is_iphone_no_js_llm($ua)) {
        return false; // No cachear
    }

    return $can_cache;
}

// Hook adicional para LiteSpeed - Control de caché
add_action('litespeed_init', 'asdrubal_litespeed_control_init');
function asdrubal_litespeed_control_init() {
    $disable_cache = get_option('asdrubal_llm_disable_cache', false);
    if (!$disable_cache) return;

    $ua = strtolower(asdrubal_get_effective_user_agent());
    
    $allowed_bots = get_option('asdrubal_llm_selected_bots', array());
    if (!is_array($allowed_bots)) {
        $allowed_bots = [];
    }
    
    $custom = get_option('asdrubal_llm_custom_bots', '');
    $custom_list = array_filter(array_map('trim', explode("\n", $custom)));
    $allowed_bots = array_merge($allowed_bots, $custom_list);

    foreach ($allowed_bots as $bot) {
        if (stripos($ua, $bot) !== false) {
            do_action('litespeed_control_set_nocache', 'asdrubal bot detected');
            return;
        }
    }
    
    if (asdrubal_is_iphone_no_js_llm($ua)) {
        do_action('litespeed_control_set_nocache', 'asdrubal iphone llm detected');
    }
}


add_filter('do_rocket_generate_caching_files', 'asdrubal_exclude_bots_from_cache');
function asdrubal_exclude_bots_from_cache($can_cache) {
    $ua = strtolower(asdrubal_get_effective_user_agent());
    $allowed_bots = get_option('asdrubal_llm_selected_bots', array());
    $custom = get_option('asdrubal_llm_custom_bots', '');
    $custom_list = array_filter(array_map('trim', explode("\n", $custom)));
    $allowed_bots = array_merge($allowed_bots, $custom_list);

    foreach ($allowed_bots as $bot) {
        if (stripos($ua, $bot) !== false) {
            return false; // No cache for this bot
        }
    }
    if (asdrubal_is_iphone_no_js_llm($ua)) {
        return false;
    }

    return $can_cache;
}