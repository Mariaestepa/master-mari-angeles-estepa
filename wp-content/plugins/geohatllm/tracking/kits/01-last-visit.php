<?php
// ==========================
// ÚLTIMAS VISITAS CON CÓDIGO DE RESPUESTA HTTP
// ==========================
?>
<hr>
<div>

  <?php
  global $wpdb;
  $table = $wpdb->prefix . 'geohatllm_visits';

  // ==========================
  // Función para obtener código de respuesta HTTP
  // ==========================
  function get_http_status_code($url) {
      static $status_cache = [];
      if (isset($status_cache[$url])) return $status_cache[$url];

      if (empty($url) || !filter_var($url, FILTER_VALIDATE_URL))
          return ['code' => 'N/A', 'class' => 'text-gray-400'];

      $response = wp_remote_head($url, [
          'timeout' => 5,
          'redirection' => 5,
          'sslverify' => false,
          'user-agent' => 'Mozilla/5.0 (compatible; GeoHatLLM/1.0)'
      ]);

      if (is_wp_error($response))
          return $status_cache[$url] = ['code' => 'Error', 'class' => 'text-red-600'];

      $status_code = wp_remote_retrieve_response_code($response);
      $class = match (true) {
          $status_code >= 200 && $status_code < 300 => 'ghrc gh-rc-green',
          $status_code >= 300 && $status_code < 400 => 'ghrc gh-rc-blue',
          $status_code >= 400 && $status_code < 500 => 'ghrc gh-rc-red',
          $status_code >= 500 => 'ghrc gh-rc-orange',
          default => 'text-gray-400'
      };

      return $status_cache[$url] = ['code' => $status_code, 'class' => $class];
  }

  // ==========================
  // Filtros
  // ==========================
  $filter_sources = isset($_GET['source']) ? array_map('sanitize_text_field', (array) $_GET['source']) : ['chatgpt', 'gemini', 'claude', 'copilot', 'perplexity', 'mistral','venice'];
  $filter_from    = isset($_GET['from_date']) ? sanitize_text_field($_GET['from_date']) : '';
  $filter_to      = isset($_GET['to_date']) ? sanitize_text_field($_GET['to_date']) : '';
  $filter_url     = isset($_GET['url']) ? sanitize_text_field($_GET['url']) : '';
  $view_mode      = isset($_GET['view_mode']) ? sanitize_text_field($_GET['view_mode']) : 'detailed';
  $check_status   = isset($_GET['check_status']) ? true : false;

  // ==========================
  // Paginación
  // ==========================
  $current_page = isset($_GET['paged']) ? max(1, intval($_GET['paged'])) : 1;
  $current_per_page = isset($_GET['per_page']) ? max(1, intval($_GET['per_page'])) : 20;
  $offset = ($current_page - 1) * $current_per_page;

  // ==========================
  // Construcción dinámica del WHERE
  // ==========================
  $where_clauses = [];
  $params = [];

  if (!empty($filter_sources)) {
      $placeholders = implode(',', array_fill(0, count($filter_sources), '%s'));
      $where_clauses[] = "source IN ($placeholders)";
      $params = array_merge($params, $filter_sources);
  }
  if (!empty($filter_from)) {
      $where_clauses[] = "DATE(visit_date) >= %s";
      $params[] = $filter_from;
  }
  if (!empty($filter_to)) {
      $where_clauses[] = "DATE(visit_date) <= %s";
      $params[] = $filter_to;
  }
  if (!empty($filter_url)) {
      $where_clauses[] = "url LIKE %s COLLATE utf8mb4_general_ci";
      $params[] = '%' . $wpdb->esc_like($filter_url) . '%';
  }

  $where_sql = $where_clauses ? ('WHERE ' . implode(' AND ', $where_clauses)) : '';

  // ==========================
  // Consultas SQL
  // ==========================
  switch ($view_mode) {
      case 'grouped_day':   $group_field = "DATE(visit_date)"; break;
      case 'grouped_month': $group_field = "DATE_FORMAT(visit_date, '%Y-%m')"; break;
      case 'grouped_year':  $group_field = "YEAR(visit_date)"; break;
      case 'grouped_total': $group_field = 'total'; break;
      default: $group_field = '';
  }

  if ($view_mode === 'grouped_total') {
      $group_sql = "source" . (!empty($filter_url) ? ", url" : "");
      $count_sql = "SELECT COUNT(*) FROM (SELECT 1 FROM $table $where_sql GROUP BY $group_sql) AS grouped";
      $data_sql = "
          SELECT 
              source,
              " . (!empty($filter_url) ? "url" : "'' AS url") . ",
              SUM(hits) AS hits
          FROM $table
          $where_sql
          GROUP BY $group_sql
          ORDER BY SUM(hits) DESC
          LIMIT %d OFFSET %d";
  } elseif ($group_field) {
      $group_by = [$group_field, "source"];
      if (!empty($filter_url)) $group_by[] = "url";
      $group_sql = implode(', ', $group_by);
      $count_sql = "SELECT COUNT(*) FROM (SELECT 1 FROM $table $where_sql GROUP BY $group_sql) AS grouped";
      $data_sql = "
          SELECT 
              $group_field AS visit_date,
              source,
              " . (!empty($filter_url) ? "url" : "'' AS url") . ",
              SUM(hits) AS hits
          FROM $table
          $where_sql
          GROUP BY $group_sql
          ORDER BY $group_field DESC
          LIMIT %d OFFSET %d";
  } else {
      $count_sql = "SELECT COUNT(*) FROM $table $where_sql";
      $data_sql  = "
          SELECT visit_date, source, url, hits 
          FROM $table 
          $where_sql 
          ORDER BY visit_date DESC 
          LIMIT %d OFFSET %d";
  }

  $params_for_data = array_merge($params, [$current_per_page, $offset]);
  $total_items = $params ? $wpdb->get_var($wpdb->prepare($count_sql, ...$params)) : $wpdb->get_var($count_sql);
  $results = $params_for_data ? $wpdb->get_results($wpdb->prepare($data_sql, ...$params_for_data)) : $wpdb->get_results($data_sql);
  ?>

  <!-- ========================== -->
  <!-- FORMULARIO DE FILTROS -->
  <!-- ========================== -->
  <form method="get" class="mb-4 mt-6 last-visist-selector" action="#last-visited" style="margin-top:3em">
      <input type="hidden" name="page" value="<?= esc_attr($_GET['page']) ?>" />

      <label style="display: flex; align-items: center; gap: 8px;">
          <?php _e('Source:', 'geohatllm'); ?>
          <div id="llm-multiselect" style="position:relative; display:inline-block;">
              <button type="button" id="llm-multiselect-btn" class="button"><?php _e('Select LLMs', 'geohatllm'); ?></button>
              <div id="llm-dropdown" style="display:none; position:absolute; z-index:10; background:white; border:1px solid #ccc; padding:8px; border-radius:6px;">
              <?php 
              $sources_all = ['chatgpt', 'gemini', 'claude', 'copilot', 'perplexity', 'mistral','venice'];
              $selected_sources = isset($_GET['source']) ? (array) $_GET['source'] : $sources_all;
              foreach ($sources_all as $src): ?>
                  <label style="display:block; margin-bottom:3px;">
                      <input type="checkbox" name="source[]" value="<?= esc_attr($src) ?>" <?= in_array($src, $selected_sources) ? 'checked' : '' ?>> <?= ucfirst($src) ?>
                  </label>
              <?php endforeach; ?>
              </div>
          </div>
      </label>


      <label><?php _e('From:', 'geohatllm'); ?><input type="date" name="from_date" value="<?= esc_attr($filter_from); ?>"></label>
      <label><?php _e('To:', 'geohatllm'); ?><input type="date" name="to_date" value="<?= esc_attr($filter_to); ?>"></label>
      <label><?php _e('URL contains:', 'geohatllm'); ?><input type="text" name="url" value="<?= esc_attr($filter_url); ?>"></label>
      <label><?php _e('View:', 'geohatllm'); ?>
          <select name="view_mode">
              <option value="detailed" <?= selected($view_mode, 'detailed', false); ?>><?php _e('Detailed (date and time)', 'geohatllm'); ?></option>
              <option value="grouped_day" <?= selected($view_mode, 'grouped_day', false); ?>><?php _e('Grouped by day', 'geohatllm'); ?></option>
              <option value="grouped_month" <?= selected($view_mode, 'grouped_month', false); ?>><?php _e('Grouped by month', 'geohatllm'); ?></option>
              <option value="grouped_year" <?= selected($view_mode, 'grouped_year', false); ?>><?php _e('Grouped by year', 'geohatllm'); ?></option>
              <option value="grouped_total" <?= selected($view_mode, 'grouped_total', false); ?>><?php _e('Global total', 'geohatllm'); ?></option>
          </select>
      </label>

      <label style="display: flex; align-items: center; gap: 4px;">
          <input type="checkbox" name="check_status" value="1" <?= $check_status ? 'checked' : ''; ?>>
          <?php _e('Check HTTP status', 'geohatllm'); ?>
      </label>

      <input type="submit" class="button" value="<?php esc_attr_e('Filter', 'geohatllm'); ?>">
  </form>

  <h2 class="text-xl mt-6"><?php _e('Latest registered visits', 'geohatllm'); ?></h2>

  <?php
  if (empty($results)) {
      echo '<p>' . esc_html__('No data available yet.', 'geohatllm') . '</p>';
  } else {
      echo '<div class="overflow-x-auto rounded-xl border border-blue-100 shadow-sm mt-6">';
      echo '<table id="gh-last-visits" class="min-w-full divide-y divide-gray-200 bg-white">';
      echo '<thead class="bg-blue-50"><tr>';
      echo '<th class="px-4 py-3 text-left text-xs font-semibold text-blue-700 uppercase tracking-wider">' . esc_html__('Date and time', 'geohatllm') . '</th>';
      echo '<th class="px-4 py-3 text-left text-xs font-semibold text-blue-700 uppercase tracking-wider">' . esc_html__('Source', 'geohatllm') . '</th>';
      echo '<th class="px-4 py-3 text-left text-xs font-semibold text-blue-700 uppercase tracking-wider">' . esc_html__('URL', 'geohatllm') . '</th>';
      if ($check_status && !empty($filter_url))
          echo '<th class="px-4 py-3 text-left text-xs font-semibold text-blue-700 uppercase tracking-wider">' . esc_html__('HTTP Status', 'geohatllm') . '</th>';
      echo '<th class="px-4 py-3 text-left text-xs font-semibold text-blue-700 uppercase tracking-wider">' . esc_html__('Visits', 'geohatllm') . '</th>';
      echo '</tr></thead><tbody class="divide-y divide-gray-100">';

      foreach ($results as $row) {
          echo '<tr class="odd:bg-white even:bg-blue-50/40 hover:bg-[#8d096c15] transition-colors">';
          echo '<td class="px-4 py-2 text-sm text-gray-700">' . esc_html($row->visit_date) . '</td>';
          echo '<td class="px-4 py-2 text-sm text-gray-700">' . esc_html(ucfirst($row->source)) . '</td>';
          echo '<td class="px-4 py-2 text-sm text-gray-700"><a href="' . esc_url($row->url ?: '#') . '" target="_blank">' . esc_html($row->url ?: __('All URLs', 'geohatllm')) . '</a></td>';

          if ($check_status && !empty($filter_url) && !empty($row->url)) {
              $status = get_http_status_code($row->url);
              echo '<td class="px-4 py-2 text-sm font-mono ' . esc_attr($status['class']) . '">' . esc_html($status['code']) . '</td>';
          }

          echo '<td class="px-4 py-2 text-sm text-gray-700">' . intval($row->hits) . '</td>';
          echo '</tr>';
      }

      echo '</tbody></table></div>';

      // Selector de resultados por página
      echo '<form method="get" class="mt-4 flex items-center gap-2 last-visist-selector">';
      foreach ($_GET as $key => $value) {
          if ($key === 'per_page' || $key === 'paged') continue;
          if (is_array($value)) foreach ($value as $v)
              echo '<input type="hidden" name="' . esc_attr($key) . '[]" value="' . esc_attr($v) . '">';
          else
              echo '<input type="hidden" name="' . esc_attr($key) . '" value="' . esc_attr($value) . '">';
      }
      echo '<label style="display:flex; align-items:center; gap:6px;">';
      echo '<span>' . esc_html__('Results per page:', 'geohatllm') . '</span>';
      echo '<select name="per_page" onchange="this.form.submit()" class="button">';
      foreach ([10, 20, 50, 100, 200, 500, 1000, 10000] as $num)
          echo "<option value='$num'" . selected($current_per_page, $num, false) . ">$num</option>";
      echo '</select></label></form>';

      // Paginación
      $total_pages = ceil($total_items / $current_per_page);
      if ($total_pages > 1) {
          echo '<div class="mt-4 flex gap-2 gh-paginacion">';
          for ($i = 1; $i <= $total_pages; $i++) {
              $link = add_query_arg(array_merge($_GET, [
                  'paged' => $i,
                  'per_page' => $current_per_page
              ])) . '#last-visited';
              $class = $i === $current_page ? 'bg-blue-600 text-white' : 'bg-blue-100 text-blue-700';
              echo "<a class='px-3 py-1 rounded text-sm $class' href='" . esc_url($link) . "'>$i</a>";
          }
          echo '</div>';
      }
  }
  ?>
</div>
<hr>
<script>
document.addEventListener('DOMContentLoaded', function() {
  const heads = document.querySelectorAll('thead.bg-blue-50 th');
  heads.forEach(th => {
    th.setAttribute(
      'title',
      '<?php echo esc_js(__('Be careful when filtering in the table header. These filters only work on the currently visible page, and rows not on this page will not be filtered.', 'geohatllm')); ?>'
    );
  });
});
</script>