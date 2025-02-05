<?php 

/*

Exercice 2 : Héritage et surcharge (gestion des comptes utilisateurs)

Objectif : Créer une classe de base CompteUtilisateur qui gère les informations générales d'un utilisateur. Ensuite, crée une classe dérivée ComptePremium qui hérite de CompteUtilisateur et qui ajoute des fonctionnalités spécifiques aux comptes premium.

Énoncé :

    Créer une classe CompteUtilisateur avec les propriétés protégées $nom et $email, ainsi qu'une méthode afficherInfos() qui affiche les informations de l'utilisateur.
    Créer une classe ComptePremium qui hérite de CompteUtilisateur et surcharge la méthode afficherInfos() pour ajouter "Compte Premium" dans les informations affichées.
    Instancier les deux types d’utilisateurs et appelle leurs méthodes afficherInfos().

*/

class CompteUtilisateur 
{
    protected $nom;
    protected $email;
    public function __construct($nom, $email) 
    {
        $this->nom = $nom;
        $this->email = $email;
    }
    public function afficherInfos() 
    {
        return "Nom : $this->nom, Email : $this->email";
    }
}

class ComptePremium extends CompteUtilisateur 
{
    public function afficherInfos() 
    {
        return parent::afficherInfos() . " (Compte Premium)";
    }
}

// Tests

$utilisateur = new CompteUtilisateur("Jean Dupont", "jean.dupont@example.com");
echo $utilisateur->afficherInfos() . "\n";

$utilisateurPremium = new ComptePremium("Marie Curie", "marie.curie@example.com");
echo $utilisateurPremium->afficherInfos() . "\n";