<?php 

/* 

-------------------------- 1 Les constantes 
Les constantes dans une classe permettent de définir des "constantes", des valeurs qui ne changeront pas par la suite du code passé leur définition.
Les constantes de classe sont définies avec le mot clé const, contrairement aux constantes globales qui sont définies par define("URL", "www.monurlabsolue.com");
Par convention, on les nommera toujours en majuscule

-------------------------- 2 les propriétés et méthodes statics 
Les props et méthodes statiques appartiennent à la classe elle même et non aux objets instanciés à partir de cette classe.
C'est à dire que l'on peut accéder à ces éléments (props et méthode) sans instancier d'objet 
On les déclare en mettant le mot clé static après le niveau de visibilité de l'élément 
Et on les manipule en appelant le nom de la Class::$prop   Class::method()

-------------------------- 3 Le mot clé self 
Le mot clé self est utilisé pour accéder aux éléments static d'une classe à l'intérieur de cette même classe, c'est l'équivalent de $this, mais dans le contexte static
On écrira donc self::$prop  ou self::method()


*/


class Panier {
    const TVA = 20; // Constante de classe
    public static $totalProduits = 0; // Propriété static appartenant à la classe 
    public $nomPanier = "Mon panier"; // Propriété non static, appartenant à l'objet 

    public function ajouterProduit($prix) { // Methode non static, appartenant à l'objet
        self::$totalProduits += $prix; // self:: ici permet de pointer sur la prop static de la classe 
    }

    public static function afficherTotal() { // Methode static, appartenant à la classe 
        return "Total avec TVA : " . self::$totalProduits  * 1.2 . "€<hr>"; // self:: ici permet de pointer sur la prop static 
    }
}

// $panier = new Panier;
// var_dump($panier);

// echo $panier->TVA; // Erreur, cette constante n'appartient pas à l'objet 
// echo $panier->totalProduits; // Erreur, cette props n'appartient pas à l'objet mais à la classe !

// Voilà comment appeler des éléments static 
echo Panier::TVA . "<hr>";
echo Panier::$totalProduits . "<hr>";

echo Panier::afficherTotal();

$panier = new Panier;
$panier->ajouterProduit(20);
echo Panier::afficherTotal();
$panier->ajouterProduit(30);
echo Panier::afficherTotal();

// Tests des syntaxes PHP entre static et non static 

echo $panier->nomPanier; // Ok normal, sur un objet, j'appelle une prop de l'objet
$panier->ajouterProduit(30); // Ok normal, sur un objet j'appelle une méthode de l'objet 
// $panier->TVA; // Erreur, je ne peux pas appeler une constante dans un contexte objet (non static)

// Etonnemment les syntaxes ci dessous fonctionne... Cela est dû à la flexibilité du langage PHP et le fait qu'il soit permissif sur certaines instructions
// ATTENTION, on utilisera jamais ces syntaxes là, elle sera par ailleurs non autorisées dans d'autres langages de programmation OO, donc on s'habitue déjà à utiliser les éléments en fonction de leur contexte ! Un élément static doit TOUJOURS être appelé depuis la classe et non pas un objet de cette classe 
// donc toujours pour nous ici Panier::    et non pas $panier:: 
echo $panier::TVA; 
echo $panier::$totalProduits;




