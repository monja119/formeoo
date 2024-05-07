import Chart from 'chart.js/auto'
import host from "../../settings/host.js";

let user_id = document.querySelector('#user_id')
let module_id = document.querySelector('#module_id')
let apprenant = document.getElementById('apprenant');
let apprenant_id = document.getElementById('apprenant_id');
let select_apprenant = document.getElementById('select-apprenant');


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
            label: ['Taux de participation'],
            data: [65, 59, 80, 81, 56, 55, 40],
            fill: false,
            borderColor: 'rgb(75, 192, 192)',
            tension: 0.1

        }],

    };

    new Chart(
        document.getElementById('chart-line'),
        {
            type: 'line',
            data: data,
        }
    );
})();


//_____inscription____
function main() {
    if(document.querySelector('#inscription')) {
        let inscription_button = document.querySelector('#inscription')
        inscription_button.onclick = function () {
            inscription_button.disable = true;
            let url = host + '/module/' + module_id.value + '/signin/' + user_id.value;
            var xhr = new XMLHttpRequest();
            xhr.open('GET', url, true);
            xhr.onload = function () {
                if (this.status === 201) {
                    inscription_button.id = 'quitter';
                    inscription_button.classList.remove('btn-primary');
                    inscription_button.classList.add("btn-danger");
                    inscription_button.value = 'Quitter';
                    inscription_button.disable = false;
                    document.querySelector('#apprenant_count').innerText = parseInt(document.querySelector('#apprenant_count').innerText) + 1;
                    main();
                }
            }
            xhr.send();
        }
    }

    if(document.querySelector('#quitter')) {
        let quitter_button = document.querySelector('#quitter')
        quitter_button.onclick = function () {
            quitter_button.disable = true
            let url = host + '/module/' + module_id.value + '/signout/' + user_id.value;
            var xhr = new XMLHttpRequest();
            xhr.open('GET', url, true);
            xhr.onload = function () {
                if (this.status === 201) {
                    quitter_button.id = "inscription";
                    quitter_button.classList.remove('btn-danger');
                    quitter_button.classList.add("btn-primary");
                    quitter_button.value = "S'inscrire";
                    quitter_button.disable = false;
                    document.querySelector('#apprenant_count').innerText = parseInt(document.querySelector('#apprenant_count').innerText) - 1;
                    main();
                }
            }
            xhr.send();
        }
    }

}
main()


// ____________ nom de l'apprenant ____________
function participation_perso ()  {
    const data = {
        labels: [
            'Participation',
            'Absence',
        ],
        datasets: [{
            label: ['Taux'],
            data: [30, 70],
            backgroundColor: [
                'rgb(0, 200, 0)',
                'rgb(200, 0, 0)',
            ],
            hoverOffset: 4,
        }],

    };

    new Chart(
        document.getElementById('chart-pie-perso'),
        {
            type: 'pie',
            data: data,
        }
    );
}


function suivi_parso () {
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
            label: ['Taux'],
            data: [65, 59, 80, 81, 56, 55, 40],
            fill: false,
            borderColor: 'rgb(75, 192, 192)',
            tension: 0.1

        }],

    };

    new Chart(
        document.getElementById('chart-line-perso'),
        {
            type: 'line',
            data: data,
        }
    );
}


// fetching formateur
apprenant.addEventListener('keyup', function (){
    select_apprenant.innerHTML = null;

    let nom = this.value;
    let url = 'http://localhost:8000/getapprenant/';

    var xhr = new XMLHttpRequest();
    xhr.open('GET', url, true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

    xhr.onload = function () {
        if (this.status === 201) {
            var response = JSON.parse(this.responseText);

            Object.keys(response).forEach(function (key, index){
                let apprenants = response[key];
                select_apprenant.innerHTML +=
                    `
                         <div class="row small bold-hover list-apprenant p-1" id="apprenant-`+ apprenants['id'] + `">
                                <span class="col-12 ellipsis"> `+ apprenants['nom'] + ` </span>
                        </div>
                    `;
            })

            updateSelectapprenantsItem();
        }
    }

    xhr.send(JSON.stringify({
        nom: nom,
    }));

})

function updateSelectapprenantsItem(){
    let apprenants_list = select_apprenant.querySelectorAll('.list-apprenant');

    apprenants_list.forEach(function (apprenant_list){
        apprenant_list.addEventListener('click', function (){
            apprenant_id.value  = apprenant_list.id.split('-')[1];
            apprenant.value = apprenant_list.querySelector('span').innerText;
            select_apprenant.innerHTML = '';

            participation_perso();
            suivi_parso();
        })
    })
}

