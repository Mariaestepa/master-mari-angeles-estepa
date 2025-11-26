<?php

/*
Next Update:

if ( did_action('elementor/loaded') ) {
    // your elementor hooks here
}

if ( class_exists('ET_Builder_Module') ) {
    // your Divi hooks here
}

if ( function_exists('vc_add_param') ) {
    add_action('vc_after_init', 'asdrubal_add_nosnippet_option_to_vc_modules');
}
*/

// Classic Editor

// 1. Add the "Styles" button to the second editor group
// 1) Ensure "Formats" button in the second editor group
add_filter('mce_buttons_2', function($buttons) {
    if (!in_array('styleselect', $buttons, true)) {
        array_unshift($buttons, 'styleselect');
    }
    return $buttons;
});

// 2) Add "GEOhat" group with its options, preserving previous formats
add_filter('tiny_mce_before_init', function($init_array) {
    // Retrieve existing formats (if any)
    $existing_formats = array();
    if (!empty($init_array['style_formats'])) {
        $existing_formats = json_decode($init_array['style_formats'], true);
        if (!is_array($existing_formats)) {
            $existing_formats = array();
        }
    }

    // GEOhat group in the "Formats" menu
    $geohat_group = array(
        'title' => __('GEOhat', 'geohatllm'),
        'items' => array(
            array(
                'title' => __('Hide from bots (GEOhat)', 'geohatllm'),
                'inline' => 'span',
                'attributes' => array(
                    'data-nosnippet-geohat' => 'true'
                )
            ),
            array(
                'title' => __('Hide from search engines', 'geohatllm'),
                'inline' => 'span', // valid for data-nosnippet
                'attributes' => array(
                    'data-nosnippet' => 'true'
                )
            )
        )
    );

    // Merge with previous without overwriting
    $merged_formats = array_merge($existing_formats, array($geohat_group));

    // Return to TinyMCE
    $init_array['style_formats'] = wp_json_encode($merged_formats);

    return $init_array;
});


// Attribute for Gutenberg
add_filter('wp_kses_allowed_html', function($allowed_tags, $context) {
    foreach ($allowed_tags as $tag => &$attributes) {
        $attributes['data-nosnippet-geohat'] = true;
        if (in_array($tag, array('div', 'section', 'span'))) {
            $attributes['data-nosnippet'] = true;
        }
    }
    return $allowed_tags;
}, 10, 2);

add_action('enqueue_block_editor_assets', function() {
    // Construir URL con parámetros personalizados
    $script_url = add_query_arg(
        array(
            'v' => '02',
            'date' => date('y-m')
        ),
        plugin_dir_url(__FILE__) . 'js/editor.js'
    );
    
    // Main editor script
    wp_enqueue_script(
        'geohatllm-editor-script',
        $script_url,  // ← Usar la URL con parámetros
        array('wp-blocks', 'wp-element', 'wp-editor', 'wp-components', 'wp-compose', 'wp-edit-post', 'wp-data'),
        GEOHATLLM_VERSION,
        true
    );
/*
    // Additional editor script
    wp_enqueue_script(
        'asdrubal-editor',
        plugin_dir_url(__FILE__) . 'assets/editor.js',
        array('wp-blocks', 'wp-element', 'wp-i18n', 'wp-editor'),
        '1.0',
        true
    );
*/
    // Translations for the script
    wp_set_script_translations(
        'asdrubal-editor',
        'geohatllm',
        plugin_dir_path(__FILE__) . 'languages'
    );
});

// ELEMENTOR 

// Add custom controls to all elements (common to sections, columns, containers, widgets)
add_action('elementor/editor/after_enqueue_scripts', 'asdrubal_enqueue_editor_script');

function asdrubal_enqueue_editor_script() {
    // Construir URL con parámetros personalizados
    $script_url = add_query_arg(
        array(
            'v' => '02',
            'date' => date('y-m')
        ),
        plugin_dir_url(__FILE__) . 'js/editor.js'
    );
    
    wp_enqueue_script(
        'geohat-editor',
        $script_url,  // ← Usar la URL con parámetros
        array(), // You can add array('jquery') if needed
        null,
        true
    );
}

add_action('elementor/element/common/section_advanced/before_section_end', function($element, $section_id) {
    $element->add_control(
        'asdrubal_data_nosnippet_geohat',
        array(
            'label' => __('Hide from LLMs (Geohat)', 'geohatllm'),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => __('Yes', 'geohatllm'),
            'label_off' => __('No', 'geohatllm'),
            'return_value' => 'yes',
            'default' => '',
            'separator' => 'before'
        )
    );

    $element->add_control(
        'asdrubal_data_nosnippet',
        array(
            'label' => __('Hide from search engines', 'geohatllm'),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => __('Yes', 'geohatllm'),
            'label_off' => __('No', 'geohatllm'),
            'return_value' => 'yes',
            'default' => '',
            'separator' => 'after'
        )
    );
}, 10, 2);

add_action('elementor/frontend/element/before_render', 'asdrubal_elementor_add_attributes');
add_action('elementor/element/container/section_layout/before_section_end', function($element, $section_id) {
    // repeat the same control code here
}, 10, 2);

function asdrubal_elementor_add_attributes($element) {
    $settings = $element->get_settings_for_display();

    if (!empty($settings['asdrubal_data_nosnippet_geohat']) && $settings['asdrubal_data_nosnippet_geohat'] === 'yes') {
        $element->add_render_attribute('_wrapper', 'data-nosnippet-geohat', 'true');
        $element->add_render_attribute('_wrapper', 'class', 'geohat-nosnippet');
    }

    if (!empty($settings['asdrubal_data_nosnippet']) && $settings['asdrubal_data_nosnippet'] === 'yes') {
        $element->add_render_attribute('_wrapper', 'data-nosnippet', 'true');
        $element->add_render_attribute('_wrapper', 'class', 'nosnippet');
    }
}


// Add attributes to any frontend element (widgets, sections, columns, containers)
add_filter('elementor/frontend/widget/should_render', 'asdrubal_elementor_set_attributes', 10, 2);
add_filter('elementor/frontend/section/should_render', 'asdrubal_elementor_set_attributes', 10, 2);
add_filter('elementor/frontend/column/should_render', 'asdrubal_elementor_set_attributes', 10, 2);
add_filter('elementor/frontend/container/should_render', 'asdrubal_elementor_set_attributes', 10, 2);

function asdrubal_elementor_set_attributes($should_render, $element) {
    $settings = $element->get_settings_for_display();

    if (!empty($settings['asdrubal_data_nosnippet_geohat']) && $settings['asdrubal_data_nosnippet_geohat'] === 'yes') {
        $element->add_render_attribute('_wrapper', 'data-nosnippet-geohat', 'true');
        $element->add_render_attribute('_wrapper', 'class', 'geohat-nosnippet');
    }

    if (!empty($settings['asdrubal_data_nosnippet']) && $settings['asdrubal_data_nosnippet'] === 'yes') {
        $element->add_render_attribute('_wrapper', 'data-nosnippet', 'true');
        $element->add_render_attribute('_wrapper', 'class', 'nosnippet');
    }

    return $should_render;
}

add_action('elementor/element/common/section_advanced/after_section_end', function($element, $section_id) {
    $element->start_controls_section(
        'asdrubal_section_geohatllm',
        array(
            'label' => __('GEOhat LLM', 'geohatllm'),
            'tab' => \Elementor\Controls_Manager::TAB_ADVANCED
        )
    );

    $element->add_control(
        'asdrubal_data_nosnippet_geohat',
        array(
            'label' => __('Hide from LLMs (Geohat)', 'geohatllm'),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => __('Yes', 'geohatllm'),
            'label_off' => __('No', 'geohatllm'),
            'return_value' => 'yes',
            'default' => ''
        )
    );

    $element->add_control(
        'asdrubal_data_nosnippet',
        array(
            'label' => __('Hide from search engines', 'geohatllm'),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => __('Yes', 'geohatllm'),
            'label_off' => __('No', 'geohatllm'),
            'return_value' => 'yes',
            'default' => ''
        )
    );

    $element->end_controls_section();
}, 10, 2);

add_action('elementor/frontend/element/before_render', function($element) {
    $settings = $element->get_settings_for_display();

    if (!empty($settings['asdrubal_data_nosnippet_geohat']) && $settings['asdrubal_data_nosnippet_geohat'] === 'yes') {
        $element->add_render_attribute('_wrapper', 'data-nosnippet-geohat', 'true');
        $element->add_render_attribute('_wrapper', 'class', 'geohat-nosnippet');
    }

    if (!empty($settings['asdrubal_data_nosnippet']) && $settings['asdrubal_data_nosnippet'] === 'yes') {
        $element->add_render_attribute('_wrapper', 'data-nosnippet', 'true');
        $element->add_render_attribute('_wrapper', 'class', 'nosnippet');
    }
});



// Attribute for Divi
// Only if Divi Builder is active
if ( class_exists('ET_Builder_Module') ) {
    add_filter('et_pb_all_fields', 'geohat_divi_add_nosnippet_fields_by_slug', 20, 2);

    function geohat_divi_add_nosnippet_fields_by_slug( $fields, $slug ) {
        // Apply only to compatible modules (you can add more here)
        $modulos_compatibles = array(
            'et_pb_accordion',
            'et_pb_text',
            'et_pb_toggle',
            'et_pb_blurb',
            'et_pb_cta',
            'et_pb_section',
            'et_pb_row',
            'et_pb_column'
        );

        if ( in_array($slug, $modulos_compatibles, true) ) {
            $fields['geohat_data_nosnippet'] = array(
                'label'        => __('Hide from search engine snippets (data-nosnippet)', 'geohatllm'),
                'type'         => 'yes_no_button',
                'options'      => array(
                    'off' => __('No', 'geohatllm'),
                    'on'  => __('Yes', 'geohatllm')
                ),
                'default'      => 'off',
                'tab_slug'     => 'advanced',
                'toggle_slug'  => 'visibility',
                'description'  => __('Adds data-nosnippet="true" (only valid on section/div/span).', 'geohatllm')
            );

            $fields['geohat_data_nosnippet_geohat'] = array(
                'label'        => __('Hide from LLMs (data-nosnippet-geohat)', 'geohatllm'),
                'type'         => 'yes_no_button',
                'options'      => array(
                    'off' => __('No', 'geohatllm'),
                    'on'  => __('Yes', 'geohatllm')
                ),
                'default'      => 'off',
                'tab_slug'     => 'advanced',
                'toggle_slug'  => 'visibility',
                'description'  => __('Adds data-nosnippet-geohat="true".', 'geohatllm')
            );
        }

        return $fields;
    }

    // Inject attributes into rendered HTML
    add_filter('et_module_shortcode_output', function($output, $render_slug, $atts){
        if ( empty($output) || !is_string($output) ) {
            return $output;
        }

        $attrs_to_add = array();

        if ( isset($atts['geohat_data_nosnippet']) && $atts['geohat_data_nosnippet'] === 'on' ) {
            $attrs_to_add['data-nosnippet'] = 'true';
        }
        if ( isset($atts['geohat_data_nosnippet_geohat']) && $atts['geohat_data_nosnippet_geohat'] === 'on' ) {
            $attrs_to_add['data-nosnippet-geohat'] = 'true';
        }

        if ( empty($attrs_to_add) ) {
            return $output;
        }

        // Only add if element is section/div/span
        if ( !preg_match('/^\s*<\s*(section|div|span)\b/i', $output) ) {
            return $output;
        }

        // Avoid duplicates and add attributes
        foreach ($attrs_to_add as $key => $val) {
            if ( !preg_match('/\b'.preg_quote($key, '/').'\s*=\s*"/i', $output) ) {
                $output = preg_replace(
                    '/^(\s*<\s*(?:section|div|span)\b)/i',
                    '$1 ' . $key . '="' . esc_attr($val) . '"',
                    $output,
                    1
                );
            }
        }

        return $output;
    }, 10, 3);

    add_filter('et_pb_all_fields_unprocessed_et_pb_section', function($fields) {
        $fields['geohat_data_nosnippet'] = array(
            'label'       => __('Hide from search engines (data-nosnippet)', 'geohatllm'),
            'type'        => 'yes_no_button',
            'options'     => array( 
                'off' => __('No', 'geohatllm'), 
                'on' => __('Yes', 'geohatllm') 
            ),
            'default'     => 'off',
            'tab_slug'    => 'advanced',
            'toggle_slug' => 'visibility'
        );
        return $fields;
    }, 20);

    add_filter('et_module_shortcode_output', function($output, $render_slug, $atts){
        if ( empty($output) || !is_string($output) ) return $output;

        if ( isset($atts['module_class']) ) {
            if ( strpos($atts['module_class'], 'geohat-nosnippet') !== false ) {
                $output = preg_replace('/^(\s*<\s*\w+)/', '$1 data-nosnippet="true"', $output, 1);
            }
            if ( strpos($atts['module_class'], 'geohat-nosnippet-geohat') !== false ) {
                $output = preg_replace('/^(\s*<\s*\w+)/', '$1 data-nosnippet-geohat="true"', $output, 1);
            }
        }

        return $output;
    }, 10, 3);

}


// WP Bakery

function asdrubal_add_nosnippet_option_to_vc_modules() {
    if (!function_exists('vc_add_param')) {
        return;
    }

    $vc_elements = WPBMap::getShortCodes();

    foreach ($vc_elements as $tag => $settings) {
        vc_add_param($tag, array(
            'type' => 'checkbox',
            'heading' => __('Prevent content from being shown to selected LLMs in GEOhat', 'geohatllm'),
            'param_name' => 'asdrubal_data_nosnippet_geohat',
            'value' => array(__('Yes', 'geohatllm') => 'yes'),
            'group' => __('Geohat', 'geohatllm')
        ));

        vc_add_param($tag, array(
            'type' => 'checkbox',
            'heading' => __('Prevent content from appearing in Google rich snippets', 'geohatllm'),
            'param_name' => 'asdrubal_data_nosnippet_google',
            'value' => array(__('Yes', 'geohatllm') => 'yes'),
            'group' => __('Geohat', 'geohatllm')
        ));
    }
}
add_action('vc_after_init', 'asdrubal_add_nosnippet_option_to_vc_modules');

function asdrubal_render_vc_module($atts, $content = null) {
    $atts = shortcode_atts(array(
        'asdrubal_data_nosnippet_geohat' => '',
        'asdrubal_data_nosnippet' => ''
    ), $atts);

    $attributes = '';
    $classes = array();

    // Only apply if wrapped in a div
    if ($atts['asdrubal_data_nosnippet_geohat'] === 'yes') {
        $attributes .= ' data-nosnippet-geohat="true"';
        $classes[] = 'geohat-nosnippet';
    }

    if ($atts['asdrubal_data_nosnippet_google'] === 'yes') {
        $attributes .= ' data-nosnippet="true"';
        $classes[] = 'nosnippet';
    }

    $class_attr = $classes ? ' class="' . esc_attr(implode(' ', $classes)) . '"' : '';

    // Render wrapped content
    return '<div' . $class_attr . $attributes . '>' . do_shortcode($content) . '</div>';
}



?>