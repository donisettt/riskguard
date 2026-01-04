document.addEventListener('DOMContentLoaded', () => {

    if (!window.DASHBOARD_DATA) return;

    const riskStats = window.DASHBOARD_DATA.riskStats;

    const labels = riskStats.map(item => item.risk_level);
    const values = riskStats.map(item => item.jml);

    // Doughnut Chart
    new Chart(document.getElementById('riskChart'), {
        type: 'doughnut',
        data: {
            labels,
            datasets: [{
                data: values,
                backgroundColor: [
                    'rgba(16,185,129,.8)',
                    'rgba(251,191,36,.8)',
                    'rgba(249,115,22,.8)',
                    'rgba(239,68,68,.8)'
                ],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            cutout: '65%',
            plugins: {
                legend: { position: 'bottom' }
            }
        }
    });

    // Bar Chart
    new Chart(document.getElementById('barChart'), {
        type: 'bar',
        data: {
            labels,
            datasets: [{
                label: 'Jumlah Responden',
                data: values,
                backgroundColor: 'rgba(59,130,246,.8)',
                borderRadius: 6
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true }
            }
        }
    });

});
