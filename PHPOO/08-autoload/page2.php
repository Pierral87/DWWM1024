<?php
// Le fait d'utiliser use ici m'évite de fournir le FQN pour l'instanciation de User
// Je peux aussi nommer un alias cela ne dérange pas le fonctionnement de l'autoload

use Controller\UserController;
use Model\User AS Utilisateur;


// Mon autoload est actif à partir de cette ligne
require_once("autoloadNamespace.php");

// Avec l'instanciation ci dessous, l'autoload comprend qu'il doit s'activer et va inclure automatiquement le fichier User.php contenu dans le dossier src/Model
// Ca fonctionne aussi si je ne fais pas forcement l'appel FQN, mais l'appel avec un use  

// Cet appel ne fonctionnera que si j'ai bien respecté ma norme de nommage des dossiers/fichiers 
$user = new Utilisateur;
$userController = new UserController

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
    <h2><?= $user->getNom(); ?></h2>
    <h2><?= $userController->getNom(); ?></h2>
</body>
</html>