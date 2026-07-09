import Chart from 'chart.js/auto';

function renderTrendChart() {
    const canvas = document.getElementById('trendChart');

    if (!canvas) {
        return;
    }

    const dataEl = document.getElementById('trendChartData');

    if (!dataEl) {
        return;
    }

    const trend = JSON.parse(dataEl.textContent);

    const styles = getComputedStyle(document.documentElement);
    const inkColor = (styles.getPropertyValue('--color-ink') || '#1D1D1F').trim() || '#1D1D1F';
    const gridColor = (styles.getPropertyValue('--color-line') || '#EBEBED').trim() || '#EBEBED';

    const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    new Chart(canvas, {
        type: 'line',
        data: {
            labels: trend.labels,
            datasets: [{
                data: trend.data,
                borderColor: inkColor,
                backgroundColor: 'transparent',
                borderWidth: 2,
                pointRadius: 0,
                tension: 0.3,
            }],
        },
        options: {
            animation: !reducedMotion,
            plugins: {
                legend: { display: false },
                tooltip: { enabled: true },
            },
            scales: {
                x: {
                    grid: { display: false },
                    ticks: { display: false },
                },
                y: {
                    beginAtZero: true,
                    grid: { color: gridColor },
                    ticks: { color: inkColor },
                },
            },
        },
    });
}

document.addEventListener('DOMContentLoaded', renderTrendChart);
