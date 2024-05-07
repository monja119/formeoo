import Chart from "chart.js/auto";


(function() {
    const data = {
        datasets: [{
            label: ['Taux'],
            data: [
                80,
                20,
            ],
            backgroundColor: [
                'rgb(0, 200, 0)',
                'rgb(200, 60, 60)',
            ],
            hoverOffset: 4,
        }],

    };

    new Chart(
        document.getElementById('participation'),
        {
            type: 'pie',
            data: data,
        }
    );
})();


(async function() {
    const data = {
        labels: [
            'Janvier',
            'Février',
            'Mars',
            'Avril',
            'Mai',
            'Juin',
            'Juillet'
        ],
        datasets: [{
            label: ['Formations suivies par mois'],
            data: [75, 50, 60, 81, 56, 55, 60],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(255, 205, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(201, 203, 207, 0.2)'
            ],
            borderColor: [
                'rgb(255, 99, 132)',
                'rgb(255, 159, 64)',
                'rgb(255, 205, 86)',
                'rgb(75, 192, 192)',
                'rgb(54, 162, 235)',
                'rgb(153, 102, 255)',
                'rgb(201, 203, 207)'
            ],
            borderWidth: 1,
        }],

    };

    new Chart(
        document.getElementById('diagnostic-months'),
        {
            type: 'bar',
            data: data,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            },
        }
    );
})();


(async function() {
    const data = {
        labels: [
            'formations',
            'Modules',
            'Achevés',
            'Présences',
            'Absences',

        ],
        datasets: [{
            label: 'My First Dataset',
            data: [50, 13, 40, 10, 40],
            backgroundColor: [
                'rgb(75, 192, 192)',
                'rgb(255, 205, 86)',
                'rgb(54, 162, 235)',
                'rgb(0, 220, 0)',
                'rgb(200, 0, 0)',
            ]
        }]
    };

    const config = {
        type: 'polarArea',
        data: data,
        options: {}
    };

    new Chart(
        document.getElementById('diagnostic-total'),
        config
    );

})();
