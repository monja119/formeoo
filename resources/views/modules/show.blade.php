@extends('base')
@section('title')
    {{ $module->titre }}
@endsection

<meta name="csrf-token" content="{{ csrf_token() }}" />
@csrf

@vite(['resources/js/pages/modules/show.js'])

@section('content')
    <input type="hidden" name="module" value="{{ $module->id }}">
    <div class="row mt-4">
        <div class="col-9 main-color">
            <h4>
                <b>
                    {{ $module->titre}}
                </b>
            </h4>
        </div>
        <div class="col-3 d-flex flex-row justify-content-end align-items-center">
            @can('admin')
            <i class="fa fa-edit text-primary cursor-pointer"></i>
            <i class="fa fa-trash text-danger cursor-pointer ml-5"></i>
            @endcan
            @cannot('admin')
            <input id="user_id" type="hidden" value="{{ session()->get('user')->id }}" />
            <input id="module_id" type="hidden" value="{{ $module->id }}" />

            @if($is_signed)
                <input id="quitter" type="button" class="btn btn-danger" value="Quitter" />
            @else
                <input id="inscription" type="button" class="btn btn-primary" value="S'inscrire" />
            @endif
            @endcannot
        </div>
    </div>

    <div class="card mt-1">
        <div class="card-body">
        <div class="row">
            <div class="col-6">
                <!-- module_id -->
                <div class="mt-3">
                        <span class="small fw-bold"> code : </span>
                        <span class="small"> {{ $module->id }} </span>
                </div>
                <!-- ./module_id -->
                <!-- description -->
                <div class="mt-1">
                    <div class="block">
                        <p class="small" id="description">
                            {{ $module->description }}
                        </p>
                    </div>
                </div>
                <!-- ./description -->


                <div class="row">
                    <!-- objectifs -->
                    <div class="mt-3 col-12 d-flex flex-column">
                        <span class="opacity-50 fw-bold small">Objectifs</span>
                        <div class="block">
                            <ul class="small" id="list-objectif">
                                @foreach($objectifs as $objectif)
                                    <li>{{ $objectif->objectif }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- ./objectifs -->

                <!-- compétences -->
                <div class="row">
                    <div class="mt-3 col-12 d-flex flex-column">
                        <span class="opacity-50 fw-bold small">Compétences visées</span>
                        <div class="block">
                            <ul class="small" id="list-objectif">
                                @foreach($competences as $competence)
                                    <li>{{ $competence->competence }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- ./compétences -->

                <!-- prerequis -->
                <div class="row">
                    <div class="mt-3 col-12 d-flex flex-column">
                        <span class="opacity-50 fw-bold small">Prérequis pour poursuivre</span>
                        <div class="block">
                            <ul class="small" id="list-objectif">
                                @foreach($prerequis as $prerequi)
                                    <li>{{ $prerequi->prerequis }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- ./prerequis -->

            </div>

            <div class="col-6 d-flex flex-column align-items-center justify-content-center">
                <h1 class="main-color" id="apprenant_count">
                    {{ $apprenant_count }}
                </h1>
                <span class=""> Apprenants </span>
            </div>
        </div>
        </div>
    </div>

    <hr />
    <div class="row mt-5">
        <h6 class="">
                Suivi global de la formation sur
            <span class="fw-bold main-color">
                {{ $module->titre }}
            </span>
        </h6>
    </div>
    <div class="row mt-4 mb-3">
        <div class="col-12">
            <canvas id="chart-line"></canvas>
        </div>
    </div>


    <!-- apprenant -->
    <div class="mt-5">
        <hr />
        <div class="row">
            <h6 class="main-color">
                Suivi personnel
            </h6>
        </div>
        <div class="row mt-3">
            <div class="col-12">
                <label for="apprenant" class="opacity-50 fw-bold small">Nom de l'apprenant</label>
                <div class="row">
                    <div class="col-12">
                        <input type="hidden" name="apprenant_id" id="apprenant_id" required/>
                        <input type="text" class="form-control" name="apprenant" id="apprenant" required/>
                        <div class="mt-1 d-flex flex-column border" id="select-apprenant">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section class="mt-5">
            <div class="row">
                <div class="col-3 d-flex flex-column align-items-center justify-content-center">
                    <canvas id="chart-pie-perso"></canvas>
                </div>
                <div class="col-9">
                    <canvas id="chart-line-perso"></canvas>
                </div>
            </div>
        </section>
    </div>
    <!-- ./apprenant -->


@endsection
