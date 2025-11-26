<?php


// ==================================================
// 🔄 AUTO-ACTUALIZACIÓN DE TABLA (post 08/10/2025)
// ==================================================
add_action('init', 'geohatllm_check_and_update_table');
function geohatllm_check_and_update_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'geohatllm_visits';

    // Si ya se actualizó antes, no repetir
    if (get_option('geohatllm_db_updated')) return;

    // Obtener fecha de instalación
    $install_date = get_option('geohatllm_install_date');
    if (!$install_date) return;

    // Fecha límite de corte: 2025-10-08
    $cutoff_date = '2025-10-08 00:00:00';

    // Si el plugin se instaló antes del 08/10/2025 → revisar y actualizar
    if ($install_date < $cutoff_date) {
        // Verificar si la columna 'url' existe
        $column_exists = $wpdb->get_results(
            $wpdb->prepare("SHOW COLUMNS FROM `$table_name` LIKE %s", 'url')
        );

        if (empty($column_exists)) {
            $wpdb->query("ALTER TABLE `$table_name` ADD COLUMN url VARCHAR(255) DEFAULT '' AFTER source");
        }

        // Evitar que vuelva a ejecutarse
        update_option('geohatllm_db_updated', 1);
    }
}


// Finalmente, añade esto al inicio de tu plugin:
add_action('plugins_loaded', function() {
load_plugin_textdomain( 'geohatllm', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );});

add_action('admin_menu', 'asdrubal_llm_settings_menu');

function asdrubal_llm_settings_menu() {
    add_menu_page(
        __('LLM Settings', 'geohatllm'),
        __('GEOhat LLM', 'geohatllm'),
        'manage_options',
        'geohatllm-settings',
        'asdrubal_llm_settings_page',
        plugins_url('/img/geohat.svg', __FILE__),
        74
    );
     add_submenu_page(
        'geohatllm-settings', // slug del menú padre
        __('GH Content', 'geohatllm'), // Título de la página
        __('GH Content', 'geohatllm'), // Nombre visible en el submenú
        'manage_options',
        'geohatllm-settings',
        'asdrubal_llm_settings_page'
    );
}
// =======================
// INTEGRAR EN EL MENÚ WP
// =======================
add_action('admin_menu', function() {
    add_submenu_page(
        'geohatllm-settings',          // Página padre
        __('LLM Tracker', 'geohatllm'),
        __('LLM Tracker', 'geohatllm'),

        'manage_options',
        'geohatllm-tracking',
        'geohat_llm_tracking_admin_page'
    );
    
});
add_action('admin_menu', function() {
    add_submenu_page(
        'geohatllm-settings',        // 🔹 Slug del menú padre
        __('Licencia GEOhat LLM', 'geohatllm'),  // Título de la página
        __('License', 'geohatllm'), // Texto del submenú
        'manage_options',            // Capacidad necesaria
        'geohatllm-license',         // Slug único de la subpágina
        'geohatllm_license_page'     // Función callback
    );
});

// =====================================
// OPCIONES: LLMs habilitados
// =====================================
function geohat_llm_get_sources() {
    return [
        'chatgpt.com' => 'ChatGPT',
        'gemini.google.com' => 'Gemini',
        'claude.ai' => 'Claude',
        'grok.x.ai' => 'Grok'
    ];
}

// Registrar ajustes en la base de datos de WP
add_action('admin_init', function() {
    register_setting('geohatllm_tracking', 'geohatllm_enabled_sources', [
        'type' => 'array',
        'default' => array_keys(geohat_llm_get_sources())
    ]);
});

add_action('admin_enqueue_scripts', function() {
    $screen = get_current_screen();
    if (!isset($screen->id) || strpos($screen->id, 'geohatllm') === false) return;

    $css_file = plugin_dir_path(__FILE__) . 'css/gh.css';
    $js_file  = plugin_dir_path(__FILE__) . 'js/core-admin.js';

    $css_ver = file_exists($css_file) ? filemtime($css_file) : GEOHATLLM_VERSION;
    $js_ver  = file_exists($js_file) ? filemtime($js_file) : GEOHATLLM_VERSION;

    // CSS → se imprime en el <head>
    wp_enqueue_style(
        'geohatllm-admin-style',
        plugin_dir_url(__FILE__) . 'css/gh.css',
        [],
        $css_ver
    );
    wp_enqueue_style(
        'geohatllm-google-fonts',
        'https://fonts.googleapis.com/css2?family=Sedgwick+Ave&display=swap',
        [],
        null // sin versión, para que no añada ?ver=
    );
    // JS → se imprime en el footer del admin
    wp_enqueue_script(
        'geohatllm-admin-script',
        plugin_dir_url(__FILE__) . 'js/core-admin.js',
        ['jquery'],
        $js_ver,
        true
    );
}, 1);

add_action('in_admin_header', function() {
    $screen = get_current_screen();
    if (!isset($screen->id) || strpos($screen->id, 'geohatllm') === false) return;
    echo '

<nav class="gh-main-nav">
<a href="https://geohat-llm.com/" target="_blank" class="gh-logo"> 
<img 
src="' . plugin_dir_url(__FILE__) . 'img/logo-llm.avif' .'" 
alt="GEOhat GEO" width="52" height="71"> 
</a>
<div class="gh-long-titlenavbar"> 
<div class="gh-title-nav">
GEOhat LLM
</div>
<div class="gh-nav-desc">
Versión ' . esc_html(GEOHATLLM_VERSION) . '
</div>
</div>
</nav>
';
});


add_filter('admin_footer_text', function($text) {
    $screen = get_current_screen();
    if (strpos($screen->id, 'geohatllm') === false) return $text;

    // Translatable strings (English default)
    $plugin_name = __('GEOhat LLM', 'geohatllm');
    $description = __('Plugin for improving positioning in LLMs developed by', 'geohatllm');
    $company = __('Asdrubal SEO', 'geohatllm');

    return sprintf(
        '🧠 %1$s — %2$s <a href="https://asdrubalseo.com" target="_blank">%3$s</a>',
        esc_html($plugin_name),
        esc_html($description),
        esc_html($company)
    );
});

add_filter('update_footer', function($text) {
    $screen = get_current_screen();
    if (strpos($screen->id, 'geohatllm') === false) return $text;

    // Translatable string (English default)
    $version_label = __('Plugin version:', 'geohatllm');

    return sprintf(
        '%1$s <strong>%2$s</strong>',
        esc_html($version_label),
        esc_html(GEOHATLLM_VERSION)
    );
}, 999);

include_once 'updates/update-checker.php';
?>