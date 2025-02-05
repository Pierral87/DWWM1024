<?php 

// require_once("Classes/Article.php");

// Mon autoload est actif à partir de cette ligne
require ("autoload.php");

// Avec l'instanciation ci dessous, l'autoload comprend qu'il doit s'activer et va inclure automatiquement le fichier Article.php contenu dans le dossier Classes 
$article = new Article;
// $user = new User;


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Test de mon autoload</h1>
    <h2><?= $article->getNom(); ?></h2>
    <h2><?= $user->getNom(); ?></h2>
</body>
</html>