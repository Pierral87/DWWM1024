<?php 

/* 

Les cookies sont des fichiers de données que les serveurs web peuvent créer sur notre ordinateur ! (dans notre navigateur) 

Ca permet aux applications web de conserver des informations d'une session à l'autre, telles que des préférences d'un utilisateur (langue, thème, monnaie ou autre) même après la fermeture du navigateur.

En PHP, les cookies sont gérés par la superglobale $_COOKIE, sous forme de clé => valeur, encore une fois, c'est un tableau array !!!  

Syntaxe et manipulation d'un cookie : 

    1 - Création d'un cookie 
        Avec la fonction setcookie() - ATTENTION - Cette instruction doit être appelé avant tout contenu HTML sinon elle ne fonctionnera pas !  

        setcookie(nom, valeur, expiration) 

    2 - Lecture d'un cookie 
        Les cookies déjà définis seront lisibles dans $_COOKIE, à l'indice de leur nom, si j'ai créé un cookie s'appelant "langue" j'aurai un indice "langue" dans $_COOKIE

    3 - Suppression d'un cookie : 
        Pour supprimer un cookie il faut lui donner une date passée (avec la fonction time() on récupère le timestamp donc on fait généralement time() - 1  pour supprimer un cookie)

*/

if (isset($_COOKIE["theme"])) {
    $theme = $_COOKIE["theme"];
    setcookie("theme", $theme, time() + (365*24*60*60));
} else {
    $theme = "clair";
    setcookie("theme", $theme, time() + (365*24*60*60));
}

if (isset($_GET["theme"])) {
    $theme = $_GET["theme"];
    setcookie("theme", $theme, time() + (365*24*60*60));
}

var_dump($_COOKIE);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exemple de gestion de thème avec cookie</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: <?= $theme == "sombre" ? "#333" : "#fff"; ?>; color: <?= $theme == "sombre" ? "#fff" : "#333"; ?>" > 
    <div class="container mt-5">
        <h1>Choisir un thème</h1>
        <p>
            <a href="?theme=clair" class="btn btn-light ">Thème Clair</a>
            <a href="?theme=sombre" class="btn btn-dark ">Thème Sombre</a>
        </p>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>