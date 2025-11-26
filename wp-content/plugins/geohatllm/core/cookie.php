<?php
// ADMIN BAR: Añadir botón para activar/desactivar el modo LLM sin recargar
add_action('admin_bar_menu', 'asdrubal_llm_toggle_admin_bar_item_js', 100);
function asdrubal_llm_toggle_admin_bar_item_js($wp_admin_bar) {
    // Mostrar solo si está logueado y no en el admin
    if (!is_user_logged_in() || is_admin()) return;

    // Comprobar si la cookie está activa
    $is_on = isset($_COOKIE['GEOHAT-LLM-simulator-mode']) && $_COOKIE['GEOHAT-LLM-simulator-mode'] === 'on';

    // Texto según estado
    $label = $is_on
        ? __('👁️ LLM Mode: ACTIVE', 'geohatllm')
        : __('🕵️ Enable LLM Mode', 'geohatllm');

    $wp_admin_bar->add_node([
        'id'    => 'asdrubal_llm_toggle',
        'title' => $label,
        'href'  => '#',
        'meta'  => [
            'onclick' => 'toggleLLMMode(); return false;',
        ]
    ]);
}


// MOSTRAR AVISO EN EL FOOTER SI ESTÁ ACTIVO
add_action('wp_footer', function() {
    if (is_user_logged_in()) {
        ?>
        <script>
            if (document.cookie.includes('GEOHAT-LLM-simulator-mode=on')) {
                document.addEventListener("DOMContentLoaded", function () {
                    const div = document.createElement('div');
                    div.innerHTML = '👁️ <?php echo esc_js(__('You are viewing as an LLM Bot', 'geohatllm')); ?>';
                    div.style.cssText = 'position:fixed;bottom:0;left:0;z-index:9999;background:#000;color:#0f0;padding:8px 12px;font-size:12px;';
                    document.body.appendChild(div);
                });
            }
        </script>
        <?php
    }
});

// INYECTAR JS PARA GESTIÓN DE COOKIE GEOHAT-LLM-simulator-mode
// add_action('admin_footer', 'asdrubal_llm_cookie_js');
add_action('wp_footer', 'asdrubal_llm_cookie_js'); // Por si se quiere usar también en frontend

function asdrubal_llm_cookie_js() {
    if (!is_user_logged_in()) return;
    ?>
    <script>
        function toggleLLMMode() {
            const name = 'GEOHAT-LLM-simulator-mode';
            const isOn = document.cookie.includes(name + '=on');

            if (isOn) {
                // Eliminar cookie
                document.cookie = name + '=; path=/; expires=Thu, 01 Jan 1970 00:00:00 UTC;';
            } else {
                // Añadir cookie
                document.cookie = name + '=on; path=/;';
            }

            location.reload();
        }
    </script>
    <?php
}
