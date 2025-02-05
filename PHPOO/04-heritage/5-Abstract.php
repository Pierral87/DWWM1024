<?php 

/* 

    -- Classes abstraites et méthodes abstraites 

    Une classe abstraite ne peut pas être instanciée directement, mais elle sert de modèle pour d'autres classes.
    Elle contient en général des méthodes abstraites qui doivent être définies dans les classes enfants. 

        Methode abstraite : Une méthode déclarée mais non implémentée dans la classe abstraite (classe mère). Elle oblige les classes filles à définir cette méthode 

    Ici on ne peut pas instancier Animals car elle est abstraire et on est obligé de redéfinir communiquer() dans toutes nos sous classes pour fournir à chacune sa propre implémentation

    L'utilisation des classes abstraites permet de fournir un cadre strict de développement pour que tous les développeurs de l'équipe travaillant sur cette classe et sous classe, s'assurent de travailler de la même manière ou en tout cas de nommer la méthode communiquer() comme prévu par la classe abstraite.

*/

abstract class Animals { // Ici je défini ma classe comme étant une classe abstraite, je ne peux plus l'instancier
    public $nom;

    public function __construct($nom) {
        $this->nom = $nom;
    }

    abstract public function communiquer(); // Cette méthode est abstraite donc ne peut pas contenir de body (pas d'accolades), une méthode abstraite ne peut etre contenu que dans une classe déjà elle même abstraite 
}

// $animal = new Animal("Pilou"); // Erreur, on ne peut pas instancier une classe abstract 

class Chien extends Animals {

    // abstract public function communiquer();

    public function communiquer() {
        echo "$this->nom aboie : Wan wan!";
    }
}

// class Doberman extends Chien {

// }

class Chat extends Animals {

    public function communiquer() {
        echo "$this->nom miaule : Nyan nyan!";
    }
}

class Oiseau extends Animals {

    public function communiquer() {
        echo "$this->nom chante : Piou piou!";
    }
}

$chien = new Chien("Pilou");
echo $chien->nom;
