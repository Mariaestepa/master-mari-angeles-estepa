<?php
add_action('template_redirect', 'asdrubal_maybe_buffer_output');
function asdrubal_maybe_buffer_output() {
    if (asdrubal_is_restricted_bot()) {
        ob_start('asdrubal_filter_nosnippet_elements');
    }
}
function asdrubal_is_restricted_bot() {
    if (is_user_logged_in() && isset($_COOKIE['GEOHAT-LLM-simulator-mode']) && $_COOKIE['GEOHAT-LLM-simulator-mode'] === 'on') {
        return true;
    }
    $ua = strtolower(asdrubal_get_effective_user_agent());
    $selected_bots = get_option('asdrubal_llm_selected_bots', []);
    $custom = get_option('asdrubal_llm_custom_bots', '');
    $custom_list = array_filter(array_map('trim', explode("\n", $custom)));
    $allowed_bots = array_merge($selected_bots, $custom_list);
    foreach ($allowed_bots as $bot) {
        if (stripos($ua, $bot) !== false) {
            return true;
        }
    }
    if (asdrubal_is_iphone_no_js_llm($ua)) {
        return true;
    }
    return false;
}

function asdrubal_process_nosnippet_elements($html) {
    $supported_tags = ['article', 'img', 'iframe', 'p'];
    $excluded_pattern = '(?!' . implode('|', $supported_tags) . ')';
    
    $html = preg_replace(
        '#<(' . $excluded_pattern . '[a-zA-Z0-9]+)([^>]*\sdata-nosnippet-geohat=["\']?true["\']?[^>]*)>(.*?)</\1>#is',
        '',
        $html
    );
    $tags = ['article', 'img', 'iframe', 'p'];
    $pattern = '/<(' . implode('|', $tags) . ')([^>]*)>/is';
    $html = preg_replace_callback($pattern, function ($matches) {
        $tag   = $matches[1];
        $attrs = $matches[2];
        $span_attrs = [];
        preg_match_all('/\s(data-nosnippet(?:-geohat)?)(?:=(["\'])(.*?)\2)?/i', $attrs, $found_data, PREG_SET_ORDER);
        $has_class = preg_match('/class=["\'][^"\']*geohat-nosnippet[^"\']*["\']/', $attrs);
        if (empty($found_data) && !$has_class) {
            return $matches[0];
        }
        $clean_attrs = preg_replace([
            '/\sdata-nosnippet(?:-geohat)?(?:=(["\']).*?\1)?/i',
            '/\sclass=["\'][^"\']*geohat-nosnippet[^"\']*["\']/i'
        ], '', $attrs);
        foreach ($found_data as $attr) {
            $name  = $attr[1];
            $value = isset($attr[3]) ? trim($attr[3]) : '';
            if ($value !== '') {
                $span_attrs[] = $name . '="' . esc_attr($value) . '"';
            } else {
                $span_attrs[] = $name;
            }
        }
        if ($has_class && !preg_grep('/^data-nosnippet/', $span_attrs)) {
            $span_attrs[] = 'data-nosnippet';
        }
        
        $span_attr_string = implode(' ', array_unique($span_attrs));
        $new_tag = '<' . $tag . $clean_attrs . '>';
        
        if (in_array($tag, ['img', 'iframe']) && preg_match('/\/\s*>$/', $matches[0])) {
            return '<span ' . $span_attr_string . '>' . rtrim($new_tag, '>') . ' /></span>';
        }
        return '<!-- NOSNIPPET_OPEN:' . $span_attr_string . ' -->' . $new_tag;
    }, $html);
    $html = preg_replace_callback('/<!-- NOSNIPPET_OPEN:(.*?) -->(.*?)<\/(article|iframe|p)>/is', function ($matches) {
        $span_attr = trim($matches[1]);
        $content   = $matches[2];
        $closing   = $matches[3];
        return '<span ' . $span_attr . '>' . $content . '</' . $closing . '></span>';
    }, $html);
    
    return $html;
}

function asdrubal_filter_nosnippet_elements($html) { 
 $html = preg_replace( '#<([a-zA-Z0-9]+)([^>]*\sdata-nosnippet-geohat=["\']?true["\']?[^>]*)>(.*?)</\1>#is', '', $html );
  $html = preg_replace( '#<([a-zA-Z0-9]+)([^>]*\sclass=["\'][^"\']*geohat-nosnippet[^"\']*["\'][^>]*)>(.*?)</\1>#is', '', $html ); return $html; 
}