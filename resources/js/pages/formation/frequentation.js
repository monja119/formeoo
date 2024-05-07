import Chart from "chart.js/auto";
import host from "../../settings/host.js";

let frequentation_line_chart = document.querySelector('#frequentation_line_chart')
let module_id = document.querySelector('#module_id')

// calculer la fraquentation
// url /calcul/frequentation/session/{module_id}
let url = host + '/calcul/frequentation/session/' + module_id.value;

fetch(url,
    {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
        }
    })
    .then(response => response.json())
    .then(data => {
        frequentation(data.date, data.participants)
    }
    )
    .catch(error => console.log(error))


function frequentation (date, participants) {

    const data = {
        labels: date,
        datasets: [{
            label: ['Fréquentation'],
            data: participants,
            fill: false,
            borderColor: 'rgb(75, 192, 192)',
            tension: 0.1

        }],

    };

    new Chart(
        document.getElementById('frequentation_line_chart'),
        {
            type: 'line',
            data: data,
        }
    );
}
