
document.addEventListener('DOMContentLoaded', function() {
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
    // Verifica que Chart esté disponible
    if (typeof Chart === 'undefined') {
        console.log(typeof Chart);
        console.error('Chart.js no se cargó correctamente');
        return;
    }else{

    /*const ctxOrdenes = document.getElementById('chartOrdenes').getContext('2d');
    new Chart(ctxOrdenes, {
        type: 'bar',
        data: {
            labels: ['Ene', 'Feb', 'Mar'],
            datasets: [{
                label: 'Órdenes por mes',
                data: [12, 19, 3],
                backgroundColor: 'rgba(255, 159, 64, 0.7)',
                borderColor: 'rgba(255, 159, 64, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });*/

    // Gráfico de Ventas concretadas
    const ctxVentas = document.getElementById('chartVentas').getContext('2d');
    new Chart(ctxVentas, {
        type: 'line',
        data: {
            labels: ['Semana 1', 'Semana 2', 'Semana 3'],
            datasets: [{
                label: 'Ventas por mes',
                data: [15, 22, 8, 12, 7, 10],
                fill: false,
                backgroundColor: 'rgba(54, 162, 235, 0.7)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 3
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    position: 'bottom',
                },
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
    const ctx = document.getElementById('chartOrdenPie').getContext('2d');
            
            const pieChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Electrónicos', 'Ropa', 'Alimentos', 'Hogar', 'Otros'],
                    datasets: [{
                        data: [35, 25, 20, 15, 5],
                        backgroundColor: [
                            '#4e73df',
                            '#1cc88a',
                            '#36b9cc',
                            '#f6c23e',
                            '#e74a3b'
                        ],
                        hoverBackgroundColor: [
                            '#2e59d9',
                            '#17a673',
                            '#2c9faf',
                            '#dda20a',
                            '#be2617'
                        ],
                        hoverBorderColor: "rgba(234, 236, 244, 1)",
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    plugins: {
                        legend: {
                            position: 'right',
                            labels: {
                                padding: 20,
                                usePointStyle: true,
                                pointStyle: 'circle'
                            }
                        },
                        tooltip: {
                            backgroundColor: "rgb(255,255,255)",
                            bodyColor: "#858796",
                            titleMarginBottom: 10,
                            titleColor: '#6e707e',
                            titleFontSize: 14,
                            borderColor: '#dddfeb',
                            borderWidth: 1,
                            padding: 15,
                            displayColors: true,
                            intersect: false,
                            mode: 'index',
                            callbacks: {
                                label: function(context) {
                                    const label = context.label || '';
                                    const value = context.raw || 0;
                                    const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                    const percentage = Math.round((value / total) * 100);
                                    return `${label}: ${value} (${percentage}%)`;
                                }
                            }
                        }
                    },
                    cutout: '0%', // Cambia a '50%' para un gráfico donut
                    animation: {
                        animateScale: true,
                        animateRotate: true
                    }
                }
            });

            // Función para actualizar datos dinámicamente
            window.updateChart = function(data) {
                pieChart.data.datasets[0].data = data;
                pieChart.update();
            };
        
}});
