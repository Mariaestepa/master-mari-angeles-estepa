<div class="geohat-graphics">
<?php
// ==========================
// FILTERED VISITS CHART
// ==========================

global $wpdb;
$table = $wpdb->prefix . 'geohatllm_visits';

// === Retrieve filters from URL ===
$filter_sources = isset($_GET['source']) ? array_map('sanitize_text_field', (array) $_GET['source']) : ['chatgpt', 'gemini', 'claude', 'copilot', 'perplexity', 'mistral','venice'];
$filter_from   = isset($_GET['from_date']) ? sanitize_text_field($_GET['from_date']) : '';
$filter_to     = isset($_GET['to_date']) ? sanitize_text_field($_GET['to_date']) : '';

// === Define dynamic date range ===
$start_date = $filter_from ?: date('Y-m-d', strtotime('-29 days'));
$end_date   = $filter_to ?: date('Y-m-d');

// === Generate array of days between start and end ===
$days = [];
$current = strtotime($start_date);
$end = strtotime($end_date);

while ($current <= $end) {
    $days[] = date('Y-m-d', $current);
    $current = strtotime('+1 day', $current);
}

// === Initialize data arrays ===
$chatgpt_data = [];
$gemini_data  = [];
$claude_data  = [];
$copilot_data = [];
$perplexity_data = [];
$mistral_data  = [];
$venice_data  = [];

foreach ($days as $date) {
    // ChatGPT
    $chatgpt_data[] = (!in_array('chatgpt', $filter_sources)) ? 0 :
        (int)$wpdb->get_var($wpdb->prepare(
            "SELECT SUM(hits) FROM $table WHERE source='chatgpt' AND DATE(visit_date) = %s",
            $date
        ));

    // Gemini
    $gemini_data[] = (!in_array('gemini', $filter_sources)) ? 0 :
        (int)$wpdb->get_var($wpdb->prepare(
            "SELECT SUM(hits) FROM $table WHERE source='gemini' AND DATE(visit_date) = %s",
            $date
        ));

    // Claude
    $claude_data[] = (!in_array('claude', $filter_sources)) ? 0 :
        (int)$wpdb->get_var($wpdb->prepare(
            "SELECT SUM(hits) FROM $table WHERE source='claude' AND DATE(visit_date) = %s",
            $date
        ));

    // Copilot
    $copilot_data[] = (!in_array('copilot', $filter_sources)) ? 0 :
        (int)$wpdb->get_var($wpdb->prepare(
            "SELECT SUM(hits) FROM $table WHERE source='copilot' AND DATE(visit_date) = %s",
            $date
        ));

           // Perplexity
    $perplexity_data[] = (!in_array('perplexity', $filter_sources)) ? 0 :
        (int)$wpdb->get_var($wpdb->prepare(
            "SELECT SUM(hits) FROM $table WHERE source='perplexity' AND DATE(visit_date) = %s",
            $date
        ));

    // Mistral
      $mistral_data[] = (!in_array('mistral', $filter_sources)) ? 0 :
        (int)$wpdb->get_var($wpdb->prepare(
            "SELECT SUM(hits) FROM $table WHERE source='mistral' AND DATE(visit_date) = %s",
            $date
        ));

    // Venice
      $venice_data[] = (!in_array('venice', $filter_sources)) ? 0 :
        (int)$wpdb->get_var($wpdb->prepare(
            "SELECT SUM(hits) FROM $table WHERE source='venice' AND DATE(visit_date) = %s",
            $date
        ));
}
?>

<hr>
<h2 class="text-xl mt-6"><?php _e('Visits Chart', 'geohatllm'); ?></h2>
<?php
if (count($filter_sources) === 5) {
    $source_label = __('All LLMs', 'geohatllm');
} else {
    $source_label = implode(', ', array_map('ucfirst', $filter_sources));
}
$sources_list = geohatllm_tracking_sources_list();
if (!empty($filter_sources)) {
        $placeholders = implode(',', array_fill(0, count($filter_sources), '%s'));
        $where_clauses[] = "source IN ($placeholders)";
        $params = array_merge(($params ?? []), $filter_sources);
    }
?>
<div id="last-visited" class="filtros-info">
    <div class="gh-lastv ghdates"><?= esc_html($start_date); ?> → <?= esc_html($end_date); ?></div> | <div class="gh-lastv ghsources"><?= esc_html($source_label); ?></div>
</div>


<!-- Container with Preline style -->
<div class="relative w-full h-[550px] max-h-[70vh] sm:h-[500px] lg:h-[550px] overflow-hidden">
  <canvas id="geohatllm_chart" class="absolute inset-0 w-full h-full"></canvas>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const ctx = document.getElementById('geohatllm_chart');
  if (!ctx) return;

  const ctx2d = ctx.getContext('2d');

  // === Gradientes ===
  const gradient = (c1, c2) => {
    const g = ctx2d.createLinearGradient(0, 0, 0, 400);
    g.addColorStop(0, c1);
    g.addColorStop(1, c2);
    return g;
  };

  // === Logos ===
  const logos = {
    'ChatGPT     ': '/wp-content/plugins/geohatllm/core/img/ai-logos/chatgpt.svg',
    'Gemini     ': '/wp-content/plugins/geohatllm/core/img/ai-logos/gemini.svg',
    'Claude     ': '/wp-content/plugins/geohatllm/core/img/ai-logos/claude.svg',
    'Copilot     ': '/wp-content/plugins/geohatllm/core/img/ai-logos/bing.svg',
    'Perplexity     ': '/wp-content/plugins/geohatllm/core/img/ai-logos/perplexity.svg',
    'Mistral      ': '/wp-content/plugins/geohatllm/core/img/ai-logos/mistral.png',
    'Venice': '/wp-content/plugins/geohatllm/core/img/ai-logos/venice.svg'
  };

  // === Carga de imágenes ===
  const loadedImages = {};
  for (const [name, src] of Object.entries(logos)) {
    const img = new Image();
    img.src = src;
    loadedImages[name] = img;
  }

  // === Configuración del gráfico ===
  new Chart(ctx, {
    type: 'line',
    data: {
      labels: <?= json_encode($days); ?>,
      datasets: [
        {
          label: 'ChatGPT     ',
          data: <?= json_encode($chatgpt_data); ?>,
          borderColor: '#10A37F',
          backgroundColor: gradient('rgba(16,163,127,0.4)', 'rgba(16,163,127,0.05)'),
          borderWidth: 2,
          tension: 0.4,
          pointRadius: 0,
          fill: true,
        },
        {
          label: 'Gemini     ',
          data: <?= json_encode($gemini_data); ?>,
          borderColor: '#4285F4',
          backgroundColor: gradient('rgba(66,133,244,0.4)', 'rgba(66,133,244,0.05)'),
          borderWidth: 2,
          tension: 0.4,
          pointRadius: 0,
          fill: true,
        },
        {
          label: 'Claude     ',
          data: <?= json_encode($claude_data); ?>,
          borderColor: '#FFB300',
          backgroundColor: gradient('rgba(255,179,0,0.4)', 'rgba(255,179,0,0.05)'),
          borderWidth: 2,
          tension: 0.4,
          pointRadius: 0,
          fill: true,
        },
        {
          label: 'Copilot     ',
          data: <?= json_encode($copilot_data); ?>,
          borderColor: '#151a28',
          backgroundColor: gradient('rgba(0,120,215,0.4)', 'rgba(0,120,215,0.05)'),
          borderWidth: 2,
          tension: 0.4,
          pointRadius: 0,
          fill: true,
        },
        {
          label: 'Perplexity     ',
          data: <?= json_encode($perplexity_data); ?>,
          borderColor: '#31b8c6',
          backgroundColor: gradient('#191a1ab0', '#31b7c6a0'),
          borderWidth: 2,
          tension: 0.4,
          pointRadius: 0,
          fill: true,
        },
        {
          label: 'Mistral      ',
          data: <?= json_encode($mistral_data); ?>,
          borderColor: 'rgba(255,130,5,1)',
          backgroundColor: gradient('rgba(179,93,32,0.4)', 'rgba(211,129,47,0.5)'),
          borderWidth: 2,
          tension: 0.4,
          pointRadius: 0,
          fill: true,
        }
        ,
        {
          label: 'Venice',
          data: <?= json_encode($venice_data); ?>,
          borderColor: 'rgba(219,51,0,1)',
          backgroundColor: gradient('rgba(226,224,208,0.4)', 'rgba(66,153,225,0.5)'),
          borderWidth: 2,
          tension: 0.4,
          pointRadius: 0,
          fill: true,
        }
      ]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          position: 'top',
          labels: {
            color: '#111827',
            boxWidth: 0, // 🔹 sin cuadro
            usePointStyle: false,
            font: { size: 18 },
            generateLabels: chart => chart.data.datasets.map((ds, i) => ({
              text: ds.label,
              datasetIndex: i,
              hidden: !chart.isDatasetVisible(i)
            }))
          }
        },
        tooltip: {
          backgroundColor: '#fff',
          titleColor: '#111827',
          bodyColor: '#4b5563',
          borderColor: '#e5e7eb',
          borderWidth: 1,
          padding: 10,
          displayColors: true,
          usePointStyle: true
        }
      },
      interaction: { mode: 'index', intersect: false },
      scales: {
        x: {
          grid: { display: false },
          ticks: { color: '#6b7280', font: { size: 12 } }
        },
        y: {
          beginAtZero: true,
          grid: {
            color: '#8d096c15',
            borderDash: [4, 4],
            lineWidth: 1.2
          },
          ticks: { color: '#6b7280', font: { size: 12 } }
        }
      }
    },
    plugins: [{
      id: 'legendWithLogos',
      afterDraw(chart) { // 🔹 se ejecuta solo una vez
        const { ctx, legend } = chart;
        if (!legend) return;

        legend.legendItems.forEach((item, i) => {
          const img = loadedImages[item.text];
          if (!img) return;

          const box = legend.legendHitBoxes[i];
          const y = box.top + box.height / 2 - 8;
          const x = box.left - 8;
          ctx.save();
          ctx.drawImage(img, x, y, 16, 16); // 🔹 16px tamaño limpio y visible
          ctx.restore();
        });
      }
    }]
  });
});
</script>



</div>