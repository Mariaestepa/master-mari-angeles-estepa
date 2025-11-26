<?php
/*
DETECTAR IPHONE - TRACKING POR ALTURA DE VENTANA

Registra hits de ChatGPT solo cuando la altura de ventana
NO coincida con las alturas conocidas de Safari nativo.
*/

if (!defined('ABSPATH')) exit;

// ========================================
// 📊 BASE DE DATOS: ALTURAS DE IPHONE
// ========================================

/**
 * Retorna array con alturas conocidas de Safari por modelo
 * ✅ Actualiza aquí cuando tengas nuevos datos
 */
function geohatllm_iphone_safari_heights() {
    return array(
        // iPhone XR
        714,

        // iPhone 11
        643,

        // iPhone 12 
        663,

        // iPhone 12 Pro
        645,

        // iPhone 13
        745,

        // iPhone 13 Pro
        663, 738,

        // iPhone 13 Pro Max
        763, 762,

        // iPhone 14 Pro
        681, 731, 695,

        // iPhone 14 Pro Max
        739,

        // iPhone 15 Pro Max
        739, 729,

        // iPhone 16
        760,

        // iPhone 16 Plus
        734,

        // iPhone 16 Pro
        760, 714,

        // iPhone 16 Pro Max
        759,

        // Desconocidos:
        796,
        // iPhone 17 Pro Max
        796
    );
}

/**
 * Altura máxima válida para iPhone
 * Cualquier altura superior indica spoofing de user-agent
 */
function geohatllm_iphone_max_height() {
    return 900; // Ningún iPhone tiene más de 900px de altura
}

/**
 * Altura mínima válida para iPhone
 * Cualquier altura inferior indica spoofing o error
 */
function geohatllm_iphone_min_height() {
    return 500; // iPhones más pequeños tienen al menos 500px
}

/**
 * Verifica si una altura está en la blacklist de Safari
 */
function geohatllm_is_safari_height($height) {
    $blacklist = geohatllm_iphone_safari_heights();
    return in_array((int)$height, $blacklist, true);
}

/**
 * Verifica si la altura está en el rango válido de iPhone
 */
function geohatllm_is_valid_iphone_height($height) {
    $height = (int)$height;
    $min = geohatllm_iphone_min_height();
    $max = geohatllm_iphone_max_height();
    
    return ($height >= $min && $height <= $max);
}

// ========================================
// 📱 INYECTAR TRACKING EN HEAD
// ========================================

add_action('wp_head', function() {
    // Solo para iPhone
    $ua = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
    if (stripos($ua, 'iPhone') === false) return;
    
    // ✅ Script para capturar altura y enviar AJAX
    ?>
    <script>
    (function() {
        if (!navigator.userAgent.includes('iPhone')) return;
        
        // Capturar alturas
        const vh = window.innerHeight;
        const dvh = window.visualViewport ? window.visualViewport.height : vh;
        
        // Preparar datos
        const data = new FormData();
        data.append('action', 'geohatllm_iphone_height');
        data.append('vh', vh);
        data.append('dvh', dvh);
        data.append('url', window.location.href);
        
        // Enviar vía fetch no bloqueante
        fetch('<?php echo esc_url(admin_url('admin-ajax.php')); ?>', {
            method: 'POST',
            body: data,
            keepalive: true
        }).catch(() => {
            // Silenciar errores para no afectar UX
        });
    })();
    </script>
    <?php
}, 999);

// ========================================
// 🎯 AJAX HANDLER: PROCESAR ALTURA Y REGISTRAR HIT
// ========================================

add_action('wp_ajax_geohatllm_iphone_height', 'geohatllm_process_iphone_height');
add_action('wp_ajax_nopriv_geohatllm_iphone_height', 'geohatllm_process_iphone_height');

function geohatllm_process_iphone_height() {
    // Validar que sea iPhone
    $ua = $_SERVER['HTTP_USER_AGENT'] ?? '';
    if (stripos($ua, 'iPhone') === false) {
        wp_die('Not iPhone', '', 200);
    }
    
    // Obtener datos
    $vh = isset($_POST['vh']) ? (int)$_POST['vh'] : 0;
    $dvh = isset($_POST['dvh']) ? (int)$_POST['dvh'] : 0;
    $url = isset($_POST['url']) ? esc_url_raw($_POST['url']) : '';
    
    if (!$vh || !$url) {
        wp_die('Missing data', '', 200);
    }
    
    // ✅ 1. VERIFICAR SI LA ALTURA ESTÁ EN RANGO VÁLIDO
    if (!geohatllm_is_valid_iphone_height($vh)) {
        wp_die('Invalid height range (possible spoofing)', '', 200);
    }
    
    if ($dvh > 0 && !geohatllm_is_valid_iphone_height($dvh)) {
        wp_die('Invalid dvh range (possible spoofing)', '', 200);
    }
    
    // ✅ 2. VERIFICAR SI ES ALTURA DE SAFARI (BLACKLIST)
    $is_safari_vh = geohatllm_is_safari_height($vh);
    $is_safari_dvh = geohatllm_is_safari_height($dvh);
    
    // Si alguna altura coincide con Safari = NO REGISTRAR
    if ($is_safari_vh || $is_safari_dvh) {
        wp_die('Safari height detected', '', 200);
    }
    
    // ✅ 3. VERIFICAR CONDICIONES DE TRACKING
    if (!geohatllm_should_track()) {
        wp_die('Tracking disabled', '', 200);
    }
    
    if (!geohatllm_has_valid_license()) {
        wp_die('No license', '', 200);
    }
    
    if (geohatllm_is_ip_blacklisted()) {
        wp_die('IP blacklisted', '', 200);
    }
    
    // ✅ 4. Verificar si ya registramos este visitante (evitar duplicados)
    $visitor_ip = geohatllm_get_visitor_ip();
    $visitor_hash = md5($visitor_ip . $ua . $vh . $dvh);
    $transient_key = 'geohatllm_iphone_tracked_' . $visitor_hash;
    
    if (get_transient($transient_key)) {
        wp_die('Already tracked', '', 200);
    }
    
    // ✅ 5. REGISTRAR HIT DE CHATGPT
    global $wpdb;
    $table = $wpdb->prefix . 'geohatllm_visits';
    
    $result = $wpdb->insert(
        $table,
        array(
            'visit_date' => current_time('mysql'),
            'source'     => 'chatgpt',
            'url'        => $url,
            'hits'       => 1
        ),
        array('%s', '%s', '%s', '%d')
    );
    
    if ($result) {
        // Marcar como registrado por 1 minuto
        set_transient($transient_key, true, MINUTE_IN_SECONDS);
        wp_die('Hit registered', '', 200);
    } else {
        wp_die('Database error', '', 500);
    }
}
