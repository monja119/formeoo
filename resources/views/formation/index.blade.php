@extends('base')
@section('title')
    Formations
@endsection

@vite(['resources/css/formation/style.css'])
@vite(['resources/js/pages/formation/index.js'])

@section('content')
    <div class="container-fluid">
        <div class="row mt-2 ">
            <div class="col-10">
                <h4><b>
                    Formations
                    </b>
                </h4>
            </div>
            <div class="col-1">
                <a href="{{ Route('planifier') }}">
                    <button class="planifier d-md-block d-lg-none btn btn bg-main-color rounded-5 text-white">
                        Planifier
                    </button>
                </a>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-10">
                <input type="number" class="form-control" placeholder="Code module (ex : 261)">
            </div>
            <div class="col-1">
                <button class="planifier btn bg-main-color text-white">
                    S'inscrire
                </button>
            </div>
        </div>

        <div class="row border-bottom border-black mt-5">
            <div class="col-6 text-center pb-3  bold-hover cursor-pointer nav-formation" id="all">
                <i class="fa fa-suitcase"></i>
                <span class=""> Formations</span>
            </div>
            <div class="col-6 h-100 bold-hover cursor-pointer text-center pb-3 nav-formation" id="modules">
                <i class="fa fa-book"></i>
                <span class=""> Modules</span>
            </div>
        </div>
    </div>

    <div class="row mt-1" id="content-formation">
        <h2> Fromations ... </h2>
    </div>
@endsection
