<?php 

/* 

    Exemple : Héritage dans la gestion des utilisateurs 

    Si on a plusieurs types d'utilisateurs : User, Admin, Moderator, ou autre 
    On va définir une classe de base User et définir dans un second temps des classes qui héritent de celle ci 


*/


// Je défini ici une interface logout qui oblige à définir un logout spécifique
interface Logout {
    public function logout();
}



// Déclaration de ma classe utilisateur de base implémentant logout donc obligation de définir logout
class Utilisateur implements Logout {
    protected $nom;
    protected $email; 

    public function logout() {
        return "Je me deconnecte de façon classique";
    }

    public function __construct($nom, $email) {
        $this->nom = $nom;
        $this->email = $email;
    }

    public function getDetails() {
        return "Nom : $this->nom, Email : $this->email";
    }

    public function seConnecter() {
        return "$this->nom s'est connecté";
    }
}


// J'hérite de tous les éléments de utilisateur 
class Administrateur extends Utilisateur{
    private $role = "Administrateur";

    // Je surcharge logout pour amener un traitement spécifique
    public function logout() {
        return "Je me deconnecte des droits admin en plus";
    }

    // je surcharge getDetails pour amener un traitement spécifique
    public function getDetails() {
        // ici la syntaxe parent::getDetails me permet d'atteindre la méthode getDetails du parent malgré la surcharge 
        return parent::getDetails() . ", Role : $this->role";
    }

    // Nouvelle méthode propre à la sous classe 
    public function gererUtilisateurs(){
        return "Accès à la page de gestion des users";
    }
}

$admin = new Administrateur("admin", "admin@mail.com"); 

echo $admin->logout();