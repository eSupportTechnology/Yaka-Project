document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('userChart');
    const loadingElement = document.getElementById('chartLoading');
    const errorElement = document.getElementById('chartError');

    // Initialize empty chart
    const chart = new Chart(ctx, {
        type: 'bar',
        data: { labels: [], datasets: [] },
        options: { responsive: true, maintainAspectRatio: false }
    });

    // Fetch data via AJAX
    fetch('/user-chart-data')
        .then(response => {
            if (!response.ok) throw new Error('Network response was not ok');
            return response.json();
        })
        .then(data => {
            // Update chart with new data
            chart.data.labels = data.labels;
            chart.data.datasets = [{
                label: 'Number of Users Registered',
                data: data.data,
                backgroundColor: '#A52929',
                borderColor: '#A52929',
                borderWidth: 1,
                hoverBackgroundColor: '#A52929'
            }];

            // Update chart options
            chart.options = {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { stepSize: 1 }
                    }
                },
                plugins: {
                    legend: { position: 'top' },
                    title: {
                        display: true,
                        text: 'Monthly User Registrations'
                    }
                }
            };

            chart.update();
            loadingElement.style.display = 'none';
        })
        .catch(error => {
            console.error('Error:', error);
            loadingElement.style.display = 'none';
            errorElement.style.display = 'block';
            errorElement.textContent = 'Failed to load chart data: ' + error.message;
        });


        //Paid Ad data
        const paidCtx = document.getElementById('paidChart');
        const paidLoadingElement = document.getElementById('paidChartLoading');
        const paidErrorElement = document.getElementById('paidChartError');

        // Initialize empty chart
        const paidChart = new Chart(paidCtx, {
            type: 'bar',
            data: { labels: [], datasets: [] },
            options: { responsive: true, maintainAspectRatio: false }
        });

        // Fetch data via AJAX
        fetch('/paid-ad-chart-data')
            .then(response => {
                if (!response.ok) throw new Error('Network response was not ok');
                return response.json();
            })
            .then(data => {
                // Update chart with new data
                paidChart.data.labels = data.labels;
                paidChart.data.datasets = [{
                    label: 'Number of Paid Ads',
                    data: data.data,
                    backgroundColor: '#440381',
                    borderColor: '#440381',
                    borderWidth: 1,
                    hoverBackgroundColor: '#440381'
                }];

                // Update chart options
                paidChart.options = {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: { stepSize: 1 }
                        }
                    },
                    plugins: {
                        legend: { position: 'top' },
                        title: {
                            display: true,
                            text: 'Monthly Paid Ads'
                        }
                    }
                };

                paidChart.update();
                paidLoadingElement.style.display = 'none';
            })
            .catch(error => {
                console.error('Error:', error);
                paidLoadingElement.style.display = 'none';
                paidErrorElement.style.display = 'block';
                paidErrorElement.textContent = 'Failed to load chart data: ' + error.message;
            });

            //Free Ad data
            const freeCtx = document.getElementById('freeChart');
            const freeLoadingElement = document.getElementById('freeChartLoading');
            const freeErrorElement = document.getElementById('freeChartError');

            // Initialize empty chart
            const freeChart = new Chart(freeCtx, {
                type: 'bar',
                data: { labels: [], datasets: [] },
                options: { responsive: true, maintainAspectRatio: false }
            });

            // Fetch data via AJAX
            fetch('/free-ad-chart-data')
                .then(response => {
                    if (!response.ok) throw new Error('Network response was not ok');
                    return response.json();
                })
                .then(data => {
                    // Update chart with new data
                    freeChart.data.labels = data.labels;
                    freeChart.data.datasets = [{
                        label: 'Number of Free Ads',
                        data: data.data,
                        backgroundColor: '#d10000',
                        borderColor: '#d10000',
                        borderWidth: 1,
                        hoverBackgroundColor: '#d10000'
                    }];

                    // Update chart options
                    freeChart.options = {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: { stepSize: 1 }
                            }
                        },
                        plugins: {
                            legend: { position: 'top' },
                            title: {
                                display: true,
                                text: 'Monthly Free Ads'
                            }
                        }
                    };

                    freeChart.update();
                    freeLoadingElement.style.display = 'none';
                })
                .catch(error => {
                    console.error('Error:', error);
                    freeLoadingElement.style.display = 'none';
                    freeErrorElement.style.display = 'block';
                    freeErrorElement.textContent = 'Failed to load chart data: ' + error.message;
                });
});
