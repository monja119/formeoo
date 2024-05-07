@extends('base')
@section('title')
    Utilisateurs - Formeoo
@endsection

@vite(['resources/js/pages/users/index.js'])
@section('content')
    <div class="container-fluid">
        <div class="row mt-2 ">
            <div class="col-10">
                <h4><b>
                        Utilisateurs
                    </b>
                </h4>
            </div>
            <div class="col-2">
                <a href="{{ Route('new.invitation') }}" class="w-100 mr-5">
                    <button class="btn w-100 bg-main-color rounded-5 text-white">
                        Inviter
                    </button>
                </a>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-10">
                <input type="text" class="form-control" placeholder="Nasandratra">
            </div>
            <div class="col-1">
                <button class="planifier btn btn-primary text-white">
                    Rechercher
                </button>
            </div>
        </div>

        <div class="row border-bottom border-black mt-5">
            <div class="col-4 text-center pb-3  bold-hover cursor-pointer nav-user" id="apprenants">
                <i class="fa fa-users"></i>
                <span class="">Apprenants</span>
            </div>
            <div class="col-4 text-center pb-3  bold-hover cursor-pointer nav-user" id="formateurs">
                <i class="fa fa-user"></i>
                <span class="">Formateurs</span>
            </div>
            <div class="col-4 h-100 bold-hover cursor-pointer text-center pb-3 nav-user" id="invitations">
                <i class="fa fa-envelope"></i>
                <span class="">Invitations</span>
            </div>
        </div>

        <div class="row  mt-5" id="content-user">
            <div class="col-12">
                <div class="d-flex flex-row justify-content-center align-items-center">
                    <h3 class="main-color">
                        Gérer vos utilisateurs dans cette page
                    </h3>
                </div>
            </div>
        </div>
    </div>

@endsection
