<?php
// ===================================================
// 📦 CSV Exporter for LLM visits (with groupings and smart separator)
// ===================================================

add_action('admin_init', function () {
    if (!is_admin() || !current_user_can('manage_options')) return;
    if (!isset($_GET['geohatllm_export_csv'])) return;

    global $wpdb;
    $table = $wpdb->prefix . 'geohatllm_visits';

    // === GET filters ===
    $filter_sources = isset($_GET['source']) ? array_map('sanitize_text_field', (array) $_GET['source']) : ['chatgpt', 'gemini', 'claude', 'copilot', 'perplexity', 'mistral', 'venice'];
    $filter_from   = isset($_GET['from_date']) ? sanitize_text_field($_GET['from_date']) : '';
    $filter_to     = isset($_GET['to_date']) ? sanitize_text_field($_GET['to_date']) : '';
    $filter_url    = isset($_GET['url']) ? sanitize_text_field($_GET['url']) : '';
    $view_mode     = isset($_GET['view_mode']) ? sanitize_text_field($_GET['view_mode']) : 'detailed';

    // === Separator detection based on browser language ===
    $lang = $_SERVER['HTTP_ACCEPT_LANGUAGE'] ?? '';
    $separator = (strpos($lang, 'es') === 0 || strpos($lang, 'fr') === 0 || strpos($lang, 'de') === 0) ? ';' : ',';

    // === Build dynamic WHERE ===
    $where_clauses = [];
    $params = [];

    if (!empty($filter_sources)) {
        $placeholders = implode(',', array_fill(0, count($filter_sources), '%s'));
        $where_clauses[] = "source IN ($placeholders)";
        $params = array_merge(($params ?? []), $filter_sources);
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

    $where_sql = $where_clauses ? (' WHERE ' . implode(' AND ', $where_clauses)) : '';

    // ======================================================
    // 🔁 SQL query construction based on view_mode
    // ======================================================
    switch ($view_mode) {
        case 'grouped_day':
            $select_fields = "DATE(visit_date) AS fecha, source";
            $group_by = "DATE(visit_date), source";
            if (!empty($filter_url)) {
                $select_fields .= ", url";
                $group_by .= ", url";
            } else {
                $select_fields .= ", '' AS url";
            }
            break;

        case 'grouped_month':
            $select_fields = "DATE_FORMAT(visit_date, '%Y-%m') AS fecha, source";
            $group_by = "DATE_FORMAT(visit_date, '%Y-%m'), source";
            if (!empty($filter_url)) {
                $select_fields .= ", url";
                $group_by .= ", url";
            } else {
                $select_fields .= ", '' AS url";
            }
            break;

        case 'grouped_year':
            $select_fields = "YEAR(visit_date) AS fecha, source";
            $group_by = "YEAR(visit_date), source";
            if (!empty($filter_url)) {
                $select_fields .= ", url";
                $group_by .= ", url";
            } else {
                $select_fields .= ", '' AS url";
            }
            break;

        case 'grouped_total':
            $select_fields = "source";
            $group_by = "source";
            if (!empty($filter_url)) {
                $select_fields .= ", url";
                $group_by .= ", url";
            } else {
                $select_fields .= ", '' AS url";
            }
            break;

        default: // detailed
            $select_fields = "visit_date AS fecha, source, url";
            $group_by = "";
            break;
    }

    // ======================================================
    // 🔍 Final SQL
    // ======================================================
    if ($view_mode === 'detailed') {
        $sql = "
            SELECT $select_fields, hits 
            FROM $table 
            $where_sql 
            ORDER BY fecha DESC
        ";
    } else {
        $sql = "
            SELECT $select_fields, SUM(hits) AS hits 
            FROM $table 
            $where_sql 
            GROUP BY $group_by 
            ORDER BY fecha DESC
        ";
    }

    // ======================================================
    // 🧩 Execute query
    // ======================================================
    $results = count($params)
        ? $wpdb->get_results($wpdb->prepare($sql, ...$params))
        : $wpdb->get_results($sql);

    // ======================================================
    // 🧾 Send CSV
    // ======================================================
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=llm_visits.csv');

    $output = fopen('php://output', 'w');

    // Headers
    fputcsv($output, [
        __('Date', 'geohatllm'), 
        __('Source', 'geohatllm'), 
        __('URL', 'geohatllm'), 
        __('Visits', 'geohatllm')
    ], $separator);

    // Rows
    if (!empty($results)) {
        foreach ($results as $row) {
            fputcsv($output, [
                $row->fecha,
                ucfirst($row->source),
                $row->url,
                (int)$row->hits
            ], $separator);
        }
    } else {
        fputcsv($output, [__('No data', 'geohatllm')], $separator);
    }

    fclose($output);
    exit;
});