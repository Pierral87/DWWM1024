<?php 

// Amélioration de notre autoload pour gérer les namespaces et les sous-dossiers 

// Comme vu dans le chapitre namespace, les projets modernes utilisent les namespaces pour une organisation des classes dans des sous-dossiers
// On fera aussi en sorte de respecter la norme PSR-4 pour aller piocher nos classes dans les dossiers correspondant aux namespace 

function inclusionAuto ($class){

    // Dépendant du fonctionnement des accès aux fichiers du serveur, il faudra remplacer les backslash du nom namespace\class en slash classique, sinon on ne trouvera pas le fichier
    // (C'est généralement ce qu'il faut toujours faire!)
    $class = str_replace('\\',  '/', $class);
    // chemin où chercher mes classes  (dans ce second cas, elles sont dans le dossier src)
    $file = __DIR__ . "/src/" . $class . ".php";

    // var_dump($file);

    // Je vérifie si le fichier existe
    // if (file_exists($file)) {
        // Si oui, il est require_once
        require_once $file;
    // }

}


spl_autoload_register("inclusionAuto");
