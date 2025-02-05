<?php 

/* 

    --- Surcharge ou Override

    La surcharge ou override permet à une classe enfant de réécrire une méthode héritée de la classe parente afin de modifier son comportement

*/

class Animal {
    public $nom;
    public $age = 5;

    public function __construct($nom) {
        $this->nom = $nom;
    }

    public function seDeplacer(){
        echo "$this->nom se déplace.";
    }
}

class Oiseau extends Animal {
    public $age = 10; // Ici la nouvelle valeur de la prop écrase aussi celle reçue par héritage, mais on ne parle pas vraiment de surcharge ici 
    // On surcharge seDeplacer pour modifier le comportement 
    public function seDeplacer(){  // Ici le fait de redéfinir la méthode seDeplacer va écraser le comportement d'origine pour laisser place à son comportement spécifique. Ici notre oiseau vole plutôt que de simplement se déplacer.
        echo "$this->nom vole dans le ciel.";
    }
}

$oiseau = new Oiseau("Koko");
$oiseau->seDeplacer();
echo $oiseau->age;