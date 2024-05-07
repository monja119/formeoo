@extends('base')
@section('title')
    {{ $formation->titre }} - Formeoo
@endsection

@vite(['resources/css/pages/formation/show.css'])

@vite(['resources/js/pages/formation/show.js'])
@vite(['resources/js/pages/formation/presence.js'])
@vite(['resources/js/pages/formation/frequentation.js'])


@section('content')
    <div class="container-fluid">
        <input type="hidden"
            id="module_id"
            value="{{ $formation->module_id }}"
        />
         <h3 class="text-center mt-4 fw-medium main-color opacity-75"> {{ $formation->titre }} </h3>

        <!-- row -->
        <div class="row mt-2 justify-content-center">
            <div class="col-12 card">
                <!-- card-header -->
                <div class="card-header hover-s row">
                    <div class="col-11 ellipsis small">
                        <i class="fa fa-user"></i>
                        <span class="opacity-75 fw-bold"> {{ $formation->first_name }} {{ $formation->last_name }} </span>
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
                                <span class="opacity-75 ml-1"> {{ $formation->date }} </span>
                            </div>
                            <div class="time">
                                <i class="fa fa-clock main-color"></i>
                                <span class="opacity-75 ml-1 text-success"> {{ substr($formation->heure_debut,0, 5) }} - {{ substr($formation->heure_fin,0, 5) }} </span>
                            </div>
                            <div class="lieu">
                                <i class="fa fa-map-marker-alt main-color"></i>
                                <span class="opacity-75 ml-1"> {{ $formation->lieu }} </span>
                            </div>
                            <!-- ./formation information -->

                            <!-- module information -->
                            <div class="ml-1">
                                <!-- description -->
                                <div class="mt-3">
                                    {{ $formation->description }}
                                </div>
                                <!-- ./description -->

                                <!-- objectifs -->
                                <div class="mt-3">
                                    <i class="fa fa-flag main-color"></i>
                                    <span class="opacity-50 fw-bold small">Objectifs</span>
                                    <div class="block">
                                        <ul class="small" id="list-objectif">
                                            <!-- iterating $objectifs -->
                                            @foreach($objectifs as $objectif)
                                                <li class="mt-1">
                                                    <span class="opacity-75 ml-1"> {{ $objectif->objectif }} </span>
                                                </li>
                                            @endforeach
                                            <!-- ./iterating $objectifs -->
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
                                            <!-- iterating $competences -->
                                            @foreach($competences as $competence)
                                                <li class="mt-1">
                                                    <span class="opacity-75 ml-1"> {{ $competence->competence }} </span>
                                                </li>
                                            @endforeach
                                            <!-- ./iterating $competences -->
                                        </ul>
                                    </div>
                                </div>
                                <!-- ./competences -->

                                <!-- prerequis -->
                                @if($prerequis->count() > 0)
                                <div class="mt-3">
                                    <i class="fa fa-info main-color"></i>
                                    <span class="opacity-50 fw-bold small">Prérequis</span>
                                    <div class="block">
                                        <ul class="small" id="list-prerequis">
                                            <!-- iterating $prerequis -->
                                            @foreach($prerequis as $prerequi)
                                                <li class="mt-1">
                                                    <span class="opacity-75 ml-1"> {{ $prerequi->prerequis }} </span>
                                                </li>
                                            @endforeach
                                            <!-- ./iterating $prerequis -->
                                        </ul>
                                    </div>
                                </div>
                                @endif
                                <!-- ./prerequis -->

                                <!-- module -->
                                <div class="mt-3">
                                    <a href="{{ Route('show.module', ['id' => $formation->module_id ]) }}">
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
                            <input type="hidden" id="total_apprenant" value="{{ $apprenants->count() }}" />
                            <input type="hidden" id="participant_apprenant" value="{{ $participant_apprenants }}" />
                            <div class="" style="height: 200px">
                                <canvas  class="" id="chart"></canvas>
                            </div>
                            <span class="main-color mt-5">
                                @if($apprenants->count() != 0)
                                    {{ round((($participant_apprenants / $apprenants->count()) * 100), 2) }} %
                                @else
                                    0 %
                                @endif
                            </span>
                        </div>
                        <!-- ./right-side -->

                    </div>
                </div>
                <!-- ./card-body -->

            </div>
        </div>
        <!-- ./row -->

        <!-- suivi de formation -->
        <div class="row mt-5">
            <div class="col-12">
                <h4 class=""> Fréquentation des sessions de la formation <b>{{ $formation->titre }}</b></h4>

                <!-- chart line -->
                <div class="row mt-3">
                    <div class="col-12">
                        <canvas id="frequentation_line_chart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <!-- ./suivi de formation -->


        @can('formateur')
        <!-- row -->
        <div class="row mt-3">
            <div class="col-12">
                <h3 class=""> Participation des apprenants </h3>

                <!-- index -->
                <div class="row mt-3 bold">
                    <div class="col-5">
                        <span class="main-color">Nom et prénom</span>
                    </div>
                    <div class="col-5">
                        <span class="main-color">Email</span>
                    </div>
                    <div class="col-2 small">
                        Participation
                    </div>
                </div>
                <!-- ./index -->

                <!-- apprenants -->
                @foreach($apprenants as $apprenant)
                    <div class="row mt-1">
                        <div class="col-5">
                            <span class=""> {{ $apprenant->first_name.' '.$apprenant->last_name }} </span>
                        </div>
                        <div class="col-5">
                            <span class="">{{ $apprenant->email }}</span>
                        </div>
                        <div class="col-2">
                            @if(!$apprenant->participation_id)
                                <button class="btn btn-danger btn-presence" id="btn_presence_{{ $formation->id }}_{{ $apprenant->id }}">
                                    non
                                </button>
                            @else
                                <button class="btn btn-success btn-presence" id="btn_presence_{{ $formation->id }}_{{ $apprenant->id }}">
                                    oui
                                </button>
                            @endif
                        </div>
                    </div>
                @endforeach
                <!-- ./apprenants -->


            </div>
        </div>
        <!-- ./row -->
        @endcan
    </div>
@endsection
