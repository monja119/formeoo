<html lang="fr">
<head>
    <title>
        Inscription - Formeoo
    </title>
    @vite(['resources/css/bootstrap.min.css'])
    @vite(['resources/css/login.css'])
    @vite(['resources/css/base.css'])

    @vite(['resources/js/forms/register.js'])
</head>
<body>
    <div class="container-fluid">
        <div class="row d-flex flex-row justify-content-center align-items-center mt-5">
            <img class="logo" src="{{ asset('storage/images/logo.png') }}" alt="logo">
        </div>

        <div class="row d-flex flex-row justify-content-center align-items-center mt-3">
            <div class="col-md-12 col-lg-6 d-flex flex-row justify-content-center align-items-center">
                <img class="logo" src="{{ asset('storage/images/register.png') }}" alt="formation">
            </div>
            <div class="col-md-12 col-lg-6 d-flex flex-column">
                <h3> S'inscrire sur  Formeoo </h3>

                @if(session('error_msg'))
                    <div class="m-1 small text-danger">{{ session('error_msg') }}</div>
                @endif

                <div class="mt-1 p-1">
                    <!-- login form -->
                    <form method="post" action="{{ Route('register') }}">
                        @csrf

                        <div class="p-1 d-flex flex-row align-items-center">
                            <label for="account_type">Je suis un</label>
                            <select id="account_type" name="account_type" class="form-control ml-2 w-25">
                                <option value="user">Apprenant</option>
                                <option value="entity">Entité (formateur)</option>
                            </select>
                        </div>

                        <!-- apprenant-space -->
                        <div class="apprenant-space">
                            <input class="form-control rounded-5" type="text" name="first_name" id="first_name" placeholder="Nom" maxlength="100"  />

                            <input class="form-control rounded-5 mt-2" type="text" name="last_name" id="last_name" placeholder="Prénom" maxlength="100"  />

                            <!-- gender -->
                            <div class="mt-2 pl-1 small">
                                <input type="radio" id="homme" name="gender" value="homme" checked>
                                <label for="homme">Homme</label>
                                <input type="radio" id="femme" name="gender" value="femme">
                                <label for="femme">Femme</label>
                            </div>
                            <!-- ./gender -->
                            <input class="form-control rounded-5 mt-2" type="date" name="birth" id="birth" placeholder="Date de Naissance"  />
                        </div>
                        <!-- ./apprenant-space -->


                        <!-- entity-space -->
                        <div class="entity-space">
                            <input class="form-control rounded-5" type="text" name="name" id="name" placeholder="Nom de l'entité" maxlength="100"  />

                            <!-- description textare -->
                                <textarea class="form-control mt-2" name="description" id="description" placeholder="Déscription" maxlength="1000" rows="3"></textarea>
                            <!-- ./description textare -->

                            <input class="form-control rounded-5 mt-2" type="text" name="website" id="website" placeholder="Site web" maxlength="100"  />

                        </div>
                        <!-- ./entity space -->

                        <input class="form-control rounded-5 mt-2" type="text" name="address" id="address" placeholder="Adresse" maxlength="100" required />

                        <input class="form-control rounded-5 mt-2" type="number" name="telephone" id="telephone" placeholder="Téléphone" maxlength="15" required />

                        <input class="form-control rounded-5 mt-2 " type="email" name="email" id="email" placeholder="Email" required />

                        <input class="form-control rounded-5 mt-3" type="text" name="password" id="password" placeholder="Mot de passe" required />

                        <input class="form-control mt-2 rounded-5" type="text" name="password2" id="password2" placeholder="Rétaper le mot de passe" required />

                        <div class="row mt-3 p-3">
                            <input type="submit" class="btn text-white rounded-5 col-md-12 col-lg-6" value="S'inscrire" />
                            <div class="col-md-12 col-lg-6 text-center pt-2">
                                <a href="{{ Route('login') }}" class="text-decoration-underline"> Se connecter </a>
                            </div>
                        </div>
                    </form>
                    <!-- ./login form -->
                </div>

            </div>

        </div>
        <!-- foot -->
        <div class="row">
            @extends('footer')
        </div>
        <!-- ./foot -->

    </div>
</body>
</html>
