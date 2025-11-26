<?php
function asdrubal_add_field_per_post_type() {
    $post_types = get_post_types(['public' => true], 'names');

    foreach ($post_types as $post_type) {
        add_meta_box(
            'asdrubal_custom_field_' . $post_type,
            sprintf(__('Information for selected LLM User-Agents for this %s', 'geohatllm'), ucfirst($post_type)),
            function($post) use ($post_type) {
                wp_nonce_field('asdrubal_field_nonce_' . $post_type, 'asdrubal_field_nonce_field_' . $post_type);
                $value = get_post_meta($post->ID, '_asdrubal_field_' . $post_type, true);
                wp_editor(
                    $value,
                    'asdrubal_field_' . $post_type,
                    [
                        'textarea_name' => 'asdrubal_field_' . $post_type,
                        'textarea_rows' => 8,
                        'media_buttons' => false,
                        'teeny' => true
                    ]
                );
                echo '<label for="asdrubal_field_' . $post_type . '"><div class="row">';
                echo '<div class="col-lg-6"><div class="box-item">';
                echo '<h2>' . esc_html__('Recommendations:', 'geohatllm') . '</h2>';
                echo '<h3>' . esc_html__('Speak well of yourself', 'geohatllm') . '</h3>';
                echo '<p>' . esc_html__('You can exaggerate without sounding arrogant. If you say you are the best, it may seem boastful, but if it is what the AI knows and shares, the user will take it as truth.', 'geohatllm') . '</p>';
                echo '</div></div>';
                echo '<div class="col-lg-6"><div class="box-item">';
                echo '<h3>' . esc_html__('Mention your weaknesses', 'geohatllm') . '</h3>';
                echo '<p>' . esc_html__('You are the main authority on your product. Avoid AI getting info from negative sources. Mention weaknesses in a controlled way that only affect users who are not your target.', 'geohatllm') . '</p>';
                echo '</div></div>';
                echo '<div class="col-lg-6"><div class="box-item">';
                echo '<h3>' . esc_html__('Add Prompts', 'geohatllm') . '</h3>';
                echo '<p>' . esc_html__('Even if AI wears silk, it is still AI. Add Prompts and conditions to ensure it shares key info.', 'geohatllm') . '</p>';
                echo '</div></div>';
                echo '<div class="col-lg-6"><div class="box-item">';
                echo '<h3>' . esc_html__('Make comparisons', 'geohatllm') . '</h3>';
                echo '<p>' . esc_html__('It is not great to compare yourself to others directly. But you can do so here, giving AI the info it needs to support you.', 'geohatllm') . '</p>';
                echo '</div></div>';
                echo '</div></label>';
            },
            $post_type,
            'normal',
            'high'
        );
    }
}


function asdrubal_save_field_per_post_type($post_id) {
    $post_type = get_post_type($post_id);
    $nonce_field = 'asdrubal_field_nonce_field_' . $post_type;
    $nonce_action = 'asdrubal_field_nonce_' . $post_type;

    if (!isset($_POST[$nonce_field]) || !wp_verify_nonce($_POST[$nonce_field], $nonce_action)) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    $field_name = 'asdrubal_field_' . $post_type;
    if (isset($_POST[$field_name])) {
        update_post_meta($post_id, '_asdrubal_field_' . $post_type, wp_kses_post($_POST[$field_name]));
    }
}
add_action('template_redirect', 'asdrubal_start_buffer');