<?php
/**
 * IP Blacklist System for GeoHat LLM Tracking
 * Allows blocking specific IPs from tracking
 * Auto-blocks server IP to prevent false hits during URL checks
 */

// ==========================
// Register setting in its own group
// ==========================
add_action('admin_init', function() {
    register_setting('geohatllm_blacklist_group', 'geohatllm_ip_blacklist', [
        'type' => 'string',
        'sanitize_callback' => 'geohatllm_sanitize_ip_blacklist',
        'default' => ''
    ]);
});

// ==========================
// Sanitize IP list
// ==========================
function geohatllm_sanitize_ip_blacklist($input) {
    if (empty($input)) return '';
    
    // Split by lines
    $lines = explode("\n", $input);
    $valid_ips = [];
    
    foreach ($lines as $line) {
        $ip = trim($line);
        
        // Ignore empty lines
        if (empty($ip)) continue;
        
        // Validate IP format (IPv4)
        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            $valid_ips[] = $ip;
        }
    }
    
    // Return valid IPs (one per line)
    return implode("\n", $valid_ips);
}

// ==========================
// Get server's own IP addresses
// ==========================
function geohatllm_get_server_ips() {
    $server_ips = [];
    
    // 1. Server's main IP
    if (!empty($_SERVER['SERVER_ADDR'])) {
        $ip = $_SERVER['SERVER_ADDR'];
        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            $server_ips[] = $ip;
        }
    }
    
    // 2. Try to get IP from domain resolution
    if (!empty($_SERVER['SERVER_NAME'])) {
        $ip = gethostbyname($_SERVER['SERVER_NAME']);
        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) && $ip !== $_SERVER['SERVER_NAME']) {
            $server_ips[] = $ip;
        }
    }
    
    // 3. Common localhost IPs
    $localhost_ips = ['127.0.0.1', '::1'];
    foreach ($localhost_ips as $ip) {
        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            $server_ips[] = $ip;
        }
    }
    
    return array_unique($server_ips);
}

// ==========================
// Check if an IP is blacklisted
// ==========================
function geohatllm_is_ip_blacklisted($ip = null) {
    // If no IP provided, use current one
    if ($ip === null) {
        $ip = geohatllm_get_visitor_ip();
    }
    
    // If no IP, not blacklisted
    if (empty($ip)) return false;
    
    // ALWAYS block server's own IPs (auto-protection)
    $server_ips = geohatllm_get_server_ips();
    if (in_array($ip, $server_ips, true)) {
        return true;
    }
    
    // Get blocked IP list
    $blacklist = get_option('geohatllm_ip_blacklist', '');
    
    // If no blacklist, not blocked
    if (empty($blacklist)) return false;
    
    // Convert to array
    $blocked_ips = array_map('trim', explode("\n", $blacklist));
    
    // Check if IP is in list
    return in_array($ip, $blocked_ips, true);
}

// ==========================
// Get visitor IP (with proxy support)
// ==========================
function geohatllm_get_visitor_ip() {
    // Prioritize proxy headers if they exist
    $ip_keys = [
        'HTTP_CF_CONNECTING_IP',  // Cloudflare
        'HTTP_X_FORWARDED_FOR',   // Standard proxy
        'HTTP_X_REAL_IP',         // Nginx
        'REMOTE_ADDR'             // Direct IP
    ];
    
    foreach ($ip_keys as $key) {
        if (!empty($_SERVER[$key])) {
            // If multiple IPs (X-Forwarded-For), take the first one
            $ip = trim(explode(',', $_SERVER[$key])[0]);
            
            if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
                return $ip;
            }
        }
    }
    
    return '';
}

// ==========================
// Admin interface
// ==========================
function geohatllm_render_ip_blacklist_field() {
    $current_ip = geohatllm_get_visitor_ip();
    $server_ips = geohatllm_get_server_ips();
    ?>
    <div style="background: #fff; border: 1px solid #c3c4c7; padding: 20px; margin-top: 20px; border-radius: 4px;">
        <h2 style="margin-top: 0;"><?php _e('🚫 IP Blacklist', 'geohatllm'); ?></h2>
        <p style="color: #646970;">
            <?php _e('List of IP addresses that <strong>will not be tracked</strong>. This is useful if you want to test and don\'t want them recorded in analytics. Enter one IP per line. Invalid IPs will be automatically ignored.', 'geohatllm'); ?>
        </p>
        
        <?php if (!empty($server_ips)): ?>
        <div style="background: #e7f5fe; border-left: 4px solid #0073aa; padding: 12px; margin-bottom: 20px;">
            <strong><?php _e('🛡️ Auto-Protection Active', 'geohatllm'); ?></strong>
            <p style="margin: 8px 0 0 0; color: #50575e;">
                <?php 
                printf(
                    __('Server IPs are <strong>automatically blocked</strong> to prevent false hits during URL checks: <code>%s</code>', 'geohatllm'),
                    implode('</code>, <code>', array_map('esc_html', $server_ips))
                );
                ?>
            </p>
        </div>
        <?php endif; ?>
        
        <table class="form-table" role="presentation">
            <tr>
                <th scope="row">
                    <label for="geohatllm_ip_blacklist"><?php _e('Additional Blocked IPs', 'geohatllm'); ?></label>
                </th>
                <td>
                    <textarea 
                        name="geohatllm_ip_blacklist" 
                        id="geohatllm_ip_blacklist" 
                        rows="8" 
                        cols="50" 
                        class="large-text code"
                        placeholder="192.168.1.1&#10;203.0.113.45&#10;198.51.100.78"
                        style="font-family: monospace;"
                    ><?php echo esc_textarea(get_option('geohatllm_ip_blacklist', '')); ?></textarea>
                    
                    <p class="description">
                        <?php
                        if (!empty($current_ip)) {
                            printf(
                                __('💡 Your current IP: <code>%s</code>', 'geohatllm'),
                                esc_html($current_ip)
                            );
                            
                            if (geohatllm_is_ip_blacklisted($current_ip)) {
                                if (in_array($current_ip, $server_ips, true)) {
                                    echo ' <span style="color: #d63638;">● ' . __('Blocked (Server IP)', 'geohatllm') . '</span>';
                                } else {
                                    echo ' <span style="color: #d63638;">● ' . __('Blocked', 'geohatllm') . '</span>';
                                }
                            } else {
                                echo ' <span style="color: #00a32a;">● ' . __('Allowed', 'geohatllm') . '</span>';
                                echo ' <button type="button" class="button button-secondary" id="geohatllm_add_my_ip" style="margin-left: 10px;">' . __('➕ Add my IP', 'geohatllm') . '</button>';
                            }
                        }
                        ?>
                    </p>
                    
                    <?php
                    // Show blocked IPs counter
                    $blacklist = get_option('geohatllm_ip_blacklist', '');
                    $manual_count = 0;
                    if (!empty($blacklist)) {
                        $manual_count = count(array_filter(explode("\n", $blacklist)));
                    }
                    $total_count = $manual_count + count($server_ips);
                    
                    echo '<p class="description">';
                    printf(
                        __('📊 Total blocked IPs: <strong>%d</strong> (%d server + %d manual)', 'geohatllm'),
                        $total_count,
                        count($server_ips),
                        $manual_count
                    );
                    echo '</p>';
                    ?>
                </td>
            </tr>
        </table>
    </div>
    
    <script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        const addButton = document.getElementById('geohatllm_add_my_ip');
        
        if (addButton) {
            addButton.addEventListener('click', function() {
                const textarea = document.getElementById('geohatllm_ip_blacklist');
                const myIP = '<?php echo esc_js($current_ip); ?>';
                
                if (!myIP) {
                    alert('<?php echo esc_js(__('Could not detect your IP.', 'geohatllm')); ?>');
                    return;
                }
                
                // Get current content
                let currentValue = textarea.value.trim();
                
                // Check if IP is already in the list
                const lines = currentValue.split('\n').map(ip => ip.trim());
                if (lines.includes(myIP)) {
                    alert('<?php echo esc_js(__('Your IP is already in the blacklist.', 'geohatllm')); ?>');
                    return;
                }
                
                // Add IP at the end (with line break if there's previous content)
                if (currentValue) {
                    textarea.value = currentValue + '\n' + myIP;
                } else {
                    textarea.value = myIP;
                }
                
                // Visual feedback
                this.textContent = '<?php echo esc_js(__('✅ IP added', 'geohatllm')); ?>';
                this.disabled = true;
                this.style.opacity = '0.6';
                
                // Highlight textarea briefly
                textarea.style.border = '2px solid #00a32a';
                setTimeout(() => {
                    textarea.style.border = '';
                }, 1000);
            });
        }
    });
    </script>
    <?php
}