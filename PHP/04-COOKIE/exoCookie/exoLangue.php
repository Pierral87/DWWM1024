<?php

/*

    EXERCICE COOKIE :
            Mémorisation d'un choix de langue par l'utilisateur : 

                Etapes : 
                    - 1 Créer 4 liens HTML représentant des langues 
                    - 2 Via le GET, transmettre les informations de la langue cliquée
                    - 3 En fonction de la langue cliquée, créer un cookie correspondant
                    - 4 Vérifier le fonctionnement en revenant sur la page pour voir si la langue a été mémorisée (afficher la langue sélectionnée ou une phrase dans la langue en question)
                    - 5 Bien faire en sorte que le choix de langue soit cohérent (quelle serait la priorité entre le cookie, le choix utilisateur, le choix par défaut)

*/ 
$phrases = [
    'fr' => "Bonjour, bienvenue sur notre site",
    "en" => "Hello, welcome to our website",
    "es" => "Buenos dias, bienvenido a nuestro sitio",
    "it" => "Ciao, bienvenuto nel nostro sito",
    "jp" => "こんにちは、私たちのサイトへようこそ"
];

$langueAffichage = [
    'fr' => "Français",
    "en" => "Anglais",
    "es" => "Espagnol",
    "it" => "Italien",
    "jp" => "Japonais"
];

    if (isset($_GET["langue"])) {
        $langue = $_GET["langue"];
        setcookie("langue", $langue, time() + 365*24*60*60);
    } elseif (isset($_COOKIE["langue"])) {
        $langue = $_COOKIE["langue"];
        setcookie("langue", $langue, time() + 365*24*60*60);
    } else {
        $langue = "fr";
        setcookie("langue", $langue, time() + 365*24*60*60);
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choix de la langue</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Choisissez votre langue</h1>
    <div class="d-flex justify-content-between align-items-center">
        <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                Langues
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <li><a class="dropdown-item" href="?langue=fr">Français</a></li>
                <li><a class="dropdown-item" href="?langue=en">Anglais</a></li>
                <li><a class="dropdown-item" href="?langue=es">Espagnol</a></li>
                <li><a class="dropdown-item" href="?langue=it">Italien</a></li>
                <li><a class="dropdown-item" href="?langue=jp">Japonais</a></li>
            </ul>
        </div>

        <div class="alert alert-info mb-0">
            Langue sélectionnée : <strong><?= $langueAffichage[$langue] ?></strong>
        </div>
    </div>
    
    <div class="mt-4 p-3 bg-light border">
        <h2>Message :</h2>
        <p><?= $phrases[$langue] ?></p>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>