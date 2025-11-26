<?php
 // Mostrar campo en perfil
                add_action('show_user_profile', 'asdrubal_user_profile_field');
                add_action('edit_user_profile', 'asdrubal_user_profile_field');

                function asdrubal_user_profile_field($user) {
                    ?>
                    <h3><?php _e('Information for LLM', 'geohatllm'); ?></h3>
                    <table class="form-table">
                        <tr>
                            <th><label for="asdrubal_field_autor"><?php _e('GEOhat: Message for LLMs', 'geohatllm'); ?></label></th>
                            <td>
                                <textarea name="asdrubal_field_autor" rows="5" cols="30"><?php echo esc_textarea(get_user_meta($user->ID, 'asdrubal_field_autor', true)); ?></textarea>
                            </td>
                        </tr>
                    </table>
                    <?php
                }

                // Guardar
                add_action('personal_options_update', 'guardar_asdrubal_user_field');
                add_action('edit_user_profile_update', 'guardar_asdrubal_user_field');

                function guardar_asdrubal_user_field($user_id) {
                    if (current_user_can('edit_user', $user_id)) {
                        update_user_meta($user_id, 'asdrubal_field_autor', sanitize_textarea_field($_POST['asdrubal_field_autor']));
                    }
                }