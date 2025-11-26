<?php
// Mostrar el campo al añadir una nueva categoría
add_action('category_add_form_fields', function() {
    ?>
    <div class="form-field">
        <label for="asdrubal_field_categoria"><?php esc_html_e('GEOhat: Message for LLMs', 'geohatllm'); ?></label>
        <textarea name="asdrubal_field_categoria" rows="5" cols="40"></textarea>
    </div>
    <?php
});

// Mostrar el campo al editar una categoría
add_action('category_edit_form_fields', function($term) {
    $value = get_term_meta($term->term_id, 'asdrubal_field_categoria', true);
    ?>
    <tr class="form-field">
        <th><label for="asdrubal_field_categoria"><?php esc_html_e('GEOhat: Message for LLMs', 'geohatllm'); ?></label></th>
        <td>
            <textarea name="asdrubal_field_categoria" rows="5" cols="50"><?php echo esc_textarea($value); ?></textarea>
        </td>
    </tr>
    <?php
});

// Guardar el campo
add_action('created_category', 'guardar_meta_categoria');
add_action('edited_category', 'guardar_meta_categoria');
function guardar_meta_categoria($term_id) {
    if (isset($_POST['asdrubal_field_categoria'])) {
        update_term_meta($term_id, 'asdrubal_field_categoria', sanitize_textarea_field($_POST['asdrubal_field_categoria']));
    }
}

// Verificar si WooCommerce está activo antes de añadir los hooks
add_action('plugins_loaded', function() {
    if (!class_exists('WooCommerce')) {
        return;
    }

    // Mostrar el campo al añadir una nueva categoría de producto
    add_action('product_cat_add_form_fields', function() {
        ?>
        <div class="form-field">
            <label for="asdrubal_field_categoria"><?php esc_html_e('GEOhat: Message for LLMs', 'geohatllm'); ?></label>
            <textarea name="asdrubal_field_categoria" rows="5" cols="40"></textarea>
        </div>
        <?php
    });

    // Mostrar el campo al editar una categoría de producto
    add_action('product_cat_edit_form_fields', function($term) {
        $value = get_term_meta($term->term_id, 'asdrubal_field_categoria', true);
        ?>
        <tr class="form-field">
            <th><label for="asdrubal_field_categoria"><?php esc_html_e('GEOhat: Message for LLMs', 'geohatllm'); ?></label></th>
            <td>
                <textarea name="asdrubal_field_categoria" rows="5" cols="50"><?php echo esc_textarea($value); ?></textarea>
            </td>
        </tr>
        <?php
    });

    // Guardar el campo
    add_action('created_product_cat', 'guardar_meta_categoria_wc');
    add_action('edited_product_cat', 'guardar_meta_categoria_wc');
});

function guardar_meta_categoria_wc($term_id) {
    if (isset($_POST['asdrubal_field_categoria'])) {
        update_term_meta($term_id, 'asdrubal_field_categoria', sanitize_textarea_field($_POST['asdrubal_field_categoria']));
    }
}


// ============================================
// ETIQUETAS NORMALES DE WORDPRESS
// ============================================

// Mostrar el campo al añadir una nueva etiqueta
add_action('post_tag_add_form_fields', function() {
    ?>
    <div class="form-field">
        <label for="asdrubal_field_etiqueta"><?php esc_html_e('GEOhat: Message for LLMs', 'geohatllm'); ?></label>
        <textarea name="asdrubal_field_etiqueta" rows="5" cols="40"></textarea>
    </div>
    <?php
});

// Mostrar el campo al editar una etiqueta
add_action('post_tag_edit_form_fields', function($term) {
    $value = get_term_meta($term->term_id, 'asdrubal_field_etiqueta', true);
    ?>
    <tr class="form-field">
        <th><label for="asdrubal_field_etiqueta"><?php esc_html_e('GEOhat: Message for LLMs', 'geohatllm'); ?></label></th>
        <td>
            <textarea name="asdrubal_field_etiqueta" rows="5" cols="50"><?php echo esc_textarea($value); ?></textarea>
        </td>
    </tr>
    <?php
});

// Guardar el campo
add_action('created_post_tag', 'guardar_meta_etiqueta');
add_action('edited_post_tag', 'guardar_meta_etiqueta');
function guardar_meta_etiqueta($term_id) {
    if (isset($_POST['asdrubal_field_etiqueta'])) {
        update_term_meta($term_id, 'asdrubal_field_etiqueta', sanitize_textarea_field($_POST['asdrubal_field_etiqueta']));
    }
}

// ============================================
// ETIQUETAS DE WOOCOMMERCE
// ============================================

// Verificar si WooCommerce está activo antes de añadir los hooks
add_action('plugins_loaded', function() {
    if (!class_exists('WooCommerce')) {
        return;
    }

    // Mostrar el campo al añadir una nueva etiqueta de producto
    add_action('product_tag_add_form_fields', function() {
        ?>
        <div class="form-field">
            <label for="asdrubal_field_etiqueta"><?php esc_html_e('GEOhat: Message for LLMs', 'geohatllm'); ?></label>
            <textarea name="asdrubal_field_etiqueta" rows="5" cols="40"></textarea>
        </div>
        <?php
    });

    // Mostrar el campo al editar una etiqueta de producto
    add_action('product_tag_edit_form_fields', function($term) {
        $value = get_term_meta($term->term_id, 'asdrubal_field_etiqueta', true);
        ?>
        <tr class="form-field">
            <th><label for="asdrubal_field_etiqueta"><?php esc_html_e('GEOhat: Message for LLMs', 'geohatllm'); ?></label></th>
            <td>
                <textarea name="asdrubal_field_etiqueta" rows="5" cols="50"><?php echo esc_textarea($value); ?></textarea>
            </td>
        </tr>
        <?php
    });

    // Guardar el campo
    add_action('created_product_tag', 'guardar_meta_etiqueta_wc');
    add_action('edited_product_tag', 'guardar_meta_etiqueta_wc');
});

function guardar_meta_etiqueta_wc($term_id) {
    if (isset($_POST['asdrubal_field_etiqueta'])) {
        update_term_meta($term_id, 'asdrubal_field_etiqueta', sanitize_textarea_field($_POST['asdrubal_field_etiqueta']));
    }
}