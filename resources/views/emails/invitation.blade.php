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
        <h1> Bonjour, {{ $data['first_name'].' '.$data['last_name'] }}</h1>
        <p>
            Vous avez été invité à rejoindre Formeoo. <br>
            Une plateforme de gestion de modules de formation en ligne. <br>
            Veuillez cliquer sur le lien ci-dessous pour accepter l'invitaion. <br>
            <a href="{{ $data['url'] }}">
                <input type="button" class="bg-main-color text-white" value="Accepter"/>
            </a>
        </p>
    </div>
</body>
</html>

