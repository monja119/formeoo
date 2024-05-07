@extends('base')
@section('title')
    Admin - Formeoo
@endsection

@vite(['resources/css/pages/profile.css'])
@vite(['resources/js/pages/profile/admin.js'])

@section('content')
    <div class="profile-header pt-1 border-bottom border-black pb-2">
        <!-- entité -->

        <div class="row">
            <div class="col-2">
                <img src="{{ asset('storage/images/logo.png') }}" class="border-0 pdp"  alt="nexta"/>
            </div>

                <div class="col-3 small d-flex flex-column mt-3">
                    <div class="d-flex flex-row align-items-center">
                        <span class="ml-1 mt-1 fw-bold"> {{ $user->first_name.' '.$user->last_name  }} </span>
                    </div>
                    <div class="d-flex flex-row align-items-center">
                        <span class="fw-bold"> 20 </span>
                        <span class="ml-2 small"> Modules </span>
                    </div>
                    <div class="0d-flex flex-row align-items-center">
                        <span class="fw-bold"> 100 </span>
                        <span class="ml-1 small">Formations </span>
                    </div>
                </div>
                <div class="col-3 small mt-3">
                    <div class="d-flex flex-row align-items-center">
                        <i class="fa fa-user main-color "></i>
                        <span class="ml-1 mt-1"> {{ $user->role }}</span>
                    </div>
                    <div class="d-flex flex-row align-items-center">
                        <i class="fa fa-envelope main-color"></i>
                        <span class="ml-1 "> {{ $user->email  }}</span>
                    </div>
                </div>
                <div class="col-3 small" style="width: 100px; height: 100px">
                        <canvas id="participation"></canvas>
                </div>
                <div class="col-1 ml-5 d-flex flex-column justify-content-center align-items-center">

                    <a href="/logout">
                        <button id="logout" class="btn btn-danger mt-1 w-100">
                            <i class="fa fa-sign-out-alt"></i>
                        </button>
                    </a>
                </div>


        </div>
        <!-- ./entity -->
    </div>


    <!-- content profile -->
    <section id="content" class="mt-2 p-1">
        <div class="row justify-content-center">
            <div class="col-5">
                <canvas id="diagnostic-total"></canvas>
            </div>
        </div>
        <div class="row mt-2 mb-5">
            <div class="col-12">
                <canvas id="diagnostic-months"></canvas>
            </div>
        </div>
    </section>
    <!-- ./content profile -->

@endsection
