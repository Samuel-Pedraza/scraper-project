<canvas id="linegraph-primary">

</canvas>
<script>
    const ctx = document.getElementById('linegraph-primary').getContext('2d');

    let pointData = [];

    fetch('http://localhost:9000?endpoint=articlePoints')
    .then(response => response.json())
    .then(data => {
        pointData = data.filter(Number);

        const myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: 'Points Data Range',
                datasets: [{
                    label: 'Point Data',
                    data: pointData,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });

    });
</script>