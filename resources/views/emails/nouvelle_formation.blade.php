<html lang="fr">
<head>
    <title>Nouvelle formation sur {{ $data['titre'] }}</title>
    @vite(['resources/css/bootstrap.min.css'])
    @vite(['resources/css/fontawesome-free/css/all.min.css'])
</head>
<body>
<div class="container-fluid">
    <h1> Bonjour, {{ $data['formateur']['first_name'].' '.$data['formateur']['last_name'] }}</h1>
    <p>
        Une nouvelle formation sur le module {{ $data['titre'] }} a été planifiée. <br>
        Elle aura lieu le {{ $data['date'] }} de  {{ $data['heure_debut'] }} à {{ $data['heure_fin'] }} à {{ $data['lieu'] }}. <br>
        <a href="{{ $data['lien'] }}">
            <input type="button" class="bg-primary text-white" value="Accepter"
                   style="background-color: #0d6efd; color :white; margin-top: 15px"/>
        </a>
    </p>
</div>
</body>
</html>

