<?php 

/* 

Finalisation des classes et des méthodes 

Le mot clé final est utilisé pour empêcher l'héritage d'une classe ou la surcharge d'une méthode 

    Classe finale : Une classe marquée comme final ne peut pas être héritée
    Méthode finale : Une méthode marquée comme final ne peut pas être surchargée dans les classes filles 

    // Dans notre exemple ci dessous, la classe Chien hérite bien de seDeplacer() mais ne peut pas modifier son comportement
    // Aussi, on défini la classe Chien comme étant final, donc elle ne pourra pas induire de nouvelles sous-classes

*/ 

class Animal {
    public $nom;

    public function __construct($nom) {
        $this->nom = $nom;
    }

    // Méthode finale, ne pourra pas être surcharge dans les sous classes
    final public function seDeplacer() {
        echo "$this->nom se déplace.<hr>";
    }
}

$animal = new Animal("Pilou");
var_dump($animal);
var_dump(get_class_methods($animal));
echo $animal->seDeplacer();

final class Chien extends Animal { // Si je défini cette classe comme étant une classe finale, c'est la fin des héritages à partir de cette classe, elle ne pourra pas avoir de sous classe
    public function aboyer() {
        echo "$this->nom aboie : Wan wan!<hr>";
    }

    // public function seDeplacer() { // Erreur, je ne peux pas surcharger cette méthode, car je l'ai reçu finale par l'héritage 

    // }
}

// class Doberman extends Chien {} // Erreur - On ne peut pas hériter d'une classe finale

$chien = new Chien("Lardon");
$chien->aboyer();
$chien->seDeplacer();