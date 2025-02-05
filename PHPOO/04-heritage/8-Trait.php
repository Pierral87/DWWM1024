<?php 

/* 

    -- Trait 

    Les traits permettent de regrouper des méthodes (et des props, mais moins courant) réutilisables dans des classes sans utiliser l'héritage.
    Les traits sont utiles pour éviter la duplication de code entre des classes qui ne partagent pas un même héritage 
    Tout comme les interfaces, on peut implémenter plusieurs traits à la fois, ce qui fait sauter la limite de l'héritage 

    Ici on utilise le même trait qui permet d'apporter une nouvelle méthode à deux éléments qui n'ont pourtant aucuns liens entre eux.

*/

trait Identifiable {
    public function afficheId() {
        echo "mon Id est : " . uniqid();
    }
}

class Utilisateur1 {
    use Identifiable;
}

class Produit {
    use Identifiable;
}

$utilisateur = new Utilisateur1;
$produit = new Produit;

$utilisateur->afficheId();
$produit->afficheId();
