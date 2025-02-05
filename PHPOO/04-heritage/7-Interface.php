<?php 


/* 

    -- Interface 

    Une interface est une structure qui définit un ensemble de méthodes vides !  
    En implémentant une interface on oblige la classe qui l'implémente à définir les méthodes en question 

    L'avantage des interfaces, est qu'on peut en implémenter plusieurs à la fois ! Contrairement à l'héritage d'une classe abstract qui est limité à l'héritage d'une seule classe (l'héritage tout court est toujours limité à une seule classe)

*/

interface AnimalInterface {
    public function communiquer();
}

interface Mammifere {
    public function metBas();
}

class Chien implements AnimalInterface, Mammifere {
    public function communiquer() {
        echo "Le chien aboie";
    }

    public function metBas() {
        echo "Hop un bébé animal";
    }
}

class Chat implements AnimalInterface {
    public function communiquer() {
        echo "Le chat miaule";
    }
}