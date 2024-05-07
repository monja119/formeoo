import Chart from "chart.js/auto";


(function() {
    let total_apprenant = document.querySelector('#total_apprenant').value;
    let participant_apprenant = document.querySelector('#participant_apprenant').value;

    // calculer le taux de presence
    let taux_presence = (participant_apprenant/total_apprenant)*100
    let taux_absence = 100 - taux_presence

    const data = {
        labels: [
            'Absent',
            'Présent',
        ],
        datasets: [{
            label: ['Taux'],
            data: [
                taux_absence,
                taux_presence,
            ],
            backgroundColor: [
                'rgb(200, 60, 60)',
                'rgb(0, 200, 0)',
            ],
            hoverOffset: 4,
        }],

    };

    new Chart(
        document.getElementById('chart'),
        {
            type: 'pie',
            data: data,
        }
    );
})();
