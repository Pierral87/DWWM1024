<?php 

/* 

    La programmation orientée objet repose sur quelques concepts clés comme les classes, les objets et les instances. 
    Elle inclut aussi les notions de visibilité qui contrôlent l'accès aux propriétés et aux méthodes.



    1 - Déclaration d'une classe 
    Une classe en PHP est un modèle qui définit des propriétés et des méthodes qui seront partagées par les objets créés à partir de cette classe.
*/

    class Voiture {
        // Propriétés (attributs)
        public $marque;
        public $couleur;
        protected $km; 
        private $moteur;

        // Méthodes (fonctions) 
        public function demarrer() {
            return "La voiture démarre";
        }

        protected function ajouterKm() {
            return "J'ajoute des kms";
        }

        private function ouvertureCapot() {
            return "Le capot est ouvert";
        }
    }

    // 2 - Instanciation d'une classe 
    // Pour utiliser une classe, on doit créer un objet à partir de celle-ci. C'est ce qu'on appelle l'instanciation 

    // Instanciation de la classe Voiture 
    $maVoiture = new Voiture();

    // Assignation de valeurs aux propriétés 
    $maVoiture->marque = "Toyota";
    $maVoiture->couleur = "Rouge";
    // $maVoiture->km = 2000; // Fatal Error, je n'ai pas le droit d'accéder à une propriété protected
    // $maVoiture->moteur = "moteur"; // Fatal error, je n'ai pas le droit d'accéder à une propriété private 

    // $maVoiture->ajouterKm(); // Fatal Error, je n'ai pas le droit d'accéder à une méthode protected
    // $maVoiture->ouvertureCapot(); // Fatal Error, je n'ai pas le droit d'accéder à une méthode private 

    // Appel de la méthode démarrer()
    echo $maVoiture->demarrer();
    echo $maVoiture->marque;

    // Je crée ici un nouvel objet, il est totalement indépendant du premier, il a ses propres valeurs, différentes du premier 
    $maVoiture2 = new Voiture();
    $maVoiture2->marque = "Peugeot";
    $maVoiture2->couleur = "Bleue";

    // Pour voir les props de l'objet 
    var_dump($maVoiture);
    var_dump($maVoiture2);

    // Pour voir les méthodes de l'objet 
    var_dump(get_class_methods($maVoiture));

    /* 
        Les niveaux de visibilité : 
            Public : Les propriétés/méthodes publiques sont accessibles depuis n'importe où, y compris depuis l'extérieur de la classe (dans le scope global en gros)
            Protected : Les propriétés/méthodes protected sont accessibles uniquement à l'intérieur de la classe (scope local) et ses classes dérivées (héritage), les éléments protected que ce soit méthode ou props seront récupérés par héritage 
            Private : Les propriétés/méthodes private sont accessibles uniquement à l'intérieur de la classe (scope local) et ne sont pas héritées ! 


    */


?>