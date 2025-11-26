<?php
add_action('admin_head', function() {
    if (!is_admin()) return;
    if (!isset($_GET['page']) || $_GET['page'] !== 'geohatllm-tracking') return;
    ?>
    <!-- Dependencias para los gráficos (solo visual, solo en admin Tracking LLM) -->
    <link rel="stylesheet" href="<?php echo plugin_dir_url(__FILE__) . '/track.css'; ?>">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        html {
            scroll-behavior: smooth;
        }
        div#descargar-datos {
            width: fit-content;
            margin: auto;
            margin-top: 1.5rem;
            margin-bottom: 1rem;
        }
        a.text-white {
            color: white !important;
        }
        nav.gh-main-nav {
            width: calc(100% + 20px) !important;
        }
        .wp-menu-image.dashicons-before img {
            display: inline;
        }
    </style>
    <?php
});
