@extends('base')
@section('title')
    @if(session()->has('user'))
        {{ session()->get('user')->first_name }} {{ session()->get('user')->last_name }}
    @elseif(session()->has('entity'))
        {{ session()->get('entity')->name }}
    @endif
    - Formeoo
@endsection

@vite(['resources/css/pages/profile.css'])
@vite(['resources/js/pages/profile/index.js'])

@section('content')
    <div class="profile-header pt-1">
        <!-- entité -->

        <div class="row">
            <div class="col-2">
                <img src="{{ asset('storage/images/nexta.png') }}" class="rounded-circle pdp"  alt="nexta"/>
            </div>

            @if(session()->has('entity'))
            <div class="col-3 small d-flex flex-column">
                <div class="d-flex flex-row align-items-center">
                    <span class="ml-1 mt-1 fw-bold"> Entreprise Informatique</span>
                </div>
                <div class="d-flex flex-row align-items-center">
                    <span class="fw-bold"> 0 </span>
                    <span class="ml-2 small"> Formations </span>
                </div>
                <div class="0d-flex flex-row align-items-center">
                    <span class="fw-bold"> 0 </span>
                    <span class="ml-1 small">Suivis </span>
                </div>
            </div>
            <div class="col-6 small">
                <div class="d-flex flex-row align-items-center">
                    <i class="fa fa-envelope main-color"></i>
                    <span class="ml-1 "> {{ session()->get('entity')->email  }}</span>
                </div>
                <div class="d-flex flex-row align-items-center">
                    <i class="fa fa-book main-color"></i>
                    <span class="ml-1 "> {{ $user_module_count  }} inscrits</span>
                </div>
                <div class="d-flex flex-row align-items-center">
                    <i class="fa fa-location main-color "></i>
                    <span class="ml-1 "> {{ session()->get('entity')->address  }} </span>
                </div>
                <div class="d-flex flex-row align-items-center">
                    <i class="fa fa-earth main-color "></i>
                    <span class="ml-1 "> {{ session()->get('entity')->website  }} </span>
                </div>
            </div>
            <div class="col-1 d-flex flex-column justify-content-start align-items-center">
                <input type="button" class="btn btn-primary" value="Suivre" />
                <button id="logout" class="btn btn-danger mt-1 w-100">
                    <i class="fa fa-sign-out-alt"></i>
                </button>
            </div>

            @endif

        </div>
        <div class="d-flex flex-row ml-4 mt-2 align-items-center">
            <span class="fw-bold entity-name" >
                @if(session()->has('user'))
                    {{ session()->get('user')->first_name }} {{ session()->get('user')->last_name }}
                @elseif(session()->has('entity'))
                    {{ session()->get('entity')->name }}
                @endif
            </span>
        </div>
        <div class="row mt-4">
            <div class="description col-12 ml-4 opacity-75 p-1">
                {{ session()->get('entity')->description }}
            </div>
        </div>
        <!-- ./entity -->
    </div>

    <!-- navbar profile-->
    <div class="row border-top mt-4">
        <div class="col-12 navbar-profile d-flex flex-row align-items-center justify-content-center">
            <nav id="module" class="navbar-profile-item">
                <i class="fa fa-gauge"></i>
                <span class="">Rapport</span>
            </nav>
            <nav id="module" class="navbar-profile-item">
                <i class="fa fa-book"></i>
                <span class="">Modules</span>
            </nav>
            <nav id="settings" class="navbar-profile-item">
                <i class="fa fa-cog"></i>
                <span class="">Paramètres</span>
            </nav>
        </div>
    </div>
    <!-- ./navbar profile -->

    <!-- content profile -->
    <section id="content" class="mt-2 p-1">
        Contenu
    </section>
    <!-- ./content profile -->

@endsection
