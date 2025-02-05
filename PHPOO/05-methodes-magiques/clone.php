<?php 

class Ecole 
{
    public $nom = "Cloud Campus";
    public $nombreEtudiants = 100;

    public function __clone() 
    { // Un clone est toujours faisable avec l'instruction clone meme si la méthode magique n'existe pas, mais on peut si l'on souhaite appliquer un traitement spécifique ici dans la méthode magique, qui s'appliquera sur le nouvel objet copié (et non pas sur l'objet servant de modèle !)
        $this->nombreEtudiants = 0;
    }

}

$ecole1 = new Ecole; // ici on crée un premier objet, id 1 visible avec le var_dump
var_dump($ecole1);

$ecole2 = new Ecole; // ici on crée un second objet, id 2 visible avec le var_dump
$ecole2->nom = "Pierra School";
$ecole2->nombreEtudiants = 2;
var_dump($ecole2);

// $ecole3 = $ecole1; Si je lance cette instruction tel quelle, cela ne crée pas de nouvel objet !!!!! Cela rajoute simplement un "pointeur" vers l'objet id 1, c'est à dire que $ecole1 et $ecole3 représente le même objet, donc, une modification sur l'un ou l'autre, impacterons le même objet 

$ecole3 = clone $ecole1; // Par contre, si j'appelle l'instruction clone, ici un réel objet sera créé et inséré dans $ecole3 en prenant pour modèle les valeurs contenues dans $ecole1, le nouvel objet aura un id différent, ici 3 

var_dump($ecole1);
var_dump($ecole3);

echo "<hr>Ici dessous après modif de ecole3 Campus du cloud<br>";
$ecole3->nom = "Campus du cloud"; // Si je n'ai pas fait un clone avant, ici je modifie aussi bien $ecole1 que $ecole3, en fait, l'objet id1 
$ecole3->nombreEtudiants = 20;
echo "<hr>Ici dessous var_dump de ecole1<br>";
var_dump($ecole1);
echo "<hr>Ici dessous var_dump de ecole2<br>";
var_dump($ecole2);
echo "<hr>Ici dessous var_dump de ecole3<br>";
var_dump($ecole3);



// ---------------------------
// C'est aussi faisable avec des variables, pour créer en quelques sortes, des "alias" d'autres var avec des noms peut être trop long
// grâce au & devant le nom de la var à copier, on creera un variable copie de la première, mais qui pointera bien vers la même valeur 
$var1 = 10;
$var2 = &$var1;

echo "var 1 $var1  et puis var 2  $var2 <hr>";
$var1 = 20;
echo "var 1 $var1  et puis var 2  $var2";

