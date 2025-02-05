<?php 

/* 

    -- Utilisation de l'autoloading de Composer pour nos propres classes 

Composer, outre le fait d'être un outil puissant de gestion de dépendances d'un projet, il nous permet aussi d'intégrer directement un autoload sur notre projet.

L'autoload de composer est basé sur la norme PSR-4 qui va mapper les namespaces aux dossiers du projet et on définira un projet racine 

Il faut créer le fichier composer.json (aller voir ce fichier )

{
    "autoload": {
        "psr-4": {
            "ProjetPierra\\": "src/"
        }
    }
}
    Ici on spécifie l'appel de l'autoload de composer, en norme psr4 et on lui dit de lier notre namespace principal ProjetPierra au dossier src/ 

Une fois qu'on a fait ça, on doit dumper l'autoload avec la commande 
composer dump-autoload 
Composer va alors installer l'autoload dans notre projet (il va créer le dossier vendor et y installer ce dont il a besoin)

Maintenant il nous suffit d'inclure sur la page ici l'autoload de composer et il ajoutera les fichiers automatiquement comme nos autoload fait main
*/

use ProjetPierra\Controller\UserController;

// require de l'autoload de composer
require "vendor/autoload.php";

// Instanciation de notre objet contenu dans nos dossiers, suivant la norme PSR-4 
$controller = new UserController;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>

<?php 
/* 

    -- Avantages de l'autoload de composer 

        Support total de la norme PSR-4 : Composer suit parfaitement la norme PSR-4, qui est largement utilisée dans les projets moderne. Cela garantit une standardisation de notre organisation et compatible avec la plupart des bibliothèques externes.
        Plusieurs namespaces : On peut ajouter autant de namespace que nécessaire dans composer.json  pour loader via différents dossiers de notre projet 
        Gestion Centralisée : Composer gère l'autoloading pour vous, plus besoin de se soucier de la création d'autoload complexe 
        Modularité : Avec l'autoload PSR-4, comme toujours, on a une classe définie dans un fichier séparé, ce qui rend le projet plus modulable 

    -- L'autoloading est un mécanisme indispensable pour les projets modernes, on va manipuler de nombreuses classes et il permet de structure et d'organiser efficacement le code. L'idée étant de rendre le projet plus maintenable afin d'éviter les conflits et doublons de code. 

*/