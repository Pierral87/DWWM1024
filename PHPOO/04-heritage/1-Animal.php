<?php 

/* 

1 - Héritage simple 

L'héritage est un concept clé de la programmation orientée objet, permettant de créer des classes dérivées qui héritent des propriétés et méthodes d'une classe parent. Attention seuls les niveaux de visibilité public et protected seront hérités. 
Cela permet de réutiliser du code et d'ajouter des fonctionnalités supplémentaires dans les classes enfants 

Ici la classe Chien et la classe Chat héritent toutes deux de la classe Animal et bénéficient donc de ses propriétés et méthodes.
La classe enfant peut evidemment avoir ses propres nouvelles props et méthodes comme aboyer(), miauler() ou autre 

ATTENTION à respecter un contexte cohérent dans l'héritage 

    Il faut pouvoir dire que A est un B 
    Un chat est un animal
    Une voiture est un vehicule 
    Un admin est un user 

*/

class Animal 
{
    public $nom;

    public function __construct($nom)
    {
        $this->nom = $nom;
    }

    public function seDeplacer()
    {
        echo "$this->nom se déplace.";
    }
}

class Chien extends Animal // extends est le mot clé qui permet de définir un héritage entre deux classes, ici Chien hérite de Animal et donc "reçoit" ses props et méthodes tant qu'elles sont public ou protected (on ne récupère pas le private) 
{
    public function aboyer()
    {
        echo "$this->nom aboie : Wan wan!";
    }
}

class Chat extends Animal // extends est le mot clé qui permet de définir un héritage entre deux classes, ici Chat hérite de Animal et donc "reçoit" ses props et méthodes tant qu'elles sont public ou protected (on ne récupère pas le private) 
{
    public function miauler()
    {
        echo "$this->nom miaule : Nyan nyan!";
    }
}

// Test du chien 
$chien = new Chien("Fifi");
$chien->seDeplacer();
$chien->aboyer();

$chat = new Chat("Neko");
$chat->seDeplacer();
$chat->miauler();

