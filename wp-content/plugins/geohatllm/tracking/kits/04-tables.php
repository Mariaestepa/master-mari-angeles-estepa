<?php
// ==========================
// VISITS SUMMARY
// ==========================
echo '<div><hr><h2 class="text-xl">' . __('Visits Summary', 'geohatllm') . '</h2>';

$today      = date('Y-m-d H:i:s', strtotime('-1 day'));
$week       = date('Y-m-d H:i:s', strtotime('-7 day'));
$month      = date('Y-m-d H:i:s', strtotime('-1 month'));
$quarter    = date('Y-m-d H:i:s', strtotime('-3 month'));
$year       = date('Y-m-d H:i:s', strtotime('-1 year'));

$periods = [
    __('Last Day', 'geohatllm')       => $today,
    __('Last Week', 'geohatllm')      => $week,
    __('Last Month', 'geohatllm')     => $month,
    __('Last Quarter', 'geohatllm')   => $quarter,
    __('Last Year', 'geohatllm')      => $year,
];

// Build statistics for ChatGPT and Gemini
echo '<div class="overflow-x-auto rounded-xl border border-blue-100 shadow-sm mt-6">';
        echo '<table class="min-w-full divide-y divide-gray-200 bg-white">';
        echo '<thead class="bg-blue-50">';
        echo '<tr>';
        echo '<th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-blue-700 uppercase tracking-wider">' . __('Period', 'geohatllm') . '</th>';
        echo '<th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-blue-700 uppercase tracking-wider ghbot-t">ChatGPT <span class="gh-user-agent ghlabel-chatgpt"></span></th>';
        echo '<th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-blue-700 uppercase tracking-wider ghbot-t">Gemini <span class="gh-user-agent ghlabel-gemini"></span></th>';
        echo '<th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-blue-700 uppercase tracking-wider ghbot-t">Claude <span class="gh-user-agent ghlabel-claude"></span></th>';
        echo '<th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-blue-700 uppercase tracking-wider ghbot-t">Copilot <span class="gh-user-agent ghlabel-copilot"></span></th>';
        echo '<th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-blue-700 uppercase tracking-wider ghbot-t">Perplexity <span class="gh-user-agent ghlabel-perplexity"></span></th>';
        echo '<th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-blue-700 uppercase tracking-wider ghbot-t">Mistral <span class="gh-user-agent ghlabel-mistral"></span></th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody class="divide-y divide-gray-100">';
        foreach ($periods as $label => $since) {
            $chatgpt_count = $wpdb->get_var($wpdb->prepare("SELECT SUM(hits) FROM $table WHERE source='chatgpt' AND visit_date >= %s", $since));
            $gemini_count  = $wpdb->get_var($wpdb->prepare("SELECT SUM(hits) FROM $table WHERE source='gemini' AND visit_date >= %s", $since));
            $claude_count  = $wpdb->get_var($wpdb->prepare("SELECT SUM(hits) FROM $table WHERE source='claude' AND visit_date >= %s", $since));
            $copilot_count  = $wpdb->get_var($wpdb->prepare("SELECT SUM(hits) FROM $table WHERE source='copilot' AND visit_date >= %s", $since));
            $perplexity_count  = $wpdb->get_var($wpdb->prepare("SELECT SUM(hits) FROM $table WHERE source='perplexity' AND visit_date >= %s", $since));
            $mistral_count  = $wpdb->get_var($wpdb->prepare("SELECT SUM(hits) FROM $table WHERE source='mistral' AND visit_date >= %s", $since));


            echo '<tr class="odd:bg-white even:bg-blue-50/40 hover:bg-[#8d096c15] transition-colors">';
            echo '<td class="px-4 py-2 text-sm text-gray-700">' . esc_html($label) . '</td>';
            echo '<td class="px-4 py-2 text-sm text-gray-700">' . intval($chatgpt_count ?: 0) . '</td>';
            echo '<td class="px-4 py-2 text-sm text-gray-700">' . intval($gemini_count ?: 0) . '</td>';
            echo '<td class="px-4 py-2 text-sm text-gray-700">' . intval($claude_count ?: 0) . '</td>';
            echo '<td class="px-4 py-2 text-sm text-gray-700">' . intval($copilot_count ?: 0) . '</td>';
            echo '<td class="px-4 py-2 text-sm text-gray-700">' . intval($perplexity_count ?: 0) . '</td>';
            echo '<td class="px-4 py-2 text-sm text-gray-700">' . intval($mistral_count ?: 0) . '</td>';
            echo '</tr>';
}

echo '</tbody></table></div>';
?>