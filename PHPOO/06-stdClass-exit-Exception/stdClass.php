<?php 

/*

    1 -- stdClass : L'objet générique en PHP 

        En PHP, la classe stdClass est une classe générique pour créer des objets simples contenant simplement des props et leurs valeurs.
        Souvent utilisée lorsque nous avons besoin d'un objet mais qu'on ne souhaite pas déclarer explicitement une classe.
        C'est aussi la classe définie par défaut lors de conversion de type ou parfois de retour de valeur dans un objet plutôt qu'un array 

*/

 // Création d'objet avec stdClass

 $objet = new stdClass();
 $objet->nom = "Pierra";
 $objet->age = 37;
 var_dump($objet);

 // Ici l'objet de type stdClass est créé et l'ajout de props dynamique y est autorisé
 // On peut ainsi le manipuler tout comme on manipulerait un tableau array, pour stocker des données de notre choix sous forme de key/value ou plutôt prop/value 

//  Conversion d'un tableau en stdClass : 
$array = ["nom" => "Bob", "age" => 12];
var_dump($array);

// Conversion du array en objet stdClass
$objet2 = (object) $array; 
var_dump($objet2);
echo $objet2->nom;

// L'avantage de stdClass : Simple et léger d'utilisation, pour des objets temporaires ou des structures de données.

// Limite de cette classe : Pas de méthode, pas d'héritage, c'est juste du stockage, tout comme un array

