<?php
add_action('admin_init', function() {
    register_setting('asdrubal_llm_settings_group', 'asdrubal_llm_custom_css');
});

add_action('asdrubal_llm_settings_after_form', function() {
    $css = get_option('asdrubal_llm_custom_css', '');
    echo '<hr>';
    echo '<h2>' . __('Custom CSS for LLMs', 'geohatllm') . '</h2>';
    echo '<p>' . __('These styles will only be applied when an LLM bot is visiting your site.', 'geohatllm') . '</p>';
    echo '<p><b>' . htmlspecialchars('<style id="geohat-llm-custom-css">', ENT_QUOTES) . '</b></p>';
    echo '<textarea name="asdrubal_llm_custom_css" rows="4" style="width:600px; margin-left:25px; font-family:monospace;">' . esc_textarea($css) . '</textarea>';
    echo '<p><b>' . htmlspecialchars('</style>', ENT_QUOTES) . '</b></p>';

});

add_action('wp_footer', function () {
    if (!function_exists('asdrubal_is_restricted_bot') || !asdrubal_is_restricted_bot()) return; // Solo si es un LLM permitido

    $css = trim(get_option('asdrubal_llm_custom_css', ''));
    if (empty($css)) return;

    echo "\n<!-- Gh custom CSS -->\n";
    echo "<style id='geohat-llm-custom-css'>\n" . $css . "\n</style>\n";
}, PHP_INT_MAX); // PHP_INT_MAX = prioridad más baja (se ejecuta al final del footer)
