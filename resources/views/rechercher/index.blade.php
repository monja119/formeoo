@extends('base')
@section('title')
    Rechercher - Formeoo
@endsection
@vite(['resources/js/pages/formation/show.js'])

@section('content')
    <div class="row mt-3">
        <div class="col-3">
            <h1>
                Rechercher
            </h1>
        </div>
        <div class="col-9 ">
            <form method="post" action="{{ Route('rechercher') }}" enctype="multipart/form-data">
                @csrf
                <div class="row mt-2 justify-content-end align-items-center">
                    <div class="col-8">
                        <input type="text" class="form-control rounded-5" name="recherche" id="recherche" required/>
                    </div>
                    <div class="col-2">
                        <button type="submit" class="rounded-5 btn btn-primary w-100 p-2">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="mt-3 small">
        Résultat pour : <span class="fw-bold">Cybersécurité</span>
    </div>
    <div class="row mt-5 border-bottom pb-1 border-black">
        <div class="col-3 hover-main-color hover-scale d-flex flex-row justify-content-center align-items-center fw-bold">
            Formations
        </div>
        <div class="col-3 hover-main-color hover-scale d-flex flex-row justify-content-center align-items-center fw-bold">
            Modules
        </div>
        <div class="col-3 hover-main-color hover-scale d-flex flex-row justify-content-center align-items-center fw-bold">
            Personnes
        </div>
        <div class="col-3 hover-main-color hover-scale d-flex flex-row justify-content-center align-items-center fw-bold">
            Tout
        </div>
    </div>

    <div class="mt-3">
        <div class="col-12 p-2">
            <input type="hidden"
                   id="module_id"
                   value="4"
            />
            <h3 class="text-center mt-4 fw-medium main-color opacity-75"> Cybersécurité </h3>

            <!-- row -->
            <div class="row mt-2 justify-content-center">
                <div class="col-12 card">
                    <!-- card-header -->
                    <div class="card-header hover-s row">
                        <div class="col-11 ellipsis small">
                            <i class="fa fa-user"></i>
                            <span class="opacity-75 fw-bold"> Mialy rasoanirina </span>
                        </div>
                        <div class="col-1">
                            <i class="fa fa-bars cursor-pointer hover-scale"></i>
                        </div>
                    </div>
                    <!-- ./card-header -->

                    <!-- card-body -->
                    <div class="card-body small">
                        <div class="row">
                            <!-- left-side -->
                            <div class="col-6 pt-2 d-flex flex-column">

                                <!-- formation information -->
                                <div class="date">
                                    <i class="fa fa-calendar-days main-color"></i>
                                    <span class="opacity-75 ml-1"> 2023-08-15 </span>
                                </div>
                                <div class="time">
                                    <i class="fa fa-clock main-color"></i>
                                    <span class="opacity-75 ml-1 text-success">  14:00 - 16:00 </span>
                                </div>
                                <div class="lieu">
                                    <i class="fa fa-map-marker-alt main-color"></i>
                                    <span class="opacity-75 ml-1"> Mon entreprise </span>
                                </div>
                                <!-- ./formation information -->

                                <!-- module information -->
                                <div class="ml-1">
                                    <!-- description -->
                                    <div class="mt-3">
                                        Un module qui foculiser sur la cybersecurité
                                    </div>
                                    <!-- ./description -->

                                    <!-- objectifs -->
                                    <div class="mt-3">
                                        <i class="fa fa-flag main-color"></i>
                                        <span class="opacity-50 fw-bold small">Objectifs</span>
                                        <div class="block">
                                            <ul class="small" id="list-objectif">
                                                <li class="mt-1">
                                                    <span class="opacity-75 ml-1">
                                                        Sensibiliser les participants aux risques liés à la cybercriminalité et aux bonnes pratiques à adopter pour s’en prémunir.
                                                    </span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- ./objectifs -->

                                    <!-- competences -->
                                    <div class="mt-3">
                                        <i class="fa fa-check-circle main-color"></i>
                                        <span class="opacity-50 fw-bold small">Compétences</span>
                                        <div class="block">
                                            <ul class="small" id="list-competence">
                                                    <li class="mt-1">
                                                        <span class="opacity-75 ml-1">
                                                            Faire preuve de vigilance et de prudence dans l’utilisation des outils numériques.
                                                        </span>
                                                    </li>
                                                <li class="mt-1">
                                                        <span class="opacity-75 ml-1">
                                                            Adopter les bonnes pratiques pour se protéger des risques liés à la cybercriminalité.
                                                        </span>
                                                    </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- ./competences -->

                                    <!-- module -->
                                    <div class="mt-3">
                                        <a href="#">
                                            <input style="transform: scale(0.8); margin-left: -4%" type="button" class="small btn btn-primary" value="Voir le module" />
                                        </a>
                                    </div>
                                    <!-- ./module -->

                                </div>
                                <!-- ./module information -->

                            </div>
                            <!-- ./left-side -->

                            <!-- right-side -->
                            <div class="col-6 d-flex flex-column justify-content-center align-items-center ">
                                <input type="hidden" id="total_apprenant" value="1" />
                                <input type="hidden" id="participant_apprenant" value="4" />
                                <div class="" style="height: 200px">
                                    <canvas  class="" id="chart"></canvas>
                                </div>
                                <span class="main-color mt-5">
                                    65 %
                            </span>
                            </div>
                            <!-- ./right-side -->

                        </div>
                    </div>
                    <!-- ./card-body -->

                </div>
            </div>
            <!-- ./row -->
        </div>
    </div>
@endsection
