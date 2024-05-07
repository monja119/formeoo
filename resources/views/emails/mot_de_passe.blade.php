<html lang="fr">
<head>
    <title>Invitation à rejoindre Formeoo</title>
    @vite(['resources/css/bootstrap.min.css'])
    @vite(['resources/css/fontawesome-free/css/all.min.css'])
    @vite(['resources/css/base.css'])
    @vite(['resources/css/responsive.css'])
</head>
<body>
<div class="container-fluid">
    <h1> {{ $user['first_name'].' '.$user['last_name'] }}</h1>
    <p>
        Vous êtes désormais parmis nous, Formeoo. <br>
        Votre mot de passe est : <br>
            <strong>{{ $password }}</strong>

        <br>
        Ne le partagez pas avec quelqu'un d'autre.
    </p>
</div>
</body>
</html>

