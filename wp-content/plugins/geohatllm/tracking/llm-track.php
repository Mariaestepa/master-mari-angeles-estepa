<?php
// ==========================
// Source list (for future use)
// ==========================
function geohatllm_tracking_sources_list() {
    return array(
        'chatgpt'     => 'ChatGPT',
        'gemini'      => 'Gemini',
        'claude'      => 'Claude',
        'copilot'     => 'Copilot',
        'perplexity'  => 'Perplexity',
        'mistral'     => 'Mistral',
        'venice'      => 'Venice',
        'n'        => __('Other LLMs', 'geohatllm'),
    );
}
 goto TJpWj; WEL9C: $tracking_enabled = get_option("\x67\x65\x6f\150\x61\164\x6c\154\155\x5f\x74\162\x61\x63\x6b\x69\156\x67\137\x65\156\141\x62\x6c\145\x64", 1); goto hZmvf; llrVv: $geohatllm_iph_is_iphone = stripos($geohatllm_iph_iphone_ua, "\x69\x50\x68\157\156\145") !== false; goto imTs_; hZmvf: if (!$license_valid) { $tracking_enabled = 0; } goto xiU_7; w9YoF: $geohatllm_iph_is_firefox = stripos($geohatllm_iph_iphone_ua, "\106\151\162\x65\146\157\170") !== false || stripos($geohatllm_iph_iphone_ua, "\x46\x78\x69\117\x53") !== false; goto boctI; Fi69d: include_once "\x6b\x69\x74\163\x2f\x30\x32\x2d\x76\x69\x73\165\x61\154\55\x63\x68\x61\162\x74\56\160\x68\x70"; goto j6gdQ; gKu6p: $geohatllm_iph_is_chrome = stripos($geohatllm_iph_iphone_ua, "\103\150\x72\x6f\x6d\x65") !== false || stripos($geohatllm_iph_iphone_ua, "\x43\x72\x69\x4f\x53") !== false; goto w9YoF; JOvLe: if (!$license_valid) { $tracking_enabled = 0; update_option("\147\145\157\x68\x61\x74\154\154\x6d\137\x74\x72\x61\143\x6b\151\156\x67\137\145\156\x61\142\154\x65\144", 0); } goto m3dui; jmivj: if ($geohatllm_iph_is_iphone_safari) { include_once "\153\151\164\163\57\60\70\x2d\151\160\x68\157\x6e\145\55\x67\x70\164\56\160\x68\x70"; } goto bZA83; imTs_: $geohatllm_iph_is_safari = stripos($geohatllm_iph_iphone_ua, "\123\x61\x66\141\162\151") !== false; goto gKu6p; bZA83: add_action("\141\x64\x6d\x69\x6e\x5f\x69\x6e\151\x74", function () { register_setting("\x67\x65\x6f\x68\x61\164\154\x6c\x6d\x5f\164\x72\141\143\153\151\156\147\137\147\162\x6f\x75\160", "\147\x65\157\150\141\164\154\x6c\x6d\x5f\164\162\141\143\153\151\x6e\147\x5f\145\156\141\142\x6c\145\x64"); register_setting("\x67\145\x6f\x68\141\x74\154\154\155\x5f\x74\162\x61\x63\x6b\x69\x6e\x67\x5f\147\x72\157\165\160", "\x67\145\157\x68\141\164\154\x6c\x6d\137\x65\x6e\x61\142\154\145\144\137\163\x6f\x75\x72\x63\x65\163"); }); goto IO1i4; ZwLuy: function geohat_llm_tracking_admin_page() { global $wpdb; $table = $wpdb->prefix . "\x67\145\x6f\150\x61\x74\x6c\x6c\155\x5f\x76\151\163\151\x74\163"; $sources = geohatllm_tracking_sources_list(); $enabled_sources = (array) get_option("\x67\x65\x6f\x68\141\x74\x6c\154\x6d\x5f\x65\156\141\142\154\x65\x64\x5f\x73\x6f\x75\x72\143\x65\163", array("\x63\150\x61\164\147\x70\x74")); ?>
    <div class="wrap">
        <h1><?php  _e("\x4c\114\115\40\124\x72\x61\x63\153\x69\x6e\x67", "\147\145\157\150\x61\x74\154\x6c\155"); ?>
</h1>
        <form method="post" action="options.php">
            <?php  settings_fields("\x67\x65\x6f\150\141\x74\x6c\154\155\137\x74\162\x61\143\x6b\151\156\x67\x5f\x67\162\x6f\x75\160"); do_settings_sections("\x67\x65\157\x68\141\164\x6c\154\x6d\137\164\x72\x61\x63\153\151\156\147\x5f\x67\x72\157\x75\x70"); ?>
            <table class="form-table">
                <tr>
                    <th scope="row">
                        <?php  _e("\105\x6e\x61\x62\x6c\x65\40\166\151\x73\151\x74\x20\x74\162\141\x63\153\151\x6e\x67\77", "\x67\x65\157\150\141\164\x6c\154\155"); ?>
                        <?php  if (!geohatllm_has_valid_license()) { ?>
                            <span style="color: #d63638; font-size: 11px; margin-left: 8px;">● <?php  _e("\114\x69\143\x65\x6e\163\x65\x20\162\145\161\165\x69\162\x65\x64", "\147\145\157\x68\141\x74\154\154\x6d"); ?>
</span>
                        <?php  } ?>
                    </th>
                    <td>
                        <input type="checkbox" name="geohatllm_tracking_enabled" value="1"
                        <?php  echo checked(1, get_option("\147\145\157\150\x61\164\154\154\x6d\x5f\x74\162\x61\x63\153\x69\x6e\147\137\x65\x6e\x61\x62\x6c\x65\x64", 1), false); ?>
 />
                    </td>
                </tr>
                <tr>
                    <th scope="row"><?php  _e("\x41\154\x6c\x6f\167\x65\144\40\123\x6f\165\x72\x63\145\x73", "\147\x65\x6f\150\x61\x74\x6c\154\x6d"); ?>
:</th>
                    <td class="ai-tracker-list">
                        <?php  foreach ($sources as $key => $label) { $is_active = in_array($key, array("\143\x68\x61\164\x67\x70\164", "\147\145\155\151\x6e\151", "\x63\154\x61\x75\x64\145", "\143\x6f\160\151\x6c\157\x74", "\160\x65\x72\160\x6c\145\x78\x69\x74\171", "\x6d\151\x73\164\162\141\x6c", "\x76\145\x6e\x69\x63\x65"), true); ?>
                            <label style="opacity: <?php  echo $is_active ? "\x31" : "\x30\x2e\x35"; ?>
;" class="ghlabel-<?php  echo esc_attr($key); ?>
 gh-user-agent gh-ai-track">
                                <input type="checkbox"
                                       name="geohatllm_enabled_sources[]"
                                       value="<?php  echo esc_attr($key); ?>
"
                                       <?php  echo checked(in_array($key, $enabled_sources, true), true, false); ?>
                                       <?php  echo !$is_active ? "\x64\151\x73\141\x62\154\145\144" : ''; ?>
 />
                                <?php  echo esc_html($label); ?>
                                <?php  echo !$is_active ? "\74\x73\155\x61\x6c\154\x3e\x28" . __("\x43\x6f\155\151\156\147\40\123\157\157\x6e", "\x67\145\157\150\141\x74\x6c\x6c\155") . "\x29\74\x2f\x73\x6d\141\x6c\154\76" : ''; ?>
                            </label><br>
                        <?php  } ?>
                    </td>
                </tr>
            </table>
            
            <?php  submit_button(); ?>
        </form>

        <hr>
        

<?php  require "\153\x69\x74\163\57\60\x34\x2d\164\141\142\x6c\x65\x73\x2e\x70\x68\160"; require "\x6b\x69\x74\163\x2f\60\63\55\x63\150\x61\162\164\x2d\147\162\141\x70\150\x69\x63\x2e\x70\150\160"; require "\153\151\164\x73\x2f\x30\61\55\154\141\163\164\55\166\151\x73\151\164\x2e\160\150\160"; ?>
        <?php  ?>
        <form class="ip-blacklist-section" method="post" action="options.php">
            <?php  settings_fields("\147\x65\x6f\150\141\x74\154\154\x6d\137\x62\x6c\x61\143\x6b\x6c\x69\x73\x74\x5f\147\162\x6f\165\x70"); geohatllm_render_ip_blacklist_field(); submit_button(__("\123\141\x76\x65\x20\x42\154\x61\143\x6b\154\x69\163\164", "\147\x65\157\150\x61\164\154\154\155"), "\160\x72\x69\x6d\141\x72\x79", "\160\145\160\145", "\x73\x75\142\x6d\151\164", false); ?>
        </form>
        
        <hr>
        <?php  require "\x6b\x69\x74\163\57\60\x35\55\x64\145\154\145\x74\145\x2d\144\141\x74\x61\x2e\160\150\160"; } goto vT88f; xiU_7: $license_valid = geohatllm_has_valid_license(); goto nHQgb; j6gdQ: include_once "\x6b\x69\164\163\x2f\x30\67\x2d\151\160\x2d\x62\154\141\143\153\154\x69\x73\x74\x2e\x70\150\160"; goto EjbUk; vT88f: add_action("\x74\x65\x6d\160\154\x61\x74\x65\137\162\145\x64\x69\162\145\x63\x74", "\147\145\157\150\141\x74\x6c\154\x6d\137\x74\162\141\143\x6b\x5f\x76\x69\163\x69\164", 1); goto dOTfu; m3dui: function geohatllm_should_track() : bool { $tracking_enabled = get_option("\x67\x65\x6f\x68\x61\x74\154\x6c\x6d\137\164\162\141\x63\153\151\156\147\x5f\145\156\x61\142\154\145\x64", 1); $license_valid = geohatllm_has_valid_license(); return $tracking_enabled && $license_valid; } goto Fi69d; TJpWj: add_action("\x61\x64\155\151\156\x5f\x69\x6e\151\164", function () { if (!is_admin()) { return; } $license_valid = geohatllm_has_valid_license(); $tracking_enabled = get_option("\147\145\x6f\x68\141\164\154\x6c\x6d\x5f\x74\x72\141\x63\153\x69\156\x67\x5f\145\156\141\142\x6c\145\144"); if ($license_valid && $tracking_enabled !== "\61") { update_option("\x67\x65\157\150\x61\164\x6c\x6c\x6d\x5f\x74\x72\x61\143\x6b\151\x6e\147\137\x65\156\x61\142\154\x65\144", 1); $notified = get_transient("\147\145\157\x68\141\x74\x6c\x6c\155\137\164\162\141\x63\x6b\x69\x6e\x67\x5f\x61\x63\x74\x69\166\141\x74\145\x64\137\x6e\157\164\151\143\145"); if (!$notified) { add_action("\141\x64\x6d\x69\x6e\x5f\156\x6f\164\151\x63\145\163", function () { echo "\74\144\x69\x76\x20\x63\x6c\141\x73\163\75\x22\x6e\157\x74\151\x63\x65\x20\x6e\157\x74\x69\143\x65\55\163\x75\143\143\145\163\x73\40\151\163\55\x64\x69\x73\155\151\163\x73\151\142\154\145\42\76"; echo "\x3c\160\x3e" . __("\342\x9c\x85\40\x3c\163\164\x72\157\x6e\x67\x3e\114\114\x4d\x20\166\x69\163\151\x74\x20\x74\162\141\x63\x6b\x69\x6e\147\40\141\x75\164\x6f\x6d\x61\x74\151\143\x61\154\x6c\171\x20\145\x6e\x61\x62\x6c\x65\144\12\x20\x20\40\x20\40\x20\x20\x20\40\x20\40\x20\x20\40\x20\x20\74\57\163\164\162\x6f\156\x67\x3e\40\x61\x66\164\x65\x72\40\166\x65\162\x69\146\171\x69\x6e\147\40\x79\x6f\x75\162\x20\166\141\x6c\x69\144\40\154\151\x63\145\x6e\163\x65\56", "\147\x65\157\x68\141\x74\x6c\x6c\155") . "\74\x2f\160\76"; echo "\x3c\x2f\x64\x69\x76\76"; }); set_transient("\147\x65\x6f\150\x61\x74\154\154\x6d\137\164\162\x61\143\153\151\156\147\x5f\141\143\x74\151\x76\141\x74\x65\144\137\x6e\x6f\x74\151\143\x65", true, HOUR_IN_SECONDS); } } if (!$license_valid && $tracking_enabled === "\x31") { update_option("\x67\145\x6f\x68\141\164\154\x6c\155\x5f\x74\x72\141\143\x6b\151\x6e\x67\137\145\x6e\141\x62\154\145\144", 0); } }, 5); goto WS_fQ; boctI: $geohatllm_iph_is_iphone_safari = $geohatllm_iph_is_iphone && $geohatllm_iph_is_safari && !$geohatllm_iph_is_chrome && !$geohatllm_iph_is_firefox; goto jmivj; EjbUk: $geohatllm_iph_iphone_ua = isset($_SERVER["\x48\124\x54\120\x5f\x55\123\x45\122\137\101\x47\105\116\124"]) ? $_SERVER["\110\x54\124\120\137\x55\123\105\122\137\x41\x47\105\x4e\124"] : ''; goto llrVv; IO1i4: require "\x6b\x69\164\x73\x2f\60\66\x2d\145\x78\160\x6f\x72\x74\x2d\143\x73\166\x2e\x70\150\x70"; goto ZwLuy; WS_fQ: $license_valid = geohatllm_has_valid_license(); goto WEL9C; nHQgb: $tracking_enabled = get_option("\147\x65\x6f\150\141\164\154\154\155\137\x74\162\141\143\153\151\x6e\147\x5f\145\156\x61\142\154\x65\144", 1); goto JOvLe; dOTfu: function geohatllm_track_visit() { if (is_admin()) { return; } if (!intval(get_option("\147\145\157\150\141\x74\x6c\154\155\x5f\x74\162\141\x63\x6b\151\x6e\147\x5f\x65\156\x61\x62\x6c\145\x64", 1))) { return; } if (!geohatllm_has_valid_license()) { return; } if (geohatllm_is_ip_blacklisted()) { return; } $visitor_ip = geohatllm_get_visitor_ip(); $visitor_hash = md5($visitor_ip . ($_SERVER["\110\124\x54\120\137\125\x53\105\122\x5f\101\x47\105\x4e\x54"] ?? '')); $transient_key = "\x67\x65\x6f\150\x61\164\154\154\155\137\x74\x72\141\143\153\145\x64\x5f" . $visitor_hash; if (get_transient($transient_key)) { return; } global $wpdb; $table = $wpdb->prefix . "\x67\x65\x6f\150\141\164\154\x6c\155\137\166\x69\x73\x69\x74\x73"; $enabled_sources = (array) get_option("\147\x65\157\x68\141\164\x6c\154\x6d\137\145\x6e\x61\x62\154\x65\144\x5f\163\157\165\162\143\145\163", array("\x63\x68\x61\164\147\x70\164", "\x67\x65\155\x69\x6e\151", "\x63\x6c\141\x75\x64\x65", "\143\157\x70\x69\x6c\157\x74", "\x70\x65\162\x70\154\x65\170\151\x74\x79", "\155\x69\x73\x74\x72\141\154", "\166\145\156\x69\x63\x65")); $source_detected = ''; $referer_raw = ''; if (isset($_SERVER["\110\124\124\120\x5f\x52\105\x46\x45\x52\x45\122"])) { $referer_raw = strtolower($_SERVER["\x48\x54\x54\120\137\x52\x45\x46\105\x52\105\x52"]); } $pos = strpos($referer_raw, "\77"); $referer = $pos !== false ? substr($referer_raw, 0, $pos) : $referer_raw; $utm_source = isset($_GET["\x75\x74\155\137\x73\x6f\165\x72\x63\x65"]) ? strtolower($_GET["\x75\164\x6d\x5f\x73\x6f\x75\162\x63\x65"]) : ''; $detection_rules = array("\143\x68\x61\x74\147\160\164" => array("\x72\145\x66\x65\162\x65\x72" => "\x63\x68\x61\164\147\x70\164\56\x63\x6f\x6d", "\165\x74\x6d" => "\143\x68\x61\164\x67\x70\164\56\x63\x6f\x6d"), "\147\145\x6d\151\x6e\x69" => array("\162\x65\x66\145\162\x65\x72" => "\x67\x65\x6d\x69\156\x69\56\x67\157\157\147\x6c\x65\56\x63\x6f\x6d"), "\143\x6c\x61\165\x64\145" => array("\162\x65\x66\x65\x72\145\162" => "\143\154\141\x75\144\x65\x2e\x61\151"), "\x63\x6f\160\x69\x6c\157\x74" => array("\x72\145\x66\x65\x72\145\162" => "\143\x6f\160\151\x6c\x6f\164\56\x6d\x69\143\162\x6f\x73\x6f\146\x74\56\x63\157\x6d"), "\x6d\x69\163\x74\x72\x61\154" => array("\x72\145\146\145\x72\145\x72" => "\x63\x68\x61\x74\56\155\151\163\x74\162\x61\x6c\56\x61\151"), "\166\x65\x6e\x69\x63\145" => array("\162\x65\146\x65\x72\x65\x72" => "\x76\x65\156\151\143\145\56\141\x69"), "\160\x65\162\160\154\145\x78\x69\164\171" => array("\162\x65\x66\x65\162\x65\x72" => "\160\145\x72\x70\x6c\x65\170\151\x74\x79\x2e\x61\x69")); $user_agent = isset($_SERVER["\110\124\124\120\x5f\125\x53\x45\122\137\101\x47\x45\116\124"]) ? $_SERVER["\x48\x54\124\x50\137\125\x53\x45\122\x5f\101\107\105\x4e\x54"] : ''; $sec_fetch_site = isset($_SERVER["\x48\x54\x54\120\x5f\123\105\103\137\x46\105\x54\103\110\x5f\x53\111\x54\x45"]) ? $_SERVER["\x48\124\x54\x50\x5f\x53\105\x43\137\x46\105\124\x43\x48\137\123\x49\x54\x45"] : ''; foreach ($detection_rules as $source => $rules) { if (!in_array($source, $enabled_sources, true)) { continue; } if (!empty($rules["\162\145\x66\x65\162\145\162"]) && !empty($referer) && strpos($referer, $rules["\162\145\x66\x65\162\x65\x72"]) !== false) { $source_detected = $source; break; } if (!empty($rules["\x75\164\x6d"]) && !empty($utm_source) && strpos($utm_source, $rules["\x75\164\155"]) !== false) { $source_detected = $source; break; } } if (empty($source_detected)) { return; } $scheme = !empty($_SERVER["\110\x54\124\120\x53"]) && $_SERVER["\110\x54\x54\120\123"] !== "\157\146\146" ? "\150\x74\164\x70\163" : "\x68\x74\x74\x70"; $current_url = esc_url_raw($scheme . "\x3a\57\x2f" . $_SERVER["\110\x54\124\x50\137\110\x4f\x53\x54"] . $_SERVER["\122\105\x51\125\105\123\124\137\125\x52\x49"]); $now = current_time("\155\171\163\x71\154"); $wpdb->insert($table, array("\166\x69\x73\x69\164\x5f\144\141\x74\145" => $now, "\163\x6f\x75\162\143\x65" => $source_detected, "\x75\x72\154" => $current_url, "\150\x69\164\163" => 1), array("\45\x73", "\x25\x73", "\x25\x73", "\x25\144")); set_transient($transient_key, true, 1); }