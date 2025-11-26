document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('geohatllm_chart').getContext('2d');
    let chart;
    const select = document.getElementById('geohatllm_range');

    function fetchData(range = 'day') {
        jQuery.post(geohatllm_ajax.ajax_url, {
            action: 'geohatllm_stats',
            nonce: geohatllm_ajax.nonce,
            range: range
        }, function (response) {
            const labels = response.map(row => row.period);
            const data = response.map(row => parseInt(row.total, 10));

            if (chart) chart.destroy();
            chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Visitas',
                        data: data
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0
                            }
                        }
                    }
                }
            });
        });
    }

    select.addEventListener('change', () => fetchData(select.value));
    fetchData(select.value); // Inicial
});
console.log("✅ Archivo JS cargado correctamente");
