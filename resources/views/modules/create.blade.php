@extends('base')
@section('title')
    Création module - Formeoo
@endsection

@vite(['resources/js/pages/modules/index.js'])
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>
@section('content')
<section id="create-module-section">
    <header class="row mt-4 d-flex flex-row p-1 border-bottom">
        <div>
            <h5 class="fw-bold">
                Créer un nouveau module
            </h5>
        </div>
    </header>

    <div class="mt-4">
        <form>
            @csrf
            <span id="error" class="text-danger">

            </span>
            <!-- titre -->
            <input type="text" name="titre" class="form-control mt-1" id="titre" placeholder="Titre" required/>
            <!-- ./titre -->

            <!-- objectifs -->
            <div class="mt-3">
                <span class="opacity-50 fw-bold small">Objectifs</span>
                <div class="block">
                    <ul class="small" id="list-objectif">

                    </ul>
                    <div class="row">
                        <div class="col-10">
                            <input type="text" class="form-control" id="input-add-objectif" placeholder="ex : comprendre la méthode agile"/>
                        </div>
                        <div class="col-2">
                            <input type="button" id="objectif" class="btn btn-primary" value="Ajouter"/>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ./objectifs -->


            <!-- competences -->
            <div class="mt-3">
                <span class="opacity-50 fw-bold small">Compétences visées</span>
                <div class="block">
                    <ul class="small" id="list-competence">

                    </ul>
                    <div class="row">
                        <div class="col-10">
                            <input type="text" class="form-control" id="input-add-competence" placeholder="ex : le leadership"/>
                        </div>
                        <div class="col-2">
                            <input type="button" id="competence" class="btn btn-primary" value="Ajouter"/>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ./competences -->

            <!-- description -->
            <div class="mt-3">
                <span class="opacity-50 fw-bold small">Déscription</span>
                <div class="block">
                    <textarea class="form-control" id="description" name="description"></textarea>
                </div>
            </div>
            <!-- ./description -->

            <!-- prerequis -->
            <div class="mt-3">
                <span class="opacity-50 fw-bold small">Prérequis pour poursuivre</span>
                <div class="block">
                    <ul class="small" id="list-prerequis">

                    </ul>
                    <div class="row">
                        <div class="col-10">
                            <input type="text" class="form-control" id="input-add-prerequis" placeholder="ex : de quoi à noter "/>
                        </div>
                        <div class="col-2">
                            <input type="button" id="prerequis" class="btn btn-primary" value="Ajouter"/>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ./prerequis -->

            <div class="row justify-content-center mt-3">
                <button id="submit" type="button" class="btn btn-success col-5">
                    Valider
                </button>
            </div>

        </form>
    </div>

</section>

@endsection
