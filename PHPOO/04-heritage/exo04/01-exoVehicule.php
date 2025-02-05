<?php 

/*

    Exercice 1 : 
        Modifier le code des classes pour répondre aux questions ci-dessous

    1. Faire en sorte de ne pas avoir d'objet Vehicule (abstract sur la classe Vehicule)
    2. Obligation pour la Renault et la Peugeot de posséder exactement la même méthode démarrer() (final sur la méthode demarrer)
    3. Obligation pour la Renault de déclarer un carburant diesel et pour la Peugeot de déclarer un carburant essence (abstract sur la methode carburant dans vehicule, redéclaration dans les sous classes)
    4. La Renault doit effectuer 30 test de + qu'un véhicule de base (redéclaration dans les sous classe et appel avec parent:: pour récupérer la valeur contenu dans la méthode d'origine)
    5. La Peugeot doit effectuer 70 test de + qu'un vehicule de base  
    6. Testez

    */

    abstract class Vehicule1
    {
        final public function demarrer() 
        {
            return "je démarre";
        }

        abstract public function carburant();

        public function nombreDeTests() 
        {
            return 100;
        }
    }

    class Peugeot extends Vehicule1
    {
        public function carburant() {
            return "essence";
        }

        public function nombreDeTests() {
            return parent::nombreDeTests() + 70;
        }
    }

    class Renault extends Vehicule1 
    {
        public function carburant() {
            return "diesel";
        }

        public function nombreDeTests() {
            return parent::nombreDeTests() + 30;
        }
    }

    $peugeot = new Peugeot;
    $renault = new Renault;

    echo $peugeot->demarrer();
    echo $renault->demarrer();
    echo $peugeot->carburant();
    echo $renault->carburant();
    echo $peugeot->nombreDeTests();
    echo $renault->nombreDeTests();


