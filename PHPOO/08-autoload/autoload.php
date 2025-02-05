<?php 

/* 

    -- Autoloading : Le concept 

En PHP, l'autoloading est activé grâce à la fonction spl_autoload_register(). Cette fonction enregistre une ou plusieurs fonctions/méthodes à appeler automatiquement lorsque vous instanciez une classe qui n'a pas encore été incluse dans votre fichier  

L'intérêt de l'autoload ? 
Eviter de faire des require/include à la main pour toutes les classes dont on a besoin sur un fichier 
require_once("Classes/Article.php");
require_once("Classes/Article.php");
require_once("Classes/Article.php");
require_once("Classes/Article.php");
require_once("Classes/Article.php");
 
etc 

Le but étant que lorsque je lance une instanciation, l'autoload comprenne automatiquement qu'il doit inclure le bon fichier 

Lorsqu'il verra 
$article = new Article;
Il comprendra qu'il doit faire un require("Article.php");

*/

//  Création d'un autoload à la main 

function inclusionAuto ($class){

    // chemin où chercher mes classes 
    $file = __DIR__ . "/Classes/" . $class . ".php";

    // var_dump($file);

    // Je vérifie si le fichier existe
    if (file_exists($file)) {
        // Si oui, il est require_once
        require_once $file;
    }

}


// spl_autoload_register c'est une fonction qui se déclenche dès qu'elle voit une instanciation
// Elle comprend ici qu'elle doit lancer une fonction qui s'appelle inclusionAuto()
// Elle enverra automatiquement un param étant le nom la classe (comprennant aussi le nom du namespace s'il y en a un)
spl_autoload_register("inclusionAuto");