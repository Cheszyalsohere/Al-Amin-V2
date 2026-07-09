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

function renderSourceChart() {
    const canvas = document.getElementById('sourceChart');

    if (!canvas) {
        return;
    }

    const dataEl = document.getElementById('sourceChartData');

    if (!dataEl) {
        return;
    }

    const sources = JSON.parse(dataEl.textContent);

    const styles = getComputedStyle(document.documentElement);
    const inkColor = (styles.getPropertyValue('--color-ink') || '#1D1D1F').trim() || '#1D1D1F';
    const surfaceColor = (styles.getPropertyValue('--color-surface') || '#FFFFFF').trim() || '#FFFFFF';

    // Restrained palette: one ink accent for the top source, then descending grays.
    const grayShades = ['#8E8E93', '#AEAEB2', '#C7C7CC', '#D1D1D6', '#E5E5EA', '#F2F2F7'];
    const palette = sources.map((_, i) => (i === 0 ? inkColor : grayShades[(i - 1) % grayShades.length]));

    const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    new Chart(canvas, {
        type: 'doughnut',
        data: {
            labels: sources.map((s) => s.label),
            datasets: [{
                data: sources.map((s) => s.count),
                backgroundColor: palette,
                borderColor: surfaceColor,
                borderWidth: 2,
            }],
        },
        options: {
            animation: !reducedMotion,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: { color: inkColor, boxWidth: 12, padding: 12 },
                },
                tooltip: { enabled: true },
            },
        },
    });
}

document.addEventListener('DOMContentLoaded', renderTrendChart);
document.addEventListener('DOMContentLoaded', renderSourceChart);
