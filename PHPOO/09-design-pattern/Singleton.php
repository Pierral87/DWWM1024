<?php 


/*

        -- Le pattern Singleton 

        Le Singleton garantit qu'une classe n'a qu'une seule instance dans toute l'application

        Ce pattern répond donc à la problématique de n'avoir qu'une seule et unique instance dans notre app, par exemple en web, la connexion au serveur de la BDD 
        Afin de préserver cette unicité, il est judicieux d'utiliser le pattern Singleton 

        // Un Singleton est composé de 3 caractéristiques : 
            // - Un attribut privé et statique qui conservera l'instance unique de la classe
            // - Une méthode statique qui permet soit d'instancier la classe soit de retourner 
            // - Un constructeur privé afin d'empêcher la création d'objet depuis le scope global 

    // Avantages du Singleton : Contrôle et centralise l'accès à une ressource unique (par exemple la connexion BDD)

*/

class Singleton {
    // Ici la props qui va contenir la seule et unique instance de notre classe
    private static $instance = null;

    // Ici le construct en private m'empêche d'instancier depuis le scope global, mais ne m'empêche pas d'instancier depuis la méthode getInstance()
    private function __construct() {}

    // Ici méthode statique pour créer OU retourner l'instance de l'objet si elle existe déjà 
    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new self; // new Singleton
        }
        return self::$instance;
    }

    // public function selectAll() {
    //     return "Tous les users";
    // }
}


$objet = Singleton::getInstance();
$objet1 = Singleton::getInstance();
$objet2 = Singleton::getInstance();
$objet3 = Singleton::getInstance(); // Ces variables représentent toutes le même objet (visible id 1 dans les var_dump suivant)
var_dump($objet);
var_dump($objet1);
var_dump($objet2);
var_dump($objet3);

// Et je ne peux plus instancier d'autres objets car le __construct est private, on préserve donc l'unicité de cette classe 
// $objet4 = new Singleton;
// var_dump($objet4);
// $objet5 = new Singleton;
// var_dump($objet5);
// $objet6 = new Singleton;
// var_dump($objet6);
// $objet7 = new Singleton;
// var_dump($objet7);
// $objet8 = new Singleton;
// var_dump($objet8);
// $objet9 = new Singleton;
// var_dump($objet9);
// $objet10 = new Singleton;
// var_dump($objet10);

// echo $objet1->selectAll();
// echo $objet2->selectAll();
// echo $objet3->selectAll();


?>

