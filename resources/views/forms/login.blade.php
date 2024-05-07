<html lang="fr">
<head>
    <title>
        Connexion - Formeoo
    </title>
    @vite(['resources/css/bootstrap.min.css'])
    @vite(['resources/css/login.css'])
    @vite(['resources/css/base.css'])
</head>
<body>
    <div class="container-fluid">
        <div class="row d-flex flex-row justify-content-center align-items-center mt-5">
            <img class="logo" src="{{ asset('storage/images/logo.png') }}" alt="logo">
        </div>

        <div class="row d-flex flex-row justify-content-center align-items-center mt-3">
            <div class="col-md-12 col-lg-6 d-flex flex-row justify-content-center align-items-center">
                <img class="logo animation-slide-in animation-duration-1" src="{{ asset('storage/images/page_principale.png') }}"  alt="formation">
            </div>
            <div class="col-md-12 col-lg-6 d-flex flex-column">
                <h3> Gérer vos modules de formation avec Formeoo </h3>

                @if(session('error_msg'))
                    <div class="m-1 small text-danger">{{ session('error_msg') }}</div>
                @endif
                <div class="p-1">
                    <!-- login form -->
                    <form method="post" action="{{ Route('login') }}">
                        @csrf
                        <input class="form-control rounded-5" type="email" name="email" id="email" placeholder="Votre email" required />

                        <input class="form-control mt-2 rounded-5" type="password" name="password" id="password" placeholder="Votre mot de passe" required />

                        <div class="row mt-3 p-3">
                            <input type="submit" class="btn text-white rounded-5 col-md-12 col-lg-6" value="Se connecter" />
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
