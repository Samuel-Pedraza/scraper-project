<canvas id="linegraph-secondary">

</canvas>
<script>
    const lineGraphSecondary = document.getElementById('linegraph-secondary').getContext('2d');

    let articleURLS = [];

    fetch('http://localhost:9000?endpoint=getArticleURLS')
    .then(response => response.json())
    .then(data => {

        const myChart = new Chart(lineGraphSecondary, {
            type: 'line',
            data: {
                labels: '',
                datasets: [{
                    label: 'Article URLs',
                    data: data,
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