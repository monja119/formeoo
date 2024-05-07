@extends('base')
@section('title')
    planifier
@endsection
@vite(['resources/css/pages/planifier.css'])
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>

<style>
    #select-module div, #select-formateur div{
        opacity: 0.75;
        cursor: pointer;
        padding: 1%;
    }
</style>

@section('content')
    <header class="row d-flex flex-row p-1 border-bottom">
        <div>
            <h4 class="fw-bold">
                Planifier une formation
            </h4>
        </div>
    </header>

    <section class="mt-4">
        <form method="post" action="{{ Route('planifier') }}" enctype="multipart/form-data">
            @csrf
            <!-- module -->
            <div class="mt-3 d-flex flex-column">
                <label for="module" class="opacity-50 fw-bold small">Module</label>
                <div class="row">
                    <div class="col-12">
                        <input type="hidden" name="module_id" id="module_id" required/>
                        <input type="text" class="form-control" name="module" id="module" required/>
                        <div class="mt-1 d-flex flex-column border" id="select-module">

                        </div>
                    </div>
                </div>
            </div>
            <!-- ./module -->

            <!-- formateur -->
            <div class="mt-3 d-flex flex-column">
                <label for="formateur" class="opacity-50 fw-bold small">Formateur</label>
                <div class="row">
                    <div class="col-12">
                        <input type="hidden" name="formateur_id" id="formateur_id" required/>
                        <input type="text" class="form-control" name="formateur" id="formateur" required/>
                        <div class="mt-1 d-flex flex-column border" id="select-formateur">
                        </div>
                    </div>
                </div>
            </div>
            <!-- ./formateur -->


            <!-- date -->
            <div class="mt-5 d-flex flex-column">
                <label for="date" class="opacity-50 fw-bold small">Date</label>
                <div class="row">
                    <div class="col-12">
                        <input type="date" class="form-control" name="date" id="date" required/>
                    </div>
                </div>
            </div>
            <!-- ./date -->

            <!-- heure-debut -->
            <div class="mt-3 d-flex flex-column">
                <label for="heure-debut" class="opacity-50 fw-bold small">Heure de début</label>
                <div class="row">
                    <div class="col-12">
                        <input type="time" class="form-control" name="heure-debut" id="heure-debut" required/>
                    </div>
                </div>
            </div>
            <!-- ./heure-debut -->

            <!-- heure-fin -->
            <div class="mt-3 d-flex flex-column">
                <label for="heure-fin" class="opacity-50 fw-bold small">Heure de fin</label>
                <div class="row">
                    <div class="col-12">
                        <input type="time" class="form-control" name="heure-fin" id="heure-fin" required/>
                    </div>
                </div>
            </div>
            <!-- ./heure-fin -->

            <!-- lieu -->
            <div class="mt-3 d-flex flex-column">
                <label for="lieu" class="opacity-50 fw-bold small">Lieu</label>
                <div class="mt-1 align-items-center d-flex flex-row justify-content-start">
                    <select class="form-select" name="type-lieu" id="type-lieu">
                        <option value="physique" selected>Physique</option>
                        <option value="virtuel">Virtuel</option>
                    </select>
                </div>
                <div class="row mt-1">
                    <div class="col-12">
                        <input type="text" class="form-control" name="lieu" id="lieu" required/>
                    </div>
                </div>
            </div>
            <!-- ./lieu -->

            <div class="row justify-content-center mt-5">
                <input type="submit" class="btn btn-success w-50" value="Valider" />
            </div>


        </form>
    </section>

    <script type="text/javascript" defer>
        let module = document.getElementById('module');
        let module_id = document.getElementById('module_id');
        let select_module = document.getElementById('select-module');

        let formateur = document.getElementById('formateur');
        let formateur_id = document.getElementById('formateur_id');
        let select_formateur = document.getElementById('select-formateur');

        // fetching module
        module.addEventListener('keyup', function (){
            select_module.innerHTML = null;

            let titre = this.value;
            let url = 'http://localhost:8000/getmodule/';

            var xhr = new XMLHttpRequest();
            xhr.open('GET', url, true);
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

            xhr.onload = function () {
                if (this.status === 201) {
                    var response = JSON.parse(this.responseText);

                    Object.keys(response).forEach(function (key, index){
                        let modules = response[key];
                        select_module.innerHTML +=
                        `
                         <div class="row small bold-hover list-module" id="module-`+ modules['id'] + `">
                                <span class="col-6 ellipsis"> `+ modules['titre'] + ` </span>
                                <span class="col-6 ellipsis"> `+ modules['description'] +` </span>
                        </div>
                        `;
                    })

                    updateSelectModulesItem();
                }
            }

            xhr.send(JSON.stringify({
                titre: titre,
            }));

        })

    function updateSelectModulesItem(){
        let modules_list = select_module.querySelectorAll('.list-module');

        modules_list.forEach(function (module_list){
            module_list.addEventListener('click', function (){
                module_id.value  = module_list.id.split('-')[1];
                module.value = module_list.querySelector('span').innerText;
                select_module.innerHTML = '';
            })
        })

    }


    // fetching formateur
    formateur.addEventListener('keyup', function (){
            select_formateur.innerHTML = null;

            let nom = this.value;
            let url = 'http://localhost:8000/getformateur/';

            var xhr = new XMLHttpRequest();
            xhr.open('GET', url, true);
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

            xhr.onload = function () {
                if (this.status === 201) {
                    var response = JSON.parse(this.responseText);

                    Object.keys(response).forEach(function (key, index){
                        let formateurs = response[key];
                        select_formateur.innerHTML +=
                        `
                         <div class="row small bold-hover list-formateur" id="formateur-`+ formateurs['id'] + `">
                                <span class="col-12 ellipsis"> `+ formateurs['nom'] + ` </span>
                        </div>
                        `;
                    })

                    updateSelectFormateursItem();
                }
            }

            xhr.send(JSON.stringify({
                nom: nom,
            }));

        })

        function updateSelectFormateursItem(){
        let formateurs_list = select_formateur.querySelectorAll('.list-formateur');

            formateurs_list.forEach(function (formateur_list){
                formateur_list.addEventListener('click', function (){
                    formateur_id.value  = formateur_list.id.split('-')[1];
                    formateur.value = formateur_list.querySelector('span').innerText;
                    select_formateur.innerHTML = '';
                })
            })
        }




        /// lieu managing
        let type_lieu = document.getElementById('type-lieu');
        let lieu = document.getElementById('lieu');

        type_lieu.addEventListener('change', function (){
            if(this.value === 'virtuel'){
                lieu.value = 'virtuel';
                lieu.setAttribute('disabled', 'disabled');
            }else{
                lieu.value = '';
                lieu.removeAttribute('disabled');
            }
        })
    </script>

@endsection
