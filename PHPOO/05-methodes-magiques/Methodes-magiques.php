<?php

/* 

    Les Méthodes Magiques en PHP

    Les méthodes magiques sont des fonctions spéciales en PHP qui commencent toujours par deux underscores (__). Elles permettent d'intercepter certaines opérations sur les objets et d'ajouter des comportements personnalisés. 

    1 : __construct : Le constructeur 
        Le constructeur est une méthode appelée automatiquement lors de la création d'une nouvelle instance d'une classe. Elle est généralement utilisée pour initialiser les propriétés d'un objet 

    2 : __destruct : Le destructeur 
        Le destructeur est appelé automatiquement lorsque l'objet est détruit ou lorsque le script se termine. 
        Il peut être utilisé pour effectuer des opérations de nettoyage, comme la fermeture d'une connexion à une bdd par exemple

     3 : __get et __set : Accéder et modifier des propriétés non définies 
        Ces méthodes permettent de gérer dynamiquement l'accès aux propriétés d'une classe qui ne sont pas définies    

     4 : __call et __callStatic : Accéder à des méthodes non définies 

     5 : __toString : Conversion d'un objet en chaine de caractère 
        Cette méthode est appelée lorsqu'un objet est utilisé comme une chaine de caractères (avec un echo par exemple)

     6 : __invoke() : Appeler un objet comme une fonction 

     7 : __sleep() __wakeup() : sérialisation et désérialisation d'objets 
*/

class Societe
{
    public $adresse;
    public $ville;
    public $cp;

    public function __construct($adresse, $ville, $cp)
    {
        $this->adresse = $adresse;
        $this->ville = $ville;
        $this->cp = $cp;
    }

    public function __destruct()
    {
        echo "C'est fini pour aujourd'hui<hr>";
    }

    public function __set($nom, $valeur) {
        echo "Attention la prop $nom n'existe pas, donc la valeur : $valeur, n'a pas été transmise<br>";
    }

    public function __get($nom) {
        echo "La propriété $nom n'existe pas, vous n'avez pas pu l'afficher donc...<hr>";
    }
}

$societe = new Societe("1 avenue foch", "Paris", "75000");
var_dump($societe);

$societe->nom = "Adidas";
echo $societe->nom;





