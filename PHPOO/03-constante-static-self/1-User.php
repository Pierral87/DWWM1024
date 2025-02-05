<?php 

/* 

Contexte d'utilisation des éléments static

Exemple : Gestion des rôles utilisateurs 

Dans notre système de gestion d'utilisateurs, nous avons des rôles fixes pour les droits d'accès. 
Ici ROLE_ADMIN, ROLE_MODERATOR, ROLE_USER 
Plutot que d'utiliser des string séparés (et parfois se tromper à la saisie), on préfèrera stocker l'intégralité de ces éléments dans des constantes statiques.
Le fait de les "ranger" dans User, nous permet de les classer dans un contexte bien précis, plutôt qu'une constante globale 

*/

class User {
    const ROLE_ADMIN = "admin";
    const ROLE_MODERATOR = "moderator";
    const ROLE_USER = "user";

    private $role;

    public function __construct($role) {
        $this->role = $role;
    }

    public function getRole() {
        return $this->role;
    }

    public function isAdmin() {
        return $this->role === self::ROLE_ADMIN;
    }
}

// Après une identification de l'utilisateur réussi, on va créer un objet User 
$user = new User(User::ROLE_ADMIN);
echo $user->getRole();

echo $user->isAdmin() ? "Cet utilisateur est admin" : "Cet utilisateur n'est pas admin";