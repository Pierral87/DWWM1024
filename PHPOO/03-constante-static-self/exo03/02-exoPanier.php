<?php 

/* 

Exercice 2 : Gestion de Panier avec static et const

Objectif : Créer un système simple de gestion de panier avec une classe Panier qui utilise des propriétés et méthodes statiques pour gérer le nombre total de produits et des constantes pour définir des paramètres spécifiques au panier.

Énoncé :

    Créez une classe Panier qui contiendra :
        Une constante MAX_ITEMS qui définira le nombre maximum d'articles dans le panier.
        Une propriété statique $totalItems qui contiendra le nombre total d'articles en cours dans le panier.
        Une méthode statique ajouterProduit($quantite) qui permet d'ajouter un produit au panier (en respectant la limite définie par MAX_ITEMS).
        Une méthode statique afficherTotal() qui affiche le nombre total d'articles dans le panier.

*/

class Panier
{
    const MAX_ITEMS = 10;

    private static $totalItems = 0;

    public static function ajouterProduit($quantite)
    {
        // Vérification si le nombre total d'articles ne dépasse pas la limite MAX_ITEMS
        if (self::$totalItems + $quantite <= self::MAX_ITEMS) {
            self::$totalItems += $quantite;
            echo "Produit ajouté ! Total des articles : " . self::$totalItems . "\n";
        } else {
            echo "Erreur : Vous ne pouvez pas ajouter plus de " . self::MAX_ITEMS . " articles au panier.\n";
        }
    }

    public static function afficherTotal()
    {
        echo "Nombre total d'articles dans le panier : " . self::$totalItems . "\n";
    }
}

Panier::ajouterProduit(2);
Panier::afficherTotal();
Panier::ajouterProduit(20);
Panier::afficherTotal();
Panier::ajouterProduit(5);
Panier::afficherTotal();

